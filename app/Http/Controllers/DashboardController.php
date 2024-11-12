<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $recentCustomers = Customer::latest()->take(5)->get();

        return Inertia::render('Dashboard', [
            'recentCustomers' => $recentCustomers
        ]);
    }
}
