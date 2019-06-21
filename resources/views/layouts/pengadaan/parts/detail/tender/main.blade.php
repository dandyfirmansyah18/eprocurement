@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>

<div class="modal fade" id="dokumenlengkap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Kelengkapan Dokumen</h4>
              </div>
              <div class="modal-body">
                    <div class="tab">
                      <button class="tablinks" onclick="openCity(event, 'London')">Administrasi</button>
                      <button class="tablinks" onclick="openCity(event, 'Paris')">Teknis</button>
                      <button class="tablinks" onclick="openCity(event, 'Tokyo')">Keuangan</button>
                    </div>

                    <div id="London" class="tabcontent">
                      @include('pengadaan.parts.vendor.tab-kelengkapan')
                    </div>

                    <div id="Paris" class="tabcontent">
                      <dl class="uhui dl-horizontal mt25">
                        <dt>
                          <label class="radio-inline checkbox-styled">
                            <input type="checkbox" name="trg_assessment[tax]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->tax) }} {{ $disabled }}><span>Teknis </span>
                          </label>
                        </dt>

                        <dd>
                            Struktur Organisasi : <strong></strong> <br />
                        </dd>
                        <dd>
                          @if($company_structure != null)
                            <a href="{{ URL::asset('uploads/' . $company_structure->filepath) }}" target="_blank">Struktur Organisasi.pdf</a>
                          @endif  
                          &nbsp;
                        </dd>

                        <dd>
                            Lihat Personalia : <strong></strong> <br />
                        </dd>
                        <dd>
                          <!-- <a class="btn btn-block btn-raised btn-primary btn-login" href="#" data-toggle="modal" data-target="#ikutpengadaan">View</a>   -->
                          <table class="table table-bordered order-column hover">
                              <thead>
                                  <td>Nama</td>
                                  <td>Pendidikan</td>
                                  <td>Pekerjaan</td>
                                  <td>Pengalaman</td>
                              </thead>
                              @for ($ii = 0; $ii < count($personalia); $ii++)
                                  <tr>
                                      <td>{{ $personalia[$ii]['name'] }}</td>
                                      <td>{{ $personalia[$ii]['education'] }}</td>
                                      <td>
                                          {{ $personalia[$ii]['job_title'] }}
                                      </td>
                                      <td>{{ $personalia[$ii]['experience'] }}</td>
                                  </tr>
                              @endfor
                          </table>
                          &nbsp;
                        </dd>

                      </dl>
                    </div>

                    <div id="Tokyo" class="tabcontent">
                      <dl class="uhui dl-horizontal mt25">
                        <dt>
                          <label class="radio-inline checkbox-styled">
                            <input type="checkbox" name="trg_assessment[tax]" class="target-checker trg-assessment" {{ \App\Helpers\AuxHelper::render_boolean_checked($assessment->tax) }} {{ $disabled }}><span>File Penawaran Harga </span>
                          </label>
                        </dt>

                        <dd>
                            File Penawaran : <strong></strong> <br />
                        </dd>
                        @for ($ii = 0; $ii < count($offereds); $ii++)
                              @php
                                  $st_offering   = $offereds[$ii]->offering();
                                  $st_tender  = $offereds[$ii]->tender;
                              @endphp
                        <dd>
                            {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                          &nbsp;
                        </dd>
                        @endfor

                        <dd>
                            Daftar Rincian Harga : <strong></strong> <br />
                        </dd>
                        <dd>
                          <a class="btn btn-block btn-raised btn-primary btn-login" href="#" data-toggle="modal" data-target="#rincian">View</a>  
                          &nbsp;
                        </dd>

                      </dl>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <div class="form-group floating-label">
                          <!-- <a class="btn btn-default" href="#" data-toggle="modal" data-target="#tambahpersonalia">Tambah Personalia</a> -->
                          <!-- <a id="trg_personalia" href="#" class="btn btn-primary">Save</a> -->
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

<div class="modal fade" id="ikutpengadaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Pilih Personalia</h4>
              </div>
              <div class="modal-body">
                  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                      <form id="form_personalia" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                      <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered order-column hover">
                                <thead>
                                    <td>Nama</td>
                                    <td>Pendidikan</td>
                                    <td>Pekerjaan</td>
                                    <td>Pengalaman</td>
                                </thead>
                                @for ($ii = 0; $ii < count($personalia); $ii++)
                                    <tr>
                                        <td>{{ $personalia[$ii]['name'] }}</td>
                                        <td>{{ $personalia[$ii]['education'] }}</td>
                                        <td>
                                            {{ $personalia[$ii]['job_title'] }}
                                        </td>
                                        <td>{{ $personalia[$ii]['experience'] }}</td>
                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                      <div class="form-group floating-label">
                          <!-- <a class="btn btn-default" href="#" data-toggle="modal" data-target="#tambahpersonalia">Tambah Personalia</a> -->
                          <!-- <a id="trg_personalia" href="#" class="btn btn-primary">Save</a> -->
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

<div class="card panel expanded">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#tab_tender" data-target="#stend_main">
      <header class="teksutama">
          Pembukaan dan Pembuktian Penawaran 
          <br>
          @if($schedule->a_tender != null)
            <span class="pcr-date">
                {{ $schedule->a_tender }}
            </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="stend_main" class="collapse in">
        <div class="card-body acccardbody">
            <br />
            <div class="judulformtop">
                Daftar Dokumen yang sudah Diupload peserta
            </div>
            <div class="abs-right">
                <a id="trg_sch_tender" href="#" class="btn btn-info mt20" data-actual="{{ $schedule->a_tender }}" data-back="{{ $schedule->b_tender }}">Atur Jadwal</a>
            </div>

            <table class="table table-bordered order-column hover">
                <thead>
                    <td>Nama Perusahaan</td>
                    <td>Waktu upload</td>
                    <td>File</td>
                    <td>Kelengkapan Dokumen</td>
                    <td>Nilai Penawaran</td>
                    <td>Didownload panitia</td>
                </thead>
                @for ($ii = 0; $ii < count($offereds); $ii++)
                    @php
                        $st_offering   = $offereds[$ii]->offering();
                        $st_tender  = $offereds[$ii]->tender;
                    @endphp
                    <tr>
                        <td>{{ $offereds[$ii]->vendor->name }}</td>
                        <td>{{ DateHelper::time_format($st_offering->created_at) }}</td>
                        <td class="trg_open_tender" data-id="{{ $offereds[$ii]->id }}">
                            {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                        </td>
                        <td><a class="btn btn-block btn-raised btn-primary btn-login" href="#" data-toggle="modal" data-target="#dokumenlengkap">View</a></td>
                        @if($st_tender != null)
                            <td><textarea data-id="{{ $offereds[$ii]->id }}" class="trg_st_amount form-control">{!! $st_tender->amount !!}</textarea></td>
                            <td>{{ DateHelper::time_format($st_tender->download) }}</td>
                        @else
                            <td><textarea data-id="{{ $offereds[$ii]->id }}" class="trg_st_amount form-control"></textarea></td>
                            <td>Belum didownload</td>
                        @endif
                    </tr>
                @endfor
            </table>
            <div class="clear"></div>
            <div class="pull-right">
                @if(count($offereds) > 0)
                    <a id="trg_sten_amount" href="#" class="btn btn-default-bright">
                        <i class="fa fa-save"></i> Simpan Nilai Penawaran
                    </a>
                @else
                    <a href="#" class="btn btn-default-bright" disabled>
                        <i class="fa fa-save"></i> Simpan Nilai Penawaran
                    </a>
                @endif
            </div>
            <div class="clear"></div>
        
            <h4>BA Pembuktian Penawaran</h4>
            <form id="form_sten_memorandum" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/pengadaan/atur/memoranda" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                <input type="hidden" name="tab_path" value="buka" />
                <input type="hidden" name="item[purpose]" value="tender" />
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="file" class="form-control" name="memorandum_doc">
                            <p class="help-block">Upload BA Pembuktian Penawaran</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @if($file_tender != null)
                            <p>BA Pembuktian Penawaran saat ini: </p>
                            <a href="/uploads/{{ $file_tender->filepath }}" target="_blank">{{ $file_tender->filename }}</a>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group floating-label">
                            <textarea type="text" class="form-control" name="item[notes]">{{ $ba_tender->notes }}</textarea>
                            <label for="regular2">Catatan Pembuktian Penawaran</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a id="trg_sten_memorandum" href="#" class="btn btn-default-bright"><i class="fa fa-save"></i> Simpan</a>
                    </div>
                </div>
            </form>
            <hr>
            Log Perubahan dokumen ini:
            @for ($ii = 0; $ii < count($log_tenders); $ii++)
                @if($log_tenders[$ii]->old_name == 'none')
                    <br>Upload file awal &ldquo;{{ $log_tenders[$ii]->new_name }}&rdquo;  ( {{ DateHelper::long_format($log_tenders[$ii]->created_at) }} )
                @else
                    <br>Perubahan file &ldquo;{{ $log_tenders[$ii]->new_name }}&rdquo; ( {{ DateHelper::long_format($log_tenders[$ii]->created_at) }} )
                @endif
            @endfor
            <hr>
        
            <div class="hidden-block">
                <form id="form_stg_tender_open" action="/pengadaan/atur/pembukaan" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                    <input id="sta_enrollment_id" type="hidden" name="item[enrollment_id]" value="" />
                    <input id="sta_type" type="hidden" name="item[type]" value="0" />
                </form>
                <form id="form_stg_tender_save" action="/pengadaan/atur/tender" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                    <input type="hidden" name="tab_path" value="buka" />
                    <input id="stb_enrollment_id" type="hidden" name="item[enrollment_ids]" value="" />
                    <input id="stb_type" type="hidden" name="item[type]" value="0" />
                    <input id="stb_amount" type="hidden" name="item[amounts]" value="" />
                </form>
            </div>
        </div>
    </div>
</div><!--end .panel -->

@push('jspage')
    <script>
        function openCity(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
    </script>
    <script>
        $(document).ready(function(){
            $('#trg_sten_memorandum').on('click', function(event){
                var confirmation = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    $('form#form_sten_memorandum').submit();
                }
                event.preventDefault();
            });

            $('#trg_sten_amount').on('click', function(event){
                var confirmation    = confirm("Apakah anda yakin?");
                if (confirmation == true) {
                    var ids         = '';
                    var amounts     = '';
                    $('.trg_st_amount').each(function(){
                        var $el     = $(this);
                        ids         += $el.data('id') + ','; 
                        amounts     += $el.val() + ',';
                    });
                    $('#stb_enrollment_id').val(ids);
                    $('#stb_amount').val(amounts);
                    $('form#form_stg_tender_save').submit();
                }
                event.preventDefault();
            });

            $('.trg_open_tender a').each(function(){
                var $el     = $(this);
                var en_id   = $el.parent().data('id');
                $('#sta_enrollment_id').val(en_id);
                $el.on('click', function(){
                    var form = $('form#form_stg_tender_open');
                    var form_data = new FormData(form[0]);
                    $.ajax({
                        type: form.attr("method"),
                        url: form.attr("action"),
                        data: form_data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(result){
                            console.log(result);
                        },
                        error: function(error){
                            console.log(error);
                        }
                    });
                });
            });

            $('#trg_sch_tender').on('click', function(event){
                var $el     = $(this);
                $('#sch_tab').val('buka');
                $('#sch_part').val('tender');

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
