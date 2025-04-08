@include('layouts.navigation')
@include('partials.loading')
@extends('layouts.app')

@section('title', 'Tambah Data Puskesmas')

@section('header')
    {{ __('Tambah Data Puskesmas') }}
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 border border-gray-200">
        <form action="{{ route('dataset.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Puskesmas -->
            <div>
                <label for="nama_puskesmas" class="block text-sm font-medium text-gray-700 mb-1">Nama Puskesmas</label>
                <input type="text" id="nama_puskesmas" name="nama_puskesmas"
                    class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    required>
                @error('nama_puskesmas')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Tenaga Kesehatan -->
            <h3 class="text-lg font-semibold mt-4 mb-2 text-green-700">Jumlah Tenaga Kesehatan</h3>

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
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah {{ $label }}</label>
                    <div class="flex space-x-4">
                        <input type="number" name="{{ $key }}_asn" placeholder="ASN"
                            class="border border-gray-300 rounded-lg p-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <input type="number" name="{{ $key }}_non_asn" placeholder="Non ASN"
                            class="border border-gray-300 rounded-lg p-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    </div>
                    @error($key . '_asn')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    @error($key . '_non_asn')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach

            <!-- Tombol Simpan -->
            <div class="flex space-x-4 mt-6">
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-105 hover:bg-green-700 font-semibold">Simpan</button>
                <a href="{{ route('dataset.index') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-105 hover:bg-gray-600 font-semibold">Kembali</a>
            </div>
        </form>
    </div>
@endsection
