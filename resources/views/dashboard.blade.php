@extends('page')

@section('specific-styles')
    @vite('resources/css/dashboard.css')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Levantamento</h2>
            <span>{{ \Carbon\Carbon::parse($selectedDay)->locale('pt_BR')->translatedFormat('d \d\e F \d\e Y') }}</span>

            {{-- DropDown de filtro para as leituras  --}}
            <form id="filter-form" method="GET" action="{{ route('dashboard.index') }}">
                <label for="day">Selecione o dia:</label>
                <select name="day" id="day" onchange="document.getElementById('filter-form').submit()">
                    @foreach ($days as $day)
                        <option value="{{ $day }}" {{ $day == $selectedDay ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::parse($day)->format('d/m/Y') }} <!-- Formatação da data -->
                        </option>
                    @endforeach
                </select>
            </form>

        </div>
        <div id="chart"></div>
    </div>
@endsection

@section('specific-scripts')
    <script>
        // Transformar os dados PHP em arrays JS
        let mq3Percents = @json($mq3Percents);
        let mq5Percents = @json($mq5Percents);
    </script>

    @vite('resources/js/dashboard-chart.js')
@endsection
