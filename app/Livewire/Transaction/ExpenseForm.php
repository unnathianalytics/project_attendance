<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Expense;
use Livewire\WithPagination;

class ExpenseForm extends Component
{
    use WithPagination;

    public ?Expense $expense = null;
    public $date, $site_id, $expense_unit, $salary_per_unit, $payable, $note;
    public $expenses = [];

    public function mount(?Expense $expense = null)
    {
        if ($expense) {
            $this->expense = $expense;
            $this->date = $expense->date;
            $this->expenses = Expense::where('date', $this->date)
                ->get()
                ->map(fn($att) => [
                    'site_id' => $att->site_id,
                    'description' => $att->description,
                    'amount' => $att->amount,
                    'settlement_via' => $att->settlement_via
                ])->toArray();
        }
    }


    public function addExpense()
    {
        $this->expenses[] = [
            'site_id' => '',
            'description' => '',
            'amount' => 0,
            'settlement_via' => '',
        ];
    }

    public function removeExpense($index)
    {
        unset($this->expenses[$index]);
        $this->expenses = array_values($this->expenses);
    }

    public function save()
    {
        $this->validate([
            'date' => 'required|date',
            'expenses' => 'required|array|min:1',
            'expenses.*.site_id' => 'required|exists:sites,id',
            'expenses.*.description' => 'required|string|max:255',
            'expenses.*.amount' => 'required|numeric|min:1',
            'expenses.*.settlement_via' => 'required|in:Cash,Bank/UPI,Other',
        ]);

        if ($this->expense && ($this->expense->date != $this->date)) {
            Expense::where('date', $this->expense->date)
                ->delete();
        } else {
            Expense::where('date', $this->date)
                ->delete();
        }

        foreach ($this->expenses as $att) {
            $data = array_merge($att, [
                'date' => $this->date
            ]);
            Expense::create($data);
        }

        session()->flash('success', 'Expense updated successfully.');
        return redirect()->route('expense.index');
    }

    public function render()
    {
        if (empty($this->expenses)) {
            $this->expenses = [
                [
                    'site_id' => '',
                    'description' => '',
                    'amount' => 0,
                    'settlement_via' => '',
                ]
            ];
        }
        return view('livewire.transaction.expense-form');
    }
}
