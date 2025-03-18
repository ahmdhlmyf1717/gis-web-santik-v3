<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('dataset.update', $dataset->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-2">
                        <label class="block text-gray-700">Nama Puskesmas</label>
                        <input type="text" name="nama_puskesmas"
                            value="{{ old('nama_puskesmas', $dataset->nama_puskesmas) }}"
                            class="border rounded p-2 w-full">
                        @error('nama_puskesmas')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <h3 class="text-lg font-semibold mt-4 mb-2">Jumlah Tenaga Kesehatan</h3>

                    @php
                        $fields = [
                            'dokter' => 'Dokter',
                            'perawat' => 'Perawat',
                            'bidan' => 'Bidan',
                            'sanitarian' => 'Sanitarian',
                            'ahli_gizi' => 'Ahli Gizi',
                            'tenaga' => 'Tenaga Kesehatan Lainnya',
                            'non_tenaga' => 'Non Tenaga Kesehatan',
                        ];
                    @endphp

                    @foreach ($fields as $key => $label)
                        <div class="mb-2">
                            <label class="block text-gray-700">Jumlah {{ $label }}</label>
                            <div class="flex space-x-4">
                                <input type="number" name="{{ $key }}_asn"
                                    value="{{ old($key . '_asn', $dataset[$key . '_asn']) }}"
                                    class="border rounded p-2 w-1/2" placeholder="ASN">
                                <input type="number" name="{{ $key }}_non_asn"
                                    value="{{ old($key . '_non_asn', $dataset[$key . '_non_asn']) }}"
                                    class="border rounded p-2 w-1/2" placeholder="Non ASN">
                            </div>
                            @error($key . '_asn')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            @error($key . '_non_asn')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach

                    <div class="flex space-x-4 mt-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Update
                        </button>
                        <a href="{{ route('dataset.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
