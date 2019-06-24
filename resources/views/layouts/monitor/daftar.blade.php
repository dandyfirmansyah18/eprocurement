<div class="container-fluid">
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Daftar Pengadaan</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Daftar Pengadaan</li>
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
                <h4 class="card-title">Daftar Aktif</h4>
                <!-- <h6 class="card-subtitle"></h6> -->
                <div class="table-responsive m-t-40">
                    <table id="tabelpengadaan" class="table table-bordered table-striped">
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
</div>
<script type="text/javascript" src="{{ asset('js/jsqb-tabel-pengadaan.js') }}"></script>
