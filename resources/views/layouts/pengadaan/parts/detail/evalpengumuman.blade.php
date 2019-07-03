@php
    use \App\Helpers\FormHelper;
@endphp

<div class="tab-pane p-20" id="evalpengumuman" role="tabpanel">
    <div class="pull-left">
        <h4>
            <a href="#">Evaluasi Pemenang dan Pengumuman</a>
        </h4>
        <span class="pcr-date">{{ $schedule->a_winner }}</span>
    </div>
    <hr>
    <div class="abs-right">
        <a id="trg_sch_winner" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_winner }}" data-back="{{ $schedule->b_winner }}">Atur Jadwal</a>
    </div>
    <div class="clear"></div>

    <p>
        Pilih Pemenang
    </p>
    <div class="table-responsive">
        <form id="form_winner" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/pemenang" method="POST">
            <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
            {{ csrf_field() }}
            <div class="table-responsive">
            <table id="tabel_candidates" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perusahaan</th>
                        <th>Nilai Akhir</th>
                        <th>Pemenang</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($ii = 0; $ii < count($enrollments); $ii++)
                    @php
                    $vendor = $enrollments[$ii]->vendor;
                    $evaluation = $enrollments[$ii]->evaluation;
                    @endphp
                    <tr class="win_tr">
                        <td>
                            <input type="hidden" name="winner[counter_id][{{ $ii }}]" value="{{ $ii }}" />
                            <input type="hidden" name="winner[vendor_id][{{ $ii }}]" value="{{ $vendor->id }}" />
                            {{ $ii + 1 }}
                        </td>
                        <td><a href="<?php echo url('vendor/detail/' . $vendor->id); ?>">{{ $vendor->name }}</a></td>
                        <td>
                            @if($evaluation != null)
                            <div class="score {{ $evaluation->score }}">
                                &nbsp;{{ $evaluation->score }}%
                            </div>
                            @endif
                        </td>
                        <td class="mid_td">
                            <label class="radio-inline radio-styled">
                                <input class="trg_chk_win" type="radio" name="winner[chosen][{{ $ii }}]" value="1" {{ FormHelper::checked($enrollments[$ii]->winner) }}>&nbsp;
                            </label>
                        </td>
                        <td>
                            <textarea type="text" class="form-control" name="winner[notes][{{ $ii }}]">{!! $enrollments[$ii]->notes !!}</textarea>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            </div>
        </form>
    </div><!--end .table-responsive -->
    <div class="pull-right">
        <a id="trg_winner" href="#" class="btn btn-primary">
            <i class="fa fa-pencil"></i>&nbsp;Tetapkan pemenang
        </a>
    </div>
    <div class="clear"></div>
    <hr>
    <br>
    <div class="judulform">Upload BA Pengumuman Pemenang
    </div>
    <form id="form_st07_01" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/jadwal/pengadaan/pemenang_pengumuman" method="POST">
        <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurement->id }}" />
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                @if($file_winner != null)
                <p>BA Pengumuman Pemenang saat ini: </p>
                <a href="/uploads/{{ $file_winner->filepath }}" target="_blank">{{ $file_winner->filename }}</a>
                @endif
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    <p class="help-block st-help-block">Unggah BA Pengumuman Pemenang baru</p>
                    <input type="file" name="upload_token" id="upload_token" value="{{ csrf_token() }}">
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="namalengkap">Judul File Pengumuman Pemenang</label>
                    <input type="text" class="form-control" id="st07_title" name="item[title]" value="{{ $winner->title }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group floating-label">
                    <label for="regular2">Catatan Pengumuman Pemenang</label>
                    <textarea type="text" class="form-control" id="st07_description" name="item[description]">{!! $winner->description !!}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="submit" id="submit" class="btn btn-primary mt25" value="Upload">
            </div>
        </div>
    </form>
    <hr>
    <p>Teks Pengantar Pengumuman Pemenang</p>
    <form id="form_st07_02" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/jadwal/pengadaan/pemenang_pengantar" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
        <textarea  type="text" class="form-control" id="summernote_pemenang" name="item[announcement]">{!! $winner->announcement !!}</textarea>
    </form>
    <br>
    <input type="submit" id="submit" class="btn btn-primary mt25" value="Simpan Perubahan Pengumuman">
    <hr>
    Log Perubahan dokumen ini:
    @for ($ii = 0; $ii < count($log_winners); $ii++)
        @if($log_winners[$ii]->old_name == 'none')
            <br>Upload file awal &ldquo;{{ $log_winners[$ii]->new_name }}&rdquo;  ( {{ \App\Helpers\AuxHelper::render_date_long($log_winners[$ii]->created_at) }} )
        @else
            <br>Perubahan file &ldquo;{{ $log_winners[$ii]->new_name }}&rdquo; ( {{ \App\Helpers\AuxHelper::render_date_long($log_winners[$ii]->created_at) }} )
        @endif
    @endfor
    <hr>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            $('#summernote_pemenang').summernote({
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

            $('#trg_st07_01').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_st07_01').submit();
                }
                event.preventDefault();
            });

            $('#trg_st07_02').on('click', function(event){
                $('form#form_st07_02').submit();
                event.preventDefault();
            });
            
            $('.trg_chk_win').each(function(){
                var $el = $(this);
                $el.on('click', function(){
                    var checked = $el.prop('checked');
                    $('.trg_chk_win').prop('checked', false);
                    $el.prop('checked', checked);
                });
            });

            $('#trg_winner').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_winner').submit();
                }
                event.preventDefault();
            });

            $('#trg_sch_winner').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('evalpengumuman');
                $('#sch_part').val('winner');

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
