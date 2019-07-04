@extends('layouts.main')
@section('title', 'Tabel Daftar Pengadaan Aktif Saya')

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
									<table id="tabelpengadaanvendor" class="table table-bordered order-column hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pekerjaan</th>
                            <th>Unit Kerja</th>
                            <th>Jenis Pengadaan</th>
                            <th>Nilai HPS</th>
														<!--<th>Hari sejak dimulai / total hari</th>-->
                            <th>Tahapan</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
									</table>
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
<script type="text/javascript" src="{{ URL::asset('js/jsqb-tabel-pengadaanvendor.js') }}"></script>
@endpush
