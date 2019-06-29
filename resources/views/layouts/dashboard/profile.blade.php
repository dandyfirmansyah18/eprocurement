@extends('layouts.main')
@section('title','Halaman Detail Penyedia')
@push('csspage')
<link rel="stylesheet" href="{{ URL::asset('css/libs/summernote/summernote.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('js/libs/rating/star-rating.min.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"  type="text/css"/>

@endpush

@section('content')
    <!-- BEGIN content SECTION -->
    <section class="style-default-bright">
        <div class="section-header">
            <h3 class="col-md-12">
                <span class="">{{ $company->name }}&nbsp;
                    @if($user->verified)
                    <button type="button" class="btn btn-xs ink-reaction btn-floating-action btn-info"  data-toggle="tooltip" data-placement="top" title="Terverifikasi">
                        <i class="fa fa-check"></i>
                    </button>
                    @endif
                </span>
            </h3>
        </div>
        <br>

        <div class="section-body mtm15">
            <div class="row">
                <div class="col-md-12">
                    <div class="card tabs style-default-light">
                        <ul class="card-head nav nav-tabs " data-toggle="tabs">
                            <li class="active">
                                <a href="#first5">
                                    &nbsp; Data Perusahaan &nbsp;
                                </a>
                            </li>
                            <li>
                                <a href="#second5">
                                    &nbsp; Kelengkapan Administrasi
                                </a>
                            </li>
                            <li>
                                <a href="#third5">
                                    &nbsp; Data Kelengkapan Lainnya
                                </a>
                            </li>
                            <li>
                                <a href="#fourth">
                                    <i class="fa fa-book"></i> &nbsp; Administrasi
                                </a>
                            </li>
                        </ul>
                        <div class="pt0 card-body tab-content style-default-bright">
                            <div class="tab-pane active" id="first5">
                                @include('dashboard.parts.profile.tab-informasi')
                            </div>
                            <div class="tab-pane " id="second5">
                                @include('dashboard.parts.profile.tab-kelengkapan')
                            </div>
                            <div class="tab-pane " id="third5">
                                @include('dashboard.parts.profile.tab-lainnya')
                            </div>
                            <div class="tab-pane" id="fourth">
                                @include('dashboard.parts.profile.tab-administrasi')
                            </div>
                        </div><!--end .card-body -->
                    </div><!--end .card -->
                </div>
            </div>
        </div>

    </section>
    <!-- END content SECTION -->
@endsection

@push('modal')
    <div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="change_password_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="change_password_label">Ubah password</h4>
                </div>
                <div class="modal-body">
                    <form id="form_password" class="form" role="form" action="/pengguna/ubah_password" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $user->id }}" readonly>

                        <div class="form-group floating-label">
                            <input type="password" id="old_password" class="form-control" name="password[old]" value="" />
                            <label>Password Lama</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="password" id="new_password" class="form-control" name="password[new]" value="" />
                            <label>Password Baru</label>
                        </div>
                        <div class="form-group floating-label">
                            <input type="password" id="conf_password" class="form-control" name="password[confirmation]" value="" />
                            <label>Konfirmasi Password Baru</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="trg_password" type="button" class="btn btn-primary">
                        <i class="fa fa-save"></i>&nbsp;Ubah Password
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>

    <!--Modal permintaan ubah-->
    <div class="modal fade" id="ubahdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="formModalLabel">Permintaan Ubah Data</h4>
                </div>
                <div class="modal-body">
                    <p>Kegiatan ubah data akan merubah data seperti Data Penanggung Jawab, Data Perusahaan, Data Pendirian.</p>
                    <p>Jika Anda hanya ingin mengubah "data lainnya" (data personalia, sertifikat, dll), silahkan klik tombol ubah data yang terdapat di profile anda pada tab "data kelengkapan lainnya"</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <a href="/my_profile/ubah" class="btn btn-primary ink-reaction"  >
                        <i class="fa fa-check"></i> Lanjutkan Ubah Data
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
    <!--Modal permintaan ubah-->

    <div id="active_tab" class="hidden-block">{{ Session::get('tab') }}</div>
    @php
        Session::forget('tab');
    @endphp
@endpush

@push('jspage')
    <script type="text/javascript" src="{{ URL::asset('js/libs/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/rating/star-rating.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#input-2-xs").rating();
        $('#summernote').summernote({
            height: 150,
            placeholder: 'tulis pesan',
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'table', 'hr']]
            ]
        });

        var active_tab = $('#active_tab').text().trim();
        if(active_tab != '') {
            $('a[href=#' + active_tab + ']').trigger('click');
        }

        $('#trg_chat').on('click', function(event){
            var message = $('.note-editable').html();
            if(message == '' || message == '<p></p>' || message == '<p><br></p>') {
                alert('Harap isi pesan');
            } else {
                $('form#form_chat').submit();
            }
            event.preventDefault();
        });

        $('#trg_password').on('click', function(event){
            var old_password    = $('#old_password').val();
            var new_password    = $('#new_password').val();
            var conf_password   = $('#conf_password').val();
            if(old_password != '') {
                if(new_password != '') {
                    if(new_password == conf_password) {
                        var form            = $('form#form_password');
                        var form_data       = new FormData(form[0]);
                        $.ajax({
                            type: form.attr("method"),
                            url: form.attr("action"),
                            data: form_data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(result){
                                if(result.status == 'OK') {
                                    alert('Password berhasil diubah');
                                } else {
                                    alert('Password lama salah');
                                }
                                $('#change_password').modal('hide');
                            },
                            error: function(error){
                                console.log(error);
                                alert("Failed. Something went wrong, please try again later.");
                            }
                        });
                    } else {
                        alert('Konfirmasi password tidak sama');
                    }
                } else {
                    alert('Password baru tidak boleh kosong');
                }
            } else {
                alert('Harap mengisi password lama');
            }
            event.preventDefault();
        })
    });
    </script>
@endpush
