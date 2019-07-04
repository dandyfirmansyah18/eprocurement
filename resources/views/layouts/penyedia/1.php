@extends('layouts.login')

@section('title', 'Form Kelola Pendaftaran Penyedia')

@push('csspage')
<link rel="stylesheet" href="{{ URL::asset('css/libs/dropzone/dropzone-theme.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/libs/bootstrap-datepicker/datepicker3.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/libs/select2/select2.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/libs/wizard/wizard.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/libs/typeahead/typeahead.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"  type="text/css"/>
@endpush

@section('content')
<!-- BEGIN content SECTION -->
<section class="">
    <div class="noheader section-header">

    </div>
    <div class="section-body">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Kelola Pendaftaran Penyedia</header>
                        <a class="pull-right btn btn-flat mt11" href="{{ url('/my_profile') }}">
                            <i class="fa fa-arrow-left"></i> Kembali ke halaman profile&nbsp;&nbsp;
                        </a>
                    </div>
                    <div class="card-body floating-label">
                        @if($user->state == 2)
                            <div>
                                Pendaftaran ini telah dikirimkan ke pihak PT. EDI Indonesia.
                                <br />
                                Saat ini data pendaftaran sedang diverifikasi.
                                <br />
                                Hasil verifikasi akan dikirimkan melalui email anda.
                            </div>
                            <hr>
                        @endif
                        <div id="rootwizard2" class="form-wizard form-wizard-horizontal">
                            <form class="form floating-label form-validation form-validate" role="form" action="/my_profile/simpan" method="POST" id="form_registration" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" id="currently_disabled" value="{{ $readonly }}">
                                <div class="form-wizard-nav mb50">
                                    <div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
                                    <ul class="nav nav-justified">
                                        <li class="active"><a href="#step1" data-toggle="tab"><span class="step">1</span> <span class="title">Penanggung Jawab</span></a></li>
                                        <li><a href="#step2" data-toggle="tab"><span class="step">2</span> <span class="title">Data Perusahaan</span></a></li>
                                        <li><a href="#step3" data-toggle="tab"><span class="step">3</span> <span class="title">Dokumen Administrasi</span></a></li>
                                    </ul>
                                </div><!--end .form-wizard-nav -->
                                <div class="tab-content clearfix">
                                    <div class="tab-pane active" id="step1">
                                        @include('penyedia.wizardparts.datapenanggung')
                                    </div><!--end #step1 -->
                                    <div class="tab-pane" id="step2">
                                        @include('penyedia.wizardparts.dataperusahaan')
                                    </div><!--end #step2 -->
                                    <div class="tab-pane" id="step3">
                                        @include('penyedia.wizardparts.datapendirian')
                                    </div><!--end #step3 -->
                                </div><!--end .tab-content -->
                                <ul class="pager wizard">
                                    <li class="previous"><a class="btn-raised" href="javascript:void(0);">Sebelumnya</a></li>
                                    <li class="next"><a class="btn-raised" href="javascript:void(0);">Berikutnya</a></li>
                                </ul>
                            </form>
                        </div><!--end #rootwizard -->
                    </div><!--end .card-body -->
                    <hr>
                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#verifikasi">
                                <i class="fa fa-pencil"></i>&nbsp;Ubah Data
                            </a>
                        </div>
                    </div>
                </div><!--end .card -->
                <em class="text-caption">keterangan form</em>
            </div><!--end .col -->
        </div>
    </div>
</section>
<!-- END content SECTION -->
@endsection

@push('modal')
    <!--Modal Registrasi Gagal-->
    <div class="modal fade" id="registration_loading" tabindex="-1" role="dialog" aria-labelledby="failed_registration_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="failed_registration_label">Perubahan Data Penyedia</h4>
                </div>
                <div class="modal-body">
                    <p class="textcenter">
                        <img id="registration_loader" src="{{ URL::asset('img/cog_spinner.gif') }}" alt="Loading.." />
                        <span id="failed_registration" class="hidden-block">
                            <span class="textkonfirm">Perubahan Data Penyedia Gagal!</span>
                            <br>
                            <span id="failed_message"></span>
                        </span>
                    </p>
                </div>
                <div class="modal-footer hidden-block" id="failed_btn">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!--Modal submit-->
    <div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Konfirmasi Perubahan Data Penyedia</h4>
                </div>
                <div class="modal-body">
                    <p>Anda akan melakukan perubahan data lama anda menjadi data terbaru yang sudah anda isikan, setelah diubah maka data anda pada PT. EDI Indonesia
                        akan berubah sesuai dengan inputan anda terakhir. <br>
                        Yakin data yang anda input sudah benar ? Dan akan merubah data ?
                    </p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="trg_registration" type="button" class="btn btn-primary ink-reaction">
                        <i class="fa fa-check"></i> Yakin, rubah data penyedia.
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <div class="hidden-block">
        <form id="form_delete" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="delete_id" name="id" />
        </form>
    </div>
@endpush


@push('jspage')
    <script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/jszip.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/wizard/DemoFormWizard.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/typeahead/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jsqbc-functions.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jsqb-tabel-vendor.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jsqb-form-vendor.js') }}"></script>

    @if($user->state != 2)
        <script type="text/javascript" src="{{ URL::asset('js/jsqbc-form-edit-vendor.js') }}"></script>
    @else
        <script type="text/javascript" src="{{ URL::asset('js/jsqbcd-form-vendor.js') }}"></script>
    @endif
@endpush
