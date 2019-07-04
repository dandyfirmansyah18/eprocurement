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
                                <a class="pull-right btn btn-flat mt11" href="/my_profile">
                                    <i class="fa fa-arrow-left"></i> Kembali ke halaman depan
                                </a>
                        </div>
                        <div class="card-body floating-label">
                            @if($user->state == 2)
                                <div>
                                    Pendaftaran ini telah dikirimkan ke pihak PT. Indonesia Kendaraan Terminal.
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
                            <div id="rootwizard2" class="form-wizard form-wizard-horizontal">
                                <form class="form floating-label form-validation form-validate" role="form" action="/penyedia/update_lainnya" method="POST" id="form_other" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="currently_disabled" value="{{ $readonly }}">
                                    <div class="tab-content clearfix">
                                        <div class="tab-pane active" id="step4">
                                            @include('penyedia.wizardparts.datapersonalia')
                                        </div>
                                    </div><!--end .tab-content -->
                                </form>
                            </div><!--end #rootwizard -->
                        </div><!--end .card-body -->
                        <hr>
                    </div><!--end .card -->
                    <em class="text-caption">keterangan form</em>
                </div><!--end .col -->
            </div>
        </div>
    </section>
    <!-- END content SECTION -->
@endsection

@push('modal')
    <!--Modal -->
    <div class="modal fade" id="tambahpengurus" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="employeeModalLabel">Tambah Pengurus Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <form id="form_pengurus" class="form form-validation form-validate" role="form" action="/daftar/save_manager" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="pengurus_id" name="pengurus[id]" />
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />

                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="pengurus_name" name="pengurus[name]" required>
                            <label for="regular2">Nama Lengkap</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="pengurus_nationalid" name="pengurus[national_id]">
                            <label for="regular2">No. KTP</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="pengurus_jobtitle" name="pengurus[job_title]">
                            <label for="regular2">Jabatan dalam perusahaan</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="trg_pengurus"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>


    <!--Modal -->
    <div class="modal fade" id="tambahanggota" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Tambah Anggota</h4>
                </div>
                <div class="modal-body">
                    <form id="form_holder" class="form form-validation form-validate" role="form" action="/daftar/save_stakeholder" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="holder_id" name="holder[id]" />
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />

                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="holder_name" name="holder[name]" required>
                            <label for="regular2">Nama Pemilik Saham</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="holder_nationalid" name="holder[national_id]" required>
                            <label for="regular2">No. Identitas</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="holder_nationality" name="holder[nationality]" required>
                            <label for="regular2">Kewarganegaraan</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="holder_address" name="holder[address]" required>
                            <label for="regular2">Alamat</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="holder_percentage" name="holder[percentage]" required>
                            <label for="regular2">%</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="trg_holder"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!--Modal -->
    <div class="modal fade" id="tambahpersonalia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Tambah Personalia</h4>
                </div>
                <div class="modal-body">
                    <form id="form_person" class="form form-validation form-validate" role="form" action="/daftar/save_person" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="person_id" name="person[id]" />
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />

                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="person_name" name="person[name]" required>
                            <label for="regular2">Nama Lengkap</label>
                        </div>
                        <div class="form-group">
                            <div class="input-group date" id="tanggallahirpersonalia">
                                <div class="input-group-content">
                                    <input type="text" class="form-control" id="person_birthdate" name="person[birth_date]">
                                    <label>Tanggal Lahir</label>
                                    <p class="help-block">tanggal/bulan/tahun</p>
                                </div>
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="person_education" name="person[education]">
                            <label for="regular2">Pendidikan</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="person_jobtitle" name="person[job_title]">
                            <label for="regular2">Jabatan dalam pekerjaan</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="person_experience" name="person[experience]">
                            <label for="regular2">Pengalaman Kerja</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="person_expertise" name="person[expertise]">
                            <label for="regular2">Profesi/keahlian</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="trg_person"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!--Modal -->
    <div class="modal fade " id="tambahpengalaman" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Tambah Pengalaman Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <form id="form_exp" class="form form-validation form-validate" role="form" action="/daftar/save_experience" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="exp_id" name="exp[id]" />
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="exp_name" name="exp[name]" required>
                                    <label for="regular2">Nama Paket Pekerjaan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="exp_field" name="exp[field]" required>
                                    <label for="regular2">Bidang/Sub Bidang</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="exp_location" name="exp[location]" required>
                                    <label for="regular2">Lokasi</label>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="exp_clientname" name="exp[client_name]" required>
                                    <label for="regular2">Nama Pemberi Tugas/Pengguna Jasa</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="exp_clientphone" name="exp[client_phone]" required>
                                    <label for="regular2">No Telp Pemberi Tugas/Pengguna Jasa</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="exp_contractnumber" name="exp[contract_number]" required>
                                    <label for="regular2">No. Kontrak/Tanggal</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="exp_contractvalue" name="exp[contract_value]" required>
                                    <label for="regular2">Nilai Kontrak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group date" id="tanggalpersonalia_mulai">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" id="exp_contractdue" name="exp[contract_due]">
                                            <label>Tanggal Selesai berdasarkan kontrak</label>
                                            <p class="help-block">tanggal/bulan/tahun</p>
                                        </div>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group date" id="tanggalpersonalia_selesai">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" id="exp_handover" name="exp[hand_over]">
                                            <label>Tanggal Selesai berdasarkan BA Serah terima</label>
                                            <p class="help-block">tanggal/bulan/tahun</p>
                                        </div>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="trg_exp"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!--Modal -->
    <div class="modal fade " id="tambahsertifikat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Tambah Surat/Sertifikasi</h4>
                </div>
                <div class="modal-body">
                    <div id="cert_loader">
                        <img src="{{ URL::asset('img/cog_spinner.gif') }}" alt="Loading.." />
                    </div>
                    <form id="form_cert" class="form form-validation form-validate hidden-block" role="form" action="/daftar/save_certification" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="cert_id" name="cert[id]" />
                        <input type="hidden" id="cert_pseudo_id" name="pseudo_id" />
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group floating-label">

                                    <select class="form-control" id="cert_type" name="cert[type]" required=>
                                        <option value="sertifikat">Sertifikat</option>
                                        <option value="principal">Principal</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                    <label for="regular2">Jenis Surat</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="cert_number" name="cert[number]" required>
                                    <label for="regular2">Nomor Surat/Sertifikasi</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="cert_title" name="cert[title]" required>
                                    <label for="regular2">Nama Surat/Sertifikasi</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group date" id="cert_release_date_block">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" id="cert_release_date" name="cert[release_date]">
                                            <label>Tanggal Diterbitkan</label>
                                            <p class="help-block">tanggal/bulan/tahun</p>
                                        </div>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group date" id="cert_expired_date_block">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" id="cert_expired_date" name="cert[expired_date]">
                                            <label>Tanggal Habis Berlaku</label>
                                            <p class="help-block">tanggal/bulan/tahun</p>
                                        </div>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="cert_author" name="cert[author]" required>
                                    <label for="regular2">Institusi</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="certificate_block" class="form-group dropzone-block tight">
                                    <input type="hidden" name="token_certificate" id="token_certificate" value="{{ csrf_token() }}">
                                    <div class="upload-block">
                                        <div class="image-block">
                                        </div>
                                        <div id="certificate" class="dropzone tight" url="/upload/certificate">
                                            <div class="dz-message btn btn-default">
                                                <h3>
                                                    Pilih file
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <p class="help-block">Unggah Surat/Sertifikat</p>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="trg_cert"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!--Modal -->
    <div class="modal fade " id="tambahkerja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Tambah Pengalaman Perusahaan</h4>
                </div>
                <div class="modal-body">
                    <form id="form_job" class="form form-validation form-validate" role="form" action="/daftar/save_job" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="job_id" name="job[id]" />
                        <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_name" name="job[name]" required>
                                    <label for="regular2">Nama Paket Pekerjaan</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_field" name="job[field]" required>
                                    <label for="regular2">Bidang/Sub Bidang</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_location" name="job[location]" required>
                                    <label for="regular2">Lokasi</label>
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_clientname" name="job[client_name]" required>
                                    <label for="regular2">Nama Pemberi Tugas/Pengguna Jasa</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_clientphone" name="job[client_phone]" required>
                                    <label for="regular2">No Telp Pemberi Tugas/Pengguna Jasa</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_contractnumber" name="job[contract_number]" required>
                                    <label for="regular2">No. Kontrak/Tanggal</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_contractvalue" name="job[contract_value]" required>
                                    <label for="regular2">Nilai Kontrak</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-group date" id="tanggalproyek">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" id="job_lastprogress" name="job[last_progress]">
                                            <label>Tanggal Progres terakhir</label>
                                            <p class="help-block">tanggal/bulan/tahun</p>
                                        </div>
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group floating-label">
                                    <input type="text" class="form-control" id="job_progress" name="job[progress]">
                                    <label for="regular2">Prosentase % Pekerjaan</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="trg_job"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
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

    <script type="text/javascript" src="{{ URL::asset('js/jsqbc-functions.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jsqb-tabel-vendor.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jsqb-form-vendor.js') }}"></script>

    @if($user->state != 2)
        <script type="text/javascript" src="{{ URL::asset('js/jsqbc-form-other-vendor.js') }}"></script>
    @else
        <script type="text/javascript" src="{{ URL::asset('js/jsqbcd-form-vendor.js') }}"></script>
    @endif
@endpush
