<?php

namespace App\Livewire\Master;


use Livewire\Component;
use App\Models\Site;

class SiteForm extends Component
{
    public ?Site $site = null;

    public $name, $account_id, $address, $longitude, $latitude, $status;

    public function mount(?Site $site = null)
    {
        if ($site) {
            $this->site = $site;
            $this->fill($site->only(['name', 'account_id', 'address', 'longitude', 'latitude', 'status']));
        }
    }

    public function save()
    {
        $data = $this->validate([
            'name'    => 'required|string|max:255',
            'account_id' => 'required|exists:accounts,id',
            'address' => 'required|string|max:255',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'status' => 'required|in:in_progress,pending_payment,completed',
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
