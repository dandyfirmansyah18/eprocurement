<?php // Mail Helper

namespace App\Helpers;

use Illuminate\Support\Facades\Redis;

use App\Jobs\SendEmailWithMandrill;
use App\Models\User;
use App\Models\Company;
use Mail;
use PDF;
use Carbon\Carbon;

class MailHelper
{
    public static function queue($data = [])
    {
        if ($data['type'] == 'user') {
            if ($data['action'] == 'pin-request') {
                $data['subject']  = 'Konfirmasi PIN - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.pin-request';
                dispatch(new SendEmailWithMandrill($data));
            } else if ($data['action'] == 'registration') {
                $data['subject']  = 'Konfirmasi Pendaftaran Penyedia - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.registration';
                dispatch(new SendEmailWithMandrill($data));
            } else if ($data['action'] == 'verification') {
                $data['subject']  = 'Verifikasi Penyedia - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.verification';
                dispatch(new SendEmailWithMandrill($data));
            } else if ($data['action'] == 'redo_verification') {
                $data['subject']  = 'Verifikasi Penyedia - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.redo_verification';
                dispatch(new SendEmailWithMandrill($data));
            } else if ($data['action'] == 'rejection') {
                $data['subject']  = 'Verifikasi Penyedia - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.rejection';
                dispatch(new SendEmailWithMandrill($data));
            } else if ($data['action'] == 'reset-password') {
                $data['subject']  = 'Reset Password - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.reset-password';
                dispatch(new SendEmailWithMandrill($data));
            } else if ($data['action'] == 'change-password') {
                $data['subject']  = 'Ubah Password - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.change-password';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'skrtproccess') {
                $data['subject']  = 'SKRT Proses TTD - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.skrtproccess';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'skrtdone') {
                $data['subject']  = 'SKRT Selesai - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.user.skrtdone';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'undangan') {
                $data['subject']  = 'Undangan - PT. Indonesia Kendaraan Terminal';
                $data['template'] = 'emails.user.undangan';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'reminder') {
                $data['subject']  = 'Reminder Upload - PT. Indonesia Kendaraan Terminal';
                $data['template'] = 'emails.user.reminder_upload';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'pembukaan') {
                $data['subject']  = 'Pembukaan Penawaran - PT. Indonesia Kendaraan Terminal';
                $data['template'] = 'emails.user.pembukaan';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'evaluasi') {
                $data['subject']  = 'Evaluasi Penawaran - PT. Indonesia Kendaraan Terminal';
                $data['template'] = 'emails.user.evaluasi';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'negotiation') {
                $data['subject']  = 'Negoisasi - PT. Indonesia Kendaraan Terminal';
                $data['template'] = 'emails.user.negotiation';
                dispatch(new SendEmailWithMandrill($data));
            }else if ($data['action'] == 'pemenang') {
                $data['subject']  = 'Pemenang - PT. Indonesia Kendaraan Terminal';
                $data['template'] = 'emails.user.pemenang';
                dispatch(new SendEmailWithMandrill($data));
            }
        } else if ($data['type'] == 'admin') {
            if ($data['action'] == 'registration') {
                $data['subject']  = 'Konfirmasi Pendaftaran Penyedia - PT. Multi Terminal Indonesia';
                $data['template'] = 'emails.admin.registration';
                dispatch(new SendEmailWithMandrill($data));
            }
        }
    }

    public static function sendEmail($data = [])
    {
        if ($data['type'] == 'user') {
            if ($data['action'] == 'pin-request') {
                $data['subject']  = 'Konfirmasi PIN - PT. XXX';
                $data['template'] = 'emails.user.pin-request';
            } else if ($data['action'] == 'registration') {
                $data['subject']  = 'Konfirmasi Pendaftaran Penyedia - PT. XXX';
                $data['template'] = 'emails.user.registration';
            } else if ($data['action'] == 'verification') {
                $data['subject']  = 'Verifikasi Penyedia - PT. XXX';
                $data['template'] = 'emails.user.verification';
            } else if ($data['action'] == 'redo_verification') {
                $data['subject']  = 'Verifikasi Penyedia - PT. XXX';
                $data['template'] = 'emails.user.redo_verification';
            } else if ($data['action'] == 'rejection') {
                $data['subject']  = 'Verifikasi Penyedia - PT. XXX';
                $data['template'] = 'emails.user.rejection';
            } else if ($data['action'] == 'reset-password') {
                $data['subject']  = 'Reset Password - PT. XXX';
                $data['template'] = 'emails.user.reset-password';
            } else if ($data['action'] == 'change-password') {
                $data['subject']  = 'Ubah Password - PT. XXX';
                $data['template'] = 'emails.user.change-password';
            }else if ($data['action'] == 'skrtproccess') {
                $data['subject']  = 'SKRT Proses TTD - PT. XXX';
                $data['template'] = 'emails.user.skrtproccess';
            }else if ($data['action'] == 'skrtdone') {
                $data['subject']  = 'SKRT Selesai - PT. XXX';
                $data['template'] = 'emails.user.skrtdone';
            }else if ($data['action'] == 'undangan') {
                $data['subject']  = 'Undangan - PT. XXX';
                $data['template'] = 'emails.user.undangan';
            }else if ($data['action'] == 'reminder') {
                $data['subject']  = 'Reminder Upload - PT. XXX';
                $data['template'] = 'emails.user.reminder_upload';
            }else if ($data['action'] == 'pembukaan') {
                $data['subject']  = 'Pembukaan Penawaran - PT. XXX';
                $data['template'] = 'emails.user.pembukaan';
            }else if ($data['action'] == 'evaluasi') {
                $data['subject']  = 'Evaluasi Penawaran - PT. XXX';
                $data['template'] = 'emails.user.evaluasi';
            }else if ($data['action'] == 'negotiation') {
                $data['subject']  = 'Negoisasi - PT. XXX';
                $data['template'] = 'emails.user.negotiation';
            }else if ($data['action'] == 'pemenang') {
                $data['subject']  = 'Pemenang - PT. XXX';
                $data['template'] = 'emails.user.pemenang';
            }else if ($data['action'] == 'url-register') {
                $data['subject']  = 'Link Registrasi e-Procurement PT. XXX';
                $data['template'] = 'emails.user.link_registrasi';
            }
        } else if ($data['type'] == 'admin') {
            if ($data['action'] == 'registration') {
                $data['subject']  = 'Konfirmasi Pendaftaran Penyedia - PT. XXX';
                $data['template'] = 'emails.admin.registration';
            }
        }
        
        if(array_key_exists('attachment', $data) && $data['attachment'] != null) {
            \Mail::send($data['template'], $data['data'], function ($m) use ($data) {
                $attachment = storage_path() . '/app/public/' . $data['attachment'];
                $m->from('procurement@eproc-mercu.co.id', 'PT. XXX');
                $m->to($data['email'])->subject($data['subject']);
                $m->attach($attachment);
            });
        } else {
            \Mail::send($data['template'], $data['data'], function ($m) use ($data) {
                $m->from('procurement@eproc-mercu.co.id', 'PT. XXX');
                $m->to($data['email'])->subject($data['subject']);
            });
        }
    }

