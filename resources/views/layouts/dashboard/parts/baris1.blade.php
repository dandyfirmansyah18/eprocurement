<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Dashboard</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Info box -->
    <!-- ============================================================== -->
    <div class="card-group">
        @if(Auth::user()->role_level != 2)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-screen-desktop"></i></h3>
                                <p class="text-muted">Draft Pengadaan</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-primary">{{ $count_draft_pengadaan }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-note"></i></h3>
                                <p class="text-muted">Pengajuan Perencanaan Pengadaan</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-cyan">{{ $count_perencanaan }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="{{ $count_perencanaan }}" aria-valuemin="0" aria-valuemax="20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-doc"></i></h3>
                                <p class="text-muted">Pengadaan Aktif Sedang Berjalan</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-purple">{{ $count_pengadaan }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h3><i class="icon-bag"></i></h3>
                                <p class="text-muted">Pengadaan Selesai Terlaksana</p>
                            </div>
                            <div class="ml-auto">
                                <h2 class="counter text-success">{{ $count_selesai }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Info box -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-lg-12 col-md-12">
            <div class="row">
                <!-- Column -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Vendor Baru/Tidak Aktif</h5>
                            <div class="row">
                                <div class="col-6  m-t-30">
                                    <h1 class="text-info">{{ $count_vendor_baru }}</h1>
                                    <p class="text-muted">JUNI 2019</p>
                                    <b></b> </div>
                                <div class="col-6">
                                    <div id="sparkline2dash" class="text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-6">
                    <div class="card bg-purple text-white">
                        <div class="card-body">
                            <h5 class="card-title">Vendor Aktif</h5>
                            <div class="row">
                                <div class="col-6  m-t-30">
                                    <h1 class="text-white">{{ $count_vendor_aktif }}</h1>
                                    <p class="light_op_text">JUNI 2019</p>
                                    <b class="text-white"></b> </div>
                                <div class="col-6">
                                    <div id="sales1" class="text-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
            </div>
        </div>
        
    </div>

</div>