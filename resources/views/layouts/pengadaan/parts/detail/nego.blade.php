@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane" id="nego">
    <div class="pull-left">
        <h3>
            Negosiasi
            <span class="pcr-date">{{ $schedule->a_negotiation }}</span>
        </h3>
    </div>
    <div class="pull-right">
        <a id="trg_sch_negotiation" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_negotiation }}" data-back="{{ $schedule->b_negotiation }}">Atur Jadwal</a>
    </div>
    <div class="clear"></div>

    <div class="judulformtop">
        Upload BA Negosiasi {{ $candidate_highest }}
    </div>
    <div class"table-responsive">
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>File</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @for ($ii = 0; $ii < count($mmr_negotiations); $ii++)
                    @php
                        $doc = $mmr_negotiations[$ii]->doc()
                    @endphp
                    <tr>
                        <td>{{ $ii + 1 }}</td>
                        <td>{{ DateHelper::long_format($mmr_negotiations[$ii]->created_at) }}</td>
                        <td>{!! FormHelper::file_tag($doc->filepath, $doc->filename) !!}</td>
                        <td>{{ $mmr_negotiations[$ii]->notes }}</td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="clear"></div>
    <div class="pull-right">
        @if($negotiating_id > 0)
            <a href="#" class="btn btn-block btn-primary mt20"  data-toggle="modal" data-target="#modal_negotiation">
                <i class="fa fa-plus"></i> Tambah BA Negosiasi
            </a>
        @else
            <a href="#" class="btn btn-block btn-primary mt20" disabled>
                <i class="fa fa-plus"></i> Tambah BA Negosiasi
            </a>
        @endif
    </div>
    <div class="clear"></div>
    <hr>
    <h4>Daftar peserta yang sudah dikirimkan undangan negosiasi</h4>
    <ol>
        @for ($ii = 0; $ii < count($negotiations); $ii++)
            <li>{{ $negotiations[$ii]['name'] }}</li>
        @endfor
    </ol>
    <br>
    <h4>Peserta yang saat ini dinegosiasi</h4>
    <ol>
        {{ $negotiating_name }}
    </ol>
    <hr>
    @if($candidate_next > 0)
        <a href="#" class="btn btn-block btn-primary mt20"  data-toggle="modal" data-target="#modal_negotiation">
            <i class="fa fa-pen"></i> Undang Peserta Negosiasi Berikutnya
        </a>
    @else
        <a href="#" class="btn btn-block btn-primary mt20" disabled>
            <i class="fa fa-pen"></i> Undang Peserta Negosiasi Berikutnya
        </a>
    @endif
    <div class="clear"></div>
    <hr>
</div>

@push('modal')
    <div class="modal fade" id="modal_negotiation" tabindex="-1" role="dialog" aria-labelledby="modal_negotiation_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content mtr-tight-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal_negotiation_label">Tambah BA Negosiasi</h4>
                </div>
                <div class="modal-body">                    
                    <form id="form_stng_memorandum" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/memoranda" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                        <input type="hidden" name="tab_path" value="nego" />
                        <input type="hidden" name="item[purpose]" value="nego_{{ $negotiating_id }}" />
                        <input type="hidden" name="item[base_purpose]" value="nego_" />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="memorandum_doc">
                                    <p class="help-block">Upload BA Negosiasi</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group floating-label">
                                    <textarea type="text" class="form-control" name="item[notes]"></textarea>
                                    <label for="regular2">Catatan Negosiasi</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button id="trg_stng_memorandum" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div><!-- /.modal-content -->
        </div>
    </div>
@endpush

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#trg_stng_memorandum').on('click', function(event){
                $('form#form_stng_memorandum').submit();
                event.preventDefault();
            });

            $('#trg_sch_negotiation').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('nego');
                $('#sch_part').val('negotiation');

                if($el.data('actual') != '') {
                    $('#sch_date').val($el.data('actual'));
                }

                if($('#sch_backdate').length > 0 && $el.data('back') != '') {
                    $('#sch_backdate').val($el.data('back'));
                }

                $('.daterange').daterangepicker({
                    daysOfWeekDisabled: [0,6],
                    timePicker: true,
                    timePicker24Hour: true,
                    timePickerIncrement: 10,
                    locale: {
                        format: 'LLLL'
                    }
                });

                $('#schedule_modal').modal();
                event.preventDefault();
            });
        });
    </script>
@endpush
