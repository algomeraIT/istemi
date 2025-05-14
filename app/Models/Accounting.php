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
        'name_phase',
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

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = ['accounting', 'accounting_dec', 'create_cre', 'expense_allocation'];

        $labels = [
            'accounting_dec' => 'Predisporre la contabilità delle attività eseguite ed inviarla al DEC',
            'create_cre' => 'Creazione CRE',
            'expense_allocation' => 'Riparto spese',
        ];

        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'accounting' => in_array('accounting', $selected),
                    'user_accounting' => $formData['user_accounting'] ?? null,
                    'status_accounting' => false,

                    'accounting_dec' => in_array('accounting_dec', $selected),
                    'user_accounting_dec' => $formData['user_accounting_dec'] ?? null,
                    'status_accounting_dec' => false,

                    'create_cre' => in_array('create_cre', $selected),
                    'user_create_cre' => $formData['user_create_cre'] ?? null,
                    'status_create_cre' => false,

                    'expense_allocation' => in_array('expense_allocation', $selected),
                    'user_expense_allocation' => $formData['user_expense_allocation'] ?? null,
                    'status_expense_allocation' => false,
                ]);
            }
        }
    }
}
