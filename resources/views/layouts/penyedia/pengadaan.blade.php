  <!-- BEGIN content SECTION -->
  <section class="style-default-bright">
    <div class="section-header">
      <div class="pull-left">
        <h3>
          <span class="">{{ ucwords($procurement['title'])}} &nbsp;</span>
        </h3>
      </div>
      <div class="pull-right">
        @if($enrolled == 0)
          <a id="trg_enrollment" href="#" class="btn btn-primary" @if($user->state != 1) disabled @endif>Ikuti Pengadaan Ini</a>
        @else
          <a href="#" class="btn btn-primary" disabled>Sudah terdaftar</a>
        @endif
      </div>
      <div class="clear"></div>
    </div>
    <div class="section-body mt0">
      <div class="row">
        <div class="col-md-12">
          <div class="card tabs-left style-default-light">
                <ul class="card-head nav nav-tabs" data-toggle="tabs">
                  <li class="active">
                    <a href="#first1">
                      <i class="fa fa-file-text"></i> &nbsp; Detail Pengadaan &nbsp;
                    </a>
                  </li>
                  <li>
                    <a href="#first2">
                      <i class="fa fa-users"></i> &nbsp; Daftar Peserta &nbsp;
                    </a>
                  </li>
                  @if($procurement->procurement_qualification == 1)
                    <li>
                      <a href="#pra">
                        <i class="fa fa-clock-o"></i> &nbsp; Prakualifikasi &nbsp;
                      </a>
                    </li>
                  @endif
                  <li>
                    <a href="#start">
                      1. Pengumuman/Undangan
                    </a>
                  </li>
                  <li>
                    <a href="#dok">
                      2. Download Dokumen
                    </a>
                  </li>
                  <li>
                    <a href="#aanwizing">
                      3. Aanwizing
                    </a>
                  </li>
                  <li>
                      <a href="#tawareval">
                          4. Upload Penawaran
                      </a>
                  </li>
                  <li>
                      <a href="#buka">
                          5. Pembukaan Penawaran
                      </a>
                  </li>
                  <li>
                      <a href="#eval">
                          6. Evaluasi Penawaran
                      </a>
                  </li>
                  <li>
                    <a href="#nego">
                      7. Negosiasi
                    </a>
                  </li>
                  <li>
                    <a href="#calonpem">
                      8. Pengusulan Calon Pemenang
                    </a>
                  </li>
                  <li>
                    <a href="#evalpengumuman">
                      9. Evaluasi dan Pengumuman Pemenang
                    </a>
                  </li>
                  <li>
                    <a href="#sanggah">
                      10. Sanggahan
                    </a>
                  </li>
                  <li>
                    <a href="#kontrak">
                      11. SK Penetapan Pemenang
                    </a>
                  </li>

                </ul>
                <div class="pt0 card-body tab-content style-default-bright vnd-card">
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
              </div><!--end .card -->
        </div>
      </div>
    </div>

    <div class="hidden-block">
      <form id="form_enrollment" method="POST" action="/enrollment/register">
        {{ csrf_field() }}
        <input type="hidden" name="procurement_id" value="{{ $procurement->id }}" />
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
      </form>
    </div>
  </section>
  <!-- END content SECTION -->

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
