@extends(backpack_view('blank'))

@section('content')
    <h1>Gym Check-ins Report</h1>

    <!-- Display the count of check-ins -->

    <form action="{{ route('reports') }}" method="GET">
    <div class="row align-items-end">
        <!-- Filter by period dropdown -->
        <div class="col-md-3 mb-3">
            <label for="period" class="form-label">Filter type:</label>
            <select class="form-select" id="period" name="period">
                <option value="">Custom</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
                <option value="quarter">Quarter</option>
                <option value="year">Year</option>
                <!-- Add other filter options as needed -->
            </select>
        </div>

        <!-- Start Month input -->
        <div class="col-md-3 mb-3">
            <label for="start_month" class="form-label">Start Date:</label>
            <input type="date" class="form-control" id="start_month" name="start_month">
        </div>

        <!-- End Month input -->
        <div class="col-md-3 mb-3">
            <label for="end_month" class="form-label">End Date:</label>
            <input type="date" class="form-control" id="end_month" name="end_month">
        </div>

        <!-- Filter button -->
        <div class="col-md-3 mb-3">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>


    @if ($checkIns->isEmpty())
        <p>No gym check-ins found.</p>
    @else
   
        <table class="table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Check-in Datetime</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkIns as $checkIn)
                    <tr>
                        <td>{{ $checkIn->gym_members->fullname }}</td>
                        <td>{{ $checkIn->check_in_datetime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
     
    @endif

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
