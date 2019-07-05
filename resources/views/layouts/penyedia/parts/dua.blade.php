<div class="col-md-12 mt25">
		<div class="card">
			<div class="card-head style-primary">
				<header>Tambah Daftar Vendor</header>
			</div>
			<div class="card-body floating-label">
				<div id="rootwizard2" class="form-wizard form-wizard-horizontal">
				<form class="form floating-label form-validation" role="form" novalidate="novalidate">
					<div class="form-wizard-nav mb50">
						<div class="progress"><div class="progress-bar progress-bar-primary"></div></div>
						<ul class="nav nav-justified">
							<li class="active"><a href="#step1" data-toggle="tab"><span class="step">1</span> <span class="title">Data Perusahaan</span></a></li>
							<li><a href="#step2" data-toggle="tab"><span class="step">2</span> <span class="title">Legalitas</span></a></li>
							<li><a href="#step3" data-toggle="tab"><span class="step">3</span> <span class="title">Dokumen Pendukung</span></a></li>

						</ul>
					</div><!--end .form-wizard-nav -->
					<div class="tab-content clearfix">
						<div class="tab-pane active" id="step1">
							@include('penyedia.parts.wizardparts.datadiri')
						</div><!--end #step1 -->
						<div class="tab-pane" id="step2">
							@include('penyedia.parts.wizardparts.penelitian')
						</div><!--end #step2 -->
						<div class="tab-pane" id="step3">
							@include('penyedia.parts.wizardparts.riwayat')
						</div><!--end #step3 -->

					</div><!--end .tab-content -->
					<ul class="pager wizard">
						<li class="previous"><a class="btn-raised" href="javascript:void(0);">Sebelumnya</a></li>
						<li class="next"><a class="btn-raised" href="javascript:void(0);">Berikutnya</a></li>
					</ul>
				</form>
			</div><!--end #rootwizard -->


			</div><!--end .card-body -->
			<hr>
			<div class="card-actionbar">
				<div class="card-actionbar-row">
					<button type="submit" class="btn btn-primary ink-reaction">Tambah ke database</button>
				</div>
			</div>
		</div><!--end .card -->
		<em class="text-caption">keterangan form</em>
</div><!--end .col -->
