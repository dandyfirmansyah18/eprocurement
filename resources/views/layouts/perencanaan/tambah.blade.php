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
            <h4 class="text-themecolor">Tambah Baru</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tambah Baru</li>
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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                <form id="form_perencanaan" class="form floating-label form-validation form-validate" action="/perencanaan/simpan" method="POST" novalidate="novalidate">
                    <div class="card-body floating-label">
                        <!-- <div class="judulformtop">
                            <i class="fa fa-file-text"></i> Data Pengajuan
                        </div> -->
                        <h4 class="card-title">Register Perencanaan</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="gelardepan">Unit Kerja *</label>
                                    <input type="text" class="form-control" id="gelardepan" value="{{ $unit['name'] }}" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="namalengkap">Nama Lengkap Pengaju *</label>
                                    <input type="text" class="form-control" id="namalengkap" value="{{ $user['name'] }}" readonly>
                                    <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user['id'] }}">
                                </div>
                            </div>

                        </div>

                        <!--nama pekerjaan, hps -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group floating-label">
                                    <label>Metode Pengadaan *</label>
                                    <select class="form-control select2-list" id="procurement_method" name="procurement_method">
                                        <option value=""></option>
                                        <option value="1">Pelelangan/Seleksi Umum</option>
                                        <!-- <option value="2">Pelelangan Selektif/Seleksi Terbatas</option> -->
                                        <option value="3">Pemilihan Langsung/Seleksi Langsung</option>
                                        <option value="4">Penunjukan Langsung</option>
                                        <option value="5">Pengadaan Langsung</option>
                                    </select>
                                    <input type="hidden" name="metode" id="metode" value="{{ $data['procurement_method'] }}" disabled="disabled">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <span class="boks hidden-block">
                                    <div class="form-group floating-label">
                                        <label>Pilih Rekanan</label>
                                        <input type="hidden" name="vendorlisthidden" id="vendorlisthidden" value="{{ $vendors }}" disabled="disabled">
                                        <select id="vendorlist" class="form-control select2-list" multiple name="vendorlist[]">
                                            <option value=""></option>
                                            @foreach($vendorlist as $vendor)
                                                <option value="{{ $vendor['id'] }}">{{ $vendor['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="namalengkap">Nama Pekerjaan *</label>
                                    <input type="text" class="form-control is_req" id="title" name="title" value="{{ $data['title'] }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="namalengkap">RAB/HPS/OE *</label>
                                    <input type="text" class="form-control hps-mask is_req" id="amount" name="amount" value="{{ $data['amount'] }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Usulan tanggal mulai/pengumuman pengadaan</label>
                                    <input type="text" class="form-control is_req" id="tanggal_start" name="start_date" value="{{ DateHelper::datepicker($data['start_date']) }}">
                                    <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                                    <!-- <span class="input-group-addon"><i class="fa fa-calendar"></i></span> -->
                                </div>
                            </div>
                        </div>

                        <!--Nodin -->
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="namalengkap">Nomor Nota Dinas *</label>
                                    <input type="text" class="form-control is_req" id="memo_number" name="memo_number" value="{{ $data['memo_number'] }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tanggal Nota Dinas *</label>
                                    <input type="text" class="form-control is_req" id="tanggal_memo" name="memo_date" value="{{ DateHelper::datepicker($data['memo_date']) }}">
                                    <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div id="planning_memo_block" class="form-group dropzone-block tight">
                                Unggah Nota Dinas *
                                    <input type="hidden" name="token_planning_memo" id="token_planning_memo" value="{{ csrf_token() }}">
                                    <div class="upload-block">
                                        @if($planning_memo != null && $planning_memo->filename != null)
                                        <div class="image-block">
                                            File saat ini:<br>
                                            {!! FormHelper::file_tag($planning_memo->filepath, $planning_memo->filename) !!}
                                        </div>
                                        @endif
                                        <div id="planning_memo" class="dropzone tight" url="/upload/memo">
                                            <div class="dz-message btn btn-default">
                                                <h5>
                                                    Pilih file
                                                </h5>
                                            </div>
                                        </div> 
                                    </div><br>
                                    <div class="clear"></div>
                                    
                                    <small id="emailHelp" class="form-text text-muted">* Maks. Upload File 10 MB</small>   
                                    <div class="clear"></div>
                                </div>
                            </div>


                        </div>

                        <!--SPPP -->
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="form-group floating-label">
                                    <label for="namalengkap">Nomor SPPP/B *</label>
                                    <input type="text" class="form-control is_req" id="issuance_number" name="issuance_number" value="{{ $data['issuance_number'] }}">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Tanggal SPPP/B *</label>
                                    <input type="text" class="form-control is_req" id="tanggal_issuance" name="issuance_date" value="{{ DateHelper::datepicker($data['issuance_date']) }}">
                                    <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div id="planning_issuance_block" class="form-group dropzone-block tight">
                                Unggah SPPP/B *
                                    <input type="hidden" name="token_planning_issuance" id="token_planning_issuance" value="{{ csrf_token() }}">
                                    <div class="upload-block">
                                        @if($planning_issuance != null && $planning_issuance->filename != null)
                                        <div class="image-block">
                                            File saat ini:<br>
                                            {!! FormHelper::file_tag($planning_issuance->filepath, $planning_issuance->filename) !!}
                                        </div>
                                        @endif
                                        <div id="planning_issuance" class="dropzone tight" url="/upload/issuance">
                                            <div class="dz-message btn btn-default">
                                                <h5>
                                                    Pilih file
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <small id="emailHelp" class="form-text text-muted">* Maks. Upload File 10 MB</small>
                                    <div class="clear"></div>
                                </div>
                            </div>

                        </div>

                        <!--RKS -->
                        <div class="row">
                            <div class="col-sm-4">
                                &nbsp;
                            </div>
                            <div class="col-sm-4">
                                &nbsp;
                            </div>
                            <div class="col-sm-4">
                                <div id="planning_rks_block" class="form-group dropzone-block tight">
                                Unggah RKS Teknis *
                                    <input type="hidden" name="token_planning_rks" id="token_planning_rks" value="{{ csrf_token() }}">
                                    <div class="upload-block">
                                        @if($planning_rks != null && $planning_rks->filename != null)
                                        <div class="image-block">
                                            File saat ini:<br>
                                            {!! FormHelper::file_tag($planning_rks->filepath, $planning_rks->filename) !!}
                                        </div>
                                        @endif
                                        <div id="planning_rks" class="dropzone tight" url="/upload/rks">
                                            <div class="dz-message btn btn-default">
                                                <h5>
                                                    Pilih file
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <small id="emailHelp" class="form-text text-muted">* Maks. Upload File 10 MB</small>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>

                        

                            <!--Back Date ->
                            <div class="row">
                            <div class="col-sm-4">
                            <label class="checkbox checkbox-styled">
                            <input id="trg_back_date" type="checkbox" name="with_back_date" class="target-checker" {{ $with_back_date }}><span>Disertai Back Date</span>
                        </label>
                    </div>
                    <div class="col-sm-4">
                    <div id="back_date_block" class="form-group">
                    <div class="input-group date" id="tanggal_back">
                    <div class="input-group-content">
                        <label>Usulan tanggal mulai/pengumuman pengadaan (backdate)</label>
                    <input type="text" class="form-control" name="back_date" value="{{ \App\Helpers\AuxHelper::render_date($data['back_date']) }}">
                    <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
                </div>
                </div>
                <div class="col-sm-4">
                </div>
                </div>
                -->

                        <div class="clear"></div>
                        <!-- <div class="judulform">
                            <i class="fa fa-file-text-o"></i> Catatan dan justifikasi
                        </div> -->
                        <h4 class="card-title">Catatan dan Justifikasi</h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Catatan</label>
                                    <textarea name="notes" id="textarea1" class="form-control" rows="2">{{ $data['notes'] }}</textarea>
                                    <small id="emailHelp" class="form-text text-muted">Catatan terkait pengadaan ini</small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Justifikasi * </label>
                                    <textarea name="justification" id="textarea1" class="form-control is_req" rows="2">{{ $data['justification']}}</textarea>
                                    <small id="emailHelp" class="form-text text-muted">Mengapa memilih metode pengadaan dan penyedia ini</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            {{ csrf_field() }}
                            <input type="hidden" id="item_id" name="id" value="{{ $data['id'] }}" >

                            @if($pseudo_id != 0)
                                <input type="hidden" id="pseudo_id" name="pseudo_id" value="{{ $pseudo_id }}" >
                            @endif

                            <button class="btn btn-primary ink-reaction simpan-data" onclick="save_perencanaan(this.form.id);return false;">
                                <i class="fa fa-plus"></i>&nbsp;Buat Perencanaan Pengadaan
                            </button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Row -->
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reset_password_label" id="save_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="save_modal_label" style="color:red">Data yang disikan kurang lengkap atau tidak sesuai</h4>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <p>Harap melengkapi semua informasi data pengajuan. Pastikan Anda sudah:</p>
                    <ol>
                        <li>Memilih metode pengadaan yang sesuai</li>
                        <li>Memilih rekanan yang sesuai jika metode pengadaan merupakan Pemilihan Langsung, Penunjukan Langsung, atau Pengadaan Langsung.</li>
                        <li>Sudah mengupload semua berkas yang diperlukan(Nota Dinas, SPPP/B, RKS Teknis)</li>
                        <li>Mengisi semua field wajib dengan benar:
                            <ul>
                                <li>Nama pekerjaan</li>
                                <li>Nomor dan tanggal Nota Dinas sudah benar</li>
                                <li>Nomor dan tanggal SPPP/B sudah benar</li>
                                <li>Justifikasi mengenai isian pengajuan perencanaan Anda</li>
                            </ul>
                        </li>
                        <li>Nilai RAB/HPS/OE sesuai dengan peraturan
                            <ul>
                                <li>Pemilihan langsung memiliki batas maksimum Rp 15.000.000.000 (Lima belas miliar rupiah)</li>
                                <li>Pengadaan langsung memiliki batas maksimum Rp 500.000.000 (Lima ratus juta rupiah)</li>
                            </ul>
                        </li>
                    </ol>
                </div>
                <div class="clear"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
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
    $(document).ready(function() {
        $('#tanggal_back').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });

        $('#tanggal_start').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });

        $('#tanggal_memo').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });

        $('#tanggal_issuance').datepicker({
            autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
        });


        $('#trg_back_date').on('change', function(){
            if($(this).prop('checked') == true) {
                $('#back_date_block').show();
            } else {
                $('#back_date_block').hide();
            }
        });

        $('#trg_back_date').change();

        $('#procurement_method').on('change', function() {
            var value   = $(this).val();
            if (value != '' && (value == 3 || value == 4 || value == 5)) {
                $(".boks").show();
            } else {
                $(".boks").hide();
            }
        });

        if ($('#vendorlisthidden').val() == '')
        {
            $(".boks").hide();
        }
        else
        {
            //Load Vendor Data
            $(".boks").show();
            var vendorlist  = $("#vendorlisthidden").val();
            var vendor_list = vendorlist.split(",");
            $('#vendorlist').val(vendor_list);
            $('#vendorlist').change();
        }

        //Combo
        var kualifikasi = $('#kualifikasi').val();
        var metode      = $('#metode').val();

        if(kualifikasi != null)
        {
            $('#kualifikasi-pengadaan').val(kualifikasi)
        }

        if(metode != null)
        {
            $('#procurement_method').val(metode);
            $('#procurement_method').change();
        }

        $(".form-control.hps-mask").inputmask('Rp 9.999.999.999.999', {numericInput: true, rightAlignNumerics: false, removeMaskOnSubmit: true});

        $(".form-control.hps-mask").val({{ $data['amount']}});

        $(".select2-list").select2({
            allowClear: true
        });

        // $('#trg_save').on('click', function(event){
        //     var has_rks             = $('#planning_rks .dz-preview').length > 0;
        //     var has_memo            = $('#planning_memo .dz-preview').length > 0;
        //     var has_issuance        = $('#planning_issuance .dz-preview').length > 0;
        //     var existing_rks        = $('#planning_rks_block .image-block').length > 0;
        //     var existing_issuance   = $('#planning_issuance_block .image-block').length > 0;
        //     var valid               = true;
        //     var method              = $('#procurement_method').val();

        //     $('.is_req').each(function(){
        //         if($(this).val() == '') {
        //             valid           = false;
        //         }
        //     });

        //     valid                   = valid && method != '';
        //     has_rks                 = has_rks || existing_rks;
        //     has_memo                = has_rks || existing_memo;
        //     has_issuance            = has_rks || existing_issuance;

        //     if(method != '' && (method == 3 || method == 4 || method == 5)) {
        //         var vendors         = $('#vendorlist').val();
        //         var valid_vendors   = vendors != null && vendors.length > 0;
        //         valid               = valid && valid_vendors;

        //         var amount          = $('#amount').val().replace('Rp ', '').replace(/\./g, '').replace(/_/g, '').trim();
        //         var parsed_amount   = parseInt(amount);
        //         if(valid && (method == 3 && parsed_amount > 15000000000)) {
        //             valid           = false;
        //         } else if(valid && (method == 5 && parsed_amount > 500000000)) {
        //             valid           = false;
        //         }
        //     }


        //     if(valid == true && has_rks == true && has_memo == true && has_issuance == true) {
        //         submit_form('form_perencanaan');
        //     } else {
        //         $('#save_modal').modal();
        //     }

        //     event.preventDefault();
        // });


        Dropzone.autoDiscover = false;

        var upload_url  = '/upload/planning';
        var item_id     = $('#item_id').val();

        if($('#pseudo_id').length > 0) {
            upload_url  = '/upload/pseudo_planning';
            item_id     = $('#pseudo_id').val();
        }

        var token_planning_memo = $('#token_planning_memo').val();
        var user_id = $('#user_id').val();

        $('#planning_memo').dropzone({
            url: upload_url,
            paramName: 'files',
            params: {
                '_token': token_planning_memo,
                'purpose': 'memo',
                'id': item_id
            },
            maxFilesize: 70,
            uploadMultiple: "no",
            maxFiles: 1,
            parallelUploads: 1,
            acceptedFiles: "image/jpeg, .pdf, .xls, .xlsx",
            addRemoveLinks: true,
            removedFile: function(file) {
                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '30px').css('right', '10px');
                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '30px');

                file.previewElement.remove();
            },
            init: function() {
                this.on("maxfilesexceeded", function() {
                    if (this.files[1]!=null){
                        this.removeFile(this.files[0]);
                    }
                });
            },
            success: function(file, response) {
                if(response.status == 'OK') {
                    var filepath = response.filepath;
                    var filename = response.filename;
                    var remove_btn = file.previewElement.querySelector('.dz-remove');

                    file.previewElement.classList.add('dz-success');
                    remove_btn.setAttribute('data-filename', filepath);

                    $(file.previewElement).parent().parent()
                    .find('.dropzone').css('margin-top', '0px');

                    $('#planning_memo .dz-image, #planning_memo .dz-details').on('click', function(){
                        window.open('/uploads/' + response.filepath,'_blank');
                    });
                    // alert("Dokumen berhasil di Upload.");
                    swal("","Dokumen Berhasil di Upload","success");

                    $('#planning_memo .dz-remove').on('click', function(){
                        $.ajax({
                            type: 'POST',
                            url: '/file/delete',
                            data: { 'filepath': filepath, '_token': token_planning_memo },
                            cache: false,
                            success: function(success){
                                alert("Dokumen berhasil di hapus.");
                                //console.log(success);
                                //window.location = window.location.href;
                            },
                            error: function(error){
                                console.log(error);
                                alert("Something went wrong, please try again later.");
                            }
                        });
                    });
                } else {
                    file.previewElement.classList.add('dz-error');
                }
            },
            error: function(file, response) {
                file.previewElement.classList.add('dz-error');
            }
        });

        var token_planning_issuance = $('#token_planning_issuance').val();
        $('#planning_issuance').dropzone({
            url: upload_url,
            paramName: 'files',
            params: {
                '_token': token_planning_issuance,
                'purpose': 'issuance',
                'id': item_id
            },
            maxFilesize: 20,
            uploadMultiple: "no",
            maxFiles: 1,
            parallelUploads: 1,
            acceptedFiles: "image/jpeg, .pdf, .xls, .xlsx",
            addRemoveLinks: true,
            removedFile: function(file) {
                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '30px').css('right', '10px');
                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '30px');

                file.previewElement.remove();
            },
            init: function() {
                this.on("maxfilesexceeded", function() {
                    if (this.files[1]!=null){
                        this.removeFile(this.files[0]);
                    }
                });
            },
            success: function(file, response) {
                if(response.status == 'OK') {
                    var filepath = response.filepath;
                    var filename = response.filename;
                    var remove_btn = file.previewElement.querySelector('.dz-remove');

                    file.previewElement.classList.add('dz-success');
                    remove_btn.setAttribute('data-filename', filepath);

                    $(file.previewElement).parent().parent()
                    .find('.dropzone').css('margin-top', '0px');
                    // alert("Dokumen berhasil di Upload.");
                    swal("","Dokumen Berhasil di Upload","success");

                    $('#planning_memo .dz-image, #planning_memo .dz-details').on('click', function(){
                        window.open('/uploads/' + response.filepath,'_blank');
                    });

                    $('#planning_memo .dz-remove').on('click', function(){
                        $.ajax({
                            type: 'POST',
                            url: '/file/delete',
                            data: { 'filepath': filepath, '_token': token_planning_memo },
                            cache: false,
                            success: function(success){
                                alert("Dokumen berhasil di hapus.");
                                //console.log(success);
                                //window.location = window.location.href;
                            },
                            error: function(error){
                                console.log(error);
                                alert("Something went wrong, please try again later.");
                            }
                        });
                    });
                } else {
                    file.previewElement.classList.add('dz-error');
                }
            },
            error: function(file, response) {
                file.previewElement.classList.add('dz-error');
            }
        });

        var token_planning_rks = $('#token_planning_rks').val();
        $('#planning_rks').dropzone({
            url: upload_url,
            paramName: 'files',
            params: {
                '_token': token_planning_rks,
                'purpose': 'rks',
                'id': item_id
            },
            maxFilesize: 20,
            uploadMultiple: "no",
            maxFiles: 1,
            parallelUploads: 1,
            acceptedFiles: "image/jpeg, .pdf, .xls, .xlsx",
            addRemoveLinks: true,
            removedFile: function(file) {
                $(file.previewElement).parent().parent().parent()
                .find('.help-block').css('bottom', '30px').css('right', '10px');
                $(file.previewElement).parent().parent()
                .find('.dropzone').css('margin-top', '30px');

                file.previewElement.remove();
            },
            init: function() {
                this.on("maxfilesexceeded", function() {
                    if (this.files[1]!=null){
                        this.removeFile(this.files[0]);
                    }
                });
            },
            success: function(file, response) {
                if(response.status == 'OK') {
                    var filepath = response.filepath;
                    var filename = response.filename;
                    var remove_btn = file.previewElement.querySelector('.dz-remove');

                    file.previewElement.classList.add('dz-success');
                    remove_btn.setAttribute('data-filename', filepath);

                    $(file.previewElement).parent().parent()
                    .find('.dropzone').css('margin-top', '0px');
                    // alert("Dokumen berhasil di Upload.");
                    swal("","Dokumen Berhasil di Upload","success");

                    $('#planning_memo .dz-image, #planning_memo .dz-details').on('click', function(){
                        window.open('/uploads/' + response.filepath,'_blank');
                    });

                    $('#planning_memo .dz-remove').on('click', function(){
                        $.ajax({
                            type: 'POST',
                            url: '/file/delete',
                            data: { 'filepath': filepath, '_token': token_planning_memo },
                            cache: false,
                            success: function(success){
                                alert("Dokumen berhasil di hapus.");
                                //console.log(success);
                                //window.location = window.location.href;
                            },
                            error: function(error){
                                console.log(error);
                                alert("Something went wrong, please try again later.");
                            }
                        });
                    });
                } else {
                    file.previewElement.classList.add('dz-error');
                }
            },
            error: function(file, response) {
                file.previewElement.classList.add('dz-error');
            }
        });

    });

    function save_perencanaan(formid)
    {   
        var has_rks             = $('#planning_rks .dz-preview').length > 0;
        var has_memo            = $('#planning_memo .dz-preview').length > 0;
        var has_issuance        = $('#planning_issuance .dz-preview').length > 0;
        var existing_rks        = $('#planning_rks_block .image-block').length > 0;
        var existing_issuance   = $('#planning_issuance_block .image-block').length > 0;
        var valid               = true;
        var method              = $('#procurement_method').val();

        $('.is_req').each(function(){
            if($(this).val() == '') {
                valid           = false;
            }
        });

        valid                   = valid && method != '';
        has_rks                 = has_rks || existing_rks;
        // has_memo                = has_rks || existing_memo;
        has_issuance            = has_rks || existing_issuance;

        if(method != '' && (method == 3 || method == 4 || method == 5)) {
            var vendors         = $('#vendorlist').val();
            var valid_vendors   = vendors != null && vendors.length > 0;
            valid               = valid && valid_vendors;

            var amount          = $('#amount').val().replace('Rp ', '').replace(/\./g, '').replace(/_/g, '').trim();
            var parsed_amount   = parseInt(amount);
            if(valid && (method == 3 && parsed_amount > 15000000000)) {
                valid           = false;
            } else if(valid && (method == 5 && parsed_amount > 500000000)) {
                valid           = false;
            }
        }


        if(valid == true && has_rks == true && has_issuance == true) {
            submit_form(formid);
        } else {
            $('#save_modal').modal();
        }
    }
</script>