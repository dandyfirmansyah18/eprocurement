@extends('layouts.main')
@section('title','Halaman Detail Pengadaan')
@push('csspage')
<link rel="stylesheet" href="{{ URL::asset('css/libs/summernote/summernote.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('js/libs/rating/star-rating.min.css') }}"  type="text/css"/>

@endpush

@section('content')
  <!-- BEGIN content SECTION -->
  <section class="style-default-bright">
    <div class="section-header">
      <h3>
        <span class="">Pengadaan Jasa Konsultasi Aplikasi E-Procurement 2017 &nbsp;</span>
        <small><i class="fa fa-check-circle-o"></i>:  Sudah dilaksanakan ; <i class="fa fa-circle-o"></i>: sedang berlangsung </small>
      </h3>
    </div>
    <div class="section-body mt0">
      <div class="row">
        <div class="col-md-12">
          <div class="card tabs-left style-default-light">
                <ul class="card-head nav nav-tabs" data-toggle="tabs">
                  <li class="active"><a href="#first1">
                    <i class="fa fa-file-text"></i> &nbsp; Detail Pengadaan &nbsp;
                    </a>
                  </li>
                  <li><a href="#first2">
                    <i class="fa fa-users"></i> &nbsp; Daftar Peserta &nbsp;
                    </a>
                  </li>
                  <li><a href="#pra">
                  <i class="fa fa-check-circle-o"></i> &nbsp; Prakualifikasi
                    </a>
                  </li>
                  <li><a href="#start">
                  <i class="fa fa-check-circle-o"></i> &nbsp; 1. Pengumuman/Undangan
                    </a>
                  </li>
                  <li><a href="#dok">
                  <i class="fa fa-check-circle-o"></i> &nbsp;   2. Download Dokumen
                    </a>
                  </li>
                  <li><a href="#aanwizing">
                  <i class="fa fa-circle-o"></i> &nbsp;     3. Aanwizing
                    </a>
                  </li>
                  <li><a href="#tawareval">
                    4. Upload Penawaran
                    </a>
                  </li>
                  <li><a href="#buka">
                    5. Pembukaan Penawaran
                    </a>
                  </li>
                  <li><a href="#eval">
                    6. Evaluasi Penawaran
                    </a>
                  </li>
                  <li><a href="#nego">
                    7. Negosiasi
                    </a>
                  </li>
                  <li><a href="#calonpem">
                    8. Pengusulan Calon Pemenang
                    </a>
                  </li>
                  <li><a href="#evalpengumuman">
                    9. Penetapan dan Pengumuman Pemenang
                    </a>
                  </li>
                  <li><a href="#sanggah">
                    10. Sanggahan
                    </a>
                  </li>
                  <li><a href="#kontrak">
                    11. SK Penetapan Pemenang
                    </a>
                  </li>

                </ul>
                <div class="pt0 card-body tab-content style-default-bright">
                  @include('pengadaan.parts.detail.infoutama')

                  @include('pengadaan.parts.detail.penyedia_bak')

                  @include('pengadaan.parts.detail.start_bak')

                  @include('pengadaan.parts.detail.pra')

                  @include('pengadaan.parts.detail.dok_bak')

                  @include('pengadaan.parts.detail.aanwizing')

                  @include('pengadaan.parts.detail.tawareval_bak')

                  @include('pengadaan.parts.detail.buka')

                  @include('pengadaan.parts.detail.eval')

                  @include('pengadaan.parts.detail.nego')

                  @include('pengadaan.parts.detail.calonpem')

                  @include('pengadaan.parts.detail.evalpengumuman')

                  @include('pengadaan.parts.detail.sanggah')

                  @include('pengadaan.parts.detail.kontrak')
                  <!--Modal -->
                  <div class="modal fade" id="verifikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="formModalLabel">Ubah Catatan Vendor</h4>
                          </div>
                          <div class="modal-body">
                            <form class="form" role="form">


                                  <div class="form-group floating-label">
                                    <textarea type="text" class="form-control" id="regular2">doing good </textarea>
                                    <label for="regular2">Catatan</label>
                                  </div>
                            </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                              </div>
                            </form>
                      </div><!-- /.modal-content -->
                    </div>
                  </div>





                </div><!--end .card-body -->
              </div><!--end .card -->
        </div>

      </div>
    </div>
  </section>
  <!-- END content SECTION -->
@endsection


@push('jspage')
<script type="text/javascript" src="{{ URL::asset('js/libs/summernote/summernote.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/rating/star-rating.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $("#input-2-xs").rating();
    $('#summernote').summernote();
    $('#summernote2').summernote();
    $('#summernote3').summernote();
    $('#tanggalverifikasi').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });
  });
</script>
<script type="text/javascript" src="{{ URL::asset('js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
@endpush
