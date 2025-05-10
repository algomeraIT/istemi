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
}