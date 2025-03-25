<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Cagar Alam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('cagar-alam.update', $cagarAlam->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Cagar Alam</label>
                        <input type="text" name="nama" value="{{ $cagarAlam->nama }}"
                            class="border rounded p-2 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="border rounded p-2 w-full" required>{{ $cagarAlam->deskripsi }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Upload Foto</label>
                        <input type="file" name="foto" class="border rounded p-2 w-full">
                        @if ($cagarAlam->foto)
                            <img src="{{ asset('storage/' . $cagarAlam->foto) }}" class="w-20 h-20 object-cover mt-2">
                        @endif
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                    <a href="{{ route('cagar-alam.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
                </form>
            </div>
        </div>
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
</x-app-layout>
