<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounting extends Model
{
    use HasFactory;

    protected $table = 'accountings';

    protected $fillable = [
        'client_id',
        'project_id',
        'accounting',
        'user',
        'status',
        'user_accounting',
        'status_accounting',
        'accounting_dec',
        'user_accounting_dec',
        'status_accounting_dec',
        'create_cre',
        'user_create_cre',
        'status_create_cre',
        'expense_allocation',
        'user_expense_allocation',
        'status_expense_allocation',
    ];

    // Optional relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function userAccounting()
    {
        return $this->belongsTo(User::class, 'user_accounting');
    }

    public function userAccountingDec()
    {
        return $this->belongsTo(User::class, 'user_accounting_dec');
    }

    public function userCreateCre()
    {
        return $this->belongsTo(User::class, 'user_create_cre');
    }

    public function userExpenseAllocation()
    {
        return $this->belongsTo(User::class, 'user_expense_allocation');
    }
}