<?php

namespace App\Enums;

use App\Traits\EnumToArrayTrait;

enum MeasurementUnitEnum: string
{
    use EnumToArrayTrait;

    case UNITA = 'Unità';
    case WEIGHT = 'Weight';
    case WORKING_TIME = 'Working Time';
    case LENGTH_DISTANCE = 'Length / Distance';
    case VOLUME = 'Volume';
    case UNSORTED_IMPORTED_UNITS = 'Unsorted/Imported Units';
    case A_CORPO = 'a corpo';
    case UNA_TANTUM = 'una tantum';
    case PER_ELEMENTO_INDAGATO = 'per elemento indagato';
    case A_POSA = 'a posa';
    case CAD = 'Cad';
    case AREA = 'Area';
    case LITRI = 'Litri';
    case A_PIANO = 'a piano';
    case TEMPO = 'tempo';
}
