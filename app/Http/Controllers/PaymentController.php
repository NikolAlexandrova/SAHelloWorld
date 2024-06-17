<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;

class PaymentController extends Controller
{
    /**
     * Initiate the payment process.
     *
     * @param Request $request
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function process(Request $request)
    {
        // Set your Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create a new Stripe Checkout Session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Your Product',
                        ],
                        'unit_amount' => 1000, // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success'),
                'cancel_url' => route('payment.cancel'),
            ]);

            // Redirect user to the Stripe Checkout page
            return redirect($session->url);
        } catch (ApiErrorException $e) {
            // Handle error
            return back()->with('error', 'Payment initiation failed: ' . $e->getMessage());
        }
    }

    /**
     * Handle payment success callback.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function success(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Retrieve activity ID from the request
        $activityId = $request->input('activity_id');

        // Get the currently authenticated user
        $user = Auth::user();

        // Attach the user to the activity
        $user->activities()->attach($activityId);

        // Redirect back to the activity page with success message
        return redirect()->route('activities.show', ['activity' => $activityId])->with('success', 'Payment successful. You have been registered for the activity.');
    }

    /**
     * Handle payment cancellation.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Retrieve activity ID from the request
        $activityId = $request->input('activity_id');

        // Redirect back to the activity page with error message
        return redirect()->route('activities.show', ['activity' => $activityId])->with('error', 'Payment cancelled. Please try again.');
    }

    /**
     * Process the payment callback from the payment gateway.
     *
     * @param Request $request
     * @return Response
     */
    public function callback(Request $request)
    {
        // Handle Stripe webhook events (if necessary)
        // This method is usually used to listen for asynchronous events from Stripe, such as payment success or failure

        // For synchronous payment confirmation, you might not need to implement this method
        // Instead, you can redirect the user to a success or failure page directly from the 'initiatePayment' method
    }
}
