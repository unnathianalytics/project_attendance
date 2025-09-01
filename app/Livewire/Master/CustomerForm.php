<?php

namespace App\Livewire\Master;

use Log;
use Livewire\Component;
use App\Models\Customer;

class CustomerForm extends Component
{
    public ?Customer $customer = null;

    public $name;
    public $email;
    public $op_balance;
    public $cr_dr;

    public function mount(?Customer $customer = null)
    {
        if ($customer) {
            $this->customer = $customer;
            $this->fill($customer->only(['name', 'email', 'op_balance', 'cr_dr']));
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'op_balance' => 'required|numeric',
            'cr_dr' => 'required|in:Cr,Dr',
        ]);


        $customer = Customer::updateOrCreate(
            ['id' => $this->customer?->id],
            $data
        );
        session()->flash('success', 'Customer updated successfully.');
        return redirect()->route('customer.index');
    }
    public function render()
    {
        return view('livewire.master.customer-form');
    }
}
