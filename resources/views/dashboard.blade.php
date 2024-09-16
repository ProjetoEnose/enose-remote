@extends('page')

@section('specific-styles')
    @vite('resources/css/dashboard.css')
@endsection

@section('content')
    <div id="chart"></div>
@endsection

@section('specific-scripts')
    @vite('resources/js/dashboard-chart.js')
@endsection
