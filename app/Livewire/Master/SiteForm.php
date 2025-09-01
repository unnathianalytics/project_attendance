<?php

namespace App\Livewire\Master;


use Livewire\Component;
use App\Models\Site;

class SiteForm extends Component
{
    public ?Site $site = null;

    public $name;


    public function mount(?Site $site = null)
    {
        if ($site) {
            $this->site = $site;
            $this->fill($site->only(['name']));
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


        $site = Site::updateOrCreate(
            ['id' => $this->site?->id],
            $data
        );
        session()->flash('success', 'Site updated successfully.');
        return redirect()->route('site.index');
    }
    public function render()
    {
        return view('livewire.master.site-form');
    }
}
