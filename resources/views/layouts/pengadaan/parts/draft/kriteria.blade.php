@php
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane" id="third" role="tabpanel">
    <br />
    <a href="#">
        <i class="fa fa-book"></i>&nbsp; Metode Pengadaan
    </a>
    <hr>
    <form id="form_qualification" action="/draft/qualification_save" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="procurement_id" value="{{ $item->id }}" />
        <div class="row tight-floating">
            <div class="col-sm-4">
                <div class="form-group floating-label">
                    <input id="pc_qualification" type="hidden" name="qualification" value="{{ $item->procurement_qualification }}" />
                    <label class="tight-label dirty">Metode kualifikasi</label>
                    <select id="trg_qualification" class="form-control select2-list" name="qualification" {{ $disabled }}>
                        <option value="2">Kualifikasi</option>
                        <option value="1">Pra-kualifikasi</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group floating-label">
                    <input id="pc_delivery" type="hidden" name="delivery" value="{{ $item->delivery_method }}" />
                    <label class="tight-label dirty">Metode penyampaian dokumen</label>
                    <select id="trg_delivery" class="form-control select2-list" name="delivery" {{ $disabled }}>
                        <option value="1">Satu Sampul</option>
                        <option value="2">Dua Sampul</option>
                        <option value="3">Dua Tahap</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <a id="trg_save_qualification" href="#" class="btn btn-primary btn-block">
            <i class="fa fa-save"></i> Simpan Metode Pengadaan
        </a>
        </div>
        <hr>
        <div id="pre_block" class="hidden-block">
            <div class="row tight-floating">
                <div class="col-sm-4">
                    <div class="form-group floating-label">
                        <label class="tight-label">Keterangan Pra-kualifikasi</label>
                        <textarea id="trg_pre_notes" class="form-control" name="pre_notes">{{ $item->pre_notes }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="pre_information_block" class="form-group dropzone-block tight">
                        <input type="hidden" id="pre_information_pid" value="{{ $item->id }}">
                        <input type="hidden" id="token_pre_information" value="{{ csrf_token() }}">
                        <div class="upload-block">
                            @if($pre_information != null && $pre_information->filename != null)
                            <div class="image-block">
                                File saat ini:<br>
                                {!! FormHelper::file_tag($pre_information->filepath, $pre_information->filename) !!}
                            </div>
                            @endif
                            <div id="pre_information" class="dropzone tight" url="/upload/issuance">
                                <div class="dz-message btn btn-default">
                                    <h5>
                                        Pilih file
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <p class="help-block">Unggah Dokumen Pra-kualifikasi</p>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <a href="#"><i class="ti-pencil"></i> Metode Penilaian</a>
    <hr>
    
    <form class="form-horizontal" role="form">
        <input type="hidden" id="scoring_method" value="{{ $measurement->scoring }}">
        <div class="form-group ">
            <div class="col-sm-8">
                <label class="radio-inline radio-styled">
                    <input id="trg_nonscoring" class="jenis_eval" type="radio" name="inlineRadioOptions" value="2"{{ $disabled }}>
                    <span>Metode <em>Non-Scoring</em></span>
                </label>
                <br>
                <label class="radio-inline radio-styled">
                    <input id="trg_scoring" class="jenis_eval"  type="radio" name="inlineRadioOptions" value="1"{{ $disabled }}>
                    <span>Metode <em>Scoring</em></span>
                </label>
            </div>
            <br>
            <div class="col-md-4">
                <a id="trg_save_measurement" href="#" class="btn btn-primary btn-block">
                    <i class="fa fa-save"></i> Simpan Metode Penilaian
                </a>
            </div>
        </div>
    </form>

    <hr>

    <div id="pilihan1" class="pilihan hidden-block">
        <div class="row">
            <form  id="form_measurement" action="/draft/measurement_save" method="POST" class="form floating-label" role="form" novalidate="novalidate">
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id" value="{{ $item->id }}" />
                <input id="chk_method" type="hidden" name="method" value="scoring" />
                <div class="col-md-4">
                    <div id="trg_decimal" class="form-group">
                        <input type="text" class="form-control" id="spinner-decimal" name="technical_value" value="{{ $measurement->technical_value }}" {{ $disabled }} />
                        <p class="help-block">isi dengan nilai 0,7 - 0,9</p>
                        <label for="gelardepan">Bobot penilaian teknis </label>
                    </div>
                </div><!--end .col -->
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" class="form-control" id="bobotbiaya" name="money_value" value="{{ $measurement->money_value }}" readonly />
                        <p class="help-block">otomatis menyesuaikan dari isian teknis (0,1 - 0,3)</p>
                        <label for="gelardepan">Bobot penilaian biaya </label>
                    </div>
                </div>
                <div class="clear"></div>
            </form>
        </div>
        <br />
        <div class="row">
            <div class="col-md-12">
                <a id="trg_modal_criterion" href="#" class="btn btn-primary mb15" {{ $disabled }}>
                    <i class="fa fa-plus"></i> Kriteria Penilaian
                </a>
                <table id="table_criterion" class="table no-margin">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kriteria</th>
                            <th>Penjelasan kriteria</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($im = 0; $im < count($criterions); $im++)
                        <tr id="criterion_{{ $criterions[$im]->id }}">
                            <td class="number">{{ $im + 1 }}</td>
                            <td>{{ $criterions[$im]->title }}</td>
                            <td>{{ $criterions[$im]->description }}</td>
                            <td>
                                <a href="#" class="btn btn-flat trg_del_criterion" data-id="{{ $criterions[$im]->id }}" {{ $disabled }}>
                                    hapus
                                </a>
                                <a href="#" class="btn btn-flat trg_upd_criterion" data-id="{{ $criterions[$im]->id }}" data-title="{{ $criterions[$im]->title }}" data-description="{{ $criterions[$im]->description }}" {{ $disabled }}>
                                    edit
                                </a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
                <em class="text-caption">tabel kriteria</em>
            </div>
        </div>
    </div>

    <div class="row pilihan hidden-block" id="pilihan2">
        <div class="col-md-12">
            <p>Metode ini digunakan dengan cara memeriksa dan membandingkan dokumen penawaran terhadap pemenuhan persyaratan yang telah ditetapkan dalam dokumen pengadaan barang/jasa dengan urutan proses evaluasi dimulai dari penilaian persyaratan administrasi, persyaratan teknis dan kewajaran harga. penyedia barang/jasa yang tidak lulus penilaian pada setiap tahapan dinyatakan gugur. </p>
            <p>Usulan penentuan pemenang berdasarkan harga terendah.</p>
        </div>
    </div>

</div>

    <div class="modal fade" id="modal_criterion" tabindex="-1" role="dialog" aria-labelledby="criterion_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="criterion_label">Tambah Kriteria Penilaian</h4>
                </div>
                <div class="modal-body">
                    <form class="form floating-label" role="form" id="form_criterion" action="/draft/criterion_save" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="criterion_id" name="id" value="" />
                        <input type="hidden" name="procurement_id" value="{{ $item->id }}" />
                        <input type="hidden" id="criterion_technical" name="scoring[technical]" value="$measurement->technical_value" />
                        <input type="hidden" id="criterion_money" name="scoring[money]" value="{{ $measurement->money_value }}" />
                        <input type="hidden" name="scoring[method]" value="{{ $measurement->scoring }}">
                        Kriteria yang ditambahkan merupakan penilaian 1 - 5
                        <div class="form-group floating-label">
                            <input type="text" class="form-control" id="criterion_title" name="title">
                            <label>Kriteria</label>
                        </div>
                        <div class="form-group floating-label">
                            <textarea type="text" class="form-control" id="criterion_description" name="description"> </textarea>
                            <label>Penjelasan Kriteria</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="trg_sbm_criterion" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden-block">
      <form id="form_del_criterion" method="POST" action="/draft/criterion_delete">
        {{ csrf_field() }}
        <input type="hidden" name="procurement_id" value="{{ $item->id }}" />
        <input type="hidden" id="del_criterion_id" name="id" value="" />
      </form>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.jenis_eval').click(function() {
                var test = $(this).val();
                $('div.pilihan').hide();
                $('#pilihan' + test).show();
            });

            // $("#spinner-decimal").spinner({step: 0.01, numberFormat: "n", min:0.7 , max: 0.9});

            $('#trg_scoring').on('click', function(){
                $('#chk_method').val('scoring');
            });

            $('#trg_nonscoring').on('click', function(){
                $('#chk_method').val('non-scoring');
            });

            $('#trg_qualification').on('change', function(){
                if($(this).val() == 1) {
                    $('#pre_block').show();
                } else {
                    $('#pre_block').hide();
                }
            });

            attach_combobox_action_for_tight_label('trg_qualification', 'pc_qualification');

            attach_combobox_action_for_tight_label('trg_delivery', 'pc_delivery');

            $('#trg_save_qualification').on('click', function(event){
                submit_form('form_qualification');
                event.preventDefault();
            });

            $('#trg_save_measurement').on('click', function(event){
                var scoring             = $('#trg_scoring').prop('checked');
                var count_criterion     = $('#table_criterion tbody tr').length;

                if(scoring && count_criterion == 0) {
                    alert('Harap mengisi paling tidak 1 kriteria');
                } else if(scoring && count_criterion > 0) {
                    submit_form('form_measurement');
                } else {
                    submit_form('form_measurement');
                }

                event.preventDefault();
            });

            $('#trg_decimal input').on('change keyup paste', function(){
                var technical_value = $(this).val();
                if(technical_value.length > 4) {
                    technical_value = technical_value.substring(0, 4);
                    $(this).val(technical_value);
                }

                var value           = 1 - technical_value;
                var opp_value       = Math.round( value * 100 ) / 100;
                if(opp_value <= 0.3 && opp_value >= 0.1) {
                    $('#bobotbiaya').val(opp_value);
                    $('#money_value').val(opp_value);

                    $('#criterion_technical').val($(this).val());
                    $('#criterion_money').val(opp_value);
                } else {
                    $(this).val('0.7');
                    $('#bobotbiaya').val('0.3');
                    $('#money_value').val('0.3');

                    $('#criterion_technical').val('0.7');
                    $('#criterion_money').val(opp_value);
                }
            });

            // $("#spinner-decimal").on("spinstop", function(){
            //     var technical_value = $(this).spinner('value');
            //     var value           = 1 - technical_value;
            //     var opp_value       = Math.round( value * 100 ) / 100;
            //     $('#bobotbiaya').val(opp_value);
            //     $('#money_value').val(opp_value);

            //     $('#criterion_technical').val($(this).val());
            //     $('#criterion_money').val(opp_value);
            // });

            render_checkbox_value('trg_scoring', 'trg_nonscoring', 'scoring_method');
            render_combobox_value('trg_qualification', 'pc_qualification');
            render_combobox_value('trg_delivery', 'pc_delivery');

            attach_button_action_to_empty_modal('trg_modal_criterion', 'modal_criterion');
            $('#trg_sbm_criterion').on('click', function(event){
                submit_form('form_criterion');
            });

            $('.trg_upd_criterion').each(function(){
                var $el                 = $(this);
                $el.on('click', function(event){
                    var d_id            = $el.data('id');
                    var d_title         = $el.data('title');
                    var d_description   = $el.data('description');

                    $('#form_criterion .form-control').val('');
                    $('#form_criterion #criterion_id').val(d_id);
                    $('#form_criterion #criterion_title').val(d_title);
                    $('#form_criterion #criterion_description').val(d_description);
                    $('#form_criterion .form-control').addClass('dirty');

                    $('#modal_criterion').modal();
                    event.preventDefault();
                });
            });

            $('.trg_del_criterion').each(function(){
                var $el             = $(this);
                $el.on('click', function(event){
                    var sure        = confirm("Apakah anda yakin?");
                    if(sure == true) {
                        var d_id    = $el.data('id');
                        $('#del_criterion_id').val(d_id);
                        submit_form_with_ajax('form_del_criterion',
                            function(){
                                $('tr#criterion_' + d_id + ' .btn').attr('disabled');
                            },
                            function(){
                                $('tr#criterion_' + d_id).remove();
                            }
                        );
                    }
                    event.preventDefault();
                });
            });

            // Start Pre Schedule
            var pre_information_pid     = $('#pre_information_pid').val();
            var token_pre_information   = $('#token_pre_information').val();
            var pre_schedule_params = {
                '_token': token_pre_information,
                'purpose': 'pre_information',
                'procurement_id': pre_information_pid
            };
            render_upload_box('pre_information', '/upload/procurement', pre_schedule_params);
            // End Pre Schedule
        });
    </script>
