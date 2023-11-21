<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $applications = Application::paginate(20);
        return view('application.index', compact('applications'));
    }

    public function create()
    {
        return view('application.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'address' => ['required', 'min:3', 'max:50'],
            'destination' => ['required'],
            'currency' => ['required'],
            'amount' => ['required'],
            'frequency' => ['required'],
            'country' => ['required'],
            'email' => ['required', 'email'],
        ]);

        Application::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'destination' => $request['destination'],
            'currency' => $request['currency'],
            'amount' => $request['amount'],
            'frequency' => $request['frequency'],
            'address' => $request['address'],
            'country' => $request['country'],
            'email' => $request['email'],
            'message' => $request['message'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('application.index');
    }

    public function show(Request $request, Application $application)
    {
        return view('application.show', compact('application'));
    }

    public function edit(Request $request, Application $application)
    {
        return view('application.edit', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        $request->validate([
            'first_name' => ['required', 'min:3', 'max:50'],
            'last_name' => ['required', 'min:3', 'max:50'],
            'address' => ['required', 'min:3', 'max:50'],
            'destination' => ['required'],
            'currency' => ['required'],
            'amount' => ['required'],
            'frequency' => ['required'],
            'country' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $application->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'destination' => $request['destination'],
            'currency' => $request['currency'],
            'amount' => $request['amount'],
            'frequency' => $request['frequency'],
            'address' => $request['address'],
            'country' => $request['country'],
            'email' => $request['email'],
            'message' => $request['message'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('application.index');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('application.index');
    }
}
