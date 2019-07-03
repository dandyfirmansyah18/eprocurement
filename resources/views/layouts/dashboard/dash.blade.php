@extends('templates.index')
@section('title', 'Dashboard Aplikasi')
@push('csspage')
<link rel="stylesheet" href="{{ URL::asset('js/libs/DataTables/datatables.min.css') }}"  type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}"  type="text/css"/>
@endpush

@section('content')
  <!-- BEGIN content SECTION -->
    @include('layouts.dashboard.parts.baris1')
    @include('layouts.dashboard.parts.baris2')
@endsection


@push('jspage')
<script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/libs/DataTables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/jsqb-dashboard.js') }}"></script>
@endpush
