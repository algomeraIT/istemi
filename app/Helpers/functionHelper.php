<?php

use Carbon\Carbon;

if (!function_exists('dateItFormat')) {
    function dateItFormat($date, $m = 'm')
    {
        $carbonDate = Carbon::parse($date);
        $day = $carbonDate->format('d');
        $month = ucfirst($carbonDate->translatedFormat($m));  // Capitalizza solo il mese
        $year = $carbonDate->format('Y');

        // Ricostruisci la data con il mese capitalizzato
        return "{$day}/{$month}/{$year}";
    }
}

if (!function_exists('countryList')) {
    function countryList()
    {
        return [
            'Italia',
            'Francia',
            'Germania',
            'Spagna',
            'Portogallo',
            'Regno Unito',
            'Irlanda',
            'Paesi Bassi',
            'Belgio',
            'Lussemburgo',
            'Svizzera',
            'Austria',
            'Polonia',
            'Repubblica Ceca',
            'Slovacchia',
            'Ungheria',
            'Slovenia',
            'Croazia',
            'Grecia',
            'Svezia',
            'Norvegia',
            'Danimarca',
            'Finlandia',
            'Islanda',
            'Stati Uniti',
            'Canada',
            'Australia',
            'Nuova Zelanda',
            'Giappone',
            'Cina',
            'India',
            'Brasile',
            'Argentina',
            'Messico',
            'Sudafrica',
            'Egitto',
            'Marocco',
            'Tunisia',
            'Turchia',
        ];
    }
}


if (!function_exists('badgeClient')) {
    function badgeClient($step)
    {
        $bgColor = null;

        switch ($step) {
            case 'nuovo':
                $bgColor = '#339CFF';
                break;
            case 'assegnato':
                $bgColor = '#8A63D2';
                break;
            case 'da riassegnare':
                $bgColor = '#F85C5C';
                break;
            case 'in contatto':
                $bgColor = '#F7C548';
                break;
            case 'non idoneo':
                $bgColor = '#A0A7AF';
                break;
            case 'call center':
                $bgColor = '#F6B663';
                break;
            case 'censimento':
                $bgColor = '#45AEBB';
                break;

            default:
                $bgColor = '#A0A7AF';
                break;
        }

        return $bgColor;
    }
}

// $table->foreignId('created_by')->nullable()->references('id')->on('users');
// $table->foreignId('updated_by')->nullable()->references('id')->on('users');
// $table->foreignId('deleted_by')->nullable()->references('id')->on('users');
