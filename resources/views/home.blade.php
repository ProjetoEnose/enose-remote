@extends('page')

@section('specific-styles')
    @vite('resources/css/home.css')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>leituras dos sensores</h2>
        </div>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae asperiores doloremque modi ut. Ipsa
            voluptatibus,
            quisquam nesciunt laborum necessitatibus officia expedita quam iusto libero dolorem explicabo, maxime, aut nemo
            odit?
        </p>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>sensores</h2>
        </div>
        <div class="sensor-list-body">
            <a href="/sensors#mq3">
                <span id="sensor-name">mq3</span>
                <span class="sensor-state" id="mq3-state">ativo</span>
            </a>
            <a href="/sensors#mq5">
                <span id="sensor-name">mq5</span>
                <span class="sensor-state" id="mq5-state">ativo</span>
            </a>
        </div>
    </div>
@endsection

@section('specific-scripts')
    @vite('resources/js/wsclient.js')
@endsection
