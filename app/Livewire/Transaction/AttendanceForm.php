<?php

namespace App\Livewire\Transaction;


use App\Models\Labor;
use Livewire\Component;
use App\Models\Attendance;

class AttendanceForm extends Component
{
    public ?Attendance $attendance = null;

    public $date, $site_id, $user_id, $attendance_unit, $salary_per_unit, $payable, $note;

    public function mount(?Attendance $attendance = null)
    {
        if ($attendance) {
            $this->attendance = $attendance;
            $this->fill($attendance->only(['date', 'site_id', 'user_id', 'attendance_unit', 'salary_per_unit', 'payable', 'note']));
        }
    }

    public function updatedUserId($value)
    {
        $labor = Labor::find($value);
        $this->salary_per_unit = $labor?->basic_salary;
        $this->calculatePayable();
    }
    public function updatedAttendanceUnit($value)
    {
        $this->calculatePayable();
    }

    public function calculatePayable()
    {
        $perUnit = $this->salary_per_unit ?? 0;
        $attendanceUnit = $this->attendance_unit ?? 0;
        $this->payable = $perUnit * $attendanceUnit;
    }

    public function save()
    {
        $data = $this->validate([
            'date'    => 'required|date',
            'site_id' => 'required|exists:sites,id',
            'user_id' => 'required|exists:accounts,id',
            'attendance_unit' => 'required|numeric',
            'salary_per_unit' => 'required|numeric',
            'payable' => 'required|numeric',
            'note' => 'nullable|string|max:255',
        ]);

        $data['payable'] = $data['salary_per_unit'] * $data['attendance_unit'];

        $attendance = Attendance::updateOrCreate(
            ['id' => $this->attendance?->id],
            $data
        );
        $this->reset();
        session()->flash('success', 'Attendance updated successfully.');
        return redirect()->route('attendance.index');
    }
    public function render()
    {
        return view('livewire.transaction.attendance-form');
    }
}
