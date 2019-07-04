<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
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
    
    public function master_data()
    {
        return view('pengaturan.masterdata');
    }

    public function others()
    {
        return view('pengaturan.lain');
    }

    public function users()
    {
        return view('pengaturan.pengguna');
    }
}
