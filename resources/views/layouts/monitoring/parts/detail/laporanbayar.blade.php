<div class="tab-pane" id="laporanbayar" role="tabpanel">
  <!-- BEGIN kepemilikan saham TABLE -->
	<br>
  <div class="row">
		<div class="col-md-3">
			<article class="margin-bottom-xxl">
				<a href="#" class="btn btn-block btn-primary"  data-toggle="modal" data-target="#tambahlaporanbayar"><i class="fa fa-plus"></i> Tambah Laporan Pembayaran</a>
			</article>
		</div><!--end .col -->
		<div class="col-md-12">
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
			<em class="text-caption">Tabel Laporan Pembayaran</em>
		</div><!--end .col -->
	</div><!--end .row -->
	<!-- END DEFAULT TABLE -->
</div>

<!--Modal -->
<div id="tambahlaporanbayar" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><a href="#">Tambah Laporan Pembayaran</a></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
			<div class="modal-body">
				<form id="form_mtrlaporanbayar" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/monitor/laporanbayar" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurements['id'] }}" />
					<input type="hidden" name="monitoring[id]" id="laporanbayar_id" value="" />
					{{ csrf_field() }}
					<div class="form-group floating-label">
						<label for="regular2">Catatan Pembayaran</label>
						<input type="text" class="form-control" name="monitoring[notes]" />
					</div>
					<div class="form-group">
						<div class="input-group date" id="tanggal_laporanbayar">
							<div class="input-group-content">
								<label>Tanggal BA</label>
								<input type="date" class="form-control" name="monitoring[ba_date]" />
								<p class="help-block">tanggal/bulan/tahun</p>
							</div>
						</div>
					</div>
					<div class="form-group floating-label">
						<label for="regular2">No. BA</label>
						<input type="text" class="form-control" name="monitoring[ba_number]" />
					</div>
					<div class="form-group floating-label">
						<p class="help-block">Upload BA Pembayaran</p>
						<input type="file" class="form-control" name="monitoring_ba_doc" />
					</div>
					<div class="form-group floating-label">
						<label for="regular2">Tahap Pembayaran</label>
						<input type="number" class="form-control" name="monitoring[step]" />
					</div>
					<div class="form-group floating-label">
						<label for="regular2">Nilai Pembayaran</label>
						<input type="number" class="form-control" name="monitoring[amount]" />
					</div>
                    <input type="submit" id="submit" class="btn btn-primary mt25" value="Tambah">
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div><!-- /.modal-content -->
	</div>
</div>