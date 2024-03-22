<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Library\Widget;
use App\Http\Requests\GymPaymentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class GymPaymentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GymPaymentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\GymPayment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/gym-payment');
        CRUD::setEntityNameStrings('gym payment', 'gym payments');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::setFromDb(); // set columns from db columns.
        CRUD::addColumn([
            'name' => 'gym_members_id',
            'label' => 'Member Full Name',
            'type' => 'select',
            'entity' => 'member',
            'attribute' => 'fullname',
        ]);
    
        CRUD::addColumn([
            'name' => 'amount',
            'label' => 'Amount',
            'type' => 'text',
        ]);
    
        CRUD::addColumn([
            'name' => 'type',
            'label' => 'Type',
            'type' => 'select_from_array',
            'options' => [
                'cash' => 'Cash',
                'gcash' => 'GCash',
            ],
            'attributes' => [
                'id' => 'payment_type', // Add an id for targeting with JavaScript
            ],
        ]);
    
        CRUD::addColumn([
            'name' => 'payment_for',
            'label' => 'Payment For',
            'type' => 'enum',
            'options' => [
                'monthly' => 'Monthly',
                'bi_monthly' => 'bi-Monthly',
                '6_months' => '6 Months',
                'annual' => 'Annual',
                '1_year' => '1 year'
            ],
        ]);
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GymPaymentRequest::class);
        // CRUD::setFromDb(); // set fields from db columns.
        CRUD::addField([
            'name' => 'gym_members_id',
            'label' => 'Member Full Name',
            'type' => 'select',
            'entity' => 'member',
            'attribute' => 'fullname',
        ]);

        CRUD::addField([
            'name' => 'amount',
            'label' => 'Amount',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'type',
            'label' => 'Type',
            'type' => 'select_from_array',
            'options' => [
                'cash' => 'Cash',
                'gcash' => 'GCash',
            ],
            'attributes' => [
                'id' => 'payment_type', // Add an id for targeting with JavaScript
            ],
        ]);
        
        CRUD::addField([
            'name' => 'transaction_code',
            'label' => 'Transaction Code',
            'type' => 'text',
            'wrapperAttributes' => ['class' => 'form-group transaction-code-field d-none'], // Hide initially
            'attributes' => ['id' => 'transaction_code_input'], // Add an id for targeting with JavaScript
        ]);
        
        CRUD::addField([
            'name' => 'payment_for',
            'label' => 'Payment For',
            'type' => 'enum',
            'options' => [
                'monthly' => 'Monthly',
                'bi_monthly' => 'bi-Monthly',
                '6_months' => '6 Months',
                'annual' => 'Annual',
                '1_year' => '1 year'
            ],
        ]);
        
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
        Widget::add()->type('script')->content(asset('js/field.js'));
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
