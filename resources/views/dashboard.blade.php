@extends('page')

@section('specific-styles')
    @vite('resources/css/dashboard.css')
@endsection

@section('content')
    <div class="contain-chart">
        <header>
            <h1>Temporal</h1>
        </header>
        <div id="chart"></div>
    </div>

    <div class="contain-chart">
        <header>
            <h1>Tempo real</h1>
        </header>
        <div id="chart2"></div>
    </div>
@endsection

@section('specific-scripts')
    @vite('resources/js/dashboard-chart.js')
@endsection
