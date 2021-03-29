<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\AttributeCustumerRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\DeleteCustomerRequest;
use App\Http\Requests\RestoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;
use Attribute;
use Illuminate\Http\Request;
use SebastianBergmann\CodeUnit\FunctionUnit;

class CustomerController extends Controller
{
    private const CONST_DELETE_STATE = '0';
    private const CONST_RESTORE_STATE = '1';

    /**
     * All Customer Getter with custom Data
     */
    public function getAll()
    {
        $customers = CustomerResource::collection(Customer::all());
        return $customers;
    }

    /**
     * All Customer Getter by Attribute determinate
     */
    public function getCustumersByAttributeDeterminate(AttributeCustumerRequest $request)
    {

        $customers = CustomerResource::collection(Customer::where($request->attribute, $request->value )->get());
        return $customers;
        
    }

    /**
     * Create Customer in DB
     */
    public function create(CreateCustomerRequest $request)
    {
        try {

            $customer = Customer::create($request->all());
            return [
                'message' => 'Custumer ' . $customer->name . ' ' . $customer->last_name . ' create successfully',
                'type' => 'success'
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e,
                'type' => 'danger'
            ];
        }
    }

    /**
     * Update Customer in DB
     */
    public function update(UpdateCustomerRequest $request)
    {
        try {

            $customer = Customer::find($request->id);
            if (is_null($customer))
                return [
                    'message' => 'Custumer not exist',
                    'type' => 'warning'
                ];
            
            $customer->name = $request->name;
            $customer->last_name = $request->last_name;
            $customer->phone_number = $request->phone_number;
            $customer->birth_date = $request->birth_date;
            $customer->address = $request->address;
            $customer->concessionaire_id = $request->concessionaire_id;
            $customer->district_id = $request->district_id;
            $customer->save();


            return [
                'message' => 'Custumer ' . $customer->name . ' ' . $customer->last_name . ' update successfully',
                'type' => 'success'
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e,
                'type' => 'danger'
            ];
        }
    }


    /**
     * Delete Customer from DB
     */
    public function delete(DeleteCustomerRequest $request)
    {
        try {

            $customer = Customer::find($request->id);

            if (is_null($customer))
                return [
                    'message' => 'Custumer not exist',
                    'type' => 'warning'
                ];


            $customer->state = self::CONST_DELETE_STATE;
            $customer->save();

            return [
                'message' => 'Custumer ' . $customer->name . ' ' . $customer->last_name . ' remove successfully',
                'type' => 'success'
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e,
                'type' => 'danger'
            ];
        }
    }

    /**
     * Restore Customer from DB
     */
    public function restore(RestoreCustomerRequest $request)
    {
        try {

            $customer = Customer::find($request->id);

            if (is_null($customer))
                return [
                    'message' => 'Custumer not exist',
                    'type' => 'warning'
                ];


            $customer->state = self::CONST_RESTORE_STATE;
            $customer->save();

            return [
                'message' => 'Custumer ' . $customer->name . ' ' . $customer->last_name . ' restore successfully',
                'type' => 'success'
            ];
        } catch (\Exception $e) {
            return [
                'message' => $e,
                'type' => 'danger'
            ];
        }
    }
}
