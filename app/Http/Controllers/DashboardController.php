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

        // Buscar os dias únicos para o dropdown
        $days = Sensor::getAvailableDays();

        // Determinar o dia selecionado
        $selectedDay = Sensor::getSelectedDay($selectedDay, $days);

        // Obter as leituras dos sensores
        $sensorsReadings = Sensor::getSensorReadings($selectedDay);

        // Preparar dados para o gráfico
        $mq3Percents = $this->formatSensorData($sensorsReadings, 'percent_mq3');
        $mq5Percents = $this->formatSensorData($sensorsReadings, 'percent_mq5');

        return view("dashboard", [
            "title" => "DASHBOARD",
            "mq3Percents" => $mq3Percents,
            "mq5Percents" => $mq5Percents,
            "days" => $days,
            "selectedDay" => $selectedDay,
        ]);
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
