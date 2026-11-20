<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{

public function index()
{
    $totalWorkshops = \App\Models\Workshop::count();

    $publishedWorkshops = \App\Models\Workshop::where(
        'status',
        'published'
    )->count();

    $totalRegistrations = \Illuminate\Support\Facades\DB::table(
        'registrations'
    )->count();

    $totalPayments = \Illuminate\Support\Facades\DB::table(
        'payments'
    )->count();

    $latestWorkshops = \App\Models\Workshop::latest()
        ->take(5)
        ->get();

    return view('admin.dashboard', compact(
        'totalWorkshops',
        'publishedWorkshops',
        'totalRegistrations',
        'totalPayments',
        'latestWorkshops'
    ));
}

}
