@extends('layouts.main')
@section('title', 'Dashboard Aplikasi')
@push('csspage')
<link rel="stylesheet" href="{{ URL::asset('js/libs/DataTables/datatables.min.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"  type="text/css"/>
@endpush

@section('content')
    <!-- BEGIN content SECTION -->
    <section>
        <div class="section-body">
            <div class="row"><!-- baris 2 tabel -->
                @include('dashboard.parts.baris-user')
            </div><!--end .row -->
        </div>
    </section>
    <!-- END content SECTION -->
@endsection


@push('jspage')
<script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jsqb-dashboard-user.js') }}"></script>

@endpush
