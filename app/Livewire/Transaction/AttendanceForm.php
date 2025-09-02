<?php

namespace App\Livewire\Master;


use Livewire\Component;
use App\Models\Attendance;

class AttendanceForm extends Component
{
    public ?Attendance $attendance = null;

    public $name, $account_id, $address, $longitude, $latitude, $status;

    public function mount(?Attendance $attendance = null)
    {
        if ($attendance) {
            $this->attendance = $attendance;
            $this->fill($attendance->only(['name', 'account_id', 'address', 'longitude', 'latitude', 'status']));
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

        $attendance = Attendance::updateOrCreate(
            ['id' => $this->attendance?->id],
            $data
        );
        session()->flash('success', 'Attendance updated successfully.');
        return redirect()->route('attendance.index');
    }
    public function render()
    {
        return view('livewire.master.attendance-form');
    }
}
