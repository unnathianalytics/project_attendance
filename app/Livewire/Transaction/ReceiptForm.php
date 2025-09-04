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
                    'settlement_via' => $att->settlement_via
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
        $this->validate(
            [
                'date' => 'required|date',
                'receipts' => 'required|array|min:1',
                'receipts.*.customer_id' => 'required|exists:accounts,id',
                'receipts.*.description' => 'required|string|max:255',
                'receipts.*.amount' => 'required|numeric|min:1',
                'receipts.*.settlement_via' => 'required|in:Cash,Bank/UPI,Other',
            ],
            [
                'receipts.*.customer_id.required' => 'The customer field is required.',
                'receipts.*.customer_id.exists' => 'The selected customer is invalid.',
                'receipts.*.description.required' => 'The description field is required.',
                'receipts.*.description.string' => 'The description must be a string.',
                'receipts.*.description.max' => 'The description may not be greater than 255 characters.',
                'receipts.*.amount.required' => 'The amount field is required.',
                'receipts.*.amount.numeric' => 'The amount must be a number.',
                'receipts.*.settlement_via.in' => 'The selected settlement method is invalid.',
            ], // custom messages (if you need)
            [   // custom attribute names
                'date' => 'receipt date',
                'receipts.*.customer_id' => 'customer',
                'receipts.*.description' => 'description',
                'receipts.*.amount' => 'amount',
                'receipts.*.settlement_via' => 'settlement method',
            ]
        );

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
                    'settlement_via' => '',
                ]
            ];
        }
        return view('livewire.transaction.receipt-form');
    }
}
