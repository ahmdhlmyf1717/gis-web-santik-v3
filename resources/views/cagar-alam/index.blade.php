@include('layouts.navigation')
@include('partials.loading')
@extends('layouts.app')

@section('title', 'Dataset Cagar Alam')

@section('header')
    {{ __('Data Cagar Alam') }}
@endsection

@section('content')
    {{-- bootstrap icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('cagar-alam.create') }}"
                class="text-white px-4 py-2 rounded-md text-sm font-semibold shadow-sm transition-all duration-200 ease-in-out transform hover:scale-105"
                style="background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9));">
                Tambah Dataset
            </a>
        </div>




        <div class="overflow-x-auto min-h-[300px]">
            <table class="min-w-full bg-white border border-gray-300 text-sm  rounded-lg overflow-hidden">
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
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-12 h-12 rounded object-cover"
                                    alt="Foto">
                            </td>

                            <td class="py-1 px-2 border text-center whitespace-nowrap relative">
                                <div class="flex items-center justify-center">
                                    <a href="{{ route('cagar-alam.edit', $item->id) }}"
                                        class="absolute left-2.5 top-1/2 transform -translate-y-1/2 inline-flex items-center justify-center w-6 h-6 bg-yellow-500 text-white rounded shadow hover:bg-yellow-600 transition">
                                        <i class="bi bi-pencil-square text-xs"></i>
                                    </a>
                                    <form action="{{ route('cagar-alam.destroy', $item->id) }}" method="POST"
                                        class="delete-form absolute right-2.5 top-1/2 transform -translate-y-1/2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="inline-flex items-center justify-center w-6 h-6 bg-red-500 text-white rounded shadow hover:bg-red-600 transition delete-btn">
                                            <i class="bi bi-trash text-xs"></i>
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

        <div class="mt-4" id="pagination">
            {{ $cagarAlam->appends(request()->query())->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <style>
        .pagination {
            display: flex;
            justify-content: flex-end;
            list-style: none;
            padding: 10px 0;
        }

        .pagination li {
            margin: 0 3px;
        }

        .pagination li a,
        .pagination li span {
            padding: 5px 8px;
            font-size: 12px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #333;
            border-radius: 4px;
            transition: all 0.3s ease-in-out;
        }

        .pagination li a:hover {
            background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9));
            font-weight: bold;
            color: white;
            transform: scale(1.1);
        }

        .pagination .active span {
            background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9));
            font-weight: bold;
            color: white;
            font-weight: bold;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            @endif

            // Event delegation untuk tombol delete
            document.body.addEventListener("click", function(event) {
                if (event.target.closest(".delete-btn")) {
                    let button = event.target.closest(".delete-btn");
                    let form = button.closest("form");

                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed && form) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.body.addEventListener("click", function(event) {
                if (event.target.closest(".delete-btn")) {
                    let button = event.target.closest(".delete-btn");
                    let form = button.closest("form");

                    Swal.fire({
                        title: "Yakin ingin menghapus?",
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed && form) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function loadPagination() {
                document.querySelectorAll(".pagination a").forEach(link => {
                    link.addEventListener("click", function(e) {
                        e.preventDefault(); // Stop reload!

                        let url = this.href;

                        fetch(url, {
                                headers: {
                                    "X-Requested-With": "XMLHttpRequest"
                                }
                            })
                            .then(response => response.text())
                            .then(html => {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(html, "text/html");

                                // Ganti isi tabel dataset
                                let newContent = doc.querySelector(".overflow-x-auto");
                                if (newContent) {
                                    document.querySelector(".overflow-x-auto").innerHTML =
                                        newContent.innerHTML;
                                }

                                let newPagination = doc.querySelector(".mt-4");
                                if (newPagination) {
                                    document.querySelector(".mt-4").innerHTML = newPagination
                                        .innerHTML;
                                }

                                loadPagination();

                                history.pushState(null, "", url);
                            })
                            .catch(error => console.error("Error:", error));
                    });
                });
            }

            loadPagination();
        });
    </script>
@endsection
