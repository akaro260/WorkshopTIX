<?php

namespace App\Http\Controllers\Peserta;

use App\Http\Controllers\Controller;
use App\Models\Workshop;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::where('status', 'published')
            ->with(['registrations' => fn($q) => $q->where('user_id', auth()->id())])
            ->latest()
            ->paginate(9);

        return view('peserta.workshops.index', compact('workshops'));
    }
}
