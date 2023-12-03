<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Payment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sponsors = Sponsor::paginate(10);
        return view('sponsor.index', compact('sponsors'));
    }

    public function create()
    {
        return view('sponsor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'contact' => ['required', 'min:5', 'max:50'],
            'identification' => ['required'],
            'dob' => ['required'],
        ]);

        Sponsor::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'dob' => $request['dob'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('sponsor.index');
    }

    public function show(Request $request, Sponsor $sponsor)
    {
        $payments = Payment::paginate(10);
        $children = Child::take(10)->get();
        return view('sponsor.show', compact(['sponsor', 'payments', 'children']));
    }

    public function edit(Request $request, Sponsor $sponsor)
    {
        return view('sponsor.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'contact' => ['required', 'min:5', 'max:50'],
            'dob' => ['required'],
        ]);

        $sponsor->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'dob' => $request['dob'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('sponsor.index');
    }

    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsor.index');
    }
}
