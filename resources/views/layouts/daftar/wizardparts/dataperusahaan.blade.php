@php
    use \App\Helpers\FormHelper;
    use \App\Helpers\DateHelper;
@endphp

<h5 class="card-title"><i class="fa fa-building"></i> &nbsp;&nbsp;Data Perusahaan</h5>
<br>
<input type="hidden" id="company_user_id" name="company[user_id]" value="{{ $user->id }}">

<!--nama -->
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="gelardepan">Nama Perusahaan *</label>
            <input type="text" class="form-control is_req" id="company_name" name="company[name]" value="{{ $company->name }}" required {{ $readonly }}>
            <small id="emailHelp" class="form-text text-muted">Cantumkan nama sesuai akta <strong>tanpa</strong> tipe rekanan (CV, PT, Koperasi)</small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="namalengkap">Email Perusahaan *</label>
            <input type="text" class="form-control is_req" id="namalengkap" name="company[email]" value="{{ $company->email }}" required {{ $readonly }}>
            <small id="emailHelp" class="form-text text-muted">Email akan menjadi kontak pemberitahuan</small>
        </div>
    </div>
</div>
<br>
<!--kontak -->
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="gelardepan">No Telp *</label>
            <input type="text" class="form-control is_req" id="gelardepan" name="company[phone]" value="{{ $company->phone }}" required {{ $readonly }}>
            <small id="emailHelp" class="form-text text-muted">kode area + nomor </small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="namalengkap">Fax *</label>
            <input type="text" class="form-control is_req" id="namalengkap" name="company[fax]" value="{{ $company->fax }}" required {{ $readonly }}>
            <small id="emailHelp" class="form-text text-muted">kode area + nomor </small>
        </div>
    </div>
</div>
<br>

<!--perusahaan -->
<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label">
            <label>Status</label>
            <input type="hidden" id="cmp_withbranch" value="{{ $company->with_branch }}">
            <select id="statuslokasi" class="form-control select2-list" name="company[with_branch]">
                <option value="0">Kantor Pusat</option>
                <option value="1">Kantor Cabang</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label">
            <label>Tipe Bidang Usaha</label>
            <input type="hidden" id="cmp_typeid" value="{{ $company->type_id }}">
            <select id="cmp_typeid_dd" onchange="change_typeid(this.value)" class="form-control select2-list" name="company[type_id]">
                <option value="1">PT</option>
                <option value="2">CV</option>
                <option value="3">Koperasi</option>
                <option value="4">Perseorangan</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div id="company_profile_block" class="form-group dropzone-block tight">
        <label id="text_company_profile">Unggah Company Profile</label>
            <input type="hidden" name="token_company_profile" id="token_company_profile" value="{{ csrf_token() }}">
            <div class="upload-block">
                @if($company_profile != null && $company_profile->filename != null)
                <div class="image-block">
                    File saat ini<br>
                    {!! FormHelper::file_tag($company_profile->filepath, $company_profile->filename) !!}
                </div>
                @endif
                <div id="company_profile" class="dropzone tight" url="/upload/company">
                    <div class="dz-message btn btn-default">
                        <h3>
                            Pilih file
                        </h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <small id="emailHelp" class="form-text text-muted"> Maks. Upload File 4 MB</small>
            <div class="clear"></div>
        </div>
    </div>
