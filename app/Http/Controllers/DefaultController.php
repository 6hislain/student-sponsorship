<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Child;
use App\Models\Payment;
use App\Models\Sponsor;
use Illuminate\Http\Request;

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

    public function dashboard()
    {
        $children = Child::count();
        $sponsors = Sponsor::count();
        $applications = Application::count();
        $payments = Payment::count();

        return view('dashboard.index', compact(['children', 'sponsors', 'applications', 'payments']));
    }
}
