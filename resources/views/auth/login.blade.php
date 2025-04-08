<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="flex flex-col md:flex-row w-full h-screen bg-white">
        <!-- Left Section with Animation -->
        <div class="md:w-1/2 flex items-center justify-center bg-gradient-to-r from-green-400 to-green-600 p-6">
            <img src="{{ asset('assets/logo/kabupaten.png') }}" alt="Illustrasi Login"
                class="w-[250px] h-[250px] md:w-[300px] md:h-[300px] object-contain transition-transform duration-500 ease-in-out hover:scale-105">
        </div>

        <!-- Right Section (Login Form) -->
        <div class="md:w-1/2 flex items-center justify-center p-6 md:p-16">
            <div class="w-full max-w-md">
                <h2 class="mb-2 text-2xl md:text-3xl font-semibold text-center text-gray-700">Selamat Datang !!</h2>
                <h3 class="mb-4 text-sm md:text-xs font-semibold text-center text-gray-500">Masuk ke Aplikasi Sebagai
                    Admin</h3>

                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="p-6 bg-white rounded-lg shadow-md">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email"
                            class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-400 focus:border-green-500 transition"
                            type="email" name="email" value="{{ old('email') }}" required autofocus
                            autocomplete="username">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password"
                            class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-green-400 focus:border-green-500 transition"
                            type="password" name="password" required autocomplete="current-password">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mt-4">
                        <input id="remember_me" type="checkbox"
                            class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500" name="remember">
                        <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-6">
                        <button type="submit"
                            class="w-full px-4 py-2 text-white font-semibold bg-gradient-to-r from-green-500 to-green-700 rounded-lg shadow-md hover:opacity-90 transition-all duration-200 transform hover:scale-105">
                            Login
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @include('partials.loading')

</body>

</html>