</div>
<br>
<h5 class="card-title"><i class="fa fa-map-marker"></i> &nbsp;&nbsp;Alamat Perusahaan</h5>
<br>
<!--domisili -->
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Alamat domisili *</label>
            <textarea name="company[branch_address]" id="cmpb_address" class="form-control is_req" rows="2" {{ $readonly }} required>{{ $company->branch_address }}</textarea>
            <small id="emailHelp" class="form-text text-muted">Cantumkan alamat sesuai surat keterangan domisili</small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label">
            <input type="hidden" id="cmpb_province" value="{{ $company->branch_province_id }}">
            <label>Provinsi Domisili</label>
            <select id="cmpb_province_dd" class="form-control select2-list" name="company[branch_province_id]" onchange="changeprovince(this.value, 'domicile')">
                <option value=""></option>
                @foreach($provinces as $provincess)
                <option value="{{ $provincess->province_code }}" @if($branch_province_id == $provincess->province_code) selected @endif>{{ $provincess->province_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group floating-label">
            <input type="hidden" id="cmpb_city" value="{{ $company->branch_city_id }}">
            <label>Kota/Kabupaten Domisili</label>
            <select id="cmpb_city_dd" class="form-control select2-list" name="company[branch_city_id]" onchange="changecity(this.value, 'domicile')">
                <option value=""></option>
                @if($branch_dropdown_city)
                    @foreach($branch_dropdown_city as $cities)
                    <option value="{{ $cities->city }}" @if($branch_city_id == $cities->city) selected @endif>{{ $cities->city }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php
        if($branch_postal_code_other == '0')
            $checked_branch_postal_code = '';
        else
            $checked_branch_postal_code = 'checked';
        ?>
        <input type="checkbox" name="company[lainnya_branch_postal_code]" value="1" onclick="branch_postal_code_change()" id="lainnya_branch_postal_code" {{$checked_branch_postal_code}} > <span style="font-size: 12px; font-style: italic; font-weight: bold;">Apakah Kode Pos Anda tidak tersedia dibawah ? Centang untuk masukkan lainnya.</span>
        <div class="form-group floating-label">
            <span id="span_branch_postal_code">
                <label>Kecamatan-Kelurahan-Kode Pos Domisili</label>
                <input type="hidden" id="cmpb_postalcode" value="{{ $company->branch_postal_code }}">
                <select id="cmpb_postalcode_dd" class="form-control select2-list" name="company[branch_postal_code]">
                    <option value=""></option>
                    @if($branch_dropdown_postalcode)
                        @foreach($branch_dropdown_postalcode as $postal_code)
                        <option value="{{ $postal_code->id }}" @if($branch_postal_code == $postal_code->id) selected @endif>{{$postal_code->sub_district.' - '.$postal_code->urban.' - '.$postal_code->postal_code}}</option>
                        @endforeach
                    @endif
                </select>
            </span>
            <span id="span_branch_postal_code_other">
                <label for="gelardepan">Kode Pos Domisili Lainnya</label>
                <input type="text" class="form-control" id="span_branch_postal_code_other" name="company[branch_postal_code_other]" value="{{ $branch_postal_code_other }}" {{ $readonly }}>
                <small id="emailHelp" class="form-text text-muted">Cantumkan dengan format <strong>Kecamatan-Kelurahan-KodePos</strong></small>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>No Surat Keterangan Domisili Perusahaan (SKDP) *</label>
            <input type="text" class="form-control is_req" id="skdp_document_number" name="skdp[document_number]" value="{{ $skdp->document_number }}" required {{ $readonly }}>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="input-group date" id="dtf_skdp_document_data">
                <div class="input-group-content">
                    <label>Tanggal Dokumen SKDP *</label>
                    <input type="text" class="form-control is_req" id="skdp_document_date" name="skdp[document_date]" value="{{ DateHelper::datepicker($skdp->document_date) }}" {{ $readonly }}>
                    <small id="emailHelp" class="form-text text-muted">tanggal/bulan/tahun</small>
                </div>
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div id="company_domicile_block" class="form-group dropzone-block tight">
        <label id="text_company_domicile">Unggah Surat Keterangan Domisili</label>
            <input type="hidden" name="token_company_domicile" id="token_company_domicile" value="{{ csrf_token() }}">
            <div class="upload-block">
                @if($company_domicile != null && $company_domicile->filename != null)
                <div class="image-block">
                    File saat ini<br>
                    {!! FormHelper::file_tag($company_domicile->filepath, $company_domicile->filename) !!}
                </div>
                @endif
                <div id="company_domicile" class="dropzone tight" url="/upload/company">
                    <div class="dz-message btn btn-default">
                        <h3>
                            Pilih file
                        </h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <small id="emailHelp" class="form-text text-muted"> Maks. Upload File 4 MB</small>
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <label>Alamat Operasional</label>
            <textarea name="company[operational_address]" id="operational_address" class="form-control is_req" rows="2" {{ $readonly }} required>{{ $company->operational_address }}</textarea>
            <small id="emailHelp" class="form-text text-muted">Cantumkan alamat operasional dengan lengkap, benar dan tepat.</small>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group floating-label">
            <label>Provinsi Operasional</label>
            <input type="hidden" id="operational_province" value="{{ $company->operational_province_id }}">
            <select id="operational_province_dd" class="form-control select2-list" name="company[operational_province_id]" onchange="changeprovince(this.value, 'operational')">
                <option value=""></option>
                @foreach($provinces as $provincess)
                <option value="{{ $provincess->province_code }}" @if($company->operational_province_id == $provincess->province_code) selected @endif>{{ $provincess->province_name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group floating-label">
            <label>Kota/Kabupaten Operasional</label>
            <input type="hidden" id="operational_city" value="{{ $company->operational_city_id }}">
            <select id="operational_city_dd" class="form-control select2-list" name="company[operational_city_id]" onchange="changecity(this.value, 'operational')">
                <option value=""></option>
                @if($operational_dropdown_city)
                    @foreach($operational_dropdown_city as $cities)
                    <option value="{{ $cities->city }}" @if($company->operational_city_id == $cities->city) selected @endif>{{ $cities->city }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="col-sm-4">
        <?php
        if($company->operational_postal_code_other == '0')
            $checked_operational_postal_code = '';
        else
            $checked_operational_postal_code = 'checked';
        ?>
        <input type="checkbox" name="company[lainnya_operational_postal_code]" value="1" onclick="operational_postal_code_change()" id="lainnya_operational_postal_code" {{$checked_operational_postal_code}}> <span style="font-size: 12px; font-style: italic; font-weight: bold;">Apakah Kode Pos Anda tidak tersedia dibawah ? Centang untuk masukkan lainnya.</span>
        <div class="form-group floating-label">
            <span id="span_operational_postal_code">
                <label>Kecamatan-Kelurahan-Kode Pos Operasional</label>
                <input type="hidden" id="operational_postalcode" value="{{ $company->operational_postal_code }}">
                <select id="operational_postalcode_dd" class="form-control select2-list" name="company[operational_postal_code]">
                    <option value=""></option>
                    @if($operational_dropdown_postalcode)
                        @foreach($operational_dropdown_postalcode as $postal_code)
                        <option value="{{ $postal_code->id }}" @if($company->operational_postal_code == $postal_code->id) selected @endif>{{$postal_code->sub_district.' - '.$postal_code->urban.' - '.$postal_code->postal_code}}</option>
                        @endforeach
                    @endif
                </select>
            </span>
            <span id="span_operational_postal_code_other">
                <label for="gelardepan">Kode Pos Operasional Lainnya</label>
                <input type="text" class="form-control" id="operational_postal_code_other" name="company[operational_postal_code_other]" value="{{ $company->operational_postal_code_other }}" {{ $readonly }}>
                <small id="emailHelp" class="form-text text-muted">Cantumkan dengan format <strong>Kecamatan-Kelurahan-KodePos</strong></small>
            </span>
        </div>
    </div>
</div>

<br>
<div id="branch_detail" style="display:none">
    <div class="boxs row">
        <p class="warning-cabang">Karena anda memilih status kantor cabang, mohon untuk melengkapi pula alamat kantor pusat perusahaan.</p>
        <!--domisili -->
        <div class="col-sm-12">
            <div class="form-group">
                <label>Alamat domisili kantor pusat</label>
                <textarea name="company[address]" id="cmp_address" class="form-control" rows="2" {{ $readonly }}>{{ $company->address }}</textarea>
            </div>
        </div>
    </div>
    <div class="boxs row">
        <div class="col-sm-4">
            <div class="form-group floating-label">
                <label>Provinsi Kantor Pusat</label>
                <input type="hidden" id="cmp_province" value="{{ $company->province_id }}">
                <select id="cmp_province_dd" class="form-control select2-list" name="company[province_id]" onchange="changeprovince(this.value, 'cabang')">
                    <option value=""></option>
                    @foreach($provinces as $provincess)
                    <option value="{{ $provincess->province_code }}" @if($province_id_fix == $provincess->province_code) selected @endif>{{ $provincess->province_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group floating-label">
                <label>Kota/Kabupaten Kantor Pusat</label>
                <input type="hidden" id="cmp_city" value="{{ $company->city_id }}">
                <select id="cmp_city_dd" class="form-control select2-list" name="company[city_id]" onchange="changecity(this.value, 'cabang')">
                    <option value=""></option>
                    @if($cabang_dropdown_city)
                        @foreach($cabang_dropdown_city as $cities)
                        <option value="{{ $cities->city }}" @if($city_id_fix == $cities->city) selected @endif>{{ $cities->city }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <?php
            if($postal_code_other_fix == '0')
                $checked_postal_code = '';
            else
                $checked_postal_code = 'checked';
            ?>
            <input type="checkbox" name="company[lainnya_postal_code]" value="1" onclick="postal_code_change()" id="lainnya_postal_code" {{$checked_postal_code}}> <span style="font-size: 12px; font-style: italic; font-weight: bold;">Apakah Kode Pos Anda tidak tersedia dibawah ? Centang untuk masukkan lainnya.</span>
            <div class="form-group floating-label">
                <span id="span_postal_code">
                    <label>Kecamatan-Kelurahan-Kode Pos Kantor Pusat</label>
                    <input type="hidden" id="cmp_postalcode" value="{{ $company->postal_code }}">
                    <select id="cmp_postalcode_dd" class="form-control select2-list" name="company[postal_code]">
                        <option value=""></option>
                        @if($cabang_dropdown_postalcode)
                            @foreach($cabang_dropdown_postalcode as $post)
                            <option value="{{ $post->id }}" @if($postal_code_fix == $post->id) selected @endif>{{$post->sub_district.' - '.$post->urban.' - '.$post->postal_code}}</option>
                            @endforeach
                        @endif
                    </select>
                </span>
                <span id="span_postal_code_other">
                    <label for="gelardepan">Kode Pos Kantor Pusat Lainnya</label>
                    <input type="text" class="form-control" id="postal_code_other" name="company[postal_code_other]" value="{{ $postal_code_other_fix }}" {{ $readonly }}>
                    <small id="emailHelp" class="form-text text-muted">Cantumkan dengan format <strong>Kecamatan-Kelurahan-KodePos</strong></small>
                </span>
            </div>
        </div>
    </div>
</div>

<div id="div_struktur">
    <!-- Start Struktur Organisasi -->
    <h5 class="card-title"><i class="fa fa-file-text"></i> &nbsp;&nbsp;Struktur Organisasi</h5>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div id="company_struktur_block" class="form-group dropzone-block full-width">
            <label id="text_company_struktur">Unggah Struktur Organisasi</label>
                <input type="hidden" name="token_company_struktur" id="token_company_struktur" value="{{ csrf_token() }}">
                <div class="upload-block">
                    @if($company_struktur != null && $company_struktur->filename != null)
                    <div class="image-block">
                        File saat ini:<br>
                        {!! FormHelper::file_tag($company_struktur->filepath, $company_struktur->filename) !!}
                    </div>
                    @endif
                    <div id="company_struktur" class="dropzone" url="/upload/company">
                        <div class="dz-message btn btn-default">
                            <h3>
                                Pilih file
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <small id="emailHelp" class="form-text text-muted"> Maks. Upload File 4 MB</small>
                <div class="clear"></div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <!-- End Struktur Organisasi -->
</div>
<br>
<h5 class="card-title"><i class="fa fa-gears"></i> &nbsp;&nbsp;Klasifikasi Perusahaan</h5>
<br>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label">
            <label>Klasifikasi <small> (dapat lebih dari satu)</small></label>
            <input type="hidden" id="cmp_classificationid" value="{{ $company->classification_id }}">
            <select id="cmp_classificationid_dd" class="form-control select2-list" name="company[classification_id][]" multiple>
                <option value=""></option>
                <option value="1">Penyedia Barang</option>
                <option value="2">Pemborong atau penyedia pekerjaan konstruksi</option>
                <option value="3">Konsultan atau penyedia pekerjaan konsultasi</option>
                <option value="4">Penyedia jasa lainnya</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group floating-label">
            <label>Bidang Usaha <small> (dapat lebih dari satu)</small></label>
            <input type="hidden" id="cmp_business" value="{{ $company->business }}">
            <select id="cmp_business_dd" class="form-control select2-list" name="company[business][]" multiple>
                <option value=""></option>
                <option value="it">IT</option>
                <option value="konstruksi">Konstruksi</option>
                <option value="lainnya">Lainnya</option>
            </select>
        </div>
    </div>
</div>
