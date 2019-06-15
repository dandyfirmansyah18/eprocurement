<?php // Company Helper

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

use App\Models\Attachment;
use App\Models\FileLog;

class AttachmentHelper
{

    public static function save_data($data)
    {
        if (isset(Auth::user()->id)) {
            $id_user = Auth::user()->id;
        }else{
            $id_user = $data['user_id'];
        }

    	$result_id      = 0;
        $purpose        = null;

        $entity_type    = $data['entity_type'];
        $entity_id      = $data['entity_id'];

        $existing_item  = Attachment::where('entity_type', $entity_type)->where('entity_id', $entity_id);

        if(array_key_exists('purpose', $data)) {
            $purpose        = $data['purpose'];
            $existing_item  = $existing_item->where('purpose', $purpose)->first();
        } else {
            $existing_item  = $existing_item->first();
        }

        if($existing_item != null) {
            $log_data   = array(
                'user_id'       => $id_user,
                'old_name'      => $existing_item->filename,
                'old_path'      => $existing_item->filepath,
                'new_name'      => $data['filename'],
                'new_path'      => $data['filepath'],
            );

            $existing_item->filepath     = $data['filepath'];
            $existing_item->filename   = $data['filename'];

            $existing_item->save();

            $result_id = $existing_item->id;

            $log_id = FileActivityHelper::write_log($result_id, $log_data);
        } else {
            $log_data   = array(
                'user_id'       => $id_user,
                'old_name'      => 'none',
                'old_path'      => 'none',
                'new_name'      => $data['filename'],
                'new_path'      => $data['filepath'],
            );

            $item                   = new Attachment;
            $item->entity_type      = $entity_type;
            $item->entity_id        = $entity_id;
            $item->purpose          = $purpose;
            $item->filepath         = $data['filepath'];
            $item->filename         = $data['filename'];

            $item->save();

            $result_id = $item->id;

            $log_id = FileActivityHelper::write_log($result_id, $log_data);
        }

        return $result_id;
    }

    public static function parse_pseudo($pseudo_id, $purpose, $new_id)
    {
        $items      = Attachment::where('entity_type', 'pseudo_' . $purpose)
                                    ->where('entity_id', $pseudo_id)
                                    ->get();

        foreach($items as $item) {
            $item->entity_type  = $purpose;
            $item->entity_id    = $new_id;
            $item->save();
        }

        return true;
    }

    public static function parse_pseudo_with_purpose($data)
    {
        $items              = Attachment::where('entity_type', $data['entity_type'])
                                    ->where('entity_id', $data['entity_id'])
                                    ->where('purpose', $data['purpose'])
                                    ->get();

        foreach($items as $item) {
            $item->purpose  = $data['new_purpose'];
            $item->save();
        }

        return true;
    }

    public static function remove_data($filepath, $user_id = '')
    {
        if (isset(Auth::user()->id)) {
            $id_user = Auth::user()->id;
        }else{
            $id_user = $user_id;
        }

        $item = Attachment::where('filepath', $filepath)->first();
        if($item != null) {
            $log_data   = array(
                'user_id'       => $id_user,
                'old_name'      => $item->filename,
                'old_path'      => $item->filepath,
                'new_name'      => 'none',
                'new_path'      => 'none',
            );

            $deleted_id = $item->id;

            $last_log   = FileLog::where('new_path', $item->filepath)->first();
            if($last_log->old_path == 'none') {
                $item->delete();
            } else {
                $item->filename    = $last_log->old_name;
                $item->filepath      = $last_log->old_path;
                $item->save();
            }

            $log_id = FileActivityHelper::write_log($deleted_id, $log_data);

            return true;
        }

        return false;
    }

    public static function remove($entity_type, $entity_id, $purpose)
    {
        $attachment = Attachment::where('entity_type', $entity_type)
                            ->where('entity_id', $entity_id)
                            ->where('purpose', $purpose)
                            ->first();
        if($attachment != null) {
            $attachment->delete();
            return true;
        }

        return false;
    }

    public static function company_remove($entity_id)
    {
        $items = Attachment::where('entity_type', 'company')
                    ->where('entity_id', $entity_id)
                    ->get();
        if($items != null) {
            foreach($items as $item) {
                FileLog::where('attachment_id', $item->id)->delete();
                $item->delete();
            }

            return true;
        }

        return false;
    }

    public static function render_assurance_file($id)
    {
        $attachment = Attachment::assurance_entity($id);
        if($attachment != null) {
            return AuxHelper::render_file_url($attachment->filepath, $attachment->filename);
        } else {
            return '';
        }
    }
}
