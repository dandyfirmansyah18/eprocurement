@php
use \App\Helpers\DateHelper;
use \App\Helpers\FormHelper;
@endphp

<!-- Start AKTA -->
<div id="div_akta">
    <h5 class="card-title"><i class="fa fa-file-text-o"></i> &nbsp;&nbsp;Landasan Hukum Pendirian Perusahaan</h5>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control is_req" name="deeds[number]" id="no_akta_pendirian" value="{{ $deed->number }}" required {{ $readonly }}>
                <label>No Akta Pendirian Perusahaan *</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control is_req" name="deeds[notary]" id="nama_notaris_pendirian" value="{{ $deed->notary }}" required {{ $readonly }}>
                <label>Nama Notaris Pendirian *</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="dtf_deed_released">
                    <div class="input-group-content">
                        <input type="text" class="form-control is_req" name="deeds[released]" id="tanggal_dikeluarkan_akta" value="{{ DateHelper::datepicker($deed->released) }}" required {{ $readonly }}>
                        <label>Tanggal Dikeluarkan Akta *</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="deed_release_block" class="form-group dropzone-block tight">
            <span id="text_deed_release">Unggah Akta Pendirian Perusahaan</span>
                <input type="hidden" name="token_deed_release" id="token_deed_release" value="{{ csrf_token() }}">
                <div class="upload-block">
                    @if($deed_release != null && $deed_release->filename != null)
                    <div class="image-block">
                        File saat ini:<br>
                        {!! FormHelper::file_tag($deed_release->filepath, $deed_release->filename) !!}
                    </div>
                    @endif
                    <div id="deed_release" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="deeds[renewal_number]" value="{{ $deed->renewal_number }}" {{ $readonly }}>
                <label>No Akta Perubahan Terakhir</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="deeds[renewal_notary]" value="{{ $deed->renewal_notary }}" {{ $readonly }}>
                <label>Nama Notaris Perubahan</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="dtf_deed_renewaled">
                    <div class="input-group-content">
                        <input type="text" class="form-control" name="deeds[renewaled]" value="{{ DateHelper::datepicker($deed->renewaled) }}" {{ $readonly }}>
                        <label>Tanggal Dikeluarkan Akta Perubahan</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="deed_renewal_block" class="form-group dropzone-block tight">
            <span id="text_deed_renewal">Unggah Akta Perubahan Terakhir</span>
                <input type="hidden" name="token_deed_renewal" id="token_deed_renewal" value="{{ csrf_token() }}">
                <div class="upload-block">
                    @if($deed_renewal != null && $deed_renewal->filename != null)
                    <div class="image-block">
                        File saat ini:<br>
                        {!! FormHelper::file_tag($deed_renewal->filepath, $deed_renewal->filename) !!}
                    </div>
                    @endif
                    <div id="deed_renewal" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- End AKTA -->
</div>
<div id="div_sk_kemenkumham">
    <div class="judulform">
        <i class="fa fa-file-text"></i>&nbsp;Surat Keputusan Kemenkumham
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control is_req" id="sk_kemenkumham_document_number" name="sk_kemenkumham[document_number]" value="{{ $sk_kemenkumham->document_number }}" required {{ $readonly }}>
                <label>No Surat Keputusan Kemenkumham *</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="dtf_deed_confirmed">
                    <div class="input-group-content">
                        <input type="text" class="form-control is_req" id="tanggal_pengesahan_akta" name="deeds[confirmed]" value="{{ DateHelper::datepicker($deed->confirmed) }}" {{ $readonly }}>
                        <label>Tanggal Pengesahan Akta *</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="company_sk_kemenkumham_block" class="form-group dropzone-block tight">
            <span id="text_company_sk_kemenkumham">Unggah SK Kemenkumham</span>
                <div class="upload-block">
                    @if($company_sk_kemenkumham != null && $company_sk_kemenkumham->filename != null)
                        <div class="image-block">
                            File saat ini:<br>
                            {!! FormHelper::file_tag($company_sk_kemenkumham->filepath, $company_sk_kemenkumham->filename) !!}
                        </div>
                    @endif
                    <div id="company_sk_kemenkumham" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control" id="sk_kemenkumham_perubahan_document_number" name="sk_kemenkumham[document_number_perubahan]" value="{{ $sk_kemenkumham->document_number_perubahan }}" {{ $readonly }}>
                <label>No Surat Keputusan Kemenkumham - Perubahan *</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="dtf_deed_renewal_confirmed">
                    <div class="input-group-content">
                        <input type="text" class="form-control" name="deeds[renewal_confirmed]" value="{{ DateHelper::datepicker($deed->renewal_confirmed) }}" {{ $readonly }}>
                        <label>Tanggal Pengesahan Akta Perubahan</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="company_sk_kemenkumham_perubahan_block" class="form-group dropzone-block tight">
            <span id="text_company_sk_kemenkumham_perubahan">Unggah SK Kemenkumham Perubahan</span>
                <div class="upload-block">
                    @if($company_sk_kemenkumham_perubahan != null && $company_sk_kemenkumham_perubahan->filename != null)
                        <div class="image-block">
                            File saat ini:<br>
                            {!! FormHelper::file_tag($company_sk_kemenkumham_perubahan->filepath, $company_sk_kemenkumham_perubahan->filename) !!}
                        </div>
                    @endif
                    <div id="company_sk_kemenkumham_perubahan" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<!-- Start Izin Usaha -->
