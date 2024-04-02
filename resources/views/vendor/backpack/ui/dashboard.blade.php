@extends(backpack_view('blank'))

@php
    // Calculate total cash
    $totalCash = \App\Models\GymPayment::where('type', 'cash')->sum('amount');

    // Calculate total gcash
    $totalGcash = \App\Models\GymPayment::where('type', 'gcash')->sum('amount');

    // Get the count of all members
    $totalMemberCount = \App\Models\GymMembers::count();

    // Define maximum count for members
    $maxMemberCount = 500; // For example, set a maximum count

    // Check if total member count is zero to avoid division by zero
    $memberProgress = $totalMemberCount != 0 ? ($totalMemberCount / $maxMemberCount) * 100 : 0;

    $totalMemberWidget = [
        'type'          => 'progress',
        'class'         => 'card text-white bg-warning mb-2 me-1',
        'value'         => $totalMemberCount,
        'description'   => 'Registered Members',
        'progress'      => $memberProgress,
        'hint'          => 'Total Members',
    ];

    // Get the count of active members from this month only
    $activeMemberCountThisMonth = \App\Models\Memberships::where('subscription_status', 'active')
        ->whereMonth( 'subscription_start_date', now()->month) // Filter by current month
        ->whereYear('subscription_end_date', now()->year)   // Filter by current year
        ->count();

    // Define progress percentage for active members from this month only
    $activeMemberProgressThisMonth = $totalMemberCount != 0 ? ($activeMemberCountThisMonth / $totalMemberCount) * 100 : 0;

    // Define progress widget variables for active members from this month only
    $activeMemberWidgetThisMonth = [
        'type'          => 'progress',
        'class'         => 'card text-white bg-info mb-2 me-1',
        'value'         => $activeMemberCountThisMonth,
        'description'   => 'Active Members (This Month)',
        'progress'      => $activeMemberProgressThisMonth,
        'hint'          => 'Total Active Members (This Month)',
    ];

    // Get the count of expired members
    $expiredMemberCount = \App\Models\Memberships::where('subscription_status', 'expired')->count();

    // Calculate the progress percentage for expired members
    $expiredMemberProgress = $totalMemberCount != 0 ? ($expiredMemberCount / $totalMemberCount) * 100 : 0;

    // Define progress widget variables for expired members
    $expiredMemberWidget = [
        'type'          => 'progress',
        'class'         => 'card text-white bg-danger mb-2 me-1',
        'value'         => $expiredMemberCount,
        'description'   => 'Expired Membership',
        'progress'      => $expiredMemberProgress, // Set the progress percentage
        'hint'          => 'Total Expired Members',
    ];
@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            <div class="d-flex justify-content-center">
                <!-- Total Members Box -->
                <div class="{{ $totalMemberWidget['class'] }} col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $totalMemberWidget['description'] }}</h5>
                        <p class="card-text">{{ $totalMemberWidget['value'] }}</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $totalMemberWidget['progress'] }}%;" aria-valuenow="{{ $totalMemberWidget['progress'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="card-text">{{ $totalMemberWidget['hint'] }}</p>
                    </div>
                </div>

                <!-- Active Members Box (This Month) -->
                <div class="{{ $activeMemberWidgetThisMonth['class'] }} col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $activeMemberWidgetThisMonth['description'] }}</h5>
                        <p class="card-text">{{ $activeMemberWidgetThisMonth['value'] }}</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $activeMemberWidgetThisMonth['progress'] }}%;" aria-valuenow="{{ $activeMemberWidgetThisMonth['progress'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="card-text">{{ $activeMemberWidgetThisMonth['hint'] }}</p>
                    </div>
                </div>

                <!-- Expired Members Box -->
                <div class="{{ $expiredMemberWidget['class'] }} col-lg-4 col-md-6 col-sm-6 mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $expiredMemberWidget['description'] }}</h5>
                        <p class="card-text">{{ $expiredMemberWidget['value'] }}</p>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $expiredMemberWidget['progress'] }}%;" aria-valuenow="{{ $expiredMemberWidget['progress'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="card-text">{{ $expiredMemberWidget['hint'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Bar Chart (Dynamic) -->
        <div class="col-md-12">
            <canvas id="barChart"></canvas>
        </div>
    </div>
</div>
@endsection

@push('after_scripts')
    <!-- Add any additional scripts here if needed -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var totalCash = {{ $totalCash }};
        var totalGcash = {{ $totalGcash }};

        // Bar Chart Data
        var ctxB = document.getElementById("barChart").getContext('2d');
        var myBarChart = new Chart(ctxB, {
            type: 'bar',
            data: {
                labels: ["Total Cash Income", "Total Gcash Income"],
                datasets: [{
                    label: 'Total Cash Income',
                    data: [totalCash, 0], // Add 0 for Total Gcash as default
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Total Gcash Income',
                    data: [0, totalGcash], // Add 0 for Total Cash as default
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endpush
