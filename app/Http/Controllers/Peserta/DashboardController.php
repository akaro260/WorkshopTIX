<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = User::query()
            ->whereKey(auth()->id())
            ->withCount([
                'registrations',
                'registrations as pending_registrations_count' => fn ($query) => $query
                    ->where('status', 'pending'),
                'registrations as successful_payments_count' => fn ($query) => $query
                    ->where('status', 'confirmed'),
            ])
            ->firstOrFail();

        return view('peserta.dashboard', [
            'title' => 'Dashboard Peserta',
            'totalRegistrations' => $user->registrations_count,
            'successfulPayments' => $user->successful_payments_count,
            'pendingPayments' => $user->pending_registrations_count,
        ]);
    }
}