<div class="judulform" id="judul_izin_usaha">
    <i class="fa fa-file-text-o"></i>&nbsp;Izin Usaha
    <input type="hidden" name="token_company_permit" id="token_company_permit" value="{{ csrf_token() }}">
</div>

<div id="div_siup">
    <div class="row">
        <div class="col-sm-12">
            <h3>
                SIUP
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="hidden" id="siup_type_id_val" value="{{ $siup->type_id }}">
                <select class="form-control select2-list" id="siup_type_id" name="siup[type_id]">
                    <option value="1">Kecil</option>
                    <option value="2">Menengah</option>
                    <option value="3">Besar</option>
                </select>
                <label>Kualifikasi Izin Usaha</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control is_req" id="siup_document_number" name="siup[document_number]" value="{{ $siup->document_number }}" required {{ $readonly }}>
                <label>No Dokumen Izin Usaha</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="company_siup_block" class="form-group dropzone-block tight">
            <span id="text_company_siup">Unggah Dokumen SIUP</span>
                <div class="upload-block">
                    @if($company_siup != null && $company_siup->filename != null)
                        <div class="image-block">
                            File saat ini:<br>
                            {!! FormHelper::file_tag($company_siup->filepath, $company_siup->filename) !!}
                        </div>
                    @endif
                    <div id="company_siup" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control is_req" id="siup_licensor" name="siup[licensor]" value="{{ $siup->licensor }}" required {{ $readonly }}>
                <label>Instansi Yang Mengeluarkan</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="tanggalsiupstart">
                    <div class="input-group-content">
                        <input type="text" class="form-control permit_req is_req" id="siup_release_date" name="siup[release_date]" value="{{ DateHelper::datepicker($siup->release_date) }}" required {{ $readonly }}>
                        <label>Tanggal Dikeluarkan Izin Usaha</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="tanggalsiupend">
                    <div class="input-group-content">
                        <input type="text" class="form-control is_req" id="siup_expired_date" name="siup[expired_date]" value="{{ DateHelper::datepicker($siup->expired_date) }}" required {{ $readonly }}>
                        <label>Tanggal Habis Berlaku Izin Usaha</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            if($siup->sub_business_siup_other == '')
                $checked_sub_business_siup = '';
            else
                $checked_sub_business_siup = 'checked';
            ?>
            <input type="checkbox" name="siup[sub_business_siup_other_cb]" value="1" id="sub_business_siup_other_cb" {{ $checked_sub_business_siup }}> <span style="font-size: 12px; font-style: italic; font-weight: bold;">Apakah Sub Bidang Usaha Anda tidak tersedia dibawah ? Centang untuk masukkan lainnya.</span>
            <div class="form-group floating-label">
                <span id="span_sub_business_siup">
                    <input type="hidden" id="siup_subbusiness_value" value="{{ $siup->sub_business }}">
                    <select id="siup_subbusiness" class="form-control select2-list" name="siup[sub_business][]" multiple>
                        <option value=""></option>
                        @for ($ii = 0; $ii < count($bus_siup); $ii++)
                            @php
                                $subs = $bus_siup[$ii]->subs;
                            @endphp
                            @if ($subs != null)
                            <optgroup label="{{ $bus_siup[$ii]->title }}">
                                @for ($jj = 0; $jj < count($subs); $jj++)
                                <option value="{{ $subs[$jj]->title }}">{{ $subs[$jj]->title }}</option>
                                @endfor
                            </optgroup>
                            @endif
                        @endfor
                    </select>
                    <label>Sub Bidang Usaha <small> (dapat lebih dari satu)</small></label>
                </span>
                <span id="span_sub_business_siup_other">
                    <input type="text" class="form-control" id="span_sub_business_siup_other" name="siup[sub_business_siup_other]" value="{{ $siup->sub_business_siup_other }}" {{ $readonly }}>
                    <label for="gelardepan">Sub Bidang Usaha Lainnya</label>
                    <p class="help-block">* Jika lebih dari satu, pisah dengan koma</p>
                </span>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<br />
