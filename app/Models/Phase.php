<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    use HasFactory;

    const PHASE_ARRAY = [
        1 => "Avvio",
        2 => "Pianificazione",
        3 => "Esecuzione",
        4 => "Verifica",
        5 => "Chiusura",
    ];
    const phases = ["Non Definito","Avvio", "Pianificazione", "Esecuzione", "Verifica", "Chiusura"];
    const AVVIO = 1;
    const PIANIFICAZIONE = 2;
    const ESECUZIONE = 3;
    const VERIFICA = 4;
    const CHIUSURA = 5;


    protected $fillable = [
        'name',
        'status'
    ];
}
