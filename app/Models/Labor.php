<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Labor extends User
{
    protected $table = 'users'; // Use the same table as User

    protected static function booted()
    {
        parent::booted();

        // Apply global scope to only show users with 'employee' role
        static::addGlobalScope('employee_only', function (Builder $builder) {
            $builder->whereHas('roles', function ($query) {
                $query->where('name', 'employee')->where('guard_name', 'web');
            });
        });

        // Automatically assign 'employee' role when creating
        static::creating(function ($labor) {
            if (Role::where('name', 'employee')->where('guard_name', '')->exists()) {
                $labor->assignRole('employee', ''); // Assign the 'employee' role with empty guard
            } else {
                Log::warning('Employee role with empty guard not found during Labor creation.');
            }
        });
    }

    // Fetch all labors (users with 'employee' role and empty guard)
    public static function labors()
    {
        return self::get(); // Now this will automatically filter by the global scope
    }

    // Alternative method without global scope (if you prefer not to use global scope)
    public static function laborsByRole()
    {
        return self::whereHas('roles', function ($query) {
            $query->where('name', 'employee')->where('guard_name', 'web');
        })->get();
    }

    // If you need to bypass the global scope sometimes
    public static function allLaborsIncludingWithoutRole()
    {
        return self::withoutGlobalScope('employee_only')->get();
    }
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    //Claude.ai generated code

    /**
     * Get Labor's Closing Balance using pure Eloquent
     * Calculated from specified date or from 01.01.1900
     * Closing balance as on $toDate
     * $dayMinusOne is to get one day less to $toDate which can be used as OP Bal
     *
     * @param string $toDate
     * @param bool $dayMinusOne
     * @param string $fromDate
     * @return float
     */
    public function getClosingBalance(string $toDate, bool $dayMinusOne = true, string $fromDate = '1900-01-01'): float
    {
        if ($dayMinusOne) {
            $toDate = Carbon::parse($toDate)->subDay()->format('Y-m-d');
        }

        // Get total earnings from attendances
        $totalEarnings = $this->attendances()
            ->whereBetween('date', [$fromDate, $toDate])
            ->sum('payable');

        // Get total payments
        $totalPayments = $this->payments()
            ->whereBetween('date', [$fromDate, $toDate])
            ->sum('amount');

        return $totalEarnings - $totalPayments;
    }

    /**
     * Get account closing balance as a static method
     */
    public static function getAccountClosingBalance(int $laborId, string $toDate, bool $dayMinusOne = true, string $fromDate = '1900-01-01'): float
    {
        $labor = static::find($laborId);

        if (!$labor) {
            return 0;
        }

        return $labor->getClosingBalance($toDate, $dayMinusOne, $fromDate);
    }

    /**
     * Get current balance (as of today)
     */
    public function getCurrentBalance(): float
    {
        return $this->getClosingBalance(now()->format('Y-m-d'), false);
    }

    /**
     * Get opening balance for a specific date
     */
    public function getOpeningBalance(string $date): float
    {
        return $this->getClosingBalance($date, true);
    }

    /**
     * Get balance as of a specific date (including that date)
     */
    public function getBalanceAsOf(string $date): float
    {
        return $this->getClosingBalance($date, false);
    }

    /**
     * Scope for attendances within date range
     */
    public function attendancesInRange(string $fromDate, string $toDate): HasMany
    {
        return $this->attendances()->whereBetween('date', [$fromDate, $toDate]);
    }

    /**
     * Scope for payments within date range
     */
    public function paymentsInRange(string $fromDate, string $toDate): HasMany
    {
        return $this->payments()->whereBetween('date', [$fromDate, $toDate]);
    }

    /**
     * Get detailed account statement using Eloquent Collections
     */
    public function getAccountStatement(string $fromDate, string $toDate): array
    {
        $openingBalance = $this->getOpeningBalance($fromDate);

        // Get attendances as credits
        $attendanceTransactions = $this->attendancesInRange($fromDate, $toDate)
            ->get()
            ->map(function ($attendance) {
                return [
                    'type' => 'attendance',
                    'date' => $attendance->date,
                    'credit' => (float) $attendance->payable,
                    'debit' => 0.00,
                    'note' => $attendance->note,
                    'attendance_unit' => $attendance->attendance_unit,
                    'salary_per_unit' => $attendance->salary_per_unit,
                    'site_id' => $attendance->site_id,
                ];
            });

        // Get payments as debits
        $paymentTransactions = $this->paymentsInRange($fromDate, $toDate)
            ->get()
            ->map(function ($payment) {
                return [
                    'type' => 'payment',
                    'date' => $payment->date,
                    'credit' => 0.00,
                    'debit' => (float) $payment->amount,
                    'note' => $payment->notes,
                    'payment_number' => $payment->number,
                    'payment_mode' => $payment->mode,
                    'attendance_unit' => null,
                    'salary_per_unit' => null,
                    'site_id' => null,
                ];
            });

        // Merge and sort transactions
        $allTransactions = $attendanceTransactions
            ->merge($paymentTransactions)
            ->sortBy([
                ['date', 'asc'],
                ['type', 'asc'] // attendance first, then payment for same date
            ])
            ->values();

        // Calculate running balance
        $runningBalance = $openingBalance;
        $statement = [];

        foreach ($allTransactions as $transaction) {
            $runningBalance += ($transaction['credit'] - $transaction['debit']);
            $statement[] = array_merge($transaction, [
                'balance' => $runningBalance
            ]);
        }

        return [
            'opening_balance' => $openingBalance,
            'closing_balance' => $runningBalance,
            'total_earnings' => $attendanceTransactions->sum('credit'),
            'total_payments' => $paymentTransactions->sum('debit'),
            'transactions' => $statement
        ];
    }

    /**
     * Get monthly summary using Eloquent
     */
    public function getMonthlySummary(int $year, int $month): array
    {
        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = $startDate->copy()->endOfMonth();

        $attendances = $this->attendances()
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get();

        $payments = $this->payments()
            ->whereBetween('date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->get();

        return [
            'month' => $startDate->format('F Y'),
            'opening_balance' => $this->getOpeningBalance($startDate->format('Y-m-d')),
            'closing_balance' => $this->getBalanceAsOf($endDate->format('Y-m-d')),
            'total_earnings' => $attendances->sum('payable'),
            'total_payments' => $payments->sum('amount'),
            'total_working_days' => $attendances->count(),
            'total_attendance_units' => $attendances->sum('attendance_unit'),
            'average_daily_rate' => $attendances->avg('salary_per_unit') ?? 0,
            'attendances' => $attendances,
            'payments' => $payments,
        ];
    }

    /**
     * Check if labor has outstanding balance
     */
    public function hasOutstandingBalance(): bool
    {
        return $this->getCurrentBalance() > 0;
    }

    /**
     * Get outstanding amount
     */
    public function getOutstandingAmount(): float
    {
        $balance = $this->getCurrentBalance();
        return $balance > 0 ? $balance : 0;
    }

    /**
     * Get advance amount (if negative balance)
     */
    public function getAdvanceAmount(): float
    {
        $balance = $this->getCurrentBalance();
        return $balance < 0 ? abs($balance) : 0;
    }

    /**
     * Get balance status
     */
    public function getBalanceStatus(): array
    {
        $balance = $this->getCurrentBalance();

        return [
            'balance' => $balance,
            'status' => $balance > 0 ? 'outstanding' : ($balance < 0 ? 'advance' : 'settled'),
            'outstanding' => $balance > 0 ? $balance : 0,
            'advance' => $balance < 0 ? abs($balance) : 0,
        ];
    }

    /**
     * Scope for labors with outstanding balance
     */
    public function scopeWithOutstandingBalance(Builder $query): Builder
    {
        return $query->whereHas('attendances', function ($q) {
            $q->havingRaw('SUM(payable) > COALESCE((SELECT SUM(amount) FROM payments WHERE user_id = users.id), 0)');
        });
    }

    /**
     * Get recent transactions (last N transactions)
     */
    public function getRecentTransactions(int $limit = 10): array
    {
        $recentAttendances = $this->attendances()
            ->latest('date')
            ->latest('id')
            ->take($limit)
            ->get()
            ->map(function ($attendance) {
                return [
                    'type' => 'attendance',
                    'date' => $attendance->date,
                    'amount' => (float) $attendance->payable,
                    'flow' => 'credit',
                    'description' => "Work - {$attendance->attendance_unit} units @ ₹{$attendance->salary_per_unit}",
                    'note' => $attendance->note,
                ];
            });

        $recentPayments = $this->payments()
            ->latest('date')
            ->latest('id')
            ->take($limit)
            ->get()
            ->map(function ($payment) {
                return [
                    'type' => 'payment',
                    'date' => $payment->date,
                    'amount' => (float) $payment->amount,
                    'flow' => 'debit',
                    'description' => "Payment via {$payment->mode}",
                    'note' => $payment->notes,
                ];
            });

        return $recentAttendances
            ->merge($recentPayments)
            ->sortByDesc('date')
            ->take($limit)
            ->values()
            ->toArray();
    }

    //Claude.ai generated code


}
