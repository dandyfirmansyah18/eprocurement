<?php // Company Helper

namespace App\Helpers;

use App\Models\FileLog;

use Carbon\Carbon;

class FileActivityHelper
{

    public static function write_log($attachment_id, $data)
    {
        $item                   = new FileLog;
        $item->user_id          = $data['user_id'];
        $item->attachment_id    = $attachment_id;
        $item->old_name         = $data['old_name'];
        $item->old_path         = $data['old_path'];
        $item->new_name         = $data['new_name'];
        $item->new_path         = $data['new_path'];
        $item->save();

        return $item->id;
    }
}