@extends('page')

@section('specific-styles')
    @vite('resources/css/dashboard.css')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Temporal</h2>
        </div>
        <div id="chart"></div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Tempo real</h2>
        </div>
        <div id="chart2"></div>
    </div>
@endsection

@section('specific-scripts')
    @vite('resources/js/dashboard-chart.js')
@endsection
