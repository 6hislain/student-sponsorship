<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $children = Child::paginate(20);
        return view('child.index', compact('children'));
    }

    public function create()
    {
        return view('child.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'school' => ['required', 'min:5', 'max:50'],
            'contact_person' => ['required', 'min:5', 'max:50'],
            'contact_details' => ['required', 'min:5', 'max:50'],
            'dob' => ['required'],
        ]);

        Child::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'school' => $request['school'],
            'address' => $request['address'],
            'contact_person' => $request['contact_person'],
            'contact_details' => $request['contact_details'],
            'dob' => $request['dob'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('child.index');
    }

    public function show(Request $request, Child $child)
    {
        return view('child.show', compact('client'));
    }

    public function edit(Request $request, Child $child)
    {
        return view('child.edit', compact('client'));
    }

    public function update(Request $request, Child $child)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'contact' => ['required', 'min:5', 'max:50'],
        ]);

        $child->update([
            'name' => $request['name'],
            'contact' => $request['contact'],
            'description' => $request['description'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('child.index');
    }

    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->route('child.index');
    }
}
