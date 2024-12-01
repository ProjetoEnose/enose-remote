<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedDay = $request->input('day');
        $hourRange = $request->input('hourRange', 6); // Padrão: 6 primeiras horas do dia

        // Buscar os dias únicos para o dropdown
        $days = $this->getAvailableDays();

        // Determinar o dia selecionado
        $selectedDay = $this->getSelectedDay($selectedDay, $days);

        // Determinar o intervalo de horas
        $selectedInterval = $this->getHourInterval($hourRange);

        // Obter as leituras dos sensores
        $sensorsReadings = $this->getSensorReadings($selectedDay, $selectedInterval);

        // Preparar dados para o gráfico
        $mq3Percents = $this->formatSensorData($sensorsReadings, 'percent_mq3');
        $mq5Percents = $this->formatSensorData($sensorsReadings, 'percent_mq5');

        return view("dashboard", [
            "title" => "DASHBOARD",
            "mq3Percents" => $mq3Percents,
            "mq5Percents" => $mq5Percents,
            "days" => $days,
            "selectedDay" => $selectedDay,
            "hourRange" => $hourRange, // Passar a hora selecionada para manter a seleção no front-end
        ]);
    }

    /**
     * Retorna os dias únicos das leituras no banco de dados.
     */
    private function getAvailableDays()
    {
        return Sensor::selectRaw('DATE(created_at) as day')
            ->groupBy('day')
            ->orderBy('day', 'desc')
            ->get()
            ->pluck('day');
    }

    /**
     * Retorna o dia selecionado ou o mais recente disponível.
     */
    private function getSelectedDay($selectedDay, $days)
    {
        return $selectedDay ?: $days->first();
    }

    /**
     * Retorna o intervalo de horas com base no range selecionado.
     */
    private function getHourInterval($hourRange)
    {
        $hourIntervals = [
            6 => ['start' => '00:00:00', 'end' => '06:00:00'],
            12 => ['start' => '06:00:00', 'end' => '12:00:00'],
            18 => ['start' => '12:00:00', 'end' => '18:00:00'],
            24 => ['start' => '18:00:00', 'end' => '23:59:59'], // Últimas 6 horas do dia
        ];

        return $hourIntervals[$hourRange] ?? $hourIntervals[6]; // Padrão: primeiras 6 horas
    }

    /**
     * Retorna as leituras do banco de dados filtradas por dia e intervalo de horas.
     */
    private function getSensorReadings($selectedDay, $interval)
    {
        $selectedDayFormatted = Carbon::parse($selectedDay)->toDateString();

        return Sensor::whereRaw('DATE(created_at) = ?', [$selectedDayFormatted])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Formata os dados do sensor para exibição no gráfico.
     */
    private function formatSensorData($sensorsReadings, $key)
    {
        return $sensorsReadings->map(fn(Sensor $sensor) => [
            'y' => $sensor->$key,
            'x' => $sensor->created_at->format('H:i:s'),
        ]);
    }
}
