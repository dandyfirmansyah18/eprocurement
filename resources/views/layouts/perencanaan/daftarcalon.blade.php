<div class="container-fluid">
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Daftar User</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Daftar Pengajuan Perencanaan</li>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar User</h4>
                <!-- <h6 class="card-subtitle"></h6> -->
                <div class="table-responsive m-t-40">
                    <table id="tabelperencanaan" class="table table-bordered table-striped">
					<thead>
					            <tr>
					                <th>No</th>
					                <th>Nama Pekerjaan</th>
					                <th>Unit Kerja</th>
					                <th>Jenis Pengadaan</th>
					                <th>Nilai HPS</th>
					                <th>Catatan/Justifikasi</th>
					                <th>Tanggal</th>
					                <th>Persetujuan</th>
									<th>Log</th>
					            </tr>
					        </thead>

					        <tbody>

					        @foreach($preprocurements as $no => $data)

							<tr>
					            <td>{{ $no+1 }}</td>
					            <td>
									<a href="javascript:void(0)" onclick="call('<?= url('perencanaan/detail'); ?>/{{ $data['id'] }}','_content_','Tambah Baru')">{{ ucwords($data['title']) }}</a>
					            <br>
					            @if (array_key_exists(2, $data['approvals']) && $user->role_level == 3 && !$data['proposed'])
					            <form class="form" id="procurement_{{ $data['id'] }}" role="form" action="/pengadaan/tambah" method="POST" >
					            	{{ csrf_field() }}
					            <input type="hidden" name="id" value="{{$data['id']}}">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-edit"></i> Mulai Draft Pengadaan Baru
								</button>
								</form>
								@endif
								</td>
					            <td>{{ $data['user']['unit']['name'] }} </td>
								<td>
									@php
										switch($data['procurement_method']){
											case(1):
												echo 'Pelelangan/Seleksi Umum';
												break;
											case(2):
												echo 'Pelelangan Selektif/Seleksi Terbatas';
												break;
											case(3):
												echo 'Pemilihan Langsung/Seleksi Langsung';
												break;
											case(4):
												echo 'Penunjukan Langsung';
												break;
											case(5):
												echo 'Pengadaan Langsung';
												break;
										}
									@endphp
								</td>
					            <td>Rp. {{ number_format($data['amount'], 0, ',', '.') }}</td>
								<td>{{ $data['justification'] }} <br />{{ $data['notes'] }} </td>
								<td>
									{{ \App\Helpers\AuxHelper::render_date($data['start_date']) }}
								</td>
								<td>
									@php
										if($data['verified'] == 1)
										echo 'Perencanaan telah disetujui';
										else
										echo 'Perencanaa Belum disetujui';
									@endphp
								</td>
					            <td>
					            	@if (array_key_exists(2, $data['approvals']))
									<i class="fa fa-check-circle-o fa-lg text-success"></i>
										<strong>Disetujui ({{ date('d F Y', strtotime($data['approvals'][2]['approval_time']))}})</strong>
									@else
									<i class="fa fa-check-circle-o fa-lg"></i>
										Menunggu persetujuan
									@endif
									<hr>
									@if ($data['verified'] == 1)
									 <i class="fa fa-user fa-lg text-success"></i>
										Pengadaan ({{ date('d F Y', strtotime($data['verification_date'])) }})
									@else
										<i class="fa fa-user fa-lg"></i>
										Pengadaan
									@endif
									
								</td>
					        </tr>
					        @endforeach
					        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
</div>
<script type="text/javascript" src="{{ asset('js/jsqb-tabel-perencanaan.js') }}"></script>