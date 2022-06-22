<?php

namespace App\Http\Controllers\Api\CustomerInformation;

use App\Http\Controllers\Controller;
use App\Models\CustomerInformations;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerInformationAPIController extends Controller
{
    public function getList()
    {
        try {
            $customers = CustomerInformations::select('name', 'email', 'phone')->get();

            return response()->success($customers, 'Successfully retrieved customers.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }

    public function getDetail($id)
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

    public function updateDetail(Request $request, $id)
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

    public function deleteCustomer($id)
    {
        try {
            $customer = CustomerInformations::where('id', $id)->firstOrFail();
            // $customer->delete();

            return response()->success($customer, 'Successfully deleted customer.');

        } catch (ModelNotFoundException $ex) {
            return response()->error('Customer not found.');
        } catch (Exception $ex) {
            return response()->error($ex->getMessage());
        }
    }
}
