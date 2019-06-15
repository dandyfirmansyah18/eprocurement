<?php // User Helper

namespace App\Helpers;

use App\Models\User;
use App\Models\Rating;
use App\Models\Company;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function save_data($data)
    {
        $user = User::where('email', $data['email'])->first();

        if($user == null) {
            $user         = new User;
            $user->email  = $data['email'];
        }

        if(array_key_exists('name', $data)) {
            $user->name = $data['name'];
        }

        if(array_key_exists('npwp', $data)) {
            $user->taxpayer_number = $data['npwp'];
        }

        if(array_key_exists('telp', $data)) {
            $user->telp = $data['telp'];
        }

        if(array_key_exists('pin', $data)) {
            if($user->pin == null) {
                $user->pinrequest_time = Carbon::now();
            }
            $user->pin      = $data['pin'];
            // $user->pin      = '1234';
            $user->password = \Hash::make($data['pin']);
        }

        if(array_key_exists('password', $data)) {
            $user->password = \Hash::make($data['password']);
        }

        $user->save();

        return $user->id;
    }

    public static function save_pegawai($data)
    {
        $user = User::where('email', $data['email'])->first();

        if($user == null) {
            $user         = new User;
            $user->email  = $data['email'];
        }

        if(array_key_exists('name', $data)) {
            $user->name = $data['name'];
        }

        if(array_key_exists('nip', $data)) {
            $user->nip = $data['nip'];
        }

        if(array_key_exists('role_user', $data)) {
            $user->role_level = $data['role_user'];
        }

        if(array_key_exists('password', $data)) {
            $user->pin = '1234';
            $user->state = '1';
            $user->password = bcrypt($data['password']);
        }

        if(array_key_exists('unit_id', $data)) {
            $user->unit_id = $data['unit_id'];
        }

        $user->save();

        return $user->id;
    }

    public static function save_reset_password($data)
    {
        $user = User::where('email', $data['email'])->first();
        if(array_key_exists('password', $data)) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();

        return $user->id;
    }

    public static function set_notes($user_id, $notes)
    {
        $user = User::find($user_id);

        if($user != null) {
            $user->notes = $notes;
            $user->save();
        }

        return $user->id;
    }

    public static function set_registered($user_id)
    {
        $user = User::find($user_id);

        if($user != null) {
            $user->state              = 2;
            $user->registration_time  = Carbon::now();
            $user->save();
        }

        return $user;
    }

    public static function penaltied($user_id, $data)
    {
        $user                         = User::find($user_id);
        if($user != null) {
            $now                      = Carbon::now();
            if($data['action'] == 'freeze') {
                $user->state          = 5;
                if($data['is_timed'] == '1' && $data['penalty_end'] != null) {
                    $user->penalty_end  = DateHelper::parse_from_datepicker($data['penalty_end']);
                } else {
                    $user->penalty_end  = null;
                }
                $user->penalty_start  = $now;
            } else if($data['action'] == 'blacklist') {
                $user->state          = 6;
                if($data['is_timed'] == '1' && $data['penalty_end'] != null) {
                    $user->penalty_end  = DateHelper::parse_from_datepicker($data['penalty_end']);
                } else {
                    $user->penalty_end  = null;
                }
                $user->penalty_start  = $now;
            } else if($data['action'] == 'activate') {
                $user->state          = 1;
                $user->penalty_start  = null;
                $user->penalty_end    = null;
            }

            $user->save();
        }

        return $user;
    }

    public static function reset_password($user_id)
    {
        $user                   = User::find($user_id);
        if($user != null) {
            $new_password       = AuxHelper::generate_password();
            $user->password     = \Hash::make($new_password);
            $user->save();

            $user_email_data    = [
                'email'             => $user->email,
                'name'              => $user->name,
                'data'              => [
                    'name'  => $user->name,
                    'username'  => $user->email,
                    'password' => $new_password,
                ],
                'type'              => 'user',
                'action'            => 'reset-password',
            ];
            // MailHelper::queue($user_email_data);
            MailHelper::sendEmail($user_email_data);

            return true;
        }

        return false;
    }

    public static function change_password($user_id, $old_password, $new_password)
    {
        $user                   = User::find($user_id);
        $credentials            = ['email' => $user->email,'password' => $old_password];
        if(Auth::attempt($credentials)) {
            $user->password     = \Hash::make($new_password);
            $user->save();

            $user_email_data    = [
                'email'             => $user->email,
                'name'              => $user->name,
                'data'              => [
                    'name'      => $user->name,
                    'username'  => $user->email,
                    'password'  => $new_password,
                ],
                'type'              => 'user',
                'action'            => 'change-password',
            ];
            MailHelper::sendEmail($user_email_data);

            return $user->id;
        } else {
            return 0;
        }
    }

    public static function forgot_password($email, $new_password)
    {
        $useremail = User::where('email', $email)->first();
        $user                   = User::find($useremail->id);
        if($useremail != null) {
            $user->password     = \Hash::make($new_password);
            $user->save();

            $user_email_data    = [
                'email'             => $user->email,
                'name'              => $user->name,
                'data'              => [
                    'name'      => $user->name,
                    'username'  => $user->email,
                    'password'  => $new_password,
                ],
                'type'              => 'user',
                'action'            => 'change-password',
            ];
            MailHelper::queue($user_email_data);

            if($user->state != 1){
                return -1;
            }else{
                return $user->id;
            }
        }  else {
            return 0;
        }
    }

    public static function set_name($user_id, $name)
    {
        $item   = User::find($user_id);

        if($item != null) {
            $item->name         = $name;
            if($item->state == 4) {
                $item->state    = 3;
            }
            $item->save();

            return true;
        }

        return false;
    }

    public static function set_name_and_revalidation($user_id, $name)
    {
        $item   = User::find($user_id);

        if($item != null) {
            $item->name     = $name;
            $item->state    = 3;
            $item->save();

            return true;
        }

        return false;
    }

    public static function set_rating($user_id)
    {
        $item                   = User::find($user_id);

        if($item != null) {
            $new_rating         = 0.0;
            $ratings            = Rating::where('vendor_id', $item->company->id)->pluck('rate')->toArray();
            foreach ($ratings as $rating) {
                $parsed_rating  = floatval($rating);
                $new_rating     = $new_rating + $parsed_rating;
            }
            $new_rating         = $new_rating / count($ratings);
            $item->rating       = $new_rating;
            $item->save();
        }

        return $item;
    }

    // Start Vendor Verification
    public static function set_verified($data)
    {
        $item   = User::find($data['user_id']);
        $verified = Company::where('user_id', '=', $data['user_id'])->first();
        $verified->status = 1;
        $verified->save();

        if($item != null) {
            $item->verification_time    = DateHelper::parse_from_datepicker($data['date']);
            $item->password             = \Hash::make($data['password']);
            $item->state                = 1;
            $item->verification_by      = $data['actor_id'];
            $item->save();
        }

        return $item;
    }

    public static function set_revalidated($user_id)
    {
        $item = User::find($user_id);

        if($item != null) {
            $item->state = 4;
            $item->save();
        }

        return $item;
    }
    // End Vendor Verification
}
