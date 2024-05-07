@extends('layouts.master')

{{-- @section('title')
    <h1>Dashboard</h1>
@endsection --}}

@section('content')
    <h1>Contenido</h1>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#section-title').text('Dashboard');
        });
    </script>
@endsection