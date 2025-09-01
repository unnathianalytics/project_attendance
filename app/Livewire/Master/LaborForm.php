<?php

namespace App\Livewire\Master;

use Log;
use App\Models\Labor;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LaborForm extends Component
{
    public ?Labor $labor = null;

    public $name;
    public $email;
    public $op_balance;
    public $cr_dr;
    public $password;
    public $mobile;
    public $basic_salary;

    public function mount(?Labor $labor = null)
    {
        if ($labor) {
            $this->labor = $labor;
            $this->fill($labor->only(['name', 'email', 'mobile', 'basic_salary', 'op_balance', 'cr_dr']));
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name'    => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->labor?->id),
            ],
            'password' => ($this->labor?->id ? 'nullable' : 'required') . '|min:5|max:10',
            'op_balance' => 'required|numeric',
            'cr_dr' => 'required|in:Cr,Dr',
            'mobile' => 'required|numeric|max:9999999999',
            'basic_salary' => 'required|numeric',
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['company_id'] = Auth::user()->company_id;

        $labor = Labor::updateOrCreate(
            ['id' => $this->labor?->id],
            $data
        );
        $labor->assignRole(roles: ['employee']);
        session()->flash('success', 'Labor updated successfully.');
        return redirect()->route('labor.index');
    }
    public function render()
    {
        return view('livewire.master.labor-form');
    }
}
