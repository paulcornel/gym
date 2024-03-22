{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check-In</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Corrected the asset() function -->

</head>
<body>
    <div class="container">
        <form action="{{ route('checkins') }}" method="GET"> <!-- Corrected the action and added method -->
            <input type="text" name="member_id" class="search-input" placeholder="Enter Member ID..."> <!-- Corrected the name attribute -->
            <button type="submit" class="search-button">Check In</button>
        </form>
        
        <div>
            @if(isset($checkins) && $checkins->count() > 0)
                <h2>Check-in Information</h2>
                <ul>
                    @foreach($checkins as $checkin)
                        <li>Member ID: {{ $checkin->gym_members_id }}, Check-in Time: {{ $checkin->check_in_datetime }}</li>
                    @endforeach
                </ul>
            @else
                <p>No check-in information available.</p>
            @endif
        </div>
    </div>
</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check-In</title>
    <link rel="stylesheet" href="{{('./css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <form action="{{ route('process') }}">
            <input type="text" id="id"name="query" name="members_code" class="search-input" placeholder="Enter code...">
            <button type="submit" class="search-button">Check In</button>
        </form>
    </div>


@if(isset($members) && $members->count() > 0 && request('query') && request('query'))
<div class="container">
    <h2>Search Results</h2>
    <ul>
        @foreach($members as $member)
            <li>Member Code: {{ $member->members_code }}</li>
            <li>First Name: {{ $member->first_name }}</li>
            <li>Last Name: {{ $member->last_name }}</li>
        @endforeach
    </ul>
</div>

@else
    <p class="text-center bg-danger">No matching records found.</p>
@endif
</body>
</html>