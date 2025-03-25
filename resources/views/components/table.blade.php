<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-4">{{ $title }}</h2>

    @isset($createRoute)
        <a href="{{ route($createRoute) }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            Tambah {{ $title }}
        </a>
    @endisset

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                {{ $head }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
