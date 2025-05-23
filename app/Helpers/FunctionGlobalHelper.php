<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

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


if (!function_exists('generateUniqueCode')) {
    /**
     * Genera un codice univoco solo alfanumerico per qualsiasi modello
     *
     * @param string $model    Classe del modello (es: App\Models\ProductCategory::class)
     * @param string $column   Colonna dove verificare l'unicità
     * @param string $category Categoria (es: "Indagini Diagnostiche")
     * @param string $title    Titolo (es: "[Corso VT 2L] Corso VT Esame Visivo - II Livello")
     * @param int    $sequenceLength Lunghezza della parte numerica (default 4)
     * @return string
     */
    function generateUniqueCode(
        string $model,
        string $column,
        string $category,
        string $title,
        int $sequenceLength = 4
    ): string {
        // 1) Prendi le prime 3 lettere della categoria, solo A–Z
        $rawCat = strtoupper(Str::substr($category, 0, 3));
        $catClean = preg_replace('/[^A-Z0-9]/', '', $rawCat);

        // 2) Prendi la prima lettera delle prime 3 parole del titolo, solo A–Z
        $words = collect(explode(' ', $title))
            ->filter(fn($w) => strlen($w) > 0)
            ->take(3)
            ->map(fn($w) => strtoupper(Str::substr($w, 0, 1)))
            ->implode('');
        $titleClean = preg_replace('/[^A-Z0-9]/', '', $words);

        // 3) Costruisci prefisso
        $prefix = $catClean . $titleClean;

        // 4) Trova il massimo incrementale già esistente
        $max = app($model)
            ->where($column, 'like', $prefix . '%')
            ->pluck($column)
            ->map(fn($code) => (int) Str::after($code, $prefix))
            ->max();

        $next = str_pad((string) (($max ?? 0) + 1), $sequenceLength, '0', STR_PAD_LEFT);

        return $prefix . $next;
    }

    if (!function_exists('badgeStatus')) {
        function badgeStatus($isActive)
        {
            return [
                'text' => $isActive ? '#5BC88D' : '#A0A7AF',
                'bg' => $isActive ? '#5BC88D1A' : '#A0A7AF1A',
                'label' => $isActive ? 'Attivo' : 'Disattivo'
            ];
        }
    }


    if (!function_exists('badgeQuoteStatus')) {
        function badgeQuoteStatus($status)
        {
            $result = [
                'bg' => '#FFFFFF',
                'text' => '#6C757D',
                'label' => 'Sconosciuto'
            ];

            switch ($status) {
                case 'draft': // Bozza
                    $result = [
                        'bg' => '#A0A7AF1A',
                        'text' => '#A0A7AF',
                        'label' => 'Bozza'
                    ];
                    break;

                case 'review_area': // In revisione - R.A.
                    $result = [
                        'bg' => '#F7C5481A',
                        'text' => '#F7C548',
                        'label' => 'In revisione - R.A.'
                    ];
                    break;

                case 'approved_area': // Approvato - R.A.
                    $result = [
                        'bg' => '#5AC88D1A',
                        'text' => '#5AC88D',
                        'label' => 'Approvato - R.A.'
                    ];
                    break;

                case 'rejected_area': // Rifiutato - R.A.
                    $result = [
                        'bg' => '#F85C5C1A',
                        'text' => '#F85C5C',
                        'label' => 'Rifiutato - R.A.'
                    ];
                    break;

                case 'review_management': // In revisione - Direzione
                    $result = [
                        'bg' => '#F7C5481A',
                        'text' => '#F7C548',
                        'label' => 'In revisione - Direzione'
                    ];
                    break;

                case 'approved_management': // Approvato - Direzione
                    $result = [
                        'bg' => '#5AC88D1A',
                        'text' => '#5AC88D',
                        'label' => 'Approvato - Direzione'
                    ];
                    break;

                case 'rejected_management': // Rifiutato - Direzione
                    $result = [
                        'bg' => '#F85C5C1A',
                        'text' => '#F85C5C',
                        'label' => 'Rifiutato - Direzione'
                    ];
                    break;

                case 'sent': // Inviato al cliente
                    $result = [
                        'bg' => '#F7C5481A',
                        'text' => '#F7C548',
                        'label' => 'Inviato al cliente'
                    ];
                    break;

                case 'accepted': // Approvato dal cliente
                    $result = [
                        'bg' => '#5AC88D1A',
                        'text' => '#5AC88D',
                        'label' => 'Approvato dal cliente'
                    ];
                    break;

                case 'rejected': // Rifiutato dal cliente
                    $result = [
                        'bg' => '#F85C5C1A',
                        'text' => '#F85C5C',
                        'label' => 'Rifiutato dal cliente'
                    ];
                    break;

                case 'expired': // Scaduto
                    $result = [
                        'bg' => '#FFFFFF',
                        'text' => '#6C757D',
                        'label' => 'Scaduto'
                    ];
                    break;
            }

            return $result;
        }
    }
}
