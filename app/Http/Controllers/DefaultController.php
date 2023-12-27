<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Child;
use App\Models\ChildSupport;
use App\Models\Payment;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function support(Request $request, Child $child, Sponsor $sponsor)
    {
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
        $total = Payment::sum('amount');
        $payments = Payment::select('sponsor_id', DB::raw('SUM(amount) as totalAmount'))
            ->groupBy('sponsor_id')
            ->get();

        return view('dashboard.report', compact('payments', 'total'));
    }
}
