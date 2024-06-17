<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;

class RegistrationController extends Controller
{
    public function registration(Request $request, $activity)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the maximum participants limit has been reached
        if ($this->checkMaxParticipants($activity)) {
            // Add an error message to the session
            session()->flash('error', 'The maximum amount of participants for this activity has been reached.');
            return redirect()->back();
        }

        // Use Stripe to initiate the payment process
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        try {
            // Create a payment intent with the amount set in the activity
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $activity->amount * 100, // amount in cents
                'currency' => 'eur',
            ]);
        } catch (\Exception $e) {
            // Handle any payment errors
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }

        // Pass the payment intent ID to the payment confirmation view
        return view('activities.confirmation', [
            'activity' => $activity,
            'clientSecret' => $intent->client_secret,
        ]);
    }

    public function cancellation($activity)
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Detach the user from the activity
        $user->activities()->detach($activity);

        // Inform the user that they successfully cancelled their attendance
        session()->flash('success', 'You have successfully cancelled your attendance to this activity.');

        // Redirect the user back to the activity detail page
        return redirect()->route('activities.show', $activity);
    }

    public function confirmation($activity)
    {
        // Load the payment confirmation view
        return view('activities.confirmation', [
            'activity' => $activity
        ]);
    }

    public function checkMaxParticipants($activity)
    {
        // Get the current number of participants
        $currentParticipants = $activity->participants()->count();

        // Get the number of allowed participants
        $allowedParticipants = $activity->allowed_participants;

        // Check if the limit for participants has been reached
        return $currentParticipants >= $allowedParticipants;
    }
}

