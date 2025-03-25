<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Cagar Alam') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('cagar-alam.create') }}"
                    class="text-white px-3 py-1.5 rounded-md inline-block text-sm font-semibold shadow-sm transition-all duration-200 ease-in-out transform hover:scale-105 mb-2"
                    style="background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9));">
                    Tambah
                </a>


                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                @if (session()->has('success'))
                    <script>
                        Swal.fire({
                            title: "Berhasil!",
                            text: "{{ session('success') }}",
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                    </script>
                    @php session()->forget('success'); @endphp
                @endif

                <div class="overflow-x-auto min-h-[300px]">
                    <table class="min-w-full bg-white border border-gray-300 text-sm rounded-lg overflow-hidden">
                        <thead class="bg-gray-100 text-gray-700 text-center">
                            <tr>
                                <th class="py-3 px-4 border">Nama</th>
                                <th class="py-3 px-4 border">Deskripsi</th>
                                <th class="py-3 px-4 border">Foto</th>
                                <th class="py-3 px-4 border w-20">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cagarAlam as $item)
                                <tr class="border-b hover:bg-gray-100 transition text-center">
                                    <td class="py-3 px-4 border font-semibold text-gray-800">{{ $item->nama }}</td>
                                    <td class="py-3 px-4 border text-gray-700 max-h-12 overflow-hidden">
                                        {{ $item->deskripsi }}
                                    </td>

                                    <td class="py-3 px-4 border">
                                        <img src="{{ asset('storage/' . $item->foto) }}"
                                            class="w-12 h-12 rounded object-cover" alt="Foto">
                                    </td>

                                    <td class="py-3 px-4 border">
                                        <div class="flex items-center justify-center space-x-0.5">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('cagar-alam.edit', $item->id) }}"
                                                class="bg-yellow-500 text-white flex items-center justify-center w-5 h-5 rounded-sm hover:bg-yellow-600 transition text-[10px] p-0.5">
                                                <i class="bi bi-pencil-square text-[10px]"></i>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('cagar-alam.destroy', $item->id) }}" method="POST"
                                                class="m-0 p-0 delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="bg-red-500 text-white flex items-center justify-center w-5 h-5 rounded-sm hover:bg-red-600 transition text-[10px] p-0.5 delete-btn">
                                                    <i class="bi bi-trash text-[10px]"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        @if ($cagarAlam->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center text-gray-500 font-semibold py-6">Belum ada data
                                    cagar alam.</td>
                            </tr>
                        @endif
                    </table>
                </div>

                <div class="mt-4">
                    {{ $cagarAlam->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    Swal.fire({
                        title: "Anda yakin menghapus?",
                        text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('.delete-form').submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
