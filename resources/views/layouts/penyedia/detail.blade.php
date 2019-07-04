@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Detail Penyedia</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Detail Penyedia</li>
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-b-0">
                    <h4 class="card-title">
                        <span class="">{{ $company->name.' ( '.$company->type.'. )' }}&nbsp;
                            @if($user->verified)
                            <button type="button" class="btn btn-xs ink-reaction btn-floating-action btn-info"  data-toggle="tooltip" data-placement="top" title="Terverifikasi">
                                <i class="fa fa-check"></i>
                            </button>
                            @endif
                        </span>
                    </h4>
                    <br>
                    <h6 class="card-subtitle">
                        @if($user->verified)
                        <div class="row">
                            <div class="col-md-6">
                                <h5>
                                    <!-- <strong>Data sudah diverifikasi pada tanggal: {{ DateHelper::long_format($user->verification_time) }} oleh {{ $user->verifier }}</strong> -->
                                    <span class="label label-success">
                                        Data sudah diverifikasi pada tanggal: {{ DateHelper::long_format($user->verification_time) }} oleh {{ $user->verifier }}
                                    </span>
                                </h5>
                            </div>
                        </div>
                        @elseif($user->state == 2)
                        <div class="row">
                                @if(!$assessed_all)
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#verification_redo">
                                            <i class="fa fa-info-circle"></i>&nbsp;&nbsp;Pemberitahuan lengkapi/ubah dokumen penyedia
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <a href="#" class=" btn btn-danger btn-block" data-toggle="modal" data-target="#verification_reject">
                                            <i class="fa fa-times"></i>&nbsp;&nbsp;Tidak Lolos verifikasi penyedia
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="#" class=" btn btn-success btn-block" data-toggle="modal" data-target="#verification_accept">
                                            <i class="fa fa-check"></i>&nbsp;&nbsp;Lolos verifikasi penyedia
                                        </a>
                                    </div>
                                @endif
                            <div class="clear"></div>
                        </div>
                        @endif
                    </h6>
                </div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> 
                        <a class="nav-link active" data-toggle="tab" href="#first5" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                {!! $company->render_tabinformation_icon() !!}
                                &nbsp; Data Perusahaan &nbsp;
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#second5" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                {!! $company->render_tabadministration_icon() !!}
                                &nbsp; Kelengkapan Administrasi
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#third5" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                {!! $company->render_tabother_icon() !!}
                                &nbsp; Data Kelengkapan Lainnya
                            </span>
                        </a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#fourth" role="tab">
                            <span class="hidden-sm-up"></span>
                            <span class="hidden-xs-down">
                                <!-- <i class="fa fa-book"></i>  -->
                                <i class="fa fa-book fa-lg text-danger"  data-toggle="tooltip" data-placement="top" title="Administrasi"></i>
                                &nbsp; Administrasi
                            </span>
                        </a> 
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="first5" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.penyedia.parts.detail.tab-informasi')
                        </div>
                    </div>
                    <div class="tab-pane" id="second5" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.penyedia.parts.detail.tab-kelengkapan')
                        </div>
                    </div>
                    <div class="tab-pane" id="third5" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.penyedia.parts.detail.tab-lainnya')
                        </div>
                    </div>
                    <div class="tab-pane" id="fourth" role="tabpanel">
                        <div class="p-20">
                            @include('layouts.penyedia.parts.detail.tab-administrasi')
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
<!--Modal permintaan ubah-->
<div class="modal fade" id="ubahdata" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="formModalLabel">Permintaan Ubah Data</h4>
            </div>
            <div class="modal-body">
                <p>Untuk mengubah data, Anda harus mengajukan permintaan perubahan data kepada admin PT Indonesia Kendaraan Terminal. <br>Lanjutkan permintaan ubah data ?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a href="<?php echo url('/dashboard'); ?>" class="btn btn-primary ink-reaction"  ><i class="fa fa-check"></i> Ajukan Permintaan Ubah Data</a>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!--Modal permintaan ubah-->
