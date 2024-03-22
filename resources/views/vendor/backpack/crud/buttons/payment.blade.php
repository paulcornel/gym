@if ($crud->hasAccess('payment'))
  <a href="{{ url($crud->route.'/'.$entry->getKey().'/payment') }}" class="btn btn-sm btn-link"><i class="la la-envelope"></i> Payment</a>
@endif