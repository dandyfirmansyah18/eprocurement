@extends('layouts.main')

@section('title', 'Draft Pengadaan Baru')

@push('csspage')
    <link rel="stylesheet" href="{{ URL::asset('css/libs/dropzone/dropzone-theme.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/bootstrap-datepicker/datepicker3.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/select2/select2.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/wizard/wizard.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/bootstrap-tagsinput/bootstrap-tagsinput.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/typeahead/typeahead.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/libs/summernote/summernote.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"  type="text/css"/>
@endpush

@section('content')
    <!-- BEGIN content SECTION -->
    <section class="style-default-bright">
        <div class="noheader section-header"></div>
        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-head">
                            <ul class="nav nav-tabs" data-toggle="tabs">
                                <li class="active">
                                    <a href="#first">Detail Pengadaan</a>
                                </li>
                                <li>
                                    <a href="#third">Kriteria Penilaian</a>
                                </li>

                                @if($item->delivery_method != null && $item->delivery_method > 0)
                                    <li>
                                        <a href="#second">Jadwal Pengadaan</a>
                                    </li>
                                @endif
                            </ul>
                        </div><!--end .card-head -->

                        <div class="pt0 card-body tab-content">
                            @include('pengadaan.parts.draft.infoutama')

                            @include('pengadaan.parts.draft.kriteria')

                            @if($item->delivery_method != null && $item->delivery_method > 0)
                                @include('pengadaan.parts.draft.tanggal')
                            @endif
                        </div><!--end .card-body -->

                    </div>


                </div>
            </div>
        </div>

        <div class="hidden-block">
            <form id="form_start" method="POST" action="/pengadaan/mulai">
                {{ csrf_field() }}
                <input type="hidden" id="start_id" name="id" value="{{ $item->id }}" />
            </form>
        </div>

        <div id="active_tab" class="hidden-block">{{ Session::get('tab') }}</div>
        @php
        Session::forget('tab');
        @endphp
    </section>
    <!-- END content SECTION -->
@endsection


@push('jspage')
    <script type="text/javascript" src="{{ URL::asset('js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/dropzone/dropzone.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/select2/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/wizard/jquery.bootstrap.wizard.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/wizard/DemoFormWizard.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/typeahead/typeahead.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/libs/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jsqbc-functions.js') }}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        enable_session_tab();

        $('#trg_start').on('click', function(event){
            var confirmation = confirm("Apakah anda yakin?");
            if (confirmation == true) {
                submit_form('form_start');
            }
            event.preventDefault();
        });
    });
    </script>
@endpush
