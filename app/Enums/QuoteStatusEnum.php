<?php

namespace App\Enums;

use App\Traits\EnumToArrayTrait;

enum QuoteStatusEnum: string
{
    use EnumToArrayTrait;

    case DRAFT                 = 'draft';              // Bozza
    case REVIEW_AREA           = 'review_area';        // In revisione - R.A.
    case APPROVED_AREA         = 'approved_area';      // Approvato - R.A.
    case REJECTED_AREA         = 'rejected_area';      // Rifiutato - R.A.
    case REVIEW_MANAGEMENT     = 'review_management';  // In revisione - Direzione
    case APPROVED_MANAGEMENT   = 'approved_management';// Approvato - Direzione
    case REJECTED_MANAGEMENT   = 'rejected_management';// Rifiutato - Direzione
    case SENT                  = 'sent';               // Inviato al cliente
    case ACCEPTED              = 'accepted';           // Approvato dal cliente
    case REJECTED              = 'rejected';           // Rifiutato dal cliente
    case EXPIRED               = 'expired';            // Scaduto
}
