<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Kelola Data Profile</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="call('<?= url('my_profile'); ?>','_content_','My Profile')">My Profile</a></li>
                    <li class="breadcrumb-item active">Kelola Data Profile</li>
                </ol>
                <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row" id="validation">
        <div class="col-12">
            <div class="card wizard-content">
                <div class="card-body">
                    <h4 class="card-title">Kelola Data Profile</h4>
                    <h6 class="card-subtitle">
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
                        @php
                            $dt = \Carbon\Carbon::now()->addDays(5)
                        @endphp
                    </h6>
                    <br><br>
                    <div id="rootwizard2">
                        <form class="validation-wizard form-validation wizard-circle" action="/my_profile/simpan" method="POST" id="form_registration" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" id="currently_disabled" value="{{ $readonly }}">
                            <!-- Step 1 -->
                            <h6>Penanggung Jawab</h6>
                            <section>
                                @include('layouts.penyedia.wizardparts.datapenanggung')
                            </section>
                            <!-- Step 2 -->
                            <h6>Data Perusahaan</h6>
                            <section>
                                @include('layouts.penyedia.wizardparts.dataperusahaan')
                            </section>
                            <!-- Step 3 -->
                            <h6>Dokumen Administrasi</h6>
                            <section>
                                @include('layouts.penyedia.wizardparts.datapendirian')
                            </section>
                        </form>
                    </div>
                    <hr>
                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#verifikasi">
                                <i class="fa fa-pencil"></i>&nbsp;Ubah Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>

<div class="modal fade" id="registration_loading" tabindex="-1" role="dialog" aria-labelledby="failed_registration_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="failed_registration_label">Perubahan Data Penyedia</h4>
            </div>
            <div class="modal-body">
                <center>
                <p class="textcenter">
                    <img id="registration_loader" src="{{ URL::asset('img/cog_spinner.gif') }}" alt="Loading.." />
                    <span id="failed_registration" class="hidden-block">
                        <span class="textkonfirm">Perubahan Data Penyedia Gagal!</span>
                        <br>
                        <span id="failed_message"></span>
                    </span>
                </p>
                </center>
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
                <h4 class="modal-title" id="formModalLabel">Konfirmasi Perubahan Data Penyedia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Anda akan melakukan perubahan data lama anda menjadi data terbaru yang sudah anda isikan, setelah diubah maka data anda pada Database
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

<script type="text/javascript" src="{{ asset('js/jsqb-tabel-vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsqb-form-vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/form-wizard-daftar.js') }}"></script>

@if($user->state != 2)
    <script type="text/javascript" src="{{ asset('js/jsqbc-form-edit-vendor.js') }}"></script>
@else
    <script type="text/javascript" src="{{ asset('js/jsqbcd-form-vendor.js') }}"></script>
@endif