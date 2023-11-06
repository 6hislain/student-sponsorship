<?php

namespace App\Http\Controllers;

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
        $sponsors = Sponsor::paginate(20);
        return view('sponsor.index', compact('sponsors'));
    }

    public function create()
    {
        return view('sponsor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'contact' => ['required', 'min:5', 'max:50']
        ]);

        Sponsor::create([
            'name' => $request['name'],
            'contact' => $request['contact'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('sponsor.index');
    }

    public function show(Request $request, Sponsor $sponsor)
    {
        return view('sponsor.show', compact('sponsor'));
    }

    public function edit(Request $request, Sponsor $sponsor)
    {
        return view('sponsor.edit', compact('sponsor'));
    }

    public function update(Request $request, Sponsor $sponsor)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'contact' => ['required', 'min:5', 'max:50']
        ]);

        $sponsor->update([
            'name' => $request['name'],
            'contact' => $request['contact'],
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
