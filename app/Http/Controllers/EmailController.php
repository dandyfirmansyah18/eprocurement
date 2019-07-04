<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailRegistrasi;
use Mail;

class EmailController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function send_email_registrasi()
    {
        // $data = EmailRegistrasi::where('type', $type)->where('status', 0)->get();
        $data = EmailRegistrasi::where('status', 0)->get();
        // update status to 2 semua
        foreach($data as $datas){
            $update = EmailRegistrasi::where('id', $datas->id)->update(['status' => 2]);
        }

        foreach($data as $data_send){
            if ($data_send->type == 0)
            {
                $user_email_data    = [
                    'email'             => $data_send->email,
                    'name'              => $data_send->name,
                    'attachment'        => $data_send->attachment,
                    'data'              => [
                                            'name' => $data_send->name,
                                            'verification_time' => $data_send->verification_time,
                                            ],
                ];

                $send_email =   \Mail::send('emails.user.registration', $user_email_data['data'], function ($m) use ($user_email_data) {
                                    $attachment = storage_path() . '/app/public/' . $user_email_data['attachment'];
                                    $m->from('eproc.edi-indonesia@gmail.com', 'EDI Indonesia');
                                    $m->to($user_email_data['email'], $user_email_data['name'])->subject('Konfirmasi Pendaftaran Penyedia - PT. EDI Indonesia');
                                    // $m->attach($attachment, ['as' => 'Berkas Pendaftaran']);
                                });
            }else{
                $admin_email_data   = [
                    'email'             => 'eproc.edi-indonesia@gmail.com',
                    'name'              => $data_send->name,
                    'data'              => [
                                            'url' => $data_send->url,
                                            ],
                ];
                
                $send_email =   \Mail::send('emails.admin.registration', $admin_email_data['data'], function ($m) use ($admin_email_data) {
                                    $m->from('eproc.edi-indonesia@gmail.com', 'EDI Indonesia');
                                    // $m->to('wulan@multiterminal.co.id', $admin_email_data['name']);
                                    // $m->to('andry@multiterminal.co.id', $admin_email_data['name']);
                                    // $m->to('diaz@multiterminal.co.id', $admin_email_data['name']);
                                    // $m->to('yaumil@multiterminal.co.id', $admin_email_data['name']);
                                    // $m->cc($admin_email_data['email'], $admin_email_data['name']);
                                    $m->to('dandygantengkok@gmail.com', $admin_email_data['name']);
                                    $m->subject('Konfirmasi Pendaftaran Penyedia - PT. EDI Indonesia');
                                });
            }

            // update status to 1
            $update_to_one = EmailRegistrasi::where('id', $data_send->id)->update(['status' => 1]);
        }

        return 'DONE';
    }
    
}
