<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\DataTableHelper;

use Yajra\Datatables\Facades\Datatables;

class StaticController extends Controller
{
    public function thankyou()
    {
        return view('terimakasih');
    }

    public function pin_thankyou()
    {
        return view('terimakasih-pin');
    }

    public function email_exist()
    {
        return view('email_exist');
    }

    public function process_verification()
    {
        return view('process_verification');
    }

    public function user_registered()
    {
        return view('user_registered');
    }

    public function procurements()
    {
        $items = DataTableHelper::list_public_procurement();
        return Datatables::of($items)->make(true);
    }

    public function vendors()
    {
        $items = DataTableHelper::list_vendor(true);
        return Datatables::of($items)->make(true);
    }
}
