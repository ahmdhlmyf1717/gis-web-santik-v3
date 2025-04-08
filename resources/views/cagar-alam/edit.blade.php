@include('layouts.navigation')
@include('partials.loading')
@extends('layouts.app')

@section('title', 'Edit Data Cagar Alam')

@section('header')
    {{ __('Edit Cagar Alam') }}
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6 border border-gray-200">
        <form action="{{ route('cagar-alam.update', $cagarAlam->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Cagar Alam -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Cagar Alam</label>
                <input type="text" name="nama" value="{{ $cagarAlam->nama }}"
                    class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    required>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi"
                    class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    required>{{ $cagarAlam->deskripsi }}</textarea>
            </div>

            <!-- Upload Foto -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Foto</label>
                <input type="file" name="foto"
                    class="border border-gray-300 rounded-lg w-full p-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                @if ($cagarAlam->foto)
                    <img src="{{ asset('storage/' . $cagarAlam->foto) }}"
                        class="w-20 h-20 object-cover mt-2 rounded-lg border border-gray-300">
                @endif
            </div>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tombol Update & Kembali -->
            <div class="flex space-x-4 mt-6">
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-105 hover:bg-green-700 font-semibold">Update</button>
                <a href="{{ route('cagar-alam.index') }}"
                    class="bg-gray-500 text-white px-6 py-2 rounded-lg shadow-md transition-all duration-200 ease-in-out transform hover:scale-105 hover:bg-gray-600 font-semibold">Kembali</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelector('input[name="foto"]').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                const fileExtension = file.name.split('.').pop().toLowerCase();

                if (!allowedExtensions.includes(fileExtension)) {
                    Swal.fire({
                        title: "Format Tidak Didukung!",
                        text: "Harap unggah file dengan format jpg, jpeg, png, atau gif.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                    this.value = '';
                }
            }
        });
    </script>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelector('input[name="foto"]').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                const fileExtension = file.name.split('.').pop().toLowerCase();

                if (!allowedExtensions.includes(fileExtension)) {
                    Swal.fire({
                        title: "Format Tidak Didukung!",
                        text: "Harap unggah file dengan format jpg, jpeg, png, atau gif.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                    this.value = '';
                }
            }
        });
    </script>
@endsection
