<?php

    namespace App\Http\Controllers\Peserta;

    use App\Http\Controllers\Controller;
    use App\Models\Registration;
    use App\Models\Workshop;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Validation\ValidationException;

    class RegistrationController extends Controller
    {
        public function store(Workshop $workshop)
        {
            $registration = DB::transaction(function () use ($workshop) {
                $workshop = Workshop::whereKey($workshop->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($workshop->status !== 'published') {
                    throw ValidationException::withMessages([
                        'workshop' => 'Workshop belum tersedia.',
                    ]);
                }

                $existing = Registration::where('user_id', auth()->id())
                    ->where('workshop_id', $workshop->id)
                    ->first();

                if ($existing) {
                    if ($existing->status === 'cancelled') {
                        throw ValidationException::withMessages([
                            'workshop' => 'Pendaftaran sebelumnya dibatalkan.',
                        ]);
                    }

                    return $existing;
                }

                $registeredCount = Registration::where(
                    'workshop_id',
                    $workshop->id
                )
                    ->whereIn('status', ['pending', 'confirmed'])
                    ->count();

                if ($registeredCount >= $workshop->quota) {
                    throw ValidationException::withMessages([
                        'workshop' => 'Kuota workshop sudah penuh.',
                    ]);
                }

                return Registration::create([
                    'user_id' => auth()->id(),
                    'workshop_id' => $workshop->id,
                    'status' => 'pending',
                ]);
            });

            if ($registration->status === 'confirmed') {
                return redirect()
                    ->route('peserta.dashboard')
                    ->with('success', 'Pendaftaran kamu sudah dikonfirmasi.');
            }

            return redirect()->route(
                'peserta.payments.checkout',
                $registration
            );
        }
    }
