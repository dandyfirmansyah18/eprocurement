<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\PreProcurement;
use App\Models\Assessment;
use App\Models\Attachment;
use App\Models\Chat;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyContact;
use App\Models\CompanyTax;
use App\Models\Enrollment;
use App\Models\CompanyPermit;
use App\Models\CompanyRegistration;
use App\Models\CompanyDeed;
use App\Models\CompanyEmployee;
use App\Models\MasterProvince;
use App\Models\MasterCity;
use App\Models\Option;

use App\Models\PermitSIUP;
use App\Models\PermitIUJK;
use App\Models\PermitSIUI;
use App\Models\PermitSKKemenkumham;
use App\Models\PermitSKDP;
use App\Models\MasterBusinessSIUP;
use App\Models\MasterBusinessIUJK;

use App\Helpers\DataTableHelper;
use App\Helpers\ApprovalHelper;
use App\Helpers\CompanyHelper;
use App\Helpers\ChatHelper;
use App\Helpers\MailHelper;
use App\Helpers\CompanyContactHelper;
use App\Helpers\CompanyTaxHelper;
use App\Helpers\CompanyPermitHelper;
use App\Helpers\CompanyRegistrationHelper;
use App\Helpers\CompanyDeedHelper;
use App\Helpers\CompanyProjectHelper;
use App\Helpers\CompanyExperienceHelper;
use App\Helpers\CompanyPersonnelHelper;
use App\Helpers\CompanyStackholderHelper;
use App\Helpers\CompanyEmployeeHelper;
use App\Helpers\CompanyCertificateHelper;

use Yajra\Datatables\Facades\Datatables;

use App\Jobs\UserRegistrationWorker;

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
                return view('layouts.dashboard.user');
            } else {
                $count_perencanaan      = PreProcurement::where('proposed', false)->count();
                $count_draft_pengadaan  = 12;
                $count_pengadaan        = PreProcurement::where('proposed', true)->where('worked', false)->count();
                $count_selesai          = PreProcurement::where('worked', true)->count();
                $count_vendor_baru      = DataTableHelper::list_vendor_temp()->count();
                $count_vendor_aktif     = DataTableHelper::list_vendor(true)->count();

                return view('layouts.dashboard.dash', [
                    'count_perencanaan'     => $count_perencanaan,
                    'count_pengadaan'       => $count_pengadaan,
                    'count_selesai'         => $count_selesai,
                    'count_draft_pengadaan' => 12,
                    'count_vendor_baru'     => $count_vendor_baru,
                    'count_vendor_aktif'    => $count_vendor_aktif
                ]);
            }
        }

        return redirect('/daftar');
    }

    public function procurements()
    {
        $items = DataTableHelper::list_all_procurement();
        return Datatables::of($items)->make(true);
    }

    public function my_procurements()
    {
        $user = Auth::user();
        $items = array();
        if($user->company != null) {
            $items = DataTableHelper::list_my_procurement($user->company->id);
        }
        return Datatables::of($items)->make(true);
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
