@extends(backpack_view('blank'))

@section('content')
<section class="container-fluid">
    <h2>
        <span class="text-capitalize">Payment</span>
        <small>Make a payment for {!! $entry->full_name !!}.</small>
        @if ($crud->hasAccess('list'))
            <small>
                <a href="{{ url($crud->route) }}" class="d-print-none font-sm">
                    <i class="la la-angle-double-{{ config('backpack.base.html_direction') == 'rtl' ? 'right' : 'left' }}"></i>
                    {{ trans('backpack::crud.back_to_all') }}
                    <span>{{ $crud->entity_name_plural }}</span>
                </a>
            </small>
        @endif
    </h2>
</section>
<div class="row">
    <div class="col-md-8 bold-labels">
        @if ($errors->any())
            <div class="alert alert-danger pb-0">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li><i class="la la-info-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="">
            @csrf
            <div class="card">
                <div class="card-body row">
                    <!-- Payment Form Fields -->
                    <div class="form-group col-md-6">
                        <label>Amount</label>
                        <input type="text" name="amount" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror">
                        @error('amount')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>Type</label>
                        <select name="type" class="form-control payment-type @error('type') is-invalid @enderror">
                            <option value="">Select Type</option>
                            <option value="Gcash">Gcash</option>
                            <option value="Cash">Cash</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 transaction-code-field" style="display: none;">
                        <label>Transaction Code</label>
                        <input type="text" name="transaction_code" value="{{ old('transaction_code') }}" class="form-control @error('transaction_code') is-invalid @enderror">
                        @error('transaction_code')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label>Payment For</label>
                        <select name="payment_for" class="form-control @error('payment_for') is-invalid @enderror">
                            <option value="">Select Payment For</option>
                            <option value="monthly">Monthly</option>
                            <option value="bi_monthly">bi monthly</option>
                            <option value="6_months">6 months</option>
                            <option value="annual">annual</option>
                            <option value="1_year">1 year</option>
                        </select>
                        @error('payment_for')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-none" id="parentLoadedAssets">[]</div>
            <div id="saveActions" class="form-group">
                <input type="hidden" name="_save_action" value="make_payment">
                <button type="submit" class="btn btn-success">
                    <span class="la la-money" role="presentation" aria-hidden="true"></span> &nbsp;
                    <span data-value="make_payment">Make Payment</span>
                </button>
                <div class="btn-group" role="group">
                </div>
                <a href="{{ url($crud->route) }}" class="btn btn-default"><span class="la la-ban"></span>
                    &nbsp;Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('after_scripts')
    <script>
        $(document).ready(function(){
            $('.payment-type').change(function(){
                var selectedType = $(this).val();
                if(selectedType === 'Gcash'){
                    $('.transaction-code-field').show();
                    $('.transaction-code-field input').prop('required', true); // Make transaction code required for Gcash
                } else {
                    $('.transaction-code-field').hide();
                    $('.transaction-code-field input').prop('required', false); // Make transaction code not required for other payment types
                }
            });
        });
    </script>
@endpush
