<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Receipt;
use Livewire\WithPagination;

class ReceiptForm extends Component
{
    use WithPagination;

    public ?Receipt $receipt = null;
    public $date, $customer_id, $amount, $settlement_via, $description;
    public $receipts = [];

    public function mount(?Receipt $receipt = null)
    {
        if ($receipt) {
            $this->receipt = $receipt;
            $this->date = $receipt->date;
            $this->receipts = Receipt::where('date', $this->date)
                ->get()
                ->map(fn($att) => [
                    'customer_id' => $att->customer_id,
                    'description' => $att->description,
                    'amount' => $att->amount,
                    'settlement_via' => $att->receipt_method
                ])->toArray();
        }
    }


    public function addReceipt()
    {
        $this->receipts[] = [
            'customer_id' => '',
            'description' => '',
            'amount' => 0,
            'settlement_via' => '',
        ];
    }

    public function removeReceipt($index)
    {
        unset($this->receipts[$index]);
        $this->receipts = array_values($this->receipts);
    }

    public function save()
    {
        $this->validate([
            'date' => 'required|date',
            'receipts' => 'required|array|min:1',
            'receipts.*.customer_id' => 'required|exists:accounts,id',
            'receipts.*.description' => 'required|string|max:255',
            'receipts.*.amount' => 'required|numeric',
            'receipts.*.settlement_via' => 'in:Cash,Bank/UPI,Other',
        ]);

        if ($this->receipt && ($this->receipt->date != $this->date)) {
            Receipt::where('date', $this->receipt->date)
                ->delete();
        } else {
            Receipt::where('date', $this->date)
                ->delete();
        }

        foreach ($this->receipts as $att) {
            $data = array_merge($att, [
                'date' => $this->date
            ]);
            Receipt::create($data);
        }

        session()->flash('success', 'Receipt updated successfully.');
        return redirect()->route('receipt.index');
    }

    public function render()
    {
        if (empty($this->receipts)) {
            $this->receipts = [
                [
                    'customer_id' => '',
                    'description' => '',
                    'amount' => 0,
                    'receipt_method' => '',
                ]
            ];
        }
        return view('livewire.transaction.receipt-form');
    }
}
