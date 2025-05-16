<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoicesSal extends Model
{
    use HasFactory;

    protected $table = 'invoices_sal';

    protected $fillable = [
        'client_id',
        'project_id',
        'name_phase',
        'user',
        'status',
        'invoices_sal',
        'user_invoices_sal',
        'status_invoices_sal',

        'emission_invoice',
        'user_emission_invoice',
        'status_emission_invoice',

        'payment_invoice',
        'user_payment_invoice',
        'status_payment_invoice',
    ];

    // Relationships

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function userInvoicesSal()
    {
        return $this->belongsTo(User::class, 'user_invoices_sal');
    }

    public function userEmissionInvoice()
    {
        return $this->belongsTo(User::class, 'user_emission_invoice');
    }

    public function userPaymentInvoice()
    {
        return $this->belongsTo(User::class, 'user_payment_invoice');
    }

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $phases = ['invoices_sal', 'emission_invoice', 'payment_invoice'];

        $labels = [
            'invoices_sal' => 'Fatture e acconto SAL',
            'emission_invoice' => 'Emissione fattura',
            'payment_invoice' => 'Pagamento fattura',
        ];

        foreach ($phases as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'invoices_sal' => in_array('invoices_sal', $selected),
                    'user_invoices_sal' => $formData['user_invoices_sal'] ?? null,
                    'status_invoices_sal' => false,

                    'emission_invoice' => in_array('emission_invoice', $selected),
                    'user_emission_invoice' => $formData['user_emission_invoice'] ?? null,
                    'status_emission_invoice' => false,

                    'payment_invoice' => in_array('payment_invoice', $selected),
                    'user_payment_invoice' => $formData['user_payment_invoice'] ?? null,
                    'status_payment_invoice' => false,
                ]);
            }
        }
    }
}
