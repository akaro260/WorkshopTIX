<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memproses Pembayaran - WorkshopTIX</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-950 flex items-center justify-center text-white">
    <div class="text-center px-6">
        <div class="mx-auto mb-6 h-16 w-16 animate-spin rounded-full border-4 border-slate-700 border-t-blue-500"></div>

        <h1 class="text-2xl font-bold mb-3">
            Menyiapkan Pembayaran
        </h1>

        <p class="text-slate-400">
            Kami sedang menghubungkan kamu ke Midtrans.
        </p>

        <a href="{{ $checkoutUrl }}"
           class="inline-block mt-6 rounded-lg bg-blue-600 px-6 py-3 font-semibold">
            Lanjutkan Pembayaran
        </a>
    </div>

    <script>
        window.location.replace(@json($checkoutUrl));
    </script>
</body>
</html>