<!--Modal -->
<div class="modal fade" id="verification_accept" tabindex="-1" role="dialog" aria-labelledby="verification_accept_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="verification_accept_label">Lolos verifikasi penyedia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_verification" class="form" role="form" action="/penyedia/verifikasi_terima" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="verification[user]" value="{{ $user->id }}" readonly>
                    <input type="hidden" name="verification[actor]" value="{{ Auth::user()->id }}" readonly>
                    <input type="hidden" name="company_id" value="{{ $company->id }}" readonly>

                    <div class="form-group floating-label">
                        <label for="regular2">Nama Petugas Verifikasi</label>
                        <input type="text" class="form-control" name="verification[name]" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="form-group floating-label">
                        <label for="regular2">Tanggal Verifikasi</label>
                        <input type="text" class="form-control" name="verification[date]" value="{{ DateHelper::datepicker($now) }}" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button id="trg_verification" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Verifikasi</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="verification_reject" tabindex="-1" role="dialog" aria-labelledby="verification_reject_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="verification_reject_label">Tidak Lolos verifikasi penyedia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_reject" class="form" role="form" action="/penyedia/verifikasi_tolak" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="approval[entity_type]" value="vendor" readonly>
                    <input type="hidden" name="approval[entity_id]" value="{{ $company->id }}" readonly>
                    <input type="hidden" name="approval[user_level]" value="4" readonly>
                    <input type="hidden" name="approval[user_id]" value="{{ Auth::user()->id }}" readonly>
                    <input type="hidden" name="user_id" value="{{ $user->id }}" readonly>
                    <input type="hidden" name="company_id" value="{{ $company->id }}" readonly>

                    <div class="form-group floating-label">
                        <label for="regular2">Nama petugas penolak verifikasi</label>
                        <input type="text" class="form-control" id="regular2" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="form-group floating-label">
                        <label for="textarea2">Alasan penolakan verifikasi</label>
                        <textarea name="approval[notes]" id="textarea2" class="form-control" rows="3" placeholder="">{{ $rejection }}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button id="trg_reject" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Kirim pemberitahuan penolakan</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="modal fade" id="verification_redo" tabindex="-1" role="dialog" aria-labelledby="verification_redo_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="verification_redo_label">Pemberitahuan lengkapi/ubah dokumen penyedia</h4>
            </div>
            <div class="modal-body">
                <form id="form_redo" class="form" role="form" action="/penyedia/verifikasi_ulang" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="approval[entity_type]" value="vendor" readonly>
                    <input type="hidden" name="approval[entity_id]" value="{{ $company->id }}" readonly>
                    <input type="hidden" name="approval[user_level]" value="3" readonly>
                    <input type="hidden" name="approval[user_id]" value="{{ Auth::user()->id }}" readonly>
                    <input type="hidden" name="user_id" value="{{ $user->id }}" readonly>
                    <input type="hidden" name="company_id" value="{{ $company->id }}" readonly>

                    <div class="form-group floating-label">
                        <input type="text" class="form-control" id="regular2" value="{{ Auth::user()->name }}" readonly>
                        <label for="regular2">Nama petugas pemberitahuan</label>
                    </div>
                    <div class="form-group floating-label">
                        <textarea name="approval[notes]" id="textarea2" class="form-control" rows="3" placeholder="">{{ $rejection }}</textarea>
                        <label for="textarea2">Alasan pemberitahuan</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button id="trg_redo" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Kirim pemberitahuan verifikasi</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<!--Modal -->
<div class="modal fade" id="catatanpenyedia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formModalLabel">Ubah Catatan Penyedia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_notes" class="form" role="form" action="/vendor/notes" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ $user->id }}" readonly>

                    <div class="form-group floating-label">
                        <label for="regular2">Catatan</label>
                        <textarea type="text" class="form-control" id="mdl_notes" name="notes">{{ $user->notes }}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button id="trg_notes" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
<!--Modal ubah status -->
<div class="modal fade" id="ubahstatus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formModalLabel">Ubah Status Penyedia</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form_penalty" class="form" role="form" action="/vendor/penalty" method="POST">
                    <input type="hidden" name="company_id" value="{{ $company->id }}" />
                    <input type="hidden" name="user_id" value="{{ $user->id }}" />
                    {{ csrf_field() }}
                    <div class="form-group col-md-12 floating-label">
                        <label for="regular2">Nama petugas pengubah status</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="form-group col-md-12 floating-label">
                        <label for="textarea2">Alasan ubah status</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder=""></textarea>
                    </div>

                    <div class="form-group col-md-12 floating-label">
                        <label for="select2">Pilih status</label>
                        <select id="up_state" name="action" class="form-control">
                            <option value="">&nbsp;</option>
                            @if($user->state == 5)
                            <option value="activate">Aktifkan penyedia</option>
                            <option value="blacklist">Blacklist</option>
                            @elseif($user->state == 6)
                            <option value="activate">Aktifkan penyedia</option>
                            <option value="freeze">Bekukan penyedia</option>
                            @else
                            <option value="freeze">Bekukan penyedia</option>
                            <option value="blacklist">Blacklist penyedia</option>
                            @endif
                        </select>
                    </div>
                    <div class="clear"></div>

                    <div class="form-group floating-label">
                        <div class="col-sm-12">
                            <label class="radio-inline radio-styled">
                                <input id="trg_penalty_off" type="radio" name="is_timed" value="0" checked><span>Selamanya</span>
                            </label>
                            <label class="radio-inline radio-styled">
                                <input id="trg_penalty_on" type="radio" name="is_timed" value="1"><span>Sampai Waktu Tertentu</span>
                            </label>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div id="penalty_limit" class="form-group col-md-12 floating-label">
                        <div class="input-group date" id="tanggal_pinalti">
                            <div class="input-group-content">
                                <label>Tanggal batas pembekuan / blacklist</label>
                                <input type="text" class="form-control is_req" name="penalty_end" value="{{ DateHelper::datepicker($default_penalty) }}">
                                <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                            </div>
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button id="trg_penalty" type="button" class="btn btn-primary"><i class="fa fa-check"></i> Simpan perubahan status</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>

