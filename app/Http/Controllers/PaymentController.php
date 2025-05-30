<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request ;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }
    // This is the Luhn validation function
    private function isValidCardNumber($number) {
        $number = preg_replace('/\D/', '', $number);
        $sum = 0;
        $alt = false;
        for ($i = strlen($number) - 1; $i >= 0; $i--) {
            $n = intval($number[$i]);
            if ($alt) {
                $n *= 2;
                if ($n > 9) {
                    $n -= 9;
                }
            }
            $sum += $n;
            $alt = !$alt;
        }
        return ($sum % 10 == 0);
    }
    public function processPayment(Request $request)
    {
        // Validate inputs (basic example)
        $request->validate([
           
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            
            'card_number' => 'required|digits_between:16,24',
            'exp_month' => 'required|integer|between:1,12',

            'exp_year' => 'required|string',
            'cvv' => 'required|digits_between:3,4',
        ]);
         $totalGeneral = $request->input('totalGeneral');
        $cardNumber = $request->input('card_number');

        // Use the Luhn check function here
        if (!$this->isValidCardNumber($cardNumber)) {
            return back()->withErrors(['card_number' => 'Invalid credit card number.'])->withInput();
        }
       

        // Since this is a fake payment, just simulate success
        return redirect()->route('payment.form')->with('success', 'Payment processed successfully');
    }
}

    