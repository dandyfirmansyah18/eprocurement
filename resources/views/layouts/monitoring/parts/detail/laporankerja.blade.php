<div class="tab-pane" id="laporankerja">
  <!-- BEGIN kepemilikan saham TABLE -->
	<br>
  <div class="row">
		<div class="col-md-3">
			<article class="margin-bottom-xxl">
				<a href="#" class="btn btn-block btn-primary"  data-toggle="modal" data-target="#tambahlaporankerja"><i class="fa fa-plus"></i> Tambah Laporan Pekerjaan</a>
			</article>
		</div><!--end .col -->
		<div class="col-md-9">
			<div class="card">
				<div class="card-body">
					<table class="table no-margin">
						<thead>
							<tr>
								<th>#</th>
								<th>Catatan Perkembangan</th>
								<th>Tanggal BA</th>
								<th>No. BA</th>
								<th>File BA</th>
								<th>Kemajuan Pekerjaan</th>
								<!--<th>Aksi</th>-->
							</tr>
						</thead>
						<tbody>
							@for ($ii = 0; $ii < count($works); $ii++)
								@php
									$doc = $works[$ii]->doc()
								@endphp
								<tr>
									<td>{{ $ii + 1 }}</td>
									<td>{{ $works[$ii]->notes }}</td>
									<td>{{ \App\Helpers\AuxHelper::render_date_long($works[$ii]->ba_date) }}</td>
									<td>{{ $works[$ii]->ba_number }}</td>
									<td>
										@if($doc != null)
											<a href="/uploads/{{ $doc->filepath }}" target="_blank">{{ $doc->filename }}</a>
										@endif
									</td>
									<td>{{ $works[$ii]->percentage }}%</td>
									<!--<td>
										<a href="#" class="btn btn-flat">hapus</a>
											<a href="#" class="btn btn-flat">edit</a>
									</td>-->
								</tr>
							@endfor
						</tbody>
					</table>
				</div><!--end .card-body -->
			</div><!--end .card -->
			<em class="text-caption">tabel laporan pekerjaan</em>
		</div><!--end .col -->
	</div><!--end .row -->
	<!-- END DEFAULT TABLE -->
</div>

<!--Modal -->
<div class="modal fade" id="tambahlaporankerja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content mtr-tight-modal">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">Tambah Laporan Pekerjaan</h4>
			</div>
			<div class="modal-body">
				<form id="form_mtrlaporankerja" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/monitor/laporankerja" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurements['id'] }}" />
					<input type="hidden" name="monitoring[id]" id="laporankerja_id" value="" />
					{{ csrf_field() }}
					<div class="form-group floating-label">
						<input type="text" class="form-control" name="monitoring[notes]" value="">
						<label for="regular2">Catatan Perkembangan</label>
					</div>
					<div class="form-group">
						<div class="input-group date" id="tanggal_laporankerja">
							<div class="input-group-content">
								<input type="text" class="form-control" name="monitoring[ba_date]" />
								<label>Tanggal BA</label>
								<p class="help-block">tanggal/bulan/tahun</p>
							</div>
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
					<div class="form-group floating-label">
						<input type="text" class="form-control" name="monitoring[ba_number]" />
						<label for="regular2">No. BA</label>
					</div>
					<div class="form-group floating-label">
						<input type="file" class="form-control" name="monitoring_ba_doc" />
						<p class="help-block">Upload BA Serah Terima Perkembangan Pekerjaan</p>
					</div>
					<div class="form-group floating-label">
						<input type="text" class="form-control" name="monitoring[percentage]" />
						<label for="regular2">Prosentase Pekerjaan Selesai (%)</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<button id="trg_laporanpekerjaan" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>

@push('jspage')
<script type="text/javascript">
  $(document).ready(function() {
    $('#tanggal_laporankerja').datepicker("setDate", new Date());
    
    $('#trg_laporanpekerjaan').on('click', function(event){
      $('form#form_mtrlaporankerja').submit();
      event.preventDefault();
    });
  });
</script>
@endpush