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
        <form action="{{ route('process') }}" id="">
            <input type="text" id="id"name="query" name="members_code" class="search-input" placeholder="Enter code...">
            <button type="submit" class="search-button">Check In</button>
        </form>
    </div>


    @if(isset($members) && $members->count() > 0 && request('query') && request('query'))
        <div class="container alert alert-success" id="close">
            <h2 style="color: green;">Search Results</h2>
            @foreach($members as $member)
            <div class="table-responsive">
                <table class="table table-bordered alert alert-success">
                    <tbody>
                        <tr>
                            <th scope="row">Member Code</th>
                            <td>{{ $member->members_code }}</td>
                        </tr>
                        <tr>
                            <th scope="row">First Name</th>
                            <td>{{ $member->first_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Last Name</th>
                            <td>{{ $member->last_name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Subscription Status</th>
                            <td>{{ $member->memberships->subscription_status }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Annual Status</th>
                            <td>{{ $member->memberships->annual_status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button type="button" onclick="iclose()" class="btn btn-danger">Close<span id="countdown"></span></button> 
            
            @endforeach
        </div>
    @else
        <p class="text-center bg-danger" style="color: white; padding: 10px;">No matching records found.</p>
    @endif
    
</body>
<script>
    var timeout = 5;

    function close(){
        setTimeout(function() {
            window.location.href = "{{ route('checkins') }}";
        }, 500);
    }

    function iclose(){
        window.location.href = "{{ route('checkins') }}";
    }

    function updateCountdown() {
            document.getElementById('countdown').innerText = ` (${timeout}s)`;
            timeout--;
            if (timeout >= 0) {
                setTimeout(updateCountdown, 1000); 
            } else {
                close();
            }
        }

    updateCountdown();
</script>
</html>