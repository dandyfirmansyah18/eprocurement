<div class="container-fluid">
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Halaman Detail Pengadaan</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active">Detail Pengadaan</li>
                </ol>
                <!-- <button type="button" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button> -->
            </div>
        </div>
    </div>  
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="abs-right">
                        <br>
                        @if($enrolled == 0)
                          <a id="trg_enrollment" href="#" class="btn btn-primary" @if($user->state != 1) disabled @endif>Ikuti Pengadaan Ini</a>
                        @else
                          <a href="#" class="btn btn-primary" disabled>Sudah terdaftar</a>
                        @endif
                    </div>
                <div class="card-body">
                    <h4><a href="#"><b>{{ ucwords($procurement['title'])}}&nbsp;</b></a></h4>
                    <hr>
                    <div class="vtabs">
                        <ul class="nav nav-tabs tabs-vertical" role="tablist" style="width:500px;">
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="tab" href="#first1" role="tab">
                                    <span class="hidden-sm-up">
                                        <i class="ti-file"></i>
                                    </span> 
                                    <span class="hidden-xs-down">Detail Pengadaan</span> 
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#first2" role="tab">
                                    <span class="hidden-sm-up"><i class="ti-user"></i></span> 
                                    <span class="hidden-xs-down">Daftar Peserta</span>
                                </a> 
                            </li>
                            
                            @if($procurement->procurement_qualification == 1)
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#pra" role="tab">
                                    <span class="hidden-xs-down">Prakualifikasi</span>
                                </a> 
                            </li>
                            @endif
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#start" role="tab">
                                    <span class="hidden-xs-down">1. Pengumuman/Undangan</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dok" role="tab">
                                    <span class="hidden-xs-down">2. Download Dokumen</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#aanwizing" role="tab">
                                    <span class="hidden-xs-down">3. Aanwijzing</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#tawareval" role="tab">
                                    <span class="hidden-xs-down">4. Upload Penawaran</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#buka" role="tab">
                                    <span class="hidden-xs-down">5. Pembukaan Penawaran</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#eval" role="tab">
                                    <span class="hidden-xs-down">6. Evaluasi Penawaran</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#nego" role="tab">
                                    <span class="hidden-xs-down">7. Negosiasi</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#calonpem" role="tab">
                                    <span class="hidden-xs-down">8. Pengusulan Calon Pemenang</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#evalpengumuman" role="tab">
                                    <span class="hidden-xs-down">9. Penetapan dan Pengumuman Pemenang</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#sanggah" role="tab">
                                    <span class="hidden-xs-down">10. Sanggahan</span>
                                </a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#kontrak" role="tab">
                                    <span class="hidden-xs-down">11. SK Penetapan Pemenang/Penunjukan</span>
                                </a> 
                            </li>
                            
                        </ul>
                        <div class="tab-content" style="width:1200px;">
                              @include('layouts.penyedia.parts.pengadaan.infoutama')

                              @include('layouts.penyedia.parts.pengadaan.penyedia')

                              @if($procurement->procurement_qualification == 1)
                                  @include('layouts.penyedia.parts.pengadaan.pra')
                              @endif

                              @include('layouts.penyedia.parts.pengadaan.start')

                              @include('layouts.penyedia.parts.pengadaan.dok')

                              @include('layouts.penyedia.parts.pengadaan.aanwizing')

                              @include('layouts.penyedia.parts.pengadaan.tawareval')

                              @include('layouts.penyedia.parts.pengadaan.buka')

                              @include('layouts.penyedia.parts.pengadaan.eval')

                              @include('layouts.penyedia.parts.pengadaan.nego')

                              @include('layouts.penyedia.parts.pengadaan.calonpem')

                              @include('layouts.penyedia.parts.pengadaan.evalpengumuman')

                              @include('layouts.penyedia.parts.pengadaan.sanggah')

                              @include('layouts.penyedia.parts.pengadaan.kontrak')

                        </div><!--end .card-body -->
                    </div>
                </div>
            </div><!--end .card -->
        </div>
    </div>

  <div id="active_tab" class="hidden-block">{{ Session::get('tab') }}</div>
  @php
    Session::forget('tab');
  @endphp
<script type="text/javascript">
  $(document).ready(function() {
    $("#input-2-xs").rating();

    $('#tanggalverifikasi').datepicker({
      autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"
    });

    $('#trg_enrollment').on('click', function(event){
      // var confirmation = confirm("Apakah anda yakin?");
      // if (confirmation == true) {
      //   $('form#form_enrollment').submit();
      // }
      // event.preventDefault();
      swal({
        title: "",
        text: "Anda Ikuti Pengadaan ini?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Ya, Ikuti!",
        closeOnConfirm: false
      },
      function(){
        var form = $('form#form_enrollment');
        var formData = new FormData(form[0]);
        $.ajax({
            type: form.attr("method"),
            url: form.attr("action"),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(result){
                swal("", "Anda sukses mengikuti pengadaan.", "success");
                // document.location = '/penyedia/pengadaan/'+result;
                call('/penyedia/pengadaan/'+result,'_content_','Pengadaan');
            },
            error: function(error){
                console.log(error);
                swal("", "Failed. Something went wrong, please try again later.", "error");
            }
        });
      });
    });

    var active_tab = $('#active_tab').text().trim();
    if(active_tab != '') {
      $('a[href=#' + active_tab + ']').trigger('click');
    }
  });
</script>
