@php
  use \App\Helpers\DateHelper;
  use \App\Helpers\FormHelper;
  use \App\Helper\AttachmentHelper;
@endphp

<!-- BEGIN Surat/Sertifikat Pendukung TABLE -->
<h5 class="card-title"><i class="fa fa-users"></i> &nbsp;&nbsp;Data Surat/Sertifikat Pendukung (Opsional)</h5>
<br>
<div class="row">
	<div class="col-md-3">
		<article class="margin-bottom-xxl">
			<p>Keterangan mengenai surat/sertifikat pendukung diletakan disini</p>
			<a href="#" id="trg_modal_cert" class="btn btn-block btn-primary" {{ $readonly }}><i class="fa fa-plus"></i> Tambah Surat/Sertifikat</a>
		</article>
	</div><!--end .col -->
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<table id="table_cert" class="table no-margin">
					<thead>
						<tr>
							<th>#</th>
							<th>Jenis Surat</th>
							<th>No Surat/Sertifikat</th>
							<th>Nama Surat/Sertifikat</th>
							<th>Tanggal Diterbitkan</th>
							<th>Tanggal Habis Berlaku</th>
							<th>Institusi</th>
							<th>File</th>
							@if($user->state != 2)
								<th>Aksi</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@for($im = 0; $im < count($company_certs); $im++)
                            @php
                                $doc = $company_certs[$im]->doc()
                            @endphp
							<tr id="cert_{{ $company_certs[$im]->id }}">
								<td class="number">{{ $im + 1 }}</td>
								<td>{{ $company_certs[$im]->type }}</td>
								<td>{{ $company_certs[$im]->number }}</td>
								<td>{{ $company_certs[$im]->title }}</td>
								<td>{{ DateHelper::datepicker($company_certs[$im]->release_date) }}</td>
								<td>{{ DateHelper::datepicker($company_certs[$im]->expired_date) }}</td>
								<td>{{ $company_certs[$im]->author }}</td>
								<td>
                                    @if($doc != null)
                                        {!! FormHelper::file_tag($doc->filepath, $doc->filename) !!}
                                    @endif
                                </td>
								@if($user->state != 2)
								<td>
									<a href="#" class="btn btn-warning trg_modal_cert_edit" data-id="{{ $company_certs[$im]->id }}" data-type="{{ $company_certs[$im]->type }}" data-number="{{ $company_certs[$im]->number }}" data-title="{{ $company_certs[$im]->title }}" data-release_date="{{ DateHelper::datepicker($company_certs[$im]->release_date) }}" data-expired_date="{{ DateHelper::datepicker($company_certs[$im]->expired_date) }}" data-author="{{ $company_certs[$im]->author }}">
										edit
									</a>
									<a data-id="{{ $company_certs[$im]->id }}" href="#" class="btn btn-danger trg_modal_cert_delete">hapus</a>
								</td>
								@endif
							</tr>
            			@endfor
					</tbody>
				</table>
			</div><!--end .card-body -->
		</div><!--end .card -->
		<em class="text-caption">Tabel Surat/Sertifikat Perusahaan</em>
	</div><!--end .col -->
</div><!--end .row -->
<!-- END Surat/Sertifikat Pendukung TABLE -->

<!-- BEGIN PERSONALIA TABLE -->
<h5 class="card-title"><i class="fa fa-users"></i> &nbsp;&nbsp;Data Pengalaman Perusahaan</h5>
<br>
<div class="row">
	<div class="col-md-3">
		<article class="margin-bottom-xxl">
			<p>Cantumkan pengalaman perusahaan <b>3 Tahun terakhir.</b></p>
			<a href="#" id="trg_modal_exp" class="btn btn-block btn-primary"  data-toggle="modal" data-target="#tambahpengalaman" {{ $readonly }}><i class="fa fa-plus"></i> Tambah Pengalaman</a>
		</article>
	</div><!--end .col -->
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">
				<table id="table_exp" class="table no-margin">
					<thead>
						<tr>
							<th>#</th>
							<th>Nama Pekerjaan</th>
							<th>Bidang/Sub Bidang</th>
							<th>Lokasi</th>
							<th>Pemberi Tugas/Pengguna Jasa <br>(Nama/No Telp)</th>
							<th>Kontrak <br>Nomor/Tanggal / Nilai</th>
							<th>Tanggal Selesai <br>Kontrak / BA Serah Terima</th>
							@if($user->state != 2)
								<th>Aksi</th>
							@endif
						</tr>
					</thead>
					<tbody>
						@for($im = 0; $im < count($company_exps); $im++)
							<tr id="exp_{{ $company_exps[$im]->id }}">
								<td class="number">{{ $im + 1 }}</td>
								<td>{{ $company_exps[$im]->name }}</td>
								<td>{{ $company_exps[$im]->field }}</td>
								<td>{{ $company_exps[$im]->location }}</td>
								<td>{{ $company_exps[$im]->client_name }} / {{ $company_exps[$im]->client_phone }}</td>
								<td>{{ $company_exps[$im]->contract_number }} / Rp {{ $company_exps[$im]->contract_value }}</td>
								<td>{{ DateHelper::datepicker($company_exps[$im]->contract_due) }} / {{ DateHelper::datepicker($company_exps[$im]->hand_over) }}</td>
								@if($user->state != 2)
									<td>
										<a href="#" class="btn btn-warning trg_modal_exp_edit" data-id="{{ $company_exps[$im]->id }}" data-name="{{ $company_exps[$im]->name }}" data-field="{{ $company_exps[$im]->field }}" data-location="{{ $company_exps[$im]->location }}" data-client_name="{{ $company_exps[$im]->client_name }}" data-client_phone="{{ $company_exps[$im]->client_phone }}" data-contract_number="{{ $company_exps[$im]->contract_number }}" data-contract_value="{{ $company_exps[$im]->contract_value }}" data-contract_due="{{ DateHelper::datepicker($company_exps[$im]->contract_due) }}" data-hand_over="{{ DateHelper::datepicker($company_exps[$im]->hand_over) }}">
											edit
										</a>
										<a data-id="{{ $company_exps[$im]->id }}" href="#" class="btn btn-danger trg_modal_exp_delete">hapus</a>
									</td>
								@endif
							</tr>
            @endfor
					</tbody>
				</table>
			</div><!--end .card-body -->
		</div><!--end .card -->
		<em class="text-caption">Tabel Pengalaman Perusahaan</em>
	</div><!--end .col -->
</div><!--end .row -->
<!-- END DEFAULT TABLE -->
