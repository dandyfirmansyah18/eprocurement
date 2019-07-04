<div class="container-fluid">
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Tabel Daftar Pekerjaan Aktif</h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Tabel Daftar Pekerjaan Aktif</li>
            </ol>
            <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
        </div>
    </div>
</div>
<!-- =========asd===================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tabel Daftar Pekerjaan Aktif</h4>
                <!-- <h6 class="card-subtitle"></h6> -->
                <div class="table-responsive m-t-40">
                    <table id="tabelmonitoringpekerjaan" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pekerjaan</th>
                                <th>Unit Kerja</th>
                                <th>Tanggal Mulai Pekerjaan</th>
                                <th>Hari sejak dimulai/total hari kontrak kerja</th>
                                <th>Tanggal Selesai Pekerjaan / Prosentase Pekerjaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($ii = 0; $ii < count($procurements); $ii++)
                            <tr>
                                <td>{{ $ii + 1 }}</td>
                                <td>
                                    <a href="javascript:void(0)" onclick="call('<?php echo url('monitor/detail/'.$procurements[$ii]->id.''); ?>','_content_','Detail Monitoring')">{{ $procurements[$ii]->title }}</a>
                                </td>
                                <td>
                                    {{ $procurements[$ii]->user->unit->name }}
                                </td>
                                <td>
                                    @if($procurements[$ii]->monitoring_contract != null)
                                        {{ \App\Helpers\AuxHelper::render_date_long($procurements[$ii]->monitoring_contract->start_date) }}
                                    @endif
                                </td>
                                <td>
                                    <h3 class="text-success">{{ $procurements[$ii]->render_work_day_difference() }}</h3>
                                </td>
                                <td>{{ $procurements[$ii]->render_work_end() }}</td>
                            </tr>
                            @endfor
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
<script type="text/javascript" src="{{ asset('js/jsqbc-functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsqb-tabel-monitoring-pekerjaan.js') }}"></script>