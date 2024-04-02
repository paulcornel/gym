{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-user" :link="backpack_url('user')" />
{{-- <x-backpack::menu-item title="Gym admin users" icon="la la-question" :link="backpack_url('gym-admin-users')" /> --}}
<x-backpack::menu-item title="Gym members" icon="la la-users" :link="backpack_url('gym-members')" />
{{-- <x-backpack::menu-item title="Gym payments" icon="la la-dollar" :link="backpack_url('gym-payment')" /> --}}
{{-- <x-backpack::menu-item title="Checkins" icon="la la-question" :link="backpack_url('gym-check-ins')" /> --}}
<li class="nav-item dropdown">
    <a id="navbarDropdownDashboard" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="la la-chart-bar"></i> Reports
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownDashboard">
        <a class="dropdown-item" href="{{ route('reports') }}"> <i class="la la-user-check"></i> Daily Checkins</a>
        <a class="dropdown-item" href="{{ route('members') }}"> <i class="la la-users"></i> Members</a>
        <a class="dropdown-item" href="{{ route('payments') }}"> <i class="la la-dollar"></i> Payments</a>
        <a class="dropdown-item" href="{{ route('cashFlow') }}"> <i class="la la-money-bill-wave"></i> Cash Flow</a>
    </div>
</li>
{{-- <x-backpack::menu-item title="Memberships" icon="la la-question" :link="backpack_url('memberships')" /> --}}