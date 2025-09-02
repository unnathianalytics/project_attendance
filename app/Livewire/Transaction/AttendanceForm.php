<?php

namespace App\Livewire\Transaction;

use App\Models\Labor;
use Livewire\Component;
use App\Models\Attendance;
use Livewire\WithPagination;

class AttendanceForm extends Component
{
    use WithPagination;

    public ?Attendance $attendance = null;
    public $date, $site_id, $user_id, $attendance_unit, $salary_per_unit, $payable, $note;
    public $attendances = [];

    public function mount(?Attendance $attendance = null)
    {
        if ($attendance) {
            $this->attendance = $attendance;
            $this->date = $attendance->date;
            $this->site_id = $attendance->site_id;
            $this->attendances = Attendance::where('date', $this->date)
                ->where('site_id', $this->site_id)
                ->get()
                ->map(fn($att) => [
                    'user_id' => $att->user_id,
                    'salary_per_unit' => $att->salary_per_unit,
                    'attendance_unit' => $att->attendance_unit,
                    'payable' => $att->payable,
                    'note' => $att->note,
                ])->toArray();
        } else {
            $this->attendances = [];
        }
    }

    public function updateUserId($index)
    {
        $labor = Labor::find($this->attendances[$index]['user_id'] ?? null);
        $this->attendances[$index]['salary_per_unit'] = $labor?->basic_salary ?? 0;
        $this->calculatePayable($index);
    }

    public function updatedAttendances($value, $key)
    {
        // $key will be in format like "0.user_id", "0.attendance_unit", etc.
        $parts = explode('.', $key);
        if (count($parts) >= 2) {
            $index = (int)$parts[0];
            $field = $parts[1];

            if ($field === 'user_id') {
                $this->updateUserId($index);
            } elseif (in_array($field, ['attendance_unit', 'salary_per_unit'])) {
                $this->calculatePayable($index);
            }
        }
    }

    public function calculatePayable($index)
    {
        $attendance = $this->attendances[$index] ?? [];
        $perUnit = (float)($attendance['salary_per_unit'] ?? 0);  // Fixed: removed extra [$index]
        $attendanceUnit = (float)($attendance['attendance_unit'] ?? 0);  // Fixed: removed extra [$index]
        $total = $perUnit * $attendanceUnit;
        $this->attendances[$index]['payable'] = $total;
    }

    public function addAttendance()
    {
        $this->attendances[] = [
            'user_id' => '',
            'salary_per_unit' => 0,
            'attendance_unit' => '',
            'payable' => 0,
            'note' => '',
        ];
    }

    public function removeAttendance($index)
    {
        unset($this->attendances[$index]);
        $this->attendances = array_values($this->attendances);
    }

    public function save()
    {
        $this->validate([
            'date' => 'required|date',
            'site_id' => 'required|exists:sites,id',
            'attendances.*.user_id' => 'required|exists:accounts,id',
            'attendances.*.attendance_unit' => 'required|numeric',
            'attendances.*.salary_per_unit' => 'required|numeric',
            'attendances.*.payable' => 'required|numeric',
            'attendances.*.note' => 'nullable|string|max:255',
        ]);

        if ($this->attendance && ($this->attendance->date != $this->date || $this->attendance->site_id != $this->site_id)) {
            Attendance::where('date', $this->attendance->date)
                ->where('site_id', $this->attendance->site_id)
                ->delete();
        } else {
            Attendance::where('date', $this->date)
                ->where('site_id', $this->site_id)
                ->delete();
        }

        foreach ($this->attendances as $att) {
            $data = array_merge($att, [
                'date' => $this->date,
                'site_id' => $this->site_id,
                'payable' => $att['salary_per_unit'] * $att['attendance_unit'],
            ]);
            Attendance::create($data);
        }

        session()->flash('success', 'Attendance updated successfully.');
        return redirect()->route('attendance.index');
    }

    public function render()
    {
        return view('livewire.transaction.attendance-form');
    }
}
