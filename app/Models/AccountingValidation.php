<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingValidation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'accounting_validation',
        'user_accounting_validation',
        'status_accounting_validation',
        'balance',
        'user_balance',
        'status_balance',
        'cre_archiving',
        'user_cre_archiving',
        'status_cre_archiving',
        'pay_suppliers',
        'user_pay_suppliers',
        'status_pay_suppliers',
        'pay_allocation_expenses',
        'user_pay_allocation_expenses',
        'status_pay_allocation_expenses',
        'learned_lesson',
        'user_learned_lesson',
        'status_learned_lesson',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function userAccountingValidation()
    {
        return $this->belongsTo(User::class, 'user_accounting_validation');
    }

    public function userBalance()
    {
        return $this->belongsTo(User::class, 'user_balance');
    }

    public function userCreArchiving()
    {
        return $this->belongsTo(User::class, 'user_cre_archiving');
    }

    public function userPaySuppliers()
    {
        return $this->belongsTo(User::class, 'user_pay_suppliers');
    }

    public function userPayAllocationExpenses()
    {
        return $this->belongsTo(User::class, 'user_pay_allocation_expenses');
    }

    public function userLearnedLesson()
    {
        return $this->belongsTo(User::class, 'user_learned_lesson');
    }
}