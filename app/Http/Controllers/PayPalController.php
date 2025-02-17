<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Throwable;

class PayPalController extends Controller
{
    /**
     * @throws Throwable
     */
    public function payment(): RedirectResponse
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $orderData = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "reference_id" => "ORDER_1",
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "3800.00"
                    ],
                    "description" => "Order #1 Invoice"
                ]
            ],
            "application_context" => [
                "return_url" => url('/payment/success'),
                "cancel_url" => url('/cancel'),
            ]
        ];

        $order = $provider->createOrder($orderData);

        if (isset($order['id']) && $order['status'] == "CREATED") {
            foreach ($order['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }

        return redirect()->back()->with('error', 'An error occurred while upload the order on PayPal.');
    }

    public function cancel()
    {
        return response()->json('Payment Cancelled',402);
    }

    /**
     * @throws Throwable
     */
    public function success(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $orderId = $request->query('token');
        $capture = $provider->capturePaymentOrder($orderId);

        if (isset($capture['status']) && $capture['status'] == "COMPLETED") {
            return response()->json('Paid success');
        }

        return response()->json('Payment failed', 402);
    }
}
