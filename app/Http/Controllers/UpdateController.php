<?php

namespace App\Http\Controllers;

use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $updates = Update::paginate(10);
        return view('update.index', compact('updates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required', 'min:3', 'max:50'],
            'attachment' => ['image'],
            'child' => ['required'],
        ]);

        $image = $request->file('attachment');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $image_name);
        }

        Update::create([
            'attachment' => $image ? $image_name : null,
            'content' => $request['content'],
            'child_id' => $request['child'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    public function destroy(Update $update)
    {
        $update->delete();
        return redirect()->back();
    }
}
