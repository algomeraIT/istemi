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
        'user',
        'status',
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

    public static function createFromPhases(array $formData, array $selected, int $projectId): void
    {
        $fields = [
            'accounting_validation',
            'balance',
            'cre_archiving',
            'pay_suppliers',
            'pay_allocation_expenses',
            'learned_lesson',
        ];

        $labels = [
            'balance' => 'Saldo',
            'cre_archiving' => 'Archiviazione CRE',
            'pay_suppliers' => 'Pagamento fornitori',
            'pay_allocation_expenses' => 'Pagamento riparto spese',
            'learned_lesson' => 'Lezioni apprese',
        ];

        foreach ($fields as $phase) {
            if (in_array($phase, $selected)) {
                self::create([
                    'client_id' => $formData['id_client'],
                    'project_id' => $projectId,
                    'user' => auth()->user()->name . ' ' . auth()->user()->last_name,
                    'status' => 'In attesa',
                    'name_phase' => $labels[$phase] ?? $phase,

                    'accounting_validation' => in_array('accounting_validation', $selected),
                    'user_accounting_validation' => $formData['user_accounting_validation'] ?? null,
                    'status_accounting_validation' => false,

                    'balance' => in_array('balance', $selected),
                    'user_balance' => $formData['user_balance'] ?? null,
                    'status_balance' => false,

                    'cre_archiving' => in_array('cre_archiving', $selected),
                    'user_cre_archiving' => $formData['user_cre_archiving'] ?? null,
                    'status_cre_archiving' => false,

                    'pay_suppliers' => in_array('pay_suppliers', $selected),
                    'user_pay_suppliers' => $formData['user_pay_suppliers'] ?? null,
                    'status_pay_suppliers' => false,

                    'pay_allocation_expenses' => in_array('pay_allocation_expenses', $selected),
                    'user_pay_allocation_expenses' => $formData['user_pay_allocation_expenses'] ?? null,
                    'status_pay_allocation_expenses' => false,

                    'learned_lesson' => in_array('learned_lesson', $selected),
                    'user_learned_lesson' => $formData['user_learned_lesson'] ?? null,
                    'status_learned_lesson' => false,
                ]);
            }
        }
    }
}
