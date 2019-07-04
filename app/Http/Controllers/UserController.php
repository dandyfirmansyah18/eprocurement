<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UserHelper;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function update_password(Request $request)
    {
        $user_id        = intval($request->user_id);
        $old_password   = $request->password['old'];
        $new_password   = $request->password['new'];

        $updated_id     = UserHelper::change_password($user_id, $old_password, $new_password);

        if($updated_id == 0) {
            return response()->json([
                'status' => 'ERROR'
            ]);
        } else {
            return response()->json([
                'status' => 'OK',
                'id' => $updated_id
            ]);
        }
    }
}
