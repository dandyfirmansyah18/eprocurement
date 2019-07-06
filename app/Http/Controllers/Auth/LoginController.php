<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Input;
use Auth, Hash, Redirect, Session, Mail, Log, Request, DB;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'layouts/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->redirectTo = route('dashboard');
    }

    function log_login($userid)
    {
        $save = DB::table('tl_logs')->insert(
                    [
                        'user_id' => $userid,
                        'request_method' => 'POST',
                        'log_url' => 'post_login',
                        'client_ip_address' => Request::ip(),
                    ]
                );
    }

    public function login()
    {
        return view('login');
    }

    public function postLogin()
    {
        $email = Input::get('email');
        $password = Input::get('password');
        $credentials = array('email' => $email, 'password' => $password);

        $cek_email = User::where('email', '=', $email)->first();
        if(!$cek_email)
        {
            return 'MSG#ERR#Login gagal. Email tidak terdaftar.';
        }
        else
        {
            // $user_status = User::where('USER_EMAIL', $email)->value('USER_VERIFIED');
            // if($user_status == 0)
            // {
            //     return 'MSG#ERR#Login gagal. Akun anda belum aktif atau telah dinonaktifkan. Silahkan hubungi Admin.';
            // }
            // else
            // {
                if(Auth::attempt($credentials))
                {
                    User::where('email', '=', $email)->update([
                            'session_id' => Session::getId(),
                            'user_last_login' => date('Y-m-d h:i:s'),
                            ]);

                    // insert log login
                    $this->log_login(Auth::user()->id);
                    return 'MSG#OK#Login Sukses.';
                }
                else
                {
                    return 'MSG#ERR#Login gagal. Password Anda salah.';
                }
            // }
        }
    }

    public function postRegister()
    {
        $cek_email = User::where('email', '=', Input::get('email'))->first();
        if($cek_email)
        {
            return 'MSG#ERR#Registrasi Gagal. Email sudah terdaftar.';
        }else{
            $string_encode_email = base64_encode(Input::get('email').'-'.str_random(15));
            $save = User::create([
                                'USER_EMAIL' => Input::get('email'),
                                'USER_PHONE' => Input::get('phone'),
                                'USER_NOKTP' => Input::get('noktp'),
                                'USER_PASSWORD' => Hash::make(Input::get('password')),
                                'USER_NAME' => Input::get('fullname'),
                                'USER_ROLE_ID' => '1',
                                'USER_VERIFIED' => '0',
                                'USER_REGISTERED' => Input::get('member'),
                                'USER_ADDRESS' => Input::get('address')
                            ]);

            $email = Input::get('email');
            if ($save) {
                Mail::send('email.activationaccount', ['urlencode' => $string_encode_email], function($mail) use ($email) {
                    $mail->from('no-reply@oripay.co.id', 'Ori Pay');
                    $mail->to($email)
                        ->subject('Activation Account Ori Pay');
                });

                return 'MSG#OK#';
            }else{
                return 'MSG#ERR#Registrasi Gagal, terjadi kesalahan.';
            }
        }
    }

    public function request_pin()
    {
        $cek_email = User::where('email', '=', Input::get('email'))->first();
        if($cek_email)
        {
            return 'MSG#ERR#Registrasi Gagal. Email sudah terdaftar.';
        }else{

            

            $pin = substr(str_shuffle('0123456789'), 0, 4);
            $hash_pin = Hash::make($pin);
            $save = User::create([
                'email' => Input::get('email'),
                'name' => Input::get('name'),
                'taxpayer_number' => Input::get('taxpayer_number'),
                'pin' => $pin,
                'password' => $hash_pin,
                'role_level' => '1',
                'state' => '0',
                'pinrequest_time', date('Y-m-d H:i:s')
            ]);

            return 'MSG#OK#Registrasi Berhasil, PIN pendaftaran sudah dikirim ke email anda.';
        }
    }

    public function forgotpassword()
    {
        $email = Input::get('email');
        $user = User::where('email', $email)->first();

        if(!$user)
        {
            return 'MSG#ERR#Maaf email Anda tidak terdaftar.';
        }
        else
        {

            $password_reset_code = str_random(30);

            $now = date_create(date('Y-m-d H:i:s'));
            $exp_date = $now->modify('+1 day');
            $password_reset_exp = $exp_date->format('Y-m-d H:i:s');

            Mail::send('email.resetpassword', ['password_reset_code' => $password_reset_code, 'email' => $email], function($mail) use ($email) {
                $mail->from('no-reply@eprocurement.com', 'eProcurement');
                $mail->to($email)
                    ->subject('Password Reset');
            });

            $user->password_reset_code = $password_reset_code;
            $user->password_reset_expired = $password_reset_exp;
            $user->save();

            // return 'MSG#ERR#Reset Password Failed. Please try again.';
            return 'MSG#OK#Password recovery instruction has been sent to your email.';
        }
    }

    public function resetpassword(){
        $verifier = Input::get('verifier');

        if(!$verifier)
        {
            Session::flash('ERR', 'Sorry, the page you are looking for could not be found.');
            return Redirect::to('/error404');
        }


        $user = User::where('password_reset_code', $verifier)->whereRaw('password_reset_expired > NOW()')->first();

        if (!$user)
        {
            Session::flash('ERR', 'Your password reset link has expired.');
            return Redirect::to('/login');
        }

        $email = $user->email;
        // $new_password = str_random(8);
        $new_password = $this->quickRandom();

        $user->password = Hash::make($new_password);
        $user->password_reset_code = null;
        $user->save();
        
        Mail::send('email.newpassword', ['new_password' => $new_password, 'email' => $email], function($mail) use ($email){
            $mail->from('no-reply@eprocurement.com', 'eProcurement');
            $mail->to($email)
                ->subject('Password Baru Anda');
        });

        Session::flash('OK', 'Password anda telah direset. Password baru telah dikirimkan ke email anda.');
        return Redirect::to('/login');
    }

    public function logout()
    {
        if(Auth::user())
        {
            // User::where('USER_ID', '=', Auth::user()->USER_ID)->update(['USER_LOGIN_STATUS' => 0]);
            Auth::logout();
            return Redirect::to('signin');
        }
        else
        {
            return Redirect::to('signin');
        }
    }

    public static function quickRandom($length = 10)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function signup()
    {
        return view('register');
    }

}
