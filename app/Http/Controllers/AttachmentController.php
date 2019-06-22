<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

use App\Helpers\AttachmentHelper;
use App\Helpers\CompanyHelper;
use App\Helpers\CompanyCertificateHelper;

use Carbon\Carbon;

class AttachmentController extends Controller
{
    public function company_entity_upload(Request $request)
    {
        // print_r($request->file); die();
    	$result_id     = 0;
    	$company_id    = CompanyHelper::touch($request->user_id);
    	if($company_id > 0) {
    		$uploaded_files         = $request->file('files');
	    	if ($uploaded_files != null && count($uploaded_files) > 0) {
	    		$timestamp          = time();
                $extension          = $uploaded_files[0]->getClientOriginalExtension();
                $original_filename  = $uploaded_files[0]->getClientOriginalName();
                $target_filename    = $request->purpose . '/' . $timestamp . '.' . $extension;
                Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_files[0]));

                $data = array(
                	'entity_type' => 'company', 'entity_id' => $company_id, 'purpose' => $request->purpose,
                	'filepath' => $target_filename, 'filename' => $original_filename, 'user_id' => $request->user_id
                );

                $result_id = AttachmentHelper::save_data($data);
	    	}

	    	return response()->json([
	            'status' => 'OK',
	            'id' => $result_id,
	            'filepath' => $target_filename,
	            'filename' => $original_filename
	        ]);
    	} else {
    		return response()->json([
                'status' => 'ERROR',
                'message' => 'User tidak terdaftar'
            ]);
    	}
    }

    public function certificate_entity_upload(Request $request)
    {
    	$result_id     = 0;
    	$company_id    = CompanyHelper::touch($request->user_id);

    	if($company_id > 0) {
    		$uploaded_files         = $request->file('files');
	    	if ($uploaded_files != null && count($uploaded_files) > 0) {
	    		$timestamp          = time();
                $extension          = $uploaded_files[0]->getClientOriginalExtension();
                $original_filename  = $uploaded_files[0]->getClientOriginalName();
                $target_filename    = 'certificate/' . $timestamp . '.' . $extension;
                Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_files[0]));

                $data = array(
                	'entity_type' => 'company', 'entity_id' => $company_id, 'purpose' => $request->purpose,
                	'filepath' => $target_filename, 'filename' => $original_filename, 'user_id' => $request->user_id
                );

                $result_id = AttachmentHelper::save_data($data);
	    	}

	    	return response()->json([
	            'status' => 'OK',
	            'id' => $result_id,
	            'filepath' => $target_filename,
	            'filename' => $original_filename
	        ]);
    	} else {
    		return response()->json([
                'status' => 'ERROR',
                'message' => 'User tidak terdaftar'
            ]);
    	}
    }

    public function planning_entity_upload(Request $request)
    {
        $result_id = 0;
        $target_filename = '';
        $original_filename = '';

        $uploaded_files         = $request->file('files');
        if ($uploaded_files != null && count($uploaded_files) > 0) {
            $timestamp          = time();
            $extension          = $uploaded_files[0]->getClientOriginalExtension();
            $original_filename  = $uploaded_files[0]->getClientOriginalName();
            $target_filename    = 'planning_document/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_files[0]));

            $data = array(
                'entity_type'   => 'planning',
                'entity_id'     => $request->id,
                'purpose'       => $request->purpose,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $result_id = AttachmentHelper::save_data($data);
        }

        return response()->json([
            'status'    => 'OK',
            'id'        => $result_id,
            'filepath'  => $target_filename,
            'filename'  => $original_filename
        ]);
    }

    public function pseudo_planning_entity_upload(Request $request)
    {
        $result_id = 0;

        $uploaded_files         = $request->file('files');
        if ($uploaded_files != null && count($uploaded_files) > 0) {
            $timestamp          = time();
            $extension          = $uploaded_files[0]->getClientOriginalExtension();
            $original_filename  = $uploaded_files[0]->getClientOriginalName();
            $target_filename    = 'planning_document/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_files[0]));

            $data = array(
                'entity_type'   => 'pseudo_planning',
                'entity_id'     => $request->id,
                'purpose'       => $request->purpose,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $result_id = AttachmentHelper::save_data($data);
        }

        return response()->json([
            'status'    => 'OK',
            'id'        => $result_id,
            'filepath'  => $target_filename,
            'filename'  => $original_filename
        ]);
    }

    public function verification_upload(Request $request)
    {
        $result_id = 0;

        $uploaded_files         = $request->file('files');
        if ($uploaded_files != null && count($uploaded_files) > 0) {
            $timestamp          = time();
            $extension          = $uploaded_files[0]->getClientOriginalExtension();
            $original_filename  = $uploaded_files[0]->getClientOriginalName();
            $target_filename    = 'planning_document/' . $timestamp . '.' . $extension;

            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_files[0]));

            $request->session()->put('temp_id', rand());

            $data = array(
                'entity_type'   => 'planning',
                'entity_id'     => $request->id,
                'purpose'       => $request->purpose,
                'filepath'   => $target_filename,
                'filename' => $original_filename
            );

            $result_id = AttachmentHelper::save_data($data);
        }

        return response()->json([
            'status'    => 'OK',
            'id'        => $result_id,
            'filepath'  => $target_filename,
            'filename'  => $original_filename
        ]);
    }

    public function procurement_entity_upload(Request $request)
    {
    	$result_id = 0;

        $uploaded_files = $request->file('files');
        if ($uploaded_files != null && count($uploaded_files) > 0) {
            $timestamp = time();
            $extension = $uploaded_files[0]->getClientOriginalExtension();
            $original_filename = $uploaded_files[0]->getClientOriginalName();
            $target_filename = $request->purpose . '/' . $timestamp . '.' . $extension;
            Storage::disk('local')->put('public/' . $target_filename,  File::get($uploaded_files[0]));

            $data = array(
                'entity_type' => 'procurement', 'entity_id' => $request->procurement_id, 'purpose' => $request->purpose,
                'filepath' => $target_filename, 'filename' => $original_filename
            );

            $result_id = AttachmentHelper::save_data($data);
        }

        return response()->json([
            'status' => 'OK',
            'id' => $result_id,
            'filepath' => $target_filename,
            'filename' => $original_filename
        ]);
    }

    public function remove_by_path(Request $request)
    {
        $filepath = $request->filepath;
        $user_id = $request->user_id;
    	$removed = AttachmentHelper::remove_data($filepath, $user_id);

    	return response()->json([
            'status' => 'OK',
            'filepath' => $filepath
        ]);

    }
}
