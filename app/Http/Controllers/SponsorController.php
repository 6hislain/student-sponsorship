<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildSupport;
use App\Models\Payment;
use App\Models\Sponsor;
use App\Models\User;
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
        $users = User::all();
        return view('sponsor.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'contact' => ['required', 'min:5', 'max:50'],
            'identification' => ['required'],
            'user' => ['required'],
            'dob' => ['required'],
        ]);

        Sponsor::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'dob' => $request['dob'],
            'description' => $request['description'],
            'user_id' => $request['user'],
        ]);

        return redirect()->route('sponsor.index');
    }

    public function show(Request $request, Sponsor $sponsor)
    {
        $payments = Payment::where('sponsor_id', $sponsor->id)->paginate(10);
        $children = ChildSupport::where('user_id', Auth::id())->paginate(10);
        return view('sponsor.show', compact(['sponsor', 'payments', 'children']));
    }

    public function edit(Request $request, Sponsor $sponsor)
    {
        $users = User::all();
        return view('sponsor.edit', compact('sponsor', 'users'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'contact' => ['required', 'min:5', 'max:50'],
            'user' => ['required'],
            'dob' => ['required'],
        ]);

        $sponsor->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'address' => $request['address'],
            'contact' => $request['contact'],
            'dob' => $request['dob'],
            'description' => $request['description'],
            'user_id' => $request['user'],
        ]);

        return redirect()->route('sponsor.index');
    }

    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsor.index');
    }
}
