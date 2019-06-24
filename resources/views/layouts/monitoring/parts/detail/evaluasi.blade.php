<!-- detail dan persetujuan pengadaan -->
<div class="tab-pane active" id="evaluasi">
    <a id="trg_rating" href="#" class="btn btn-primary mt25">
        <i class="fa fa-save"></i> Simpan Perubahan
    </a>
    <h3>Evaluasi pekerjaan {{ $procurements['title'] }}, {{ $winner->name }} </h3>
    <h4>Nilai akhir saat ini : {{ $winner->user->rating }}</h4>
    <p>Standar Nilai Akhir</p>
    <ul>
        <li>3,5 - 4	= Sangat Baik dan Tetap digunakan </li>
        <li>3 - 3,4 	= Baik dan tetap digunakan</li>
        <li>2,5 - 2,9 	= Cukup baik dan tetap digunakan tapi perlu perbaikan kinerja </li>
        <li>< 2,5    	= Buruk dan diganti dengan vendor yang lain</li>
    </ul>
    <hr>
    <form id="form_rating" class="form form-horizontal" action="/monitor/rating" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $winner->user->id }}" />
        <input type="hidden" name="procurement_id" value="{{ $procurements['id'] }}" />
        <input type="hidden" name="rate[vendor_id]" value="{{ $winner->id }}" />
        <div class="form-group">
            <input type="hidden" id="val_delivery" name="rate[delivery]" value="{{ $rating->delivery }}" />
            <div class="col-sm-2 label-eval">
                <label class="control-label">Delivery time </label>
            </div>
            <div id="rate_delivery" class="col-sm-3">
                <label class="radio-inline radio-styled">
                    <input type="radio" name="delivery" value="1"><span>1</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="delivery" value="2"><span>2</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="delivery" value="3"><span>3</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="delivery" value="4"><span>4</span>
                </label>
            </div><!--end .col -->
            <div class="col-sm-7">
                <ul>
                    <li>Tepat waktu = 4</li>
                    <li>Terlambat 1 s/d 2 hari = 3</li>
                    <li>Terlambat 3 s/d 7 hari = 2</li>
                    <li>Terlambat diatas 7 hari = 1</li>
                </ul>
            </div>


        </div><!--end .form-group -->
        <div class="form-group">
            <input type="hidden" id="val_quality" name="rate[quality]" value="{{ $rating->quality }}" />
            <div class="col-sm-2 label-eval">
                <label class="control-label">Kualitas material/pekerjaan</label>
            </div>
            <div id="rate_quality" class="col-sm-3">
                <label class="radio-inline radio-styled">
                    <input type="radio" name="quality" value="1"><span>1</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="quality" value="2"><span>2</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="quality" value="3"><span>3</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="quality" value="4"><span>4</span>
                </label>
            </div><!--end .col -->
            <div class="col-sm-7">
                <ul>
                    <li>Tidak pernah ada kasus kualitas material = 4</li>
                    <li>Kasus diterima dengan catatan 1-3 kali = 3</li>
                    <li>Kasus diterima dengan catatan lebih 4 kali = 2</li>
                    <li>Pernah ditolak karena kualitas material = 1</li>
                </ul>
            </div>
        </div><!--end .form-group -->
        <div class="form-group">
            <input type="hidden" id="val_case" name="rate[case]" value="{{ $rating->case }}" />
            <div class="col-sm-2 label-eval">
                <label class="control-label">Kasus umum atau terkait dengan lingkungan dan keselamatan kesehatan  kerja</label>
            </div>
            <div id="rate_case" class="col-sm-3">
                <label class="radio-inline radio-styled">
                    <input type="radio" name="case" value="1"><span>1</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="case" value="2"><span>2</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="case" value="3"><span>3</span>
                </label>
                <label class="radio-inline radio-styled">
                    <input type="radio" name="case" value="4"><span>4</span>
                </label>
            </div><!--end .col -->
            <div class="col-sm-7">
                <ul>
                    <li>Tidak pernah terjadi kasus = 4</li>
                    <li>Terjadi kasus sebanyak 1 kali = 3</li>
                    <li>Terjadi kasus sebanyak 2 kali = 2</li>
                    <li>Terjadi kasus lebih dari 2 kali = 1</li>
                </ul>
            </div>
        </div><!--end .form-group -->
    </form>
    <hr>
</div>

@push('jspage')
    <script>
        $(document).ready(function(){
            var s_delivery      = $('#val_delivery').val();
            if(s_delivery != '') {
                $('#rate_delivery input[value=' + s_delivery + ']').prop('checked', true);
            }

            var s_quality       = $('#val_quality').val();
            if(s_quality != '') {
                $('#rate_quality input[value=' + s_quality + ']').prop('checked', true);
            }

            var s_case          = $('#val_case').val();
            if(s_case != '') {
                $('#rate_case input[value=' + s_case + ']').prop('checked', true);
            }


            $('#trg_rating').on('click', function(event){
                var delivery    = $('#val_delivery').val();
                var quality     = $('#val_quality').val();
                var _case       = $('#val_case').val();

                if(delivery != '' && quality != '' && _case != '') {
                    $('form#form_rating').submit();
                } else {
                    alert('Harap mengisi semua rating');
                }
                event.preventDefault();
            });

            $('#rate_delivery label').each(function(){
                var $el     = $(this);
                $el.on('click', function(){
                    $('#val_delivery').val($el.text().trim());
                });
            });

            $('#rate_quality label').each(function(){
                var $el     = $(this);
                $el.on('click', function(){
                    $('#val_quality').val($el.text().trim());
                });
            });

            $('#rate_case label').each(function(){
                var $el     = $(this);
                $el.on('click', function(){
                    $('#val_case').val($el.text().trim());
                });
            });
        });
    </script>
@endpush
