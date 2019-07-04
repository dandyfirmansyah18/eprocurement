<div class="tab-pane" id="kontrak" role="tabpanel">
    <div class="p-20">
        <p></p>
        <h4><a href="#">Dokumen Pengikat Pekerjaan</a></h4>
        <hr>
            <form id="form_mtrkontrak" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/monitor/kontrak" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurements['id'] }}" />
                <input type="hidden" id="contract_kind_id" value="{{ $contract->kind_id }}" />
                {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group floating-label">
                                <label>Jenis Pengikat Pekerjaan</label>
                                    <?php
                                        $selected1 = ($contract->kind_id == '1')?"selected":"";
                                        $selected2 = ($contract->kind_id == '2')?"selected":"";
                                        $selected3 = ($contract->kind_id == '3')?"selected":"";
                                    ?>    
                                    <select id="trg_kin_id" class="form-control select2-list" name="monitoring[kind_id]">
                                        <option value=""></option>
                                        <option value="1" <?=$selected1?>>Perjanjian (Kontrak)</option>
                                        <option value="2" <?=$selected2?>>Surat Perintah Kerja (SPK)</option>
                                        <option value="3" <?=$selected3?>>Surat Pesanan (SP) </option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Dokumen yang Diperlukan</label>
                                <input type="file" class="form-control" name="monitoring_doc" />
                            </div>
                        </div>
                          <div class="col-md-6">
                            @if($contract_doc != null)
                              <p>Dokumen saat ini:&nbsp;&nbsp;<a href="/uploads/{{ $contract_doc->filepath }}" target="_blank">{{ $contract_doc->filename }}</a></p>
                            @endif
                          </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group floating-label">
                                <label for="regular2">No Dokumen </label>
                                <textarea type="text" class="form-control" name="monitoring[doc_number]">{{ $contract->doc_number }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group floating-label">
                                <label for="regular2">Catatan </label>
                                    <textarea type="text" class="form-control" name="monitoring[notes]">{{ $contract->notes }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="input-group date" id="tanggal_kontrakdocs">
                                    <div class="input-group-content">
                                        <label>Tanggal Dokumen </label>
                                        <input type="date" class="form-control" name="monitoring[doc_date]" value="{{ \App\Helpers\AuxHelper::render_date($contract->doc_date) }}" />
                                    
                                        <p class="help-block">bulan/tanggal/tahun</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="input-group date" id="tanggal_kontrakstart">
                                    <div class="input-group-content">
                                        <label>Tanggal Mulai Pekerjaan</label>
                                        <input type="date" class="form-control" name="monitoring[start_date]" value="{{ \App\Helpers\AuxHelper::render_date_monitoring($contract->start_date) }}" />
                                        <p class="help-block">bulan/tanggal/tahun</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                              <div class="form-group">
                                  <div class="input-group date" id="tanggal_kontrakend">
                                        <div class="input-group-content">
                                              <label>Tanggal Selesai Pekerjaan</label>
                                              <input type="date" class="form-control" name="monitoring[end_date]" value="{{ \App\Helpers\AuxHelper::render_date_monitoring($contract->end_date) }}" />
                                              <p class="help-block">bulan/tanggal/tahun</p>
                                        </div>
                                  </div>
                                </div>
                        </div>
                    </div>
                    <h4><a href="#">Adendum Dokumen Pengikat Pekerjaan</a></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group floating-label">
                                <label for="regular2">Catatan Adendum</label>
                                <textarea type="text" class="form-control" name="monitoring[addendum]">{{ $contract->addendum }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <p class="help-block">Upload Dokumen Adendum yang Diperlukan</p>
                              <input type="file" class="form-control" name="monitoring_addendum" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if($addendum_doc != null)
                              <p>Dokumen Adendum saat ini:&nbsp;&nbsp;<a href="/uploads/{{ $addendum_doc->filepath }}" target="_blank">{{ $addendum_doc->filename }}</a></p>
                            @endif
                        </div>
                    </div>
            </form>
            <a id="trg_kontrak" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Perubahan</a>
        <p></p>
        <div class="judulform">Log Perubahan dokumen ini:</div>
          @for ($ii = 0; $ii < count($contract_logs); $ii++)
            @if($contract_logs[$ii]->old_name == 'none')
              <br>Upload file awal &ldquo;{{ $contract_logs[$ii]->new_name }}&rdquo;  ( {{ \App\Helpers\AuxHelper::render_date_long($contract_logs[$ii]->created_at) }} )
            @else
              <br>Perubahan file &ldquo;{{ $contract_logs[$ii]->new_name }}&rdquo; ( {{ \App\Helpers\AuxHelper::render_date_long($contract_logs[$ii]->created_at) }} )
            @endif
          @endfor
          <hr>
        </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    
    $('#trg_kontrak').on('click', function(event){
//      $('form#form_mtrkontrak').submit();
        var form = $('form#form_mtrkontrak');
        var formData = new FormData(form[0]);
        $.ajax({
            type: form.attr("method"),
            url: form.attr("action"),
            data: formData,
            contentType: false,
            processData: false,
            success: function(result){
                console.log(result);
                var proc_id = '{{ $procurements["id"] }}';
//                $('#verification_reject').modal('hide');
                swal("","Kontrak Berhasil disimpan","success");
                // document.location = '/vendor/daftar-calon';
                call('/monitor/detail/'+proc_id,'_content_','Daftar Calon Vendor');
            },
            error: function(error){
                console.log(error);
                swal("","Kontrak Gagal disimpan","error");
            }
        });
      event.preventDefault();
    });
//oks
    var kind_id = $('#contract_kind_id').val();
    $('#trg_kin_id').val(kind_id);
    $('#trg_kin_id').change();
  });
</script>