    public static function send_email_register($user_id)
    {
        $userbro = User::find($user_id);
        try {
            $company            = Company::where('user_id', $userbro->id)->first();
            $now                = Carbon::now();
            $user               = $userbro;

            $contact            = $company->contact;
            $deed               = $company->deed;
            $tax                = $company->tax;
            $registration       = $company->registration;

            $jobs               = $company->projects;
            $exps               = $company->experiences;
            $persons            = $company->persons;
            $holders            = $company->holders;
            $employees          = $company->employees;
            
            $siup               = $company->siup;
            $iujk               = $company->iujk;
            $siui               = $company->siui;

            if($jobs == null) {
                $jobs           = array();
            }
            if($exps == null) {
                $exps           = array();
            }
            if($persons == null) {
                $persons        = array();
            }
            if($holders == null) {
                $holders        = array();
            }
            if($employees == null) {
                $employees      = array();
            }

            $print_data         = [
                  'company'               => $company,
                  'user'                  => $user,
                  'contact'               => $contact,
                  'deed'                  => $deed,
                  'now'                   => $now,
                  'tax'                   => $tax,
                  'registration'          => $registration,
                  'jobs'                  => $jobs,
                  'exps'                  => $exps,
                  'persons'               => $persons,
                  'holders'               => $holders,
                  'employees'             => $employees,
                  'siup'                  => $siup,
                  'iujk'                  => $iujk,
                  'siui'                  => $siui,
            ];
            $user_file_path     = storage_path() . '/app/public/print/' . $userbro->id . '.pdf';
            $pdf = PDF::loadView('prints/permohonan-noprint', $print_data);
            $pdf->setPaper('a4')->save($user_file_path);

            $verification_time  = Carbon::now()->addDays(3);
            if($verification_time->dayOfWeek == 0 || $verification_time->dayOfWeek == 6) {
                $verification_time->addDay(2);
            }

            \Log::info('processing user registration for ' . $userbro->email);

            $user_email_data    = [
                'email'             => $userbro->email,
                'name'              => $userbro->name,
                'attachment'        => 'print/' . $userbro->id . '.pdf',
                'data'              => [
                                          'name' => $userbro->name,
                                          'verification_time' => $verification_time->format('d F Y'),
                                        ],
            ];

            \Mail::send('emails.user.registration', $user_email_data['data'], function ($m) use ($user_email_data) {
                $attachment = storage_path() . '/app/public/' . $user_email_data['attachment'];
                $m->from('procurement@eproc-mercu.com', 'EDI Indonesia');
                $m->to($user_email_data['email'], $user_email_data['name'])->subject('Konfirmasi Pendaftaran Penyedia - PT. XXX');
                // $m->attach($attachment, ['as' => 'Berkas Pendaftaran']);
            });

            $admin_email_data   = [
                'email'             => 'dandyfirmansyah1998@gmail.com',
                'name'              => 'Admin Verifikasi',
                'data'              => [
                                          'url' => \URL::to('/') . '/vendor/detail/' . $company->id,
                                            // 'url' => 'https://e-proc.ipclogistic.co.id/vendor/detail/' . $company->id,
                                        ],
            ];
            
            \Mail::send('emails.admin.registration', $admin_email_data['data'], function ($m) use ($admin_email_data) {
                $m->from('procurement@eproc-mercu.com', 'EDI Indonesia');
                // $m->to('wulan@multiterminal.co.id', $admin_email_data['name']);
                // $m->to('andry@multiterminal.co.id', $admin_email_data['name']);
                // $m->to('diaz@multiterminal.co.id', $admin_email_data['name']);
                // $m->to('yaumil@multiterminal.co.id', $admin_email_data['name']);
                // $m->cc($admin_email_data['email'], $admin_email_data['name']);
                $m->to('dandygantengkok@gmail.com', $admin_email_data['name']);
                $m->subject('Konfirmasi Pendaftaran Penyedia - PT. XXX');
            });
        } catch(\Exception $e) {
            \Log::error(print_r($e->getMessage(), true));
        }
    }

}
