@extends('templates.index')
@section('title','Detail Monitoring Pekerjaan')
@push('csspage')

@endpush

@section('content')
<!-- BEGIN content SECTION -->
<div class="container-fluid">
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Detail Monitoring Pekerjaan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Detail Monitoring Pekerjaan</li>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"> 
                        <a class="nav-link active" data-toggle="tab" href="#detail" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-file"></i>
                            </span> 
                            <span class="hidden-xs-down">Detail Pengadaan</span>
                        </a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-file"></i>
                            </span> 
                            <span class="hidden-xs-down">Kontrak/SPK/SP</span>
                        </a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-hummer"></i>
                            </span> 
                            <span class="hidden-xs-down">Jaminan Pekerjaan</span></a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-agenda"></i>
                            </span> 
                            <span class="hidden-xs-down">Laporan Pekerjaan</span></a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-wallet"></i>
                            </span> 
                            <span class="hidden-xs-down">Laporan Pembayaran</span></a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#messages" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-check-box"></i>
                            </span> 
                            <span class="hidden-xs-down">Evaluasi Pekerjaan</span></a> 
                    </li>
                </ul>
                                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    @include('layouts.monitoring.parts.detail.infoutama')
                </div>
            </div>
        </div>
    </div>
</div>
    
@php    
Session::forget('tab');
@endphp
<!-- END content SECTION -->
@endsection

@push('jspage')
@endpush
