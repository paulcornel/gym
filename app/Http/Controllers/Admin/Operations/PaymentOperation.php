<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Models\GymPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

trait PaymentOperation
{
    protected function setupPaymentRoutes($segment, $routeName, $controller)
    {
        Route::get($segment.'/{id}/payment', [
            'as'        => $routeName.'.payment',
            'uses'      => $controller.'@payment',
            'operation' => 'payment',
        ]);

        Route::post($segment.'/{id}/payment', [
            'as'        => $routeName.'.payment-add',
            'uses'      => $controller.'@postPaymentForm',
            'operation' => 'payment',
        ]);
    }

    public function postPaymentForm(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'type' => 'required|string',
            'transaction_code' => $request->type === 'Gcash' ? 'required|string' : 'nullable', // Transaction code required only if payment type is 'Gcash'
            'payment_for' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $entry = $this->crud->getCurrentEntry();
            $entry->payments()->updateOrCreate([
                'amount' => $request->input('amount'),
                'gym_members_id' => $entry->id,
                'payment_for' => $request->input('payment_for'),
                'transaction_code' => $request->get('transaction_code'),
            ]);
            // $entry->amount = $request->input('amount');
            // $entry->type = $request->input('type');
            // $entry->transaction_code = $request->input('transaction_code');
            // $entry->payment_for = $request->input('payment_for');
            // $entry->member_id = $id;
            // $entry->save();

            return redirect()->back()->with('success', 'Payment added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    protected function setupPaymentDefaults()
    {
        CRUD::allowAccess('payment');

        CRUD::operation('payment', function () {
            CRUD::loadDefaultOperationSettingsFromConfig();
        });

        CRUD::operation('list', function () {
            CRUD::addButton('top', 'payment', 'view', 'crud::buttons.payment');
            CRUD::addButton('line', 'payment', 'view', 'crud::buttons.payment');
        });
    }

    public function payment()
    {
        CRUD::hasAccessOrFail('payment');

        $memberId = request()->route('id');
        $membership = GymPayment::where('gym_members_id', $memberId)->first();

        $data = [
            'entry' => $this->crud->getCurrentEntry(),
            'crud' => $this->crud,
            'title' => CRUD::getTitle() ?? 'Payment ' . $this->crud->entity_name,
            'membership' => $membership,
        ];

        return view('crud::operations.payment_form', $data);
    }
}
