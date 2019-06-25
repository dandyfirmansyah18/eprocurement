<!-- detail dan persetujuan pengadaan -->
<div class="tab-pane" id="evaluasi" role="tabpanel">
    <p></p>
    <h4><b>Evaluasi pekerjaan {{ $procurements['title'] }}, {{ $winner->name }} </b></h4>
    <h5>Nilai akhir saat ini : {{ $winner->user->rating }}</h5>
    <p>Standar Nilai Akhir</p>
    <ul>
        <li>3,5 - 4	= Sangat Baik dan Tetap digunakan </li>
        <li>3 - 3,4 	= Baik dan tetap digunakan</li>
        <li>2,5 - 2,9 	= Cukup baik dan tetap digunakan tapi perlu perbaikan kinerja </li>
        <li>2,5    	= Buruk dan diganti dengan vendor yang lain</li>
    </ul>
    <hr>
    <form id="form_rating" class="form form-horizontal" action="/monitor/rating" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ $winner->user->id }}" />
        <input type="hidden" name="procurement_id" value="{{ $procurements['id'] }}" />
        <input type="hidden" name="rate[vendor_id]" value="{{ $winner->id }}" />
        <div class="form-group">
            <input type="hidden" id="val_delivery" value="{{ $rating->delivery }}" />
            <div class="form-group">
                <label class="control-label"><b>Delivery time </b></label>
                <div class="radio">
                    <?php
                    $checkdel1 = ($rating->delivery == 1)?"checked":"";
                    $checkdel2 = ($rating->delivery == 2)?"checked":"";
                    $checkdel3 = ($rating->delivery == 3)?"checked":"";
                    $checkdel4 = ($rating->delivery == 4)?"checked":"";
                    ?>  
                    <table border="0" width="100%">
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" id="delivery" name="rate[delivery]" value="1" <?=$checkdel1?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Terlambat diatas 7 hari = 1</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" id="delivery" name="rate[delivery]" value="2" <?=$checkdel2?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Terlambat 3 s/d 7 hari = 2</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" id="delivery" name="rate[delivery]" value="3" <?=$checkdel3?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Kasus diterima dengan catatan 1-3 kali = 3</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" id="delivery" name="rate[delivery]" value="4" <?=$checkdel4?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Tidak pernah ada kasus kualitas material = 4</label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div><!--end .form-group -->
        <div class="form-group">
            <div class="form-group">
                <label class="control-label"><b>Kualitas material/pekerjaan </b></label>
                <input type="hidden" id="val_quality" value="{{ $rating->quality }}" />
                <div class="radio">
                    <?php
                    $checkqual1 = ($rating->quality == 1)?"checked":"";
                    $checkqual2 = ($rating->quality == 2)?"checked":"";
                    $checkqual3 = ($rating->quality == 3)?"checked":"";
                    $checkqual4 = ($rating->quality == 4)?"checked":"";
                    ?>  
                    <table border="0" width="100%">
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[quality]" value="1" <?=$checkqual1?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Pernah ditolak karena kualitas material = 1</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[quality]" value="2" <?=$checkqual2?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Kasus diterima dengan catatan lebih 4 kali = 2</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[quality]" value="3" <?=$checkqual3?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Kasus diterima dengan catatan 1-3 kali = 3</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[quality]" value="4" <?=$checkqual4?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Tidak pernah ada kasus kualitas material = 4</label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group">
                <label class="control-label"><b>Kasus umum atau terkait dengan lingkungan dan keselamatan kesehatan  kerja </b></label>
                <input type="hidden" id="val_case" value="{{ $rating->case }}" />
                <div class="radio">
                    <?php
                    $checkcase1 = ($rating->case == 1)?"checked":"";
                    $checkcase2 = ($rating->case == 2)?"checked":"";
                    $checkcase3 = ($rating->case == 3)?"checked":"";
                    $checkcase4 = ($rating->case == 4)?"checked":"";
                    ?>  
                    <table border="0" width="100%">
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[case]" value="1" <?=$checkcase1?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Terjadi kasus lebih dari 2 kali = 1</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[case]" value="2" <?=$checkcase2?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Terjadi kasus sebanyak 2 kali = 2</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[case]" value="3" <?=$checkcase3?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Terjadi kasus sebanyak 1 kali = 3</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="5%;" align="center">
                                <input type="radio" name="rate[case]" value="4" <?=$checkcase4?>>
                            </td>
                            <td>
                                <label for="square-radio-1">Tidak pernah terjadi kasus = 4</label>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <input type="submit" id="submit" class="btn btn-primary mt25" value="Simpan Perubahan">
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
