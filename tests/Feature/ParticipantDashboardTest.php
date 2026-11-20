<?php

use App\Models\User;
use App\Models\Workshop;

test('participant dashboard renders its layout slots', function () {
    $user = User::factory()->create([
        'role' => 'peserta',
    ]);

    $response = $this->actingAs($user)
        ->get(route('peserta.dashboard'));

    $response->assertOk()
        ->assertSee('Dashboard')
        ->assertSee('Halo, '.$user->name)
        ->assertSee('Temukan Workshop');
});

test('participant dashboard shows registration and payment counts for the signed-in user', function () {
    $user = User::factory()->create([
        'role' => 'peserta',
    ]);

    foreach (['pending', 'confirmed', 'cancelled'] as $index => $status) {
        $workshop = Workshop::query()->create([
            'name' => 'Workshop '.$index,
            'slug' => 'workshop-'.$index,
            'description' => 'Dashboard count test workshop.',
            'speaker' => 'Test Speaker',
            'price' => 10000,
            'quota' => 10,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDay()->addHour(),
            'status' => 'published',
        ]);

        $user->registrations()->create([
            'workshop_id' => $workshop->id,
            'status' => $status,
        ]);
    }

    $response = $this->actingAs($user)
        ->get(route('peserta.dashboard'));

    $response->assertOk()
        ->assertViewHas('totalRegistrations', 3)
        ->assertViewHas('successfulPayments', 1)
        ->assertViewHas('pendingPayments', 1)
        ->assertSeeTextInOrder([
            'Total Pendaftaran',
            '3',
            'Pembayaran Berhasil',
            '1',
            'Menunggu Pembayaran',
            '1',
        ]);
});
