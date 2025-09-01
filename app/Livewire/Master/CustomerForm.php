<?php

namespace App\Livewire\Master;

use Livewire\Component;
use App\Models\Customer;

class CustomerForm extends Component
{
    public ?Customer $customer = null;

    // Form fields (adjust according to your customers table)
    public $name;
    public $email;
    public $op_balance;
    public $cr_dr;

    public function mount(?Customer $customer = null)
    {
        if ($customer) {
            // Editing mode
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
            'cr_dr' => 'required|in:cr,dr',
        ]);

        if ($this->customer) {
            // Update existing
            $this->customer->update($data);
            session()->flash('success', 'Customer updated successfully.');
        } else {
            // Create new
            Customer::create($data);
            session()->flash('success', 'Customer created successfully.');
            $this->reset();
        }

        return redirect()->route('customer.index');
    }
    public function render()
    {
        return view('livewire.master.customer-form');
    }
}
