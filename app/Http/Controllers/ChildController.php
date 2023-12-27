<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Update;
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
        $children = Child::paginate(10);
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
            'image' => ['image'],
        ]);

        $image = $request->file('image');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $image_name);
        }

        Child::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'school' => $request['school'],
            'address' => $request['address'],
            'image' => $image ? $image_name : null,
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
        $updates = Update::where('child_id', $child->id)->paginate(10);
        return view('child.show', compact('child', 'updates'));
    }

    public function edit(Request $request, Child $child)
    {
        return view('child.edit', compact('child'));
    }

    public function update(Request $request, Child $child)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'school' => ['required', 'min:5', 'max:50'],
            'contact_person' => ['required', 'min:5', 'max:50'],
            'contact_details' => ['required', 'min:5', 'max:50'],
            'dob' => ['required'],
            'image' => ['image'],
        ]);

        $image = $request->file('image');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $image_name);
        }

        $child->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'school' => $request['school'],
            'address' => $request['address'],
            'contact_person' => $request['contact_person'],
            'contact_details' => $request['contact_details'],
            'image' => $image ? $image_name : $child->image,
            'dob' => $request['dob'],
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
