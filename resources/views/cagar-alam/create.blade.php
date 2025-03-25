<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Cagar Alam') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">


                <form action="{{ route('cagar-alam.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama Cagar Alam</label>
                        <input type="text" name="nama" class="border rounded p-2 w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" class="border rounded p-2 w-full" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Upload Foto</label>
                        <input type="file" name="foto" class="border rounded p-2 w-full">
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

                    <div class="flex space-x-4 mt-4">
                        <button type="submit"
                            class="text-white px-4 py-2 rounded shadow-sm transition-all duration-200 ease-in-out transform hover:scale-105 mb-2"
                            style="background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9)); font-weight: bold;">
                            Simpan
                        </button>
                        <a href="{{ route('cagar-alam.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded shadow-sm transition-all duration-200 ease-in-out transform hover:scale-105 mb-2">
                            Kembali
                        </a>
                    </div>

                </form>
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


    </div>

</x-app-layout>
