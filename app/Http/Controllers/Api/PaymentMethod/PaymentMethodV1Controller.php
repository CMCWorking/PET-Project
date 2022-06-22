<?php

namespace App\Http\Controllers\Api\PaymentMethod;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PaymentMethodV1Controller extends Controller
{
    /**
     * > This function returns a list of payment methods
     *
     * @param version The version of the API you are using.
     *
     * @return The payment methods are being returned.
     */
    public function getList($version)
    {
        $payment_methods = PaymentMethod::select('name', 'description')->get();

        return response()->success($payment_methods, 'Payment methods retrieved successfully');
    }

    /**
     * It returns a payment method with the given id
     *
     * @param version The version of the API you are using.
     * @param id The id of the payment method to be retrieved
     *
     * @return A payment method
     */
    public function getDetail($version, $id)
    {
        try {
            $payment_method = PaymentMethod::findOrFail($id);

            return response()->success($payment_method, 'Payment method retrieved successfully');
        } catch (ModelNotFoundException $ex) {
            return response()->error('Payment method not found', 404);
        } catch (Exception $exception) {
            return response()->error('An error occurred while retrieving payment method');
        }
    }

    /**
     * It updates the payment method with the given id
     *
     * @param version The version of the API you are using.
     * @param Request request The request object
     * @param id The id of the payment method to be updated
     */
    public function updateDetail($version, Request $request, $id)
    {
        try {
            $payment_method = PaymentMethod::findOrFail($id);

            $payment_method->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->success([], 'Payment method updated successfully');
        } catch (ModelNotFoundException $ex) {
            return response()->error('Payment method not found', 404);
        } catch (Exception $exception) {
            return response()->error('An error occurred while updating payment method');
        }
    }

    /**
     * > Delete a payment method
     *
     * @param version The version of the API you are using.
     * @param id The id of the payment method to be deleted
     */
    public function deletePaymentMethod($version, $id)
    {
        try {
            $payment_method = PaymentMethod::findOrFail($id);
            $payment_method->delete();

            return response()->success([], 'Payment method deleted successfully');
        } catch (ModelNotFoundException $ex) {
            return response()->error('Payment method not found', 404);
        } catch (Exception $exception) {
            return response()->error('An error occurred while deleting payment method');
        }
    }
}
