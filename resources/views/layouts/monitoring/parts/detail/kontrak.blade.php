<div class="tab-pane" id="kontrak">
  <a id="trg_kontrak" href="#" class="btn btn-primary mt25" ><i class="fa fa-save"></i> Simpan Perubahan</a>
  <div class="judulform">Dokumen Pengikat Pekerjaan</div>
  <form id="form_mtrkontrak" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/monitor/kontrak" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurements['id'] }}" />
    <input type="hidden" id="contract_kind_id" value="{{ $contract->kind_id }}" />
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-12">
        <div class="form-group floating-label">
          <select id="trg_kin_id" class="form-control select2-list" name="monitoring[kind_id]">
            <option value=""></option>
              <option value="1">Perjanjian (Kontrak)</option>
              <option value="2">Surat Perintah Kerja (SPK)</option>
              <option value="3">Surat Pesanan (SP) </option>
          </select>
          <label>Jenis Pengikat Pekerjaan</label>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input type="file" class="form-control" name="monitoring_doc" />
          <p class="help-block">Upload Dokumen yang Diperlukan</p>
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
        <textarea type="text" class="form-control" name="monitoring[doc_number]">{{ $contract->doc_number }}</textarea>
        <label for="regular2">No Dokumen </label>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-12">
      <div class="form-group floating-label">
        <textarea type="text" class="form-control" name="monitoring[notes]">{{ $contract->notes }}</textarea>
        <label for="regular2">Catatan </label>
      </div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-4">
      <div class="form-group">
      <div class="input-group date" id="tanggal_kontrakdoc">
        <div class="input-group-content">
          <input type="text" class="form-control" name="monitoring[doc_date]" value="{{ \App\Helpers\AuxHelper::render_date($contract->doc_date) }}" />
          <label>Tanggal Dokumen</label>
          <p class="help-block">tanggal/bulan/tahun</p>
        </div>
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
      <div class="input-group date" id="tanggal_kontrakstart">
        <div class="input-group-content">
          <input type="text" class="form-control" name="monitoring[start_date]" value="{{ \App\Helpers\AuxHelper::render_date($contract->start_date) }}" />
          <label>Tanggal Mulai Pekerjaan</label>
          <p class="help-block">tanggal/bulan/tahun</p>
        </div>
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
      <div class="input-group date" id="tanggal_kontrakend">
        <div class="input-group-content">
          <input type="text" class="form-control" name="monitoring[end_date]" value="{{ \App\Helpers\AuxHelper::render_date($contract->end_date) }}" />
          <label>Tanggal Selesai Pekerjaan</label>
          <p class="help-block">tanggal/bulan/tahun</p>
        </div>
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
    </div>
    </div>
    <div class="judulform">Adendum Dokumen Pengikat Pekerjaan
    </div>
    <div class="row">
      <div class="col-md-12">
      <div class="form-group floating-label">
        <textarea type="text" class="form-control" name="monitoring[addendum]">{{ $contract->addendum }}</textarea>
        <label for="regular2">Catatan Adendum</label>
      </div>
    </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input type="file" class="form-control" name="monitoring_addendum" />
          <p class="help-block">Upload Dokumen Adendum yang Diperlukan</p>
        </div>
      </div>
      <div class="col-md-6">
        @if($addendum_doc != null)
          <p>Dokumen Adendum saat ini:&nbsp;&nbsp;<a href="/uploads/{{ $addendum_doc->filepath }}" target="_blank">{{ $addendum_doc->filename }}</a></p>
        @endif
      </div>
    </div>
  </form>
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

@push('jspage')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tanggal_kontrakdoc').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#tanggal_kontrakstart').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#tanggal_kontrakend').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
    
    $('#trg_kontrak').on('click', function(event){
      $('form#form_mtrkontrak').submit();
      event.preventDefault();
    });

    var kind_id = $('#contract_kind_id').val();
    $('#trg_kin_id').val(kind_id);
    $('#trg_kin_id').change();
  });
</script>
@endpush