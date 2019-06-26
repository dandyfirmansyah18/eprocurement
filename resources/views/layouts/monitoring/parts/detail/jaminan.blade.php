<div class="tab-pane" id="jaminan" role="tabpanel">
  <br>
  <div class="table-responsive">
    <table id="table_assurances" class="table table-bordered order-column hover">
      <thead>
          <tr>
              <th>No</th>
              <th>Jenis Jaminan</th>
              <th>Nilai Jaminan</th>
              <th>Dokumen yang diperlukan</th>
              <th>Catatan</th>
              <th>Tanggal Mulai Jaminan</th>
              <th>Tanggal Selesai Jaminan</th>
          </tr>
      </thead>
      <tbody>
        @for ($ii = 0; $ii < count($assurances); $ii++)
          <tr>
            <td>{{ $ii + 1 }}</td>
            <td>
              {{ $assurances[$ii]['type'] }}
            </td>
            <td>
              {{ $assurances[$ii]['amount'] }}
            </td>
            <td>
              {!! \App\Helpers\AttachmentHelper::render_assurance_file($assurances[$ii]['id']) !!}
            </td>
            <td>
              {{ $assurances[$ii]['notes'] }}
            </td>
            <td>
              {{ \App\Helpers\AuxHelper::render_date_long($assurances[$ii]['start_date']) }}
            </td>
            <td>
              {{ \App\Helpers\AuxHelper::render_date_long($assurances[$ii]['end_date']) }}
            </td>
          </tr>
        @endfor
      </tbody>
    </table>
  </div><!--end .table-responsive -->
  <br>
  <form id="form_mtrjaminan" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/monitor/jaminan" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurements['id'] }}" />
    <input type="hidden" name="monitoring[id]" id="jaminan_id" value="" />
    {{ csrf_field() }}

    <div class="row">
      <div class="col-md-12">
        <div class="form-group floating-label">
          <label>Jenis Jaminan Pekerjaan</label>
          <select id="trg_type_id" class="form-control select2-list" name="monitoring[type_id]">
              <option value="2">Jaminan Pekerjaan</option>
              <option value="3">Jaminan Perawatan</option>
          </select>
        </div>
      </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        <div class="form-group floating-label">
          <label for="regular2">Nilai Jaminan</label>
          <input type="text" class="form-control" name="monitoring[amount]" />
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <p class="help-block">Upload Dokumen yang Diperlukan</p>
            <input type="file" class="form-control" name="monitoring_doc" />
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        <div class="form-group floating-label">
          <label for="regular2">Catatan </label>
          <textarea type="text" class="form-control" name="monitoring[notes]">{{ $assurance->notes }}</textarea>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
          <div class="input-group date" id="tanggal_jaminanstart">
            <div class="input-group-content">
              <label>Tanggal Mulai Jaminan</label>
              <input type="text" class="form-control" name="monitoring[start_date]" value="{{ \App\Helpers\AuxHelper::render_date($assurance->start_date) }}" />
              <p class="help-block">tanggal/bulan/tahun</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="form-group">
          <div class="input-group date" id="tanggal_jaminanend">
            <div class="input-group-content">
              <label>Tanggal Selesai Jaminan</label>
              <input type="text" class="form-control" name="monitoring[end_date]" value="{{ \App\Helpers\AuxHelper::render_date($assurance->end_date) }}" />
              <p class="help-block">tanggal/bulan/tahun</p>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    <input type="submit" id="submit" class="btn btn-primary mt25" value="Tambah Jaminan">   
  </form>
</div>

@push('jspage')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tanggal_jaminanstart').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#tanggal_jaminanend').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#trg_jaminan').on('click', function(event){
      $('form#form_mtrjaminan').submit();
      event.preventDefault();
    });
  });
</script>
@endpush
