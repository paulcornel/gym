{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />
{{-- <x-backpack::menu-item title="Gym admin users" icon="la la-question" :link="backpack_url('gym-admin-users')" /> --}}
<x-backpack::menu-item title="Gym members" icon="la la-question" :link="backpack_url('gym-members')" />
<x-backpack::menu-item title="Gym payments" icon="la la-question" :link="backpack_url('gym-payment')" />
<x-backpack::menu-item title="Checkins" icon="la la-question" :link="backpack_url('gym-check-ins')" />
{{-- <x-backpack::menu-item title="Memberships" icon="la la-question" :link="backpack_url('memberships')" /> --}}