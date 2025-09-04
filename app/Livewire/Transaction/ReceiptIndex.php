<?php

namespace App\Livewire\Transaction;

use Livewire\Component;
use App\Models\Receipt;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Carbon\Carbon;

class ReceiptIndex extends Component
{
    use WithPagination;

    #[Validate('required|date|before_or_equal:to_date')]
    public $from_date;

    #[Validate('required|date|after_or_equal:from_date')]
    public $to_date;

    public $customer_id = '';
    public $perPage = 10;

    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        // Set default dates only if not provided
        $this->from_date ??= now()->startOfMonth()->format('Y-m-d');
        $this->to_date ??= now()->format('Y-m-d');
    }

    public function updatedFromDate($value)
    {
        $this->validateOnly('from_date');

        // If from_date is after to_date, adjust to_date
        if ($this->to_date && $value > $this->to_date) {
            $this->to_date = $value;
        }

        // Reset validation errors for to_date if they exist
        $this->resetErrorBag('to_date');

        // Reset pagination when filters change
        $this->resetPage();
    }

    public function updatedToDate($value)
    {
        $this->validateOnly('to_date');

        // If to_date is before from_date, adjust from_date
        if ($this->from_date && $value < $this->from_date) {
            $this->from_date = $value;
        }

        // Reset validation errors for from_date if they exist
        $this->resetErrorBag('from_date');

        // Reset pagination when filters change
        $this->resetPage();
    }

    public function updatedSiteId()
    {
        // Reset pagination when filter changes
        $this->resetPage();
    }

    public function updatedLaborId()
    {
        // Reset pagination when filter changes
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    #[Computed]
    public function receipts()
    {
        // Only fetch data if dates are valid
        if (!$this->from_date || !$this->to_date) {
            return Receipt::query()->paginate(0); // Return empty paginated result
        }

        // Additional business logic validation
        $fromDate = Carbon::parse($this->from_date);
        $toDate = Carbon::parse($this->to_date);

        // Prevent queries for date ranges longer than 1 year for performance
        if ($fromDate->diffInDays($toDate) > 365) {
            session()->flash('warning', 'Date range cannot exceed 1 year. Showing last 365 days from to_date.');
            $fromDate = $toDate->copy()->subYear();
        }

        return Receipt::query()
            ->with(['customer:id,name']) // Eager load relationships
            ->whereBetween('date', [$fromDate->format('Y-m-d'), $toDate->format('Y-m-d')])
            ->when($this->customer_id, fn($query) => $query->where('customer_id', $this->customer_id))
            ->orderBy('date', 'desc') // Add ordering for better UX
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.transaction.receipt-index');
    }
}
