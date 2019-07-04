@extends('templates.index')
@push('csspage')
@endpush

@section('content')
<!-- BEGIN content SECTION -->
<div class="container-fluid">
<!-- ============================================================== -->
<!-- Bread crumb as and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Detail Pengadaan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Detail Pengadaan</li>
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
                        <a class="nav-link active" data-toggle="tab" href="#first" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-file"></i>
                            </span> 
                            <span class="hidden-xs-down">Detail Pengadaan</span>
                        </a> 
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#third" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-file"></i>
                            </span> 
                            <span class="hidden-xs-down">Kriteria Penilaian</span>
                        </a> 
                    </li>
                     @if($item->delivery_method != null && $item->delivery_method > 0)
                    <li class="nav-item"> 
                        <a class="nav-link" data-toggle="tab" href="#second" role="tab">
                            <span class="hidden-sm-up">
                                <i class="ti-file"></i>
                            </span> 
                            <span class="hidden-xs-down">Jadwal Pengadaan</span>
                        </a> 
                    </li>
                    @endif
                </ul>
                <div class="pt0 card-body tab-content">
                    @include('layouts.pengadaan.parts.draft.infoutama')

                    @include('layouts.pengadaan.parts.draft.kriteria')

                    @if($item->delivery_method != null && $item->delivery_method > 0)
                        @include('layouts.pengadaan.parts.draft.tanggal')
                    @endif
                </div><!--end .card-body -->
            </div>
        </div>
    </div>
</div>  
        
    
<div class="hidden-block">
    <form id="form_start" method="POST" action="/pengadaan/mulai">
        {{ csrf_field() }}
        <input type="hidden" id="start_id" name="id" value="{{ $item->id }}" />
    </form>
</div>

@php
    Session::forget('tab');
@endphp
    <!-- END content SECTION -->
@endsection


@push('jspage')
    
    <script type="text/javascript" src="{{ URL::asset('js/jsqbc-functions.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        enable_session_tab();

        $('#trg_start').on('click', function(event){
            var confirmation = confirm("Apakah anda yakin?");
            if (confirmation == true) {
                submit_form('form_start');
            }
            event.preventDefault();
        });
    });
    </script>
@endpush
