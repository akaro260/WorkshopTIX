<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use RuntimeException;

class PaymentController extends Controller
{
    /**
     * Membuat transaksi pembayaran Midtrans.
     */
    public function checkout(Registration $registration): RedirectResponse
    {
        abort_unless(
            $registration->user_id === auth()->id(),
            403
        );

        if ($registration->status === 'confirmed') {
            return to_route('peserta.dashboard')
                ->with('success', 'Pendaftaran sudah dibayar.');
        }

        if ($registration->status === 'cancelled') {
            return to_route('peserta.workshops.index')
                ->with('error', 'Pendaftaran telah dibatalkan.');
        }

        // Gunakan URL pembayaran yang sudah tersedia.
        if ($registration->payment_url) {
            return redirect()->away($registration->payment_url);
        }

        $workshop = $registration->workshop;

        if (! $workshop || $workshop->price <= 0) {
            return to_route('peserta.workshops.index')
                ->with('error', 'Data workshop atau harga tidak valid.');
        }

        $orderId = 'WS-' . $registration->id . '-' . Str::upper(Str::random(6));

        try {
            $this->configureMidtrans();

            $payment = Snap::createTransaction([
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $workshop->price,
                ],

                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],

                'item_details' => [
                    [
                        'id' => (string) $workshop->id,
                        'price' => (int) $workshop->price,
                        'quantity' => 1,
                        'name' => Str::limit($workshop->name, 50, ''),
                    ],
                ],
            ]);

            if (empty($payment->redirect_url)) {
                throw new RuntimeException(
                    'Midtrans tidak memberikan URL pembayaran.'
                );
            }

            $registration->update([
                'order_id' => $orderId,
                'payment_url' => $payment->redirect_url,
            ]);

            return redirect()->away($payment->redirect_url);

        } catch (Exception $e) {
            report($e);

            $message = $e->getCode() === 401
                ? $this->unauthorizedMessage()
                : 'Gagal membuat pembayaran. Silakan coba kembali.';

            return to_route('peserta.workshops.index')
                ->with('error', $message);
        }
    }

    /**
     * Memeriksa status transaksi Midtrans.
     */
    public function checkStatus(Registration $registration): RedirectResponse
    {
        abort_unless(
            $registration->user_id === auth()->id(),
            403
        );

        if (! $registration->order_id) {
            return to_route('peserta.workshops.index')
                ->with('error', 'Transaksi belum tersedia.');
        }

        try {
            $this->configureMidtrans();

            $result = Transaction::status($registration->order_id);

        } catch (Exception $e) {
            report($e);

            $message = $e->getCode() === 401
                ? $this->unauthorizedMessage()
                : 'Gagal memeriksa status pembayaran.';

            return to_route('peserta.dashboard')
                ->with('error', $message);
        }

        $transactionStatus = $result->transaction_status;

        switch ($transactionStatus) {
            case 'settlement':
            case 'capture':
                $registration->update([
                    'status' => 'confirmed',
                ]);

                return to_route('peserta.dashboard')
                    ->with('success', 'Pembayaran berhasil!');

            case 'pending':
                $message = 'Pembayaran masih menunggu penyelesaian.';
                break;

            case 'expire':
                $message = 'Transaksi pembayaran telah kedaluwarsa.';
                break;

            case 'cancel':
                $message = 'Transaksi pembayaran dibatalkan.';
                break;

            case 'deny':
                $message = 'Pembayaran ditolak oleh Midtrans.';
                break;

            default:
                $message = 'Status pembayaran: ' . $transactionStatus;
                break;
        }

        return to_route('peserta.dashboard')
            ->with('info', $message);
    }

    /**
     * Mengatur konfigurasi Midtrans.
     */
    private function configureMidtrans(): void
    {
        $serverKey = config('services.midtrans.server_key');

        $isProduction = (bool) config(
            'services.midtrans.is_production',
            false
        );

        $expectedPrefix = $isProduction
            ? 'Mid-server-'
            : 'SB-Mid-server-';

        if (
            ! is_string($serverKey) ||
            ! str_starts_with($serverKey, $expectedPrefix)
        ) {
            throw new RuntimeException(
                'Server Key Midtrans tidak sesuai dengan environment.'
            );
        }

        Config::$serverKey = $serverKey;
        Config::$isProduction = $isProduction;
    }

    /**
     * Pesan khusus ketika autentikasi Midtrans gagal.
     */
    private function unauthorizedMessage(): string
    {
        return 'Midtrans menolak Server Key. Periksa kembali Server Key '
            . 'dan environment Sandbox atau Production.';
    }
}
