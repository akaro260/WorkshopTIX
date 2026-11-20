<?php

use App\Models\Registration;
use App\Models\User;
use App\Models\Workshop;

test('checkout reports a server key configured for the wrong Midtrans environment', function () {
    $user = User::factory()->create();
    $user->refresh();

    $workshop = Workshop::query()->create([
        'name' => 'Workshop Test',
        'slug' => 'workshop-test',
        'description' => 'Workshop for checkout tests.',
        'speaker' => 'Test Speaker',
        'price' => 10000,
        'quota' => 10,
        'start_date' => now()->addDay(),
        'end_date' => now()->addDay()->addHour(),
        'status' => 'published',
    ]);
    $registration = Registration::query()->create([
        'user_id' => $user->id,
        'workshop_id' => $workshop->id,
        'status' => 'pending',
    ]);

    config()->set('services.midtrans.server_key', 'SB-Mid-server-test-key');
    config()->set('services.midtrans.is_production', true);

    $this->actingAs($user)
        ->get(route('peserta.payments.checkout', $registration))
        ->assertRedirect(route('peserta.workshops.index'))
        ->assertSessionHas(
            'error',
            'Gagal membuat pembayaran: MIDTRANS_SERVER_KEY tidak sesuai dengan MIDTRANS_IS_PRODUCTION. '
                .'Gunakan Server Key sandbox (SB-Mid-server-) atau production (Mid-server-) yang sesuai.'
        );
});

test('registration saves Midtrans checkout details', function () {
    $user = User::factory()->create();
    $workshop = Workshop::query()->create([
        'name' => 'Workshop Test',
        'slug' => 'workshop-test',
        'description' => 'Workshop for checkout tests.',
        'speaker' => 'Test Speaker',
        'price' => 10000,
        'quota' => 10,
        'start_date' => now()->addDay(),
        'end_date' => now()->addDay()->addHour(),
        'status' => 'published',
    ]);
    $registration = Registration::query()->create([
        'user_id' => $user->id,
        'workshop_id' => $workshop->id,
        'status' => 'pending',
    ]);

    $registration->update([
        'order_id' => 'WS-test-order',
        'payment_url' => 'https://app.sandbox.midtrans.com/snap/v1/redirect/test',
    ]);

    $this->assertDatabaseHas('registrations', [
        'id' => $registration->id,
        'order_id' => 'WS-test-order',
        'payment_url' => 'https://app.sandbox.midtrans.com/snap/v1/redirect/test',
    ]);
});
