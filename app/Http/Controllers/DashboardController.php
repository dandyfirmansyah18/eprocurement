<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth, DB;

class DashboardController extends Controller
{
    // public function __construct(ManagementUserController $_user)
    // {
    //     $this->manageuser = $_user;
    // }

    public function index()
    {
    	$user = Auth::user();
        if($user->state == 1) {
            if($user->role_level == 1) {
                return view('layouts.dashboard.dash');
            } else {
                $count_perencanaan      = PreProcurement::where('proposed', false)->count();
                $count_draft_pengadaan  = PreProcurement::where('proposed', true)->where('listed', false)->count();
                $count_pengadaan        = PreProcurement::where('proposed', true)->where('worked', false)->count();
                $count_selesai          = PreProcurement::where('worked', true)->count();
                $count_vendor_baru      = DataTableHelper::list_vendor_temp()->count();
                $count_vendor_aktif     = DataTableHelper::list_vendor(true)->count();

                return view('layouts.dashboard.dash', [
                    'count_perencanaan'     => $count_perencanaan,
                    'count_pengadaan'       => $count_pengadaan,
                    'count_selesai'         => $count_selesai,
                    'count_draft_pengadaan' => $count_draft_pengadaan,
                    'count_vendor_baru'     => $count_vendor_baru,
                    'count_vendor_aktif'    => $count_vendor_aktif
                ]);
            }
        }

        return redirect('/daftar');
    }

    public function view_dashboard()
    {
        // if (Auth::user()->USER_ROLE_ID == '3') {
        //     $data['unregisteredaccount'] = User::where('USER_REGISTERED',0)->count();
        //     $data['registeredaccount'] = User::where('USER_REGISTERED',1)->count();
        //     $data['topuppending'] = TopupBalance::whereRaw('TOPUP_STATUS IN (1,2)')->count();
        //     $data['topupdone'] = TopupBalance::whereRaw('TOPUP_STATUS = 3')->count();
        //     $data['topupcancel'] = TopupBalance::whereRaw('TOPUP_STATUS = 4')->count();
        // }else{
        //     $user_regis = Auth::user()->USER_REGISTERED;
        //     $master_balance = Maksbalance::where('MAKSBALANCE_USER_REGISTERED',$user_regis)->first();
        //     $balance = $master_balance->MAKSBALANCE_VALUE;

        //     $check = Topup::select(DB::raw('SUM(PRICE_OPT_VALUE) as total_transaction'))
        //                     ->leftjoin('TM_PRICE_OPERATOR','TM_PRICE_OPERATOR.PRICE_OPT_ID','=','TX_TRANSACTION.TRANSACTION_PRICE_OPT_ID')
        //                     ->where('TRANSACTION_USER_ID', Auth::user()->USER_ID)
        //                     ->where('TRANSACTION_STATUS','1')
        //                     ->first();
        //     $total_transaction = $check->total_transaction;

        //     $sisa_balance = $balance - $total_transaction;
        //     $data['balance_value'] = $balance;
        //     $data['balance_terpakai'] = $total_transaction;
        //     $data['balance_sisa'] = $sisa_balance;
        // }
        return view('layouts.dashboard.dashboard');
    }
}