<div id="div_iut">
    <div class="row">
        <div class="col-sm-12">
            <h3>
                IUT
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="hidden" id="iujk_type_id_val" value="{{ $iujk->type_id }}">
                <select class="form-control select2-list" id="iujk_type_id" name="iujk[type_id]">
                    <optgroup label="Kecil">
                        <option value="1">K1</option>
                        <option value="2">K2</option>
                    </optgroup>
                    <optgroup label="Menengah">
                        <option value="3">M1</option>
                        <option value="4">M2</option>
                    </optgroup>
                    <optgroup label="Besar">
                        <option value="5">B</option>
                    </optgroup>
                </select>
                <label>Kualifikasi Izin Usaha</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control" id="iujk_document_number" name="iujk[document_number]" value="{{ $iujk->document_number }}" {{ $readonly }}>
                <label>No Dokumen Izin Usaha</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div id="company_iujk_block" class="form-group dropzone-block tight">
            <span id="text_company_iujk">Unggah Dokumen IUT</span>
                <div class="upload-block">
                    @if($company_iujk != null && $company_iujk->filename != null)
                        <div class="image-block">
                            File saat ini:<br>
                            {!! FormHelper::file_tag($company_iujk->filepath, $company_iujk->filename) !!}
                        </div>
                    @endif
                    <div id="company_iujk" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control" id="iujk_licensor" name="iujk[licensor]" value="{{ $iujk->licensor }}" {{ $readonly }}>
                <label>Instansi Yang Mengeluarkan</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="tanggaliujkstart">
                    <div class="input-group-content">
                        <input type="text" class="form-control" id="iujk_release_date" name="iujk[release_date]" value="{{ DateHelper::datepicker($iujk->release_date) }}" {{ $readonly }}>
                        <label>Tanggal Dikeluarkan Izin Usaha</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="tanggaliujkend">
                    <div class="input-group-content">
                        <input type="text" class="form-control" id="iujk_expired_date" name="iujk[expired_date]" value="{{ DateHelper::datepicker($iujk->expired_date) }}" {{ $readonly }}>
                        <label>Tanggal Habis Berlaku Izin Usaha</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            if($iujk->sub_business_iujk_other == '')
                $checked_sub_business_iujk = '';
            else
                $checked_sub_business_iujk = 'checked';
            ?>
            <input type="checkbox" name="iujk[sub_business_iujk_other_cb]" value="1" id="sub_business_iujk_other_cb" {{ $checked_sub_business_iujk }}> <span style="font-size: 12px; font-style: italic; font-weight: bold;">Apakah Sub Bidang Usaha Anda tidak tersedia dibawah ? Centang untuk masukkan lainnya.</span>
            <div class="form-group floating-label">
                <span id="span_sub_business_iujk">
                    <input type="hidden" id="iujk_subbusiness_value" value="{{ $iujk->sub_business }}">
                    <select id="iujk_subbusiness" class="form-control select2-list" name="iujk[sub_business][]" multiple>
                        <option value=""></option>
                        @for ($ii = 0; $ii < count($bus_iujk); $ii++)
                            @php
                                $subs = $bus_iujk[$ii]->subs;
                            @endphp
                            @if ($subs != null)
                            <optgroup label="{{ $bus_iujk[$ii]->title }}">
                                @for ($jj = 0; $jj < count($subs); $jj++)
                                <option value="{{ $subs[$jj]->title }}">{{ $subs[$jj]->title }}</option>
                                @endfor
                            </optgroup>
                            @endif
                        @endfor
                    </select>
                    <label>Sub Bidang Usaha <small> (dapat lebih dari satu)</small></label>
                </span>
                <span id="span_sub_business_iujk_other">
                    <input type="text" class="form-control" id="span_sub_business_iujk_other" name="iujk[sub_business_iujk_other]" value="{{ $iujk->sub_business_iujk_other }}" {{ $readonly }}>
                    <label for="gelardepan">Sub Bidang Usaha Lainnya</label>
                    <p class="help-block">* Jika lebih dari satu, pisah dengan koma</p>
                </span>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <br />
