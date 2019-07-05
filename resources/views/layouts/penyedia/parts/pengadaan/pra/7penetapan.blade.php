@php
    use \App\Helpers\DateHelper;
    use \App\Helpers\FormHelper;
@endphp

<div class="card panel">
    <div class="card-head card-head-sm collapsed" data-toggle="collapse" data-parent="#prakualifikasi" data-target="#pra7">
      <header class="teksutama">
          7. Penetapan dan Pengumuman Lolos Prakualifikasi
          <br>
          @if($schedule->a_p_result != null)
              <span class="pcr-date">
                  {{ $schedule->a_p_result }}
              </span>
          @endif
      </header>
      <div class="tools">
        <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
      </div>
    </div>
    <div id="pra7" class="collapse">
      <div class="card-body acccardbody">
        <hr>
          <h4>Daftar Peserta Lolos Prakualifikasi</h4>
          <table class="table table-bordered order-column hover">
            <thead>
              <td>Nama Perusahaan</td>
              <td>waktu upload</td>
              <td>file</td>
              <td>didownload panitia</td>
              <td>evaluasi</td>
            </thead>
            <tbody>
              @for ($ii = 0; $ii < count($pre_offereds); $ii++)
                @php
                    $st_offering   = $pre_offereds[$ii]->pre_offering();
                    $st_tender  = $pre_offereds[$ii]->pre_tender;
                    $st_eval  = $pre_offereds[$ii]->pre_evaluation;
                @endphp
                <tr>
                    <td>
                      {{ csrf_field() }}
                      <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
                      <input type="hidden" name="enrollment_id[]" value="{{ $pre_offereds[$ii]->id }}" />
                      {{ $pre_offereds[$ii]->vendor->name }}
                    </td>
                    <td>{{ DateHelper::time_format($st_offering->created_at) }}</td>
                    <td>
                        {!! FormHelper::file_tag($st_offering->filepath, $st_offering->filename) !!}
                    </td>
                    @if($st_tender != null)
                        <td>{{ DateHelper::time_format($st_tender->download) }}</td>
                    @else
                        <td>Belum didownload</td>
                    @endif
                    <td>
                      @if($st_eval != null)
                        <label class="radio-inline checkbox-styled">
                          <input type="checkbox" class="p-candidate-checker" {{ FormHelper::checked($st_eval->candidate) }} disabled><span>Memenuhi Syarat</span>
                        </label>
                        <br>
                        <textarea class="form-control" name="notes[]" rows="2" cols="80" placeholder="Catatan untuk peserta" disabled>{!! $st_eval->notes !!}</textarea>
                      @else
                        <label class="radio-inline checkbox-styled">
                          <input type="checkbox" class="p-candidate-checker" disabled><span>Memenuhi Syarat</span>
                        </label>
                        <br>
                        <textarea class="form-control" name="notes[]" rows="2" cols="80" placeholder="Catatan untuk peserta" disabled></textarea>
                      @endif
                    </td>
                </tr>
                @endfor
            </tbody>
          </table>
          <div class="clear"></div>
      </div>
    </div>
</div><!--end .panel -->