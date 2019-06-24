<div class="tab-pane" id="laporanbayar">
  <!-- BEGIN kepemilikan saham TABLE -->
	<br>
  <div class="row">
		<div class="col-md-3">
			<article class="margin-bottom-xxl">
				<a href="#" class="btn btn-block btn-primary"  data-toggle="modal" data-target="#tambahlaporanbayar"><i class="fa fa-plus"></i> Tambah Laporan Pembayaran</a>
			</article>
		</div><!--end .col -->
		<div class="col-md-9">
			<div class="card">
				<div class="card-body">
					<table class="table no-margin">
						<thead>
							<tr>
								<th>#</th>
								<th>Catatan Pembayaran</th>
								<th>Tanggal BA</th>
								<th>No. BA</th>
								<th>File BA</th>
								<th>Tahap Pembayaran</th>
								<th>Nilai Pembayaran</th>
								<!--<th>Aksi</th>-->
							</tr>
						</thead>
						<tbody>
							@for ($ii = 0; $ii < count($payments); $ii++)
								@php
									$doc = $payments[$ii]->doc()
								@endphp
								<tr>
									<td>{{ $ii + 1 }}</td>
									<td>{{ $payments[$ii]->notes }}</td>
									<td>{{ \App\Helpers\AuxHelper::render_date_long($payments[$ii]->ba_date) }}</td>
									<td>{{ $payments[$ii]->ba_number }}</td>
									<td>
										@if($doc != null)
											<a href="/uploads/{{ $doc->filepath }}" target="_blank">{{ $doc->filename }}</a>
										@endif
									</td>
									<td>{{ $payments[$ii]->step }}</td>
									<td>Rp {{ $payments[$ii]->amount }}</td>
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
<div class="modal fade" id="tambahlaporanbayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">Tambah Laporan Pembayaran</h4>
			</div>
			<div class="modal-body">
				<form id="form_mtrlaporanbayar" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/monitor/laporanbayar" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurements['id'] }}" />
					<input type="hidden" name="monitoring[id]" id="laporanbayar_id" value="" />
					{{ csrf_field() }}
					<div class="form-group floating-label">
						<input type="text" class="form-control" name="monitoring[notes]" />
						<label for="regular2">Catatan Pembayaran</label>
					</div>
					<div class="form-group">
						<div class="input-group date" id="tanggal_laporanbayar">
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
						<p class="help-block">Upload BA Pembayaran</p>
					</div>
					<div class="form-group floating-label">
						<input type="number" class="form-control" name="monitoring[step]" />
						<label for="regular2">Tahap Pembayaran</label>
					</div>
					<div class="form-group floating-label">
						<input type="number" class="form-control" name="monitoring[amount]" />
						<label for="regular2">Nilai Pembayaran</label>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				<button id="trg_laporanbayar" type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>