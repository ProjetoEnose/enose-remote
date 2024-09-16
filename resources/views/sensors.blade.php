@extends('page')

@section('specific-styles')
    @vite('resources/css/sensors.css')
@endsection

@section('content')
    <div class="sensor" id="mq3">
        <div class="sensor-header">
            <h2 id="name-sensor">MQ3</h2>
        </div>
        <div class="sensor-footer">
            <div id="chart-mq3"></div>
        </div>
    </div>

    <div class="sensor" id="mq5">
        <div class="sensor-header">
            <h2 id="name-sensor">MQ5</h2>
        </div>
        <div class="sensor-footer">
            <div id="chart-mq5"></div>
        </div>
    </div>
@endsection

@section('specific-scripts')
    @vite('resources/js/sensors-chart.js')
@endsection
