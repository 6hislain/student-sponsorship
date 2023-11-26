<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $payments = Payment::paginate(20);
        return view('payment.index', compact('payments'));
    }

    public function create()
    {
        $sponsors = Sponsor::all();
        return view('payment.create', compact('sponsors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required'],
            'currency' => ['required'],
            'type' => ['required'],
            'attachment' => ['required'],
            'sponsor' => ['required'],
        ]);

        Payment::create([
            'amount' => $request['amount'],
            'currency' => $request['currency'],
            'confirmed' => $request['confirmed'] == 'on',
            'type' => $request['type'],
            'sponsor_id' => $request['sponsor'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('payment.index');
    }

    public function show(Request $request, Payment $payment)
    {
        return view('payment.show', compact('payment'));
    }

    public function edit(Request $request, Payment $payment)
    {
        $sponsors = Sponsor::all();
        return view('payment.edit', compact(['payment', 'sponsors']));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => ['required'],
            'currency' => ['required'],
            'type' => ['required'],
            'attachment' => ['required'],
            'sponsor' => ['required'],
        ]);

        $payment->update([
            'amount' => $request['amount'],
            'currency' => $request['currency'],
            'confirmed' => $request['confirmed'] == 'on',
            'type' => $request['type'],
            'sponsor_id' => $request['sponsor'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('payment.index');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payment.index');
    }
}
