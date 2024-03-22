resources/views/report.blade.php

@extends('backpack::layout')

@section('content')
    <h1>Gym Check-ins Report</h1>

    @if ($checkIns->isEmpty())
        <p>No gym check-ins found.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Check-in ID</th>
                    <th>Member ID</th>
                    <th>Check-in Datetime</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkIns as $checkIn)
                    <tr>
                        <td>{{ $checkIn->id }}</td>
                        <td>{{ $checkIn->gym_members_id }}</td>
                        <td>{{ $checkIn->check_in_datetime }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
