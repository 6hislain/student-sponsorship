<?php

namespace App\Http\Controllers;

use App\Models\Child;
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
        $payments = Payment::paginate(10);
        return view('payment.index', compact('payments'));
    }

    public function create()
    {
        $children = Child::all();
        $sponsors = Sponsor::all();
        return view('payment.create', compact('sponsors', 'children'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => ['required'],
            'currency' => ['required'],
            'type' => ['required'],
            'attachment' => ['image'],
            'child' => ['required'],
        ]);

        switch ($request['currency']) {
            case 'USD':
                $local_value = $request['amount'] * 1200;
                break;
            case 'EUR':
                $local_value = $request['amount'] * 1400;
                break;
            default:
                $local_value = $request['amount'];
        }

        $image = $request->file('attachment');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $image_name);
        }

        if (Auth::user()->role == 'sponsor')  $sponsor = Sponsor::where('user_id', Auth::id())->first();

        Payment::create([
            'amount' => $request['amount'],
            'currency' => $request['currency'],
            'confirmed' => $request['confirmed'] == 'on',
            'type' => $request['type'],
            'local_value' => $local_value,
            'child_id' => $request['child'],
            'sponsor_id' => isset($sponsor) ? $sponsor->id : $request['sponsor'],
            'description' => $request['description'],
            'attachment' => $image ? $image_name : null,
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
        $children = Child::all();
        $sponsors = Sponsor::all();
        return view('payment.edit', compact(['payment', 'sponsors', 'children']));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'amount' => ['required'],
            'currency' => ['required'],
            'type' => ['required'],
            'attachment' => ['image'],
            'child' => ['required'],
        ]);

        switch ($request['currency']) {
            case 'USD':
                $local_value = $request['amount'] * 1200;
                break;
            case 'EUR':
                $local_value = $request['amount'] * 1400;
                break;
            default:
                $local_value = $request['amount'];
        }

        $image = $request->file('attachment');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $image_name);
        }

        if (Auth::user()->role == 'sponsor')  $sponsor = Sponsor::where('user_id', Auth::id())->first();

        $payment->update([
            'amount' => $request['amount'],
            'currency' => $request['currency'],
            'confirmed' => $request['confirmed'] == 'on',
            'type' => $request['type'],
            'local_value' => $local_value,
            'child_id' => $request['child'],
            'sponsor_id' => isset($sponsor) ? $sponsor->id : $request['sponsor'],
            'description' => $request['description'],
            'attachment' => $image ? $image_name : null,
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
