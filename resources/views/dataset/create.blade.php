<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Puskesmas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('dataset.store') }}" method="POST">
                    @csrf

                    <!-- Nama Puskesmas -->
                    <div class="mb-4">
                        <label for="nama_puskesmas" class="block text-gray-700">Nama Puskesmas</label>
                        <input type="text" id="nama_puskesmas" name="nama_puskesmas"
                            class="border rounded w-full p-2">
                        @error('nama_puskesmas')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Tenaga Kesehatan -->
                    <h3 class="text-lg font-semibold mt-4 mb-2">Jumlah Tenaga Kesehatan</h3>

                    @php
                        $fields = [
                            'dokter' => 'Dokter',
                            'perawat' => 'Perawat',
                            'bidan' => 'Bidan',
                            'sanitarian' => 'Sanitarian',
                            'ahli_gizi' => 'Ahli Gizi',
                            'tenaga' => 'Tenaga',
                            'non_tenaga' => 'Non Tenaga',
                        ];
                    @endphp

                    @foreach ($fields as $key => $label)
                        <div class="mb-2">
                            <label class="block text-gray-700">Jumlah {{ $label }}</label>
                            <div class="flex space-x-4">
                                <input type="number" name="{{ $key }}_asn" placeholder="ASN"
                                    class="border rounded p-2 w-1/2">
                                <input type="number" name="{{ $key }}_non_asn" placeholder="Non ASN"
                                    class="border rounded p-2 w-1/2">
                            </div>
                            @error($key . '_asn')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            @error($key . '_non_asn')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Tombol Simpan -->
                    <div class="flex space-x-4 mt-4">
                        <button type="submit"
                            class="text-white px-4 py-2 rounded shadow-sm transition-all duration-200 ease-in-out transform hover:scale-105 mb-2"
                            style="background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9)); font-weight: bold;">
                            Simpan
                        </button>

                        <a href="{{ route('dataset.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded shadow-sm transition-all duration-200 ease-in-out transform hover:scale-105 mb-2">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