<div class="hidden-block">
    <form id="form_assessment" method="POST" action="/vendor/set_assessment">
        {{ csrf_field() }}
        <input type="hidden" id="assessment_id" name="company_id" value="{{ $company->id }}" />
        <input type="hidden" id="assessment_part" name="part" value="" />
        <input type="hidden" id="assessment_checked" name="checked" value="" />
    </form>
</div>

<div id="active_tab" class="hidden-block">{{ Session::get('tab') }}</div>
@php
    Session::forget('tab');
@endphp
<script>
    $(function () {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function () {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function () {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function () {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function () {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            //templateResult: formatRepo, // omitted for brevity, see the source of this page
            //templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
</script>

<script type="text/javascript">
    var company_id = '{{$company->id}}';
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

        $('#trg_verification').on('click', function(event){
            var form = $('form#form_verification');
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    $('#verification_accept').modal('hide');
                    swal("","Data telah selesai diverifikasi","success");
                    // document.location = get_pure_link();
                    call('vendor/daftar','_content_','Terverifikasi');
                },
                error: function(error){
                    swal("","Terjadi kesalahan, harap hubungi pihak terkait.","error");
                }
            });
            event.preventDefault();
        });

        $('#trg_notes').on('click', function(event){
            var form = $('form#form_notes');
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    swal("","Catatan berhasil disimpan","success");
                    // document.location = document.location.href;
                    // document.location = get_pure_link();
                    $('#catatanpenyedia').modal('hide');
                    call('/vendor/detail/'+company_id,'_content_','Detail Penyedia');
                },
                error: function(error){
                    swal("","Terjadi kesalahan, harap hubungi pihak terkait.","error");
                }
            });
            event.preventDefault();
        });

        $('.trg-assessment').each(function(){
            var $el = $(this);
            // var company_id = '{{ $company->id }}';
            $el.on('click', function(){
                var part_raw = $el.attr('name').replace('trg_assessment[', '').replace(']', '');
                $('#assessment_part').val(part_raw);
                if($el.prop('checked')) {
                    $('#assessment_checked').val('1');
                } else {
                    $('#assessment_checked').val('0');
                }

                var form = $('form#form_assessment');
                var formData = new FormData(form[0]);
                $.ajax({
                    type: form.attr("method"),
                    url: form.attr("action"),
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        /** Add By Dandy Firmansyah 07 05 2019 **/
                        var judul_tab = $('.nav-tabs .active').text()
                        var activeTab = judul_tab.replace(/\s/g,''); 
                        var tabs_href = '';
                        
                        var link_redirect = get_pure_link();

                        // console.log(link_redirect+"/"+tabs_href);

                        if (activeTab.toLowerCase() == 'dataperusahaan'){
                            tabs_href = 'first5';
                        }else if (activeTab.toLowerCase() == 'kelengkapanadministrasi'){
                            tabs_href = 'second5';
                        }else if (activeTab.toLowerCase() == 'datakelengkapanlainnya'){
                            tabs_href = 'third5';
                        }else if (activeTab.toLowerCase() == 'administrasi'){
                            tabs_href = 'fourth';
                        }

                        /** End Add By Dandy Firmansyah 07 05 2019 **/
                        //console.log(result);
                        // var all_checked = $('.trg-assessment:checked').length == 13;
                        @if($company->type_id == '4')
                            var all_checked = $('.trg-assessment:checked').length == 6;
                        @else
                            @if($deed_renewal != null && $deed->renewal_number)
                            var all_checked = $('.trg-assessment:checked').length == 11;
                            @else
                            var all_checked = $('.trg-assessment:checked').length == 10;
                            @endif
                        @endif
                        if(all_checked) {
                            // document.location = document.location.href;
                            // document.location = link_redirect+"-"+tabs_href;
                            call('/vendor/detail/'+company_id,'_content_','Detail Penyedia');
                            $('.nav-tabs a[href="#'+tabs_href+'"]').tab('show')
                        }
                        // else{
                        //     // document.location = link_redirect+"-"+tabs_href;
                        //     $('.nav-tabs a[href="#'+tabs_href+'"]').tab('show')
                        // }
                    },
                    error: function(error){
                        console.log(error);
                        swal("","Terjadi kesalahan, harap hubungi pihak terkait.","error");
                    }
                });
            });
        });

        $('#trg_reject').on('click', function(event){
            var form = $('form#form_reject');
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    $('#verification_reject').modal('hide');
                    swal("","Data Penyedia telah ditolak","success");
                    // document.location = '/vendor/daftar-calon';
                    call('/vendor/daftar-calon','_content_','Daftar Calon Vendor');
                },
                error: function(error){
                    console.log(error);
                    swal("","Pemberitahuan gagal, harap hubungi pihak terkait.","error");
                }
            });
            event.preventDefault();
        });

        $('#trg_redo').on('click', function(event){
            var form = $('form#form_redo');
            var formData = new FormData(form[0]);
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(result){
                    $('#verification_redo').modal('hide');
                    swal("","Pemberitahuan berhasil disampaikan.","success");
                    // document.location = document.location.href;
                    // document.location = get_pure_link();
                    call('/vendor/daftar-calon','_content_','Daftar Calon Vendor');
                },
                error: function(error){
                    console.log(error);
                    swal("","Pemberitahuan gagal, harap hubungi pihak terkait.","error");
                }
            });
            event.preventDefault();
        });

        var active_tab = $('#active_tab').text().trim();
        if(active_tab != '') {
            $('a[href=#' + active_tab + ']').trigger('click');
        }

        $('#trg_chat').on('click', function(event){
            var message = $('.note-editable').html();
            if(message == '' || message == '<p></p>' || message == '<p><br></p>') {
                swal("","Harap isi pesan","error");
            } else {
                // $('form#form_chat').submit();
                var form = $('form#form_chat');
                var formData = new FormData(form[0]);
                $.ajax({
                    type: form.attr("method"),
                    url: form.attr("action"),
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        swal("Terkirim!","Pesan Berhasil di kirim.","success");
                        // document.location = document.location.href;
                        // document.location = get_pure_link();
                        call('/vendor/detail/'+company_id,'_content_','Detail Penyedia');
                    },
                    error: function(error){
                        console.log(error);
                        swal("Gagal!","Pesan Gagal di kirim.","error");
                    }
                });
            }
            event.preventDefault();
        });

        $('#tanggal_pinalti').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });

        $('#trg_penalty_on').on('click', function(){
            $('#penalty_limit').show();
        });

        $('#trg_penalty_off').on('click', function(){
            $('#penalty_limit').hide();
        });

        $('#trg_penalty').on('click', function(event){
            // var sure = confirm("Apakah anda yakin?");
            // if(sure == true) {
                // $('form#form_penalty').submit();
            // }
            swal({
                title: "",
                text: "Apakah anda yakin rubah status penyedia ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Ya, Hapus!",
                closeOnConfirm: false
            },
            function(){
                var form = $('form#form_penalty');
                var formData = new FormData(form[0]);
                $.ajax({
                    type: form.attr("method"),
                    url: form.attr("action"),
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        $('#ubahstatus').modal('hide');
                        swal("","Perubahan status penyedia berhasil.","success");
                        // document.location = document.location.href;
                        // document.location = get_pure_link();
                        call('/vendor/detail/'+company_id,'_content_','Detail Penyedia');
                    },
                    error: function(error){
                        console.log(error);
                        swal("","Perubahan status penyedia gagal.","error");
                    }
                });
            });
            event.preventDefault();
        });
    });

    function get_pure_link()
    {
        var link_redirect = document.location.href;
        link_redirect = link_redirect.replace("#","");
        link_redirect = link_redirect.replace("-","");

        var find = ["first5", "second5", "third5", "fourth"];
        var replace = ["", "", "", ""];
        link_redirect = link_redirect.replaceArray(find, replace);
        return link_redirect;
    }

    String.prototype.replaceArray = function(find, replace) {
        var replaceString = this;
        var regex; 
        for (var i = 0; i < find.length; i++) {
            regex = new RegExp(find[i], "g");
            replaceString = replaceString.replace(regex, replace[i]);
        }
        return replaceString;
    };
</script>