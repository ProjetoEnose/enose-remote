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

        // Buscar os dias únicos das leituras para o dropdown
        $days = Sensor::selectRaw('DATE(created_at) as day') // Extrair apenas a data (sem hora)
            ->groupBy('day') // Agrupar por data
            ->orderBy('day', 'desc') // Ordenar as datas em ordem decrescente
            ->get()
            ->pluck('day'); // Obter apenas os dias como uma coleção

        // Se o usuário escolheu um dia, filtrar as leituras por esse dia
        $sensorsReadings = Sensor::query();
        if ($selectedDay) {
            $sensorsReadings->whereDate('created_at', Carbon::parse($selectedDay)); // Filtrar por data
        } else {
            $selectedDay = $days->first();
            $sensorsReadings->whereDate('created_at', Carbon::parse($days->first())); // Filtrar por data
        }

        $sensorsReadings = $sensorsReadings->get(); // Executar a consulta

        return view("dashboard", [
            "title" => "DASHBOARD",
            "mq3Percents" => $sensorsReadings->map(fn(Sensor $sensor) => ['y' => $sensor->percent_mq3, 'x' => $sensor->created_at->format('H:i:s')]),
            "mq5Percents" => $sensorsReadings->map(fn(Sensor $sensor) => ['y' => $sensor->percent_mq5, 'x' => $sensor->created_at->format('H:i:s')]),
            "days" => $days,  // Passar os dias para o dropdown
            "selectedDay" => $selectedDay, // Passar o dia selecionado para manter a seleção
        ]);
    }
}
