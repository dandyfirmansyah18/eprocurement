@extends('layouts.main')
@section('title', 'Tabel Daftar Pengajuan Perencanaan Pengadaan')

@push('csspage')
<link rel="stylesheet" href="{{ URL::asset('js/libs/DataTables/datatables.min.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"  type="text/css"/>
@endpush

@section('content')
  <!-- BEGIN content SECTION -->
	<section class="style-default-bright">
		<div class="noheader section-header">

		</div>
		<div class="section-body">
			<!-- BEGIN DATATABLE  -->
			<div class="row">

				<div class="col-lg-12">
					<div class="table-responsive">
						<table id="tabelperencanaan" class="table table-bordered order-column hover">
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
					            <a href="<?php echo url('perencanaan/detail/'); ?>/{{ $data['id'] }}">
					            	{{ ucwords($data['title']) }}
					            </a>
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
						<em><i class="fa fa-user fa-lg text-success"></i>: sudah disetujui <br>
						<i class="fa fa-user fa-lg"></i>: belum disetujui</em>
					</div><!--end .table-responsive -->
				</div><!--end .col -->
			</div><!--end .row -->
			<!-- END DATATABLE 2 -->

		</div><!--end .section-body -->
	</section>
  <!-- END content SECTION -->
@endsection


@push('jspage')
<script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jsqb-tabel-perencanaan.js') }}"></script>
@endpush
