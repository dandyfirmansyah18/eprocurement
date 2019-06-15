<?php // Company Helper

namespace App\Helpers;

use App\Models\ActivityLog;
use App\Models\User;
use App\Models\Approval;

use Carbon\Carbon;

class ActivityHelper
{

    public static function write_log($data)
    {
        $log_message            = ActivityHelper::create_log_message($data);

        $item                   = new ActivityLog;
        $item->entity_type      = $data['entity_type'];
        $item->entity_id        = $data['entity_id'];
        $item->user_id          = $data['user_id'];
        $item->log              = $log_message;
        $item->action           = $data['action'];
        $item->previous_value   = $data['previous_value'];
        $item->new_value        = $data['new_value'];
        $item->changed_field    = $data['changed_field'];

        $item->save();

        return $item->id;
    }

    public static function create_log_message($data)
    {
        $log    = '';
        $now    = Carbon::now();
        $user   = User::find($data['user_id']);

        if($data['entity_type'] == 'vendor') {
            $log = 'Penyedia';
            switch ($data['action']) {
                case 'register':
                    $log = $log . ' mendaftar pada tanggal ' . $now->format('d F Y');
                    break;
                case 'verify':
                    $log = $log . ' diverifikasi data oleh ' . $user->name . ' pada tanggal ' . $now->format('d F Y');
                    break;
                case 'activate':
                    $log = $log . ' diaktifkan oleh ' . $user->name . ' pada tanggal ' . $now->format('d F Y');
                    break;
                case 'reject':
                    $log = $log . ' ditolak verifikasi data oleh ' . $user->name . ' pada tanggal ' . $now->format('d F Y');
                    break;
                case 'blacklist':
                    $log = $log . ' ditambahkan ke daftar hitam oleh ' . $user->name . ' pada tanggal ' . $now->format('d F Y');
                    break;
                case 'freeze':
                    $log = $log . ' dibekukan oleh ' . $user->name . ' pada tanggal ' . $now->format('d F Y');
                    break;
                case 'update':
                    $log = $log . ' update data pada tanggal ' . $now->format('d F Y');
                    break;
                case 'delete':
                    $log = $log . ' dihapus oleh ' . $user->name . ' pada tanggal ' . $now->format('d F Y');
                    break;

                default:
                    break;
            }
        }elseif($data['entity_type'] == 'approval'){
            switch ($data['action']) {
                case 'approval_1':
                    # code...
                    $log = 'Manager '. $user->name .' menyetujui pada tanggal ' . $now->format('d F Y') .' dengan catatan : '. $data['notes'];
                    break;

                case 'approval_2':
                    # code...
                    $log = 'Kepala Divisi '. $user->name .' menyetujui pada tanggal ' . $now->format('d F Y') .' dengan catatan : '. $data['notes'];
                    break;

                case 'approval_3':
                    # code...
                    $log = 'Direksi '. $user->name .' menyetujui pada tanggal ' . $now->format('d F Y') .' dengan catatan : '. $data['notes'];
                    break;

                case 'reject_1':
                    # code...
                    $log = 'Manager '. $user->name .' menolak pada tanggal ' . $now->format('d F Y') .' dengan catatan : '. $data['notes'];
                    break;

                case 'reject_2':
                    # code...
                    $log = 'Kepala Divisi '. $user->name .' menolak pada tanggal ' . $now->format('d F Y') .' dengan catatan : '. $data['notes'];
                    break;

                case 'reject_3':
                    # code...
                    $log = 'Direksi '. $user->name .' menolak pada tanggal ' . $now->format('d F Y') .' dengan catatan : '. $data['notes'];
                    break;

                default:
                    # code...
                    break;
            }
        }elseif ($data['entity_type']== 'planning') {
            # code...
            switch ($data['action']) {
                case 'new':
                    # code...
                    $log = 'Pengajuan baru ['. $now->format('d F Y H.i').']';
                    break;

                case 'toVerify':
                    # code...
                    $log = 'Menunggu verifikasi pengadaan [' . $now->format('d F Y H.i').']';
                    break;

                case 'verified':
                    # code...
                    $log = 'Terverifikasi pengadaan ['. $now->format('d F Y H.i').']';
                    break;

                case 'start_approval':
                    # code...
                    $log = 'Menunggu persetujuan manajer ['. $now->format('d F Y H.i') .']';
                    break;                    
            }
        }

        return $log;
    }
}