</div>

<!-- <div class="row">
    <div class="col-sm-12">
        <h3>
            SIUI
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <input type="text" class="form-control" id="siui_document_number" name="siui[document_number]" value="{{ $siui->document_number }}" {{ $readonly }}>
            <label>No Dokumen Izin Usaha</label>
        </div>
    </div>
    <div class="col-sm-6">
        <div id="company_siui_block" class="form-group dropzone-block tight">
        Unggah Dokumen Izin Usaha
            <div class="upload-block">
                @if($company_siui != null && $company_siui->filename != null)
                    <div class="image-block">
                        File saat ini:<br>
                        {!! FormHelper::file_tag($company_siui->filepath, $company_siui->filename) !!}
                    </div>
                @endif
                <div id="company_siui" class="dropzone tight" url="/upload/company">
                    <div class="dz-message btn btn-default">
                        <h3>
                            Pilih file
                        </h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <p class="help-block">* Maks. Upload File 10MB</p>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <input type="text" class="form-control" id="siui_licensor" name="siui[licensor]" value="{{ $siui->licensor }}" {{ $readonly }}>
            <label>Instansi yang mengeluarkan</label>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="input-group date" id="tanggalsiuistart">
                <div class="input-group-content">
                    <input type="text" class="form-control" id="siui_release_date" name="siui[release_date]" value="{{ DateHelper::datepicker($siui->release_date) }}" {{ $readonly }}>
                    <label>Tanggal dikeluarkan Izin Usaha</label>
                    <p class="help-block">tanggal/bulan/tahun</p>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="input-group date" id="tanggalsiuiend">
                <div class="input-group-content">
                    <input type="text" class="form-control" id="siui_expired_date" name="siui[expired_date]" value="{{ DateHelper::datepicker($siui->expired_date) }}" {{ $readonly }}>
                    <label>Tanggal habis berlaku Izin Usaha</label>
                    <p class="help-block">tanggal/bulan/tahun</p>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
</div> -->
<div class="clear"></div>
<!-- End Izin Usaha -->
<div id="div_tdp">
    <!-- Start TDP -->
    <div class="judulform">
        <i class="fa fa-file-text"></i>&nbsp;TDP
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control is_req" id="registration_registration_number" name="registration[registration_number]" value="{{ $registration->registration_number }}" required {{ $readonly }}>
                <label>No TDP *</label>
            </div>
        </div>
        <div class="col-sm-6">
            <div id="company_registration_block" class="form-group dropzone-block">
            <span id="text_company_registration">Unggah Dokumen TDP</span>
                <input type="hidden" name="token_company_registration" id="token_company_registration" value="{{ csrf_token() }}">
                <div class="upload-block">
                    @if($company_registration != null && $company_registration->filename != null)
                    <div class="image-block">
                        File saat ini:<br>
                        {!! FormHelper::file_tag($company_registration->filepath, $company_registration->filename) !!}
                    </div>
                    @endif
                    <div id="company_registration" class="dropzone" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control is_req" id="registration_licensor" name="registration[licensor]" value="{{ $registration->licensor }}" required {{ $readonly }}>
                <label>Instansi Yang Mengeluarkan TDP *</label>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="tanggaltdpstart">
                    <div class="input-group-content">
                        <input type="text" class="form-control is_req" id="registration_release_date" name="registration[release_date]" value="{{ DateHelper::datepicker($registration->release_date) }}" required {{ $readonly }}>
                        <label>Tanggal Dikeluarkan TDP *</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="input-group date" id="tanggaltdpend">
                    <div class="input-group-content">
                        <input type="text" class="form-control is_req" id="registration_expired_date" name="registration[expired_date]" value="{{ DateHelper::datepicker($registration->expired_date) }}" {{ $readonly }}>
                        <label>Tanggal Habis Berlaku TDP *</label>
                        <p class="help-block">tanggal/bulan/tahun</p>
                    </div>
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- End TDP -->
</div>

