<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'percent_mq3',
        'percent_mq5'
    ];

    /**
     * Retorna os dias únicos das leituras no banco de dados.
     */
    public static function getAvailableDays()
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
    public static function getSelectedDay($selectedDay, $days)
    {
        return $selectedDay ?: $days->first();
    }

    /**
     * Retorna as leituras do banco de dados filtradas por dia e intervalo de horas.
     */
    public static function getSensorReadings(string $selectedDay): Collection
    {
        $selectedDayFormatted = Carbon::parse($selectedDay)->toDateString();

        return Sensor::whereRaw('DATE(created_at) = ?', [$selectedDayFormatted])
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
