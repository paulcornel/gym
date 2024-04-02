<?php

namespace App\Http\Controllers;

use App\Models\GymMembers;
use App\Models\GymPayment;
use App\Models\GymCheckIns;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // function sa report
    public function reports(Request $request)
    {
        $selectedPeriod = $request->input('period', 'custom');
        $selectedStartMonth = $request->input('start_month');
        $selectedEndMonth = $request->input('end_month');
        $selectedYear = $request->input('year', date('Y'));

        $checkInsQuery = GymCheckIns::query();

        // Apply filters based on the selected period
        if ($selectedPeriod === 'week') {
            // Apply week filter logic
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $checkInsQuery->whereBetween('check_in_datetime', [$startOfWeek, $endOfWeek]);
        } elseif ($selectedPeriod === 'month') {
            // Apply month filter logic
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
            $checkInsQuery->whereBetween('check_in_datetime', [$startOfMonth, $endOfMonth]);
        } elseif ($selectedPeriod === 'quarter') {
            // Apply quarter filter logic
            $startOfQuarter = now()->startOfQuarter();
            $endOfQuarter = now()->endOfQuarter();
            $checkInsQuery->whereBetween('check_in_datetime', [$startOfQuarter, $endOfQuarter]);
        } elseif ($selectedPeriod === 'year') {
            // Apply year filter logic
            $startOfYear = now()->startOfYear();
            $endOfYear = now()->endOfYear();
            $checkInsQuery->whereBetween('check_in_datetime', [$startOfYear, $endOfYear]);
        } elseif ($selectedStartMonth && $selectedEndMonth) {
            // Apply custom date range filter logic
            $endDate = date('Y-m-d', strtotime($selectedEndMonth . ' +1 day'));
            $checkInsQuery->whereBetween('check_in_datetime', [$selectedStartMonth, $endDate]);
        }

        // Count the check-ins
        $checkInCount = $checkInsQuery->count();

        // Get the check-ins list
        $checkIns = $checkInsQuery->get();

        return view('vendor/backpack/ui/report', compact('checkIns', 'checkInCount', 'selectedPeriod', 'selectedStartMonth', 'selectedEndMonth', 'selectedYear'));
    }


    public function members(Request $request)
    {
        $selectedPeriod = $request->input('period', 'custom');
        $selectedStartMonth = $request->input('start_month');
        $selectedEndMonth = $request->input('end_month');
        $selectedYear = $request->input('year', date('Y'));

        $membersQuery = GymMembers::query();

        // Apply filters based on the selected period
        if ($selectedPeriod === 'week') {
            // Apply week filter logic
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $membersQuery->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        } elseif ($selectedPeriod === 'month') {
            // Apply month filter logic
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
            $membersQuery->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        } elseif ($selectedPeriod === 'quarter') {
            // Apply quarter filter logic
            $startOfQuarter = now()->startOfQuarter();
            $endOfQuarter = now()->endOfQuarter();
            $membersQuery->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]);
        } elseif ($selectedPeriod === 'year') {
            // Apply year filter logic
            $startOfYear = now()->startOfYear();
            $endOfYear = now()->endOfYear();
            $membersQuery->whereBetween('created_at', [$startOfYear, $endOfYear]);
        } elseif ($selectedStartMonth && $selectedEndMonth) {
            // Apply custom date range filter logic
            $endDate = date('Y-m-d', strtotime($selectedEndMonth . ' +1 day'));
            $membersQuery->whereBetween('created_at', [$selectedStartMonth, $endDate]);
        }

        // Count the members
        $memberCount = $membersQuery->count();

        // Get the members list
        $members = $membersQuery->get();

        return view('vendor/backpack/ui/member', compact('members', 'memberCount', 'selectedPeriod', 'selectedStartMonth', 'selectedEndMonth', 'selectedYear'));
    }

    public function payments(Request $request)
    {
        $selectedPeriod = $request->input('period', 'custom');
        $selectedStartMonth = $request->input('start_month');
        $selectedEndMonth = $request->input('end_month');
        $selectedYear = $request->input('year', date('Y'));

        $paymentsQuery = GymPayment::query();

        // Apply filters based on the selected period
        if ($selectedPeriod === 'week') {
            // Apply week filter logic
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $paymentsQuery->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        } elseif ($selectedPeriod === 'month') {
            // Apply month filter logic
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
            $paymentsQuery->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        } elseif ($selectedPeriod === 'quarter') {
            // Apply quarter filter logic
            $startOfQuarter = now()->startOfQuarter();
            $endOfQuarter = now()->endOfQuarter();
            $paymentsQuery->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]);
        } elseif ($selectedPeriod === 'year') {
            // Apply year filter logic
            $startOfYear = now()->startOfYear();
            $endOfYear = now()->endOfYear();
            $paymentsQuery->whereBetween('created_at', [$startOfYear, $endOfYear]);
        } elseif ($selectedStartMonth && $selectedEndMonth) {
            // Apply custom date range filter logic
            $endDate = date('Y-m-d', strtotime($selectedEndMonth . ' +1 day'));
            $paymentsQuery->whereBetween('created_at', [$selectedStartMonth, $endDate]);
        }

        // Count the payments
        $paymentCount = $paymentsQuery->count();

        // Get the payments list
        $payments = $paymentsQuery->get();

        return view('vendor/backpack/ui/payment', compact('payments', 'paymentCount', 'selectedPeriod', 'selectedStartMonth', 'selectedEndMonth', 'selectedYear'));
    }

    public function cashflow(Request $request)
    {
        $selectedPeriod = $request->input('period', 'custom');
        $selectedStartMonth = $request->input('start_month');
        $selectedEndMonth = $request->input('end_month');
        $selectedYear = $request->input('year', date('Y'));

        $paymentsQuery = GymPayment::query();

        // Apply filters based on the selected period
        if ($selectedPeriod === 'week') {
            // Apply week filter logic
            $startOfWeek = now()->startOfWeek();
            $endOfWeek = now()->endOfWeek();
            $paymentsQuery->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        } elseif ($selectedPeriod === 'month') {
            // Apply month filter logic
            $startOfMonth = now()->startOfMonth();
            $endOfMonth = now()->endOfMonth();
            $paymentsQuery->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        } elseif ($selectedPeriod === 'quarter') {
            // Apply quarter filter logic
            $startOfQuarter = now()->startOfQuarter();
            $endOfQuarter = now()->endOfQuarter();
            $paymentsQuery->whereBetween('created_at', [$startOfQuarter, $endOfQuarter]);
        } elseif ($selectedPeriod === 'year') {
            // Apply year filter logic
            $startOfYear = now()->startOfYear();
            $endOfYear = now()->endOfYear();
            $paymentsQuery->whereBetween('created_at', [$startOfYear, $endOfYear]);
        } elseif ($selectedStartMonth && $selectedEndMonth) {
            // Apply custom date range filter logic
            $endDate = date('Y-m-d', strtotime($selectedEndMonth . ' +1 day'));
            $paymentsQuery->whereBetween('created_at', [$selectedStartMonth, $endDate]);
        }

        // Apply payment type filter
        $paymentType = $request->input('payment_type');
        if ($paymentType) {
            $paymentsQuery->where('type', $paymentType);
        }

        // Execute the query
        $payments = $paymentsQuery->paginate(10);
        $totalAmount = $payments->sum('amount');

        return view('vendor/backpack/ui/cashflow', compact('payments', 'totalAmount', 'selectedPeriod', 'selectedStartMonth', 'selectedEndMonth', 'selectedYear'));
    }
}

