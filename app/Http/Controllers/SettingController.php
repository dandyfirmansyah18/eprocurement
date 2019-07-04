<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\OptionHelper;
use App\Models\Option;

class SettingController extends Controller
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
    
    public function main_registration()
    {
        $registration_on        = Option::vendor_registration();

        return view('pengaturan.pendaftaran', [
            'registration_on'    => $registration_on
        ]);
    }

    public function toggle_registration(Request $request)
    {
        $item_id = OptionHelper::save_registration($request->value);

        return redirect('/pengaturan/pendaftaran');
    }
}