<!-- Start NPWP -->
<div class="judulform">
    <i class="fa fa-file-text"></i>&nbsp;Pajak
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <input type="hidden" id="value_npwp" value="{{ $tax->taxpayer_number }}" {{ $readonly }}>
            <input type="text" class="form-control is_req" id="taxes_taxpayer_number" name="taxes[taxpayer_number]" value="{{ $tax->taxpayer_number }}" required {{ $readonly }}>
            <label for="gelardepan">No NPWP *</label>
            <!-- <p class="help-block">NPWP akan menjadi username login aplikasi </p> -->
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="input-group date" id="tanggalnpwpstart">
                <div class="input-group-content">
                    <input type="text" class="form-control is_req" id="taxes_release_date" name="taxes[release_date]" value="{{ DateHelper::datepicker($tax->release_date) }}" required {{ $readonly }}>
                    <label>Tanggal Dikeluarkan NPWP *</label>
                    <p class="help-block">tanggal/bulan/tahun</p>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div id="company_taxpayer_block" class="form-group dropzone-block tight">
        <span id="text_company_taxpayer">Unggah NPWP</span>
            <input type="hidden" name="token_company_taxpayer" id="token_company_taxpayer" value="{{ csrf_token() }}">
            <div class="upload-block">
                @if($company_taxpayer != null && $company_taxpayer->filename != null)
                <div class="image-block">
                    File saat ini: <br>
                    {!! FormHelper::file_tag($company_taxpayer->filepath, $company_taxpayer->filename) !!}
                </div>
                @endif
                <div id="company_taxpayer" class="dropzone tight" url="/upload/company">
                    <div class="dz-message btn btn-default">
                        <h3>
                            Pilih file
                        </h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <p class="help-block">* Maks. Upload File 4 MB</p>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" class="form-control is_req" id="taxes_last_satisfactionnumber" name="taxes[last_satisfactionnumber]" value="{{ $tax->last_satisfactionnumber }}" required {{ $readonly }}>
            <label>Nomor Bukti Pelunasan Pajak <strong>(tahun terakhir)</strong>*</label>
        </div>
    </div>
    <div class="col-sm-4">
        <div id="company_taxpayment_block" class="form-group dropzone-block tight">
        <span id="text_company_taxpayment">Unggah Bukti Bayar (tahun terakhir)</span>
            <input type="hidden" name="token_company_taxpayment" id="token_company_taxpayment" value="{{ csrf_token() }}">
            <div class="upload-block">
                @if($company_taxpayment != null && $company_taxpayment->filename != null)
                <div class="image-block">
                    File saat ini:<br />
                    {!! FormHelper::file_tag($company_taxpayment->filepath, $company_taxpayment->filename) !!}
                </div>
                @endif
                <div id="company_taxpayment" class="dropzone tight" url="/upload/company">
                    <div class="dz-message btn btn-default">
                        <h3>
                            Pilih file
                        </h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <p class="help-block">* Maks. Upload File 4 MB</p>
            <div class="clear"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            <input type="text" class="form-control is_req" id="taxes_last_satisfactionnumber_kedua" name="taxes[last_satisfactionnumber_kedua]" value="{{ $tax->last_satisfactionnumber_kedua }}" required {{ $readonly }}>
            <label>Nomor Bukti Pelunasan Pajak <strong>(2 tahun terakhir)</strong>*</label>
        </div>
    </div>
    <div class="col-sm-4">
        <div id="company_taxpayment_kedua_block" class="form-group dropzone-block tight">
        <span id="text_company_taxpayment_kedua">Unggah Bukti Bayar (2 tahun terakhir)</span>
            <input type="hidden" name="token_company_taxpayment_kedua" id="token_company_taxpayment_kedua" value="{{ csrf_token() }}">
            <div class="upload-block">
                @if($company_taxpayment_kedua != null && $company_taxpayment_kedua->filename != null)
                <div class="image-block">
                    File saat ini:<br />
                    {!! FormHelper::file_tag($company_taxpayment_kedua->filepath, $company_taxpayment_kedua->filename) !!}
                </div>
                @endif
                <div id="company_taxpayment_kedua" class="dropzone tight" url="/upload/company">
                    <div class="dz-message btn btn-default">
                        <h3>
                            Pilih file
                        </h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <p class="help-block">* Maks. Upload File 4 MB</p>
            <div class="clear"></div>
        </div>
    </div>
</div>

