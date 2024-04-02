<!-- cashflow.blade.php -->
@extends(backpack_view('blank'))

@section('content')
    <h1>Gym Cashflow Report</h1>

    <form action="{{ route('cashFlow') }}" method="GET">
        <div class="row align-items-end">
            <!-- Filter by period dropdown -->
            <div class="col-md-3 mb-3">
                <label for="period" class="form-label">Total Income for:</label>
                <select class="form-select" id="period" name="period">
                    <option value="">Custom</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="quarter">Quarter</option>
                    <option value="year">Year</option>
                    <option value="Cash">Cash</option>
                    <option value="GCash">Gcash</option>
                    <!-- Add other filter options as needed -->
                </select>
            </div>
        
            <!-- Start Month input -->
            <div class="col-md-2 mb-3">
                <label for="start_month" class="form-label">Start Date:</label>
                <input type="date" class="form-control" id="start_month" name="start_month">
            </div>
        
            <!-- End Month input -->
            <div class="col-md-2 mb-3">
                <label for="end_month" class="form-label">End Date:</label>
                <input type="date" class="form-control" id="end_month" name="end_month">
            </div>
        
            <!-- Filter button -->
            <div class="col-md-2 mb-3">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <!-- Table to display cash flow data -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Member Name</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Transaction Code</th>
                    <th>Payment For</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->gym_members->fullname }}</td>
                    <td>{{ $payment->amount }}</td>
                    <td>{{ $payment->type }}</td>
                    <td>{{ $payment->transaction_code }}</td>
                    <td>{{ $payment->payment_for }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination links -->
    {{ $payments->links() }}
    
    <!-- Display total amount -->
    <div>Total Amount: {{ $totalAmount }}</div>

    <script>
        // JavaScript code to enable/disable start and end date inputs based on selected period
        document.getElementById('period').addEventListener('change', function() {
            var startMonthInput = document.getElementById('start_month');
            var endMonthInput = document.getElementById('end_month');
            var selectedPeriod = this.value;
            
            if (selectedPeriod === 'week' || selectedPeriod === 'month' || selectedPeriod === 'quarter' || selectedPeriod === 'year') {
                startMonthInput.disabled = true;
                endMonthInput.disabled = true;
            } else {
                startMonthInput.disabled = false;
                endMonthInput.disabled = false;
            }
        });
    </script>
@endsection