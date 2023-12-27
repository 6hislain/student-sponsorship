<?php

namespace App\Http\Controllers;

use App\Mail\ApprovalMail;
use App\Models\Application;
use App\Models\Child;
use App\Models\ChildSupport;
use App\Models\Payment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DefaultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['home', 'about', 'contact', 'license']);
    }

    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function license()
    {
        return view('license');
    }

    public function sponsored()
    {
        $sponsor = Sponsor::where('user_id', Auth::id())->first();
        return redirect()->route('sponsor.show', $sponsor->id);
    }

    public function support(Request $request, Child $child)
    {
        $sponsor = Sponsor::where('user_id', Auth::id())->first();
        $data = [
            'user_id' => Auth::id(),
            'child_id' => $child->id,
            'sponsor_id' => $sponsor->id,
        ];
        $support = ChildSupport::where($data)->first();

        if ($support) $support->delete();
        else ChildSupport::create($data);

        return redirect()->back();
    }

    public function approve(Request $request)
    {
        $request->validate([
            'identification' => ['required'],
            'application' => ['required'],
            'image' => ['required'],
            'dob' => ['required'],
        ]);

        $application = Application::find($request['application']);
        $image = $request->file('image');
        $identification = $request->file('identification');
        if ($image) {
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $image_name);
        }
        if ($identification) {
            $identification_name = time() . '.' . $identification->getClientOriginalExtension();
            $identification->storeAs('public', $identification_name);
        }

        Sponsor::create([
            'first_name' => $application->first_name,
            'last_name' => $application->last_name,
            'address' => $application->address,
            'contact' => $application->email,
            'dob' => $request['dob'],
            'identification' => $identification ? $identification_name : null,
            'image' => $image ? $image_name : null,
            'description' => $application->message,
            'user_id' => $application->user_id,
        ]);

        $user = $application->user;
        $user->update(['role' => 'sponsor']);
        $application->delete();

        try {
            Mail::to($application->email)->send(new ApprovalMail());
        } catch (\Exception $e) {
        }

        return redirect()->route('sponsor.index');
    }

    public function dashboard()
    {
        $children = Child::count();
        $sponsors = Sponsor::count();
        $applications = Application::count();
        $payments = Payment::count();

        if (Auth::user()->role == 'user') return redirect()->route('application.create');
        else return view('dashboard.index', compact(['children', 'sponsors', 'applications', 'payments']));
    }

    public function report()
    {
        $total = Payment::sum('local_value');
        $payments = Payment::select('sponsor_id', DB::raw('SUM(local_value) as totalAmount'))
            ->groupBy('sponsor_id')
            ->get();

        return view('dashboard.report', compact('payments', 'total'));
    }
}