<div id="div_skt">
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <input type="text" class="form-control is_req" id="taxes_sktnumber" name="taxes[sktnumber]" value="{{ $tax->sktnumber }}" required {{ $readonly }}>
                <label>Nomor Surat Keterangan Terdaftar [SKT] *</label>
                <!-- <p class="help-block">Pisahkan dengan koma</p> -->
            </div>
        </div>
        <div class="col-sm-4">
            <div id="company_skt_block" class="form-group dropzone-block tight">
            <span id="text_company_skt">Unggah SKT</span>
                <input type="hidden" name="token_company_skt" id="token_company_skt" value="{{ csrf_token() }}">
                <div class="upload-block">
                    @if($company_skt != null && $company_skt->filename != null)
                    <div class="image-block">
                        File saat ini:<br />
                        {!! FormHelper::file_tag($company_skt->filepath, $company_skt->filename) !!}
                    </div>
                    @endif
                    <div id="company_skt" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

<div id="div_sppkp">
    <!-- Start SPPKP -->
    <div class="row">
        <div class="col-sm-8">
            <div class="form-group">
                <input type="text" class="form-control is_req" id="taxes_sppkpnumber" name="taxes[sppkpnumber]" value="{{ $tax->sppkpnumber }}" required {{ $readonly }}>
                <label>Nomor SPPKP *</label>
                <!-- <p class="help-block">Pisahkan dengan koma</p> -->
            </div>
        </div>
        <div class="col-sm-4">
            <div id="company_sppkp_block" class="form-group dropzone-block tight">
            <span id="text_company_sppkp">Unggah SPPKP</span>
                <input type="hidden" name="token_company_sppkp" id="token_company_sppkp" value="{{ csrf_token() }}">
                <div class="upload-block">
                    @if($company_sppkp != null && $company_sppkp->filename != null)
                    <div class="image-block">
                        File saat ini:<br />
                        {!! FormHelper::file_tag($company_sppkp->filepath, $company_sppkp->filename) !!}
                    </div>
                    @endif
                    <div id="company_sppkp" class="dropzone tight" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- End SPPKP -->
</div>

<div id="div_neraca_keuangan">
    <!-- Start Neraca -->
    <div class="judulform">
        <i class="fa fa-file-text"></i>&nbsp;Neraca Keuangan Perusahaan
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="company_balance_block" class="form-group dropzone-block full-width">
            <span id="text_company_balance">Unggah Neraca Keuangan</span>
                <input type="hidden" name="token_company_balance" id="token_company_balance" value="{{ csrf_token() }}">
                <div class="upload-block">
                    @if($company_balance != null && $company_balance->filename != null)
                    <div class="image-block">
                        File saat ini:<br>
                        {!! FormHelper::file_tag($company_balance->filepath, $company_balance->filename) !!}
                    </div>
                    @endif
                    <div id="company_balance" class="dropzone" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <p class="help-block">* Maks. Upload File 4 MB</p>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- End Neraca -->
</div>

<!-- Start Surat Pernyataan Kesanggupan Memenuhi Pengadaan -->
<div class="judulform">
    <i class="fa fa-file-text"></i>&nbsp;Surat Pernyataan Kesanggupan Memenuhi Pengadaan
</div>
<div class="row">
    <div class="col-md-12">
        <a href="{{ URL::asset('manual/Surat Pernyataan - Kesanggupan.docx') }}" target="_blank"><span class="btn btn-info">Download Template Surat Pernyataan Kesanggupan</span></a>
        <div id="company_spkmp_block" class="form-group dropzone-block full-width">
        <span id="text_company_spkmp">Unggah Surat Pernyataan Kesanggupan Memenuhi Pengadaan</span>
            <input type="hidden" name="token_company_spkmp" id="token_company_spkmp" value="{{ csrf_token() }}">
            <div class="upload-block">
                @if($company_spkmp != null && $company_spkmp->filename != null)
                <div class="image-block">
                    File saat ini:<br>
                    {!! FormHelper::file_tag($company_spkmp->filepath, $company_spkmp->filename) !!}
                </div>
                @endif
                <div id="company_spkmp" class="dropzone" url="/upload/company">
                    <div class="dz-message btn btn-default">
                        <h3>
                            Pilih file
                        </h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <p class="help-block">* Maks. Upload File 4 MB</p>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="clear"></div>
<!-- End Surat Pernyataan Kesanggupan Memenuhi Pengadaan -->

<br /><br />
