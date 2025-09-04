<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Payment;
use Livewire\WithPagination;

class PaymentForm extends Component
{
    use WithPagination;

    public ?Payment $payment = null;
    public $date, $user_id, $payment_unit, $salary_per_unit, $payable, $note;
    public $payments = [];

    public function mount(?Payment $payment = null)
    {
        if ($payment) {
            $this->payment = $payment;
            $this->date = $payment->date;
            $this->payments = Payment::where('date', $this->date)
                ->get()
                ->map(fn($att) => [
                    'user_id' => $att->user_id,
                    'description' => $att->description,
                    'amount' => $att->amount,
                    'settlement_via' => $att->settlement_via
                ])->toArray();
        }
    }


    public function addPayment()
    {
        $this->payments[] = [
            'user_id' => '',
            'description' => '',
            'amount' => 0,
            'settlement_via' => '',
        ];
    }

    public function removePayment($index)
    {
        unset($this->payments[$index]);
        $this->payments = array_values($this->payments);
    }

    public function save()
    {
        $this->validate([
            'date' => 'required|date',
            'payments' => 'required|array|min:1',
            'payments.*.user_id' => 'required|exists:users,id',
            'payments.*.description' => 'required|string|max:255',
            'payments.*.amount' => 'required|numeric|min:1',
            'payments.*.settlement_via' => 'required|in:Cash,Bank/UPI,Other',
        ]);

        if ($this->payment && ($this->payment->date != $this->date)) {
            Payment::where('date', $this->payment->date)
                ->delete();
        } else {
            Payment::where('date', $this->date)
                ->delete();
        }

        foreach ($this->payments as $att) {
            $data = array_merge($att, [
                'date' => $this->date
            ]);
            Payment::create($data);
        }

        session()->flash('success', 'Payment updated successfully.');
        return redirect()->route('payment.index');
    }

    public function render()
    {
        if (empty($this->payments)) {
            $this->payments = [
                [
                    'user_id' => '',
                    'description' => '',
                    'amount' => 0,
                    'settlement_via' => '',
                ]
            ];
        }
        return view('livewire.transaction.payment-form');
    }
}
