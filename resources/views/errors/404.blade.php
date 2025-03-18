<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-gray-900 to-gray-700 flex items-center justify-center h-screen text-white">

    <div class="text-center">
        <h1 class="text-[10rem] font-extrabold tracking-widest text-white drop-shadow-lg animate-pulse">404</h1>
        <p class="text-3xl font-semibold text-gray-300 mt-4">Oops! Halaman tidak ditemukan.</p>
        <p class="text-gray-400 mt-2">Sepertinya halaman yang kamu cari tidak tersedia atau sudah dihapus.</p>

        <a href="{{ url('/') }}"
            class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg shadow-md transition-transform duration-300 hover:scale-105 hover:bg-blue-700">
            🔙 Kembali ke Beranda
        </a>
    </div>

</body>

</html>
