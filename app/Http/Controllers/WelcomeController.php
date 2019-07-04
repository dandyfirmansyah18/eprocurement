<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Option;
use App\Models\User;
use Mail;

class WelcomeController extends Controller
{
    public function main()
    {
    	if(Auth::user() != null) {
    		return redirect('/dashboard');
    	} else {
            $registration_on    = Option::vendor_registration();
        	return view('welcome', [
                'registration_on'    => $registration_on
            ]);
    	}
    }

    public function cobaemailbos()
    {
        // $data = ['nama' => 'Prayit'];
        $user = User::where('id', '0000000157')->first();
        // print_r($user->name);die();
        $email = $user->email;
        $name = $user->name;
        $pin = $user->pin;

        $data    = [
                'email'             => $email,
                // 'name'              => 'PT ANUGRAH BAROKAH ABADI',
                'name'              => $user->name,
                'pin'               => $user->pin,
                'type'              => 'user',
                'action'            => 'pin-request',
            ];
            // print_r($data['email']);die();
        $sendemail = \Mail::send('emails.user.pin-request', $data, function ($mail) use ($data)
                        {           
                            $mail->from('eproc.mti@gmail.com', 'Multi Terminal Indonesia');                               
                            $mail->to($data['email']);
                            $mail->subject('Konfirmasi PIN - PT. Multi Terminal Indonesia');
                        });
    }    
}
