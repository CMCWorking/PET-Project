<?php

namespace App\Http\Controllers\Api\CustomerInformation;

use App\Http\Controllers\Controller;
use App\Models\CustomerInformations;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerInformationV1Controller extends Controller
{
    /**
     * It returns a list of customers
     */
    public function getList($version)
    {
        try {
            $customers = CustomerInformations::select('name', 'email', 'phone')->get();

            return response()->success($customers, 'Successfully retrieved customers.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * It gets the customer information and addresses of a customer with the given id
     *
     * @param id The id of the customer you want to retrieve.
     */
    public function getDetail($version, $id)
    {
        try {
            $customer = CustomerInformations::whereId($id)->with('addresses')->firstOrFail();

            return response()->success($customer, 'Successfully retrieved customer.');
        } catch (ModelNotFoundException $ex) {
            return response()->error('Customer not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * It updates the customer's information
     *
     * @param Request request The request object.
     * @param id The id of the customer you want to update.
     */
    public function updateDetail($version, Request $request, $id)
    {
        // return $request->all();
        try {
            $customer = CustomerInformations::where('id', $id)->firstOrFail();
            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'receive_promotion' => $request->receive_promotion,
            ]);

            return response()->success([], 'Successfully updated customer detail.');

        } catch (ModelNotFoundException $ex) {
            return response()->error('Customer not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    /**
     * > Delete a customer from the database
     *
     * @param id The id of the customer you want to delete.
     */
    public function deleteCustomer($version, $id)
    {
        try {
            $customer = CustomerInformations::where('id', $id)->firstOrFail();
            $customer->delete();

            return response()->success([], 'Successfully deleted customer.');

        } catch (ModelNotFoundException $ex) {
            return response()->error('Customer not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
