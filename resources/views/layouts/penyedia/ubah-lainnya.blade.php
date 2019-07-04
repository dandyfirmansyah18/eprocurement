<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Kelola Data Kelengkapan Lainnya</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="call('<?= url('my_profile'); ?>','_content_','My Profile')">My Profile</a></li>
                    <li class="breadcrumb-item active">Kelola Data Kelengkapan Lainnya</li>
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
                    <h4 class="card-title">Kelola Data Kelengkapan Lainnya</h4>
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
                        <form class="validation-wizard form-validation wizard-circle" action="/penyedia/update_lainnya" method="POST" id="form_other" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" id="currently_disabled" value="{{ $readonly }}">
                            <!-- Step 4 -->
                            <section>
                                @include('layouts.penyedia.wizardparts.datapersonalia')
                            </section>
                        </form>
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

<div class="modal fade" id="tambahpengurus" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="employeeModalLabel">Tambah Pengurus Perusahaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_pengurus" class="form form-validation form-validate" role="form" action="/daftar/save_manager" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="pengurus_id" name="pengurus[id]" />
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />

                    <div class="form-group floating-label">
                        <label for="regular2">Nama Lengkap</label>
                        <input type="text" class="form-control" id="pengurus_name" name="pengurus[name]" required>
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">No. KTP</label>
                        <input type="text" class="form-control" id="pengurus_nationalid" name="pengurus[national_id]">
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Jabatan dalam perusahaan</label>
                        <input type="text" class="form-control" id="pengurus_jobtitle" name="pengurus[job_title]">
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
                <h4 class="modal-title" id="formModalLabel">Tambah Anggota</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_holder" class="form form-validation form-validate" role="form" action="/daftar/save_stakeholder" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="holder_id" name="holder[id]" />
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />

                    <div class="form-group floating-label">
                        <label for="regular2">Nama Pemilik Saham</label>
                        <input type="text" class="form-control" id="holder_name" name="holder[name]" required>
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">No. Identitas</label>
                        <input type="text" class="form-control" id="holder_nationalid" name="holder[national_id]" required>
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Kewarganegaraan</label>
                        <input type="text" class="form-control" id="holder_nationality" name="holder[nationality]" required>
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Alamat</label>
                        <input type="text" class="form-control" id="holder_address" name="holder[address]" required>
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">%</label>
                        <input type="text" class="form-control" id="holder_percentage" name="holder[percentage]" required>
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
                <h4 class="modal-title" id="formModalLabel">Tambah Personalia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_person" class="form form-validation form-validate" role="form" action="/daftar/save_person" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="person_id" name="person[id]" />
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />

                    <div class="form-group floating-label">
                        <label for="regular2">Nama Lengkap</label>
                        <input type="text" class="form-control" id="person_name" name="person[name]" required>
                    </div>
                    <div class="form-group">
                        <div class="input-group date" id="tanggallahirpersonalia">
                            <div class="input-group-content">
                                <label>Tanggal Lahir</label>
                                <input type="text" class="form-control" id="person_birthdate" name="person[birth_date]">
                                <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                            </div>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Pendidikan</label>
                        <input type="text" class="form-control" id="person_education" name="person[education]">
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Jabatan dalam pekerjaan</label>
                        <input type="text" class="form-control" id="person_jobtitle" name="person[job_title]">
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Pengalaman Kerja</label>
                        <input type="text" class="form-control" id="person_experience" name="person[experience]">
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Profesi/keahlian</label>
                        <input type="text" class="form-control" id="person_expertise" name="person[expertise]">
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
                <h4 class="modal-title" id="formModalLabel">Tambah Pengalaman Perusahaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_exp" class="form form-validation form-validate" role="form" action="/daftar/save_experience" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="exp_id" name="exp[id]" />
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nama Paket Pekerjaan</label>
                                <input type="text" class="form-control" id="exp_name" name="exp[name]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Bidang/Sub Bidang</label>
                                <input type="text" class="form-control" id="exp_field" name="exp[field]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group floating-label">
                                <label for="regular2">Lokasi</label>
                                <input type="text" class="form-control" id="exp_location" name="exp[location]" required>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nama Pemberi Tugas/Pengguna Jasa</label>
                                <input type="text" class="form-control" id="exp_clientname" name="exp[client_name]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">No Telp Pemberi Tugas/Pengguna Jasa</label>
                                <input type="text" class="form-control" id="exp_clientphone" name="exp[client_phone]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">No. Kontrak/Tanggal</label>
                                <input type="text" class="form-control" id="exp_contractnumber" name="exp[contract_number]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nilai Kontrak</label>
                                <input type="text" class="form-control" id="exp_contractvalue" name="exp[contract_value]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group date" id="tanggalpersonalia_mulai">
                                    <div class="input-group-content">
                                        <label>Tanggal Selesai berdasarkan kontrak</label>
                                        <input type="text" class="form-control" id="exp_contractdue" name="exp[contract_due]">
                                        <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                                    </div>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group date" id="tanggalpersonalia_selesai">
                                    <div class="input-group-content">
                                        <label>Tanggal Selesai berdasarkan BA Serah terima</label>
                                        <input type="text" class="form-control" id="exp_handover" name="exp[hand_over]">
                                        <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
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
                <h4 class="modal-title" id="formModalLabel">Tambah Surat/Sertifikasi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                                <label for="regular2">Jenis Surat</label>
                                <select class="form-control" id="cert_type" name="cert[type]" required=>
                                    <option value="sertifikat">Sertifikat</option>
                                    <option value="principal">Principal</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nomor Surat/Sertifikasi</label>
                                <input type="text" class="form-control" id="cert_number" name="cert[number]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nama Surat/Sertifikasi</label>
                                <input type="text" class="form-control" id="cert_title" name="cert[title]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group date" id="cert_release_date_block">
                                    <div class="input-group-content">
                                        <label>Tanggal Diterbitkan</label>
                                        <input type="text" class="form-control" id="cert_release_date" name="cert[release_date]">
                                        <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                                    </div>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group date" id="cert_expired_date_block">
                                    <div class="input-group-content">
                                        <label>Tanggal Habis Berlaku</label>
                                        <input type="text" class="form-control" id="cert_expired_date" name="cert[expired_date]">
                                        <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                                    </div>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Institusi</label>
                                <input type="text" class="form-control" id="cert_author" name="cert[author]" required>
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
                                <small id="emailHelp" class="form-text text-muted">Unggah Surat/Sertifikat</small>
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
                <h4 class="modal-title" id="formModalLabel">Tambah Pengalaman Perusahaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_job" class="form form-validation form-validate" role="form" action="/daftar/save_job" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="job_id" name="job[id]" />
                    <input type="hidden" id="user_id" name="user_id" value="{{ $user->id }}" />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nama Paket Pekerjaan</label>
                                <input type="text" class="form-control" id="job_name" name="job[name]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Bidang/Sub Bidang</label>
                                <input type="text" class="form-control" id="job_field" name="job[field]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group floating-label">
                                <label for="regular2">Lokasi</label>
                                <input type="text" class="form-control" id="job_location" name="job[location]" required>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nama Pemberi Tugas/Pengguna Jasa</label>
                                <input type="text" class="form-control" id="job_clientname" name="job[client_name]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">No Telp Pemberi Tugas/Pengguna Jasa</label>
                                <input type="text" class="form-control" id="job_clientphone" name="job[client_phone]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">No. Kontrak/Tanggal</label>
                                <input type="text" class="form-control" id="job_contractnumber" name="job[contract_number]" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Nilai Kontrak</label>
                                <input type="text" class="form-control" id="job_contractvalue" name="job[contract_value]" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-group date" id="tanggalproyek">
                                    <div class="input-group-content">
                                        <label>Tanggal Progres terakhir</label>
                                        <input type="text" class="form-control" id="job_lastprogress" name="job[last_progress]">
                                        <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                                    </div>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group floating-label">
                                <label for="regular2">Prosentase % Pekerjaan</label>
                                <input type="text" class="form-control" id="job_progress" name="job[progress]">
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

<script type="text/javascript" src="{{ asset('js/jsqb-tabel-vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsqb-form-vendor.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/form-wizard-daftar.js') }}"></script>

@if($user->state != 2)
    <script type="text/javascript" src="{{ asset('js/jsqbc-form-other-vendor.js') }}"></script>
@else
    <script type="text/javascript" src="{{ asset('js/jsqbcd-form-vendor.js') }}"></script>
@endif
