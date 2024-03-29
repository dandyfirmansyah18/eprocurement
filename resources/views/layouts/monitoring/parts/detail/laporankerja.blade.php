<div class="tab-pane" id="laporankerja" role="tabpanel">
  <!-- BEGIN kepemilikan saham TABLE -->
	<br>
    <div class="row">
		<div class="col-md-3">
			<div class="card">
				<div class="card-body">
					<article class="margin-bottom-xxl">
						<a href="#" class="btn btn-block btn-primary"  data-toggle="modal" data-target="#tambahlaporankerja"><i class="fa fa-plus"></i> Tambah Laporan Pekerjaan</a>
					</article>
				</div>
			</div>
		</div><!--end .col -->
		<div class="col-md-12">
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
					<em class="text-caption">Tabel laporan pekerjaan</em>
				</div><!--end .card-body -->
			</div><!--end .card -->
		</div><!--end .col -->
	</div><!--end .row -->
	<!-- END DEFAULT TABLE -->
</div>

<!--Modal -->
<div id="tambahlaporankerja" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><a href="#">Tambah Laporan Pekerjaan</a></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
			<div class="modal-body">
				<form id="form_mtrlaporankerja" class="form floating-label form-validation" role="form" novalidate="novalidate" action="/monitor/laporankerja" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="procurement_id" id="procurement_id" value="{{ $procurements['id'] }}" />
					<input type="hidden" name="monitoring[id]" id="laporankerja_id" value="" />
					{{ csrf_field() }}
					<div class="form-group floating-label">
						<label for="regular2">Catatan Perkembangan</label>
						<input type="text" class="form-control" name="monitoring[notes]" value="">
					</div>
					<div class="form-group">
						<div class="input-group date" id="tanggal_laporankerja">
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
						<p class="help-block">Upload BA Serah Terima Perkembangan Pekerjaan</p>
						<input type="file" class="form-control" name="monitoring_ba_doc" />
					</div>
					<div class="form-group floating-label">
						<label for="regular2">Prosentase Pekerjaan Selesai (%)</label>
						<input type="text" class="form-control" name="monitoring[percentage]" />
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#trg_laporanpekerjaan').on('click', function(event){
	//   $('form#form_mtrlaporankerja').submit();
        var form = $('form#form_mtrlaporankerja');
        var formData = new FormData(form[0]);
        $.ajax({
            type: form.attr("method"),
            url: form.attr("action"),
            data: formData,
            contentType: false,
            processData: false,
            success: function(result){
                var proc_id = '{{ $procurements["id"] }}';
                swal("","Kontrak Berhasil disimpan","success");
                call('/monitor/detail/'+proc_id,'_content_','Daftar Calon Vendor');
            },
            error: function(error){
                console.log(error);
                swal("","Kontrak Gagal disimpan","error");
            }
        });
      event.preventDefault();
    });
  });
</script>