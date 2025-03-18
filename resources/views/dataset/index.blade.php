<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tenaga Kesehatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Tombol Tambah Dataset -->
                <a href="{{ route('dataset.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah</a>

                <!-- Notifikasi SweetAlert -->
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
                    <!-- Tabel Daftar Dataset -->
                    <table class="min-w-full bg-white border border-gray-300 text-xs">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-center">
                                <th class="py-2 px-3 border" rowspan="2">Nama Puskesmas</th>
                                <th class="py-2 px-3 border" colspan="2">Dokter</th>
                                <th class="py-2 px-3 border" colspan="2">Perawat</th>
                                <th class="py-2 px-3 border" colspan="2">Bidan</th>
                                <th class="py-2 px-3 border" colspan="2">Sanitarian</th>
                                <th class="py-2 px-3 border" colspan="2">Ahli Gizi</th>
                                <th class="py-2 px-3 border" colspan="2">Tenaga</th>
                                <th class="py-2 px-3 border" colspan="2">Non-Tenaga</th>
                                <th class="py-2 px-3 border" rowspan="2">Aksi</th>
                            </tr>
                            <tr class="bg-gray-50 text-gray-700 text-center">
                                <th class="py-1 px-2 border">ASN</th>
                                <th class="py-1 px-2 border">Non-ASN</th>
                                <th class="py-1 px-2 border">ASN</th>
                                <th class="py-1 px-2 border">Non-ASN</th>
                                <th class="py-1 px-2 border">ASN</th>
                                <th class="py-1 px-2 border">Non-ASN</th>
                                <th class="py-1 px-2 border">ASN</th>
                                <th class="py-1 px-2 border">Non-ASN</th>
                                <th class="py-1 px-2 border">ASN</th>
                                <th class="py-1 px-2 border">Non-ASN</th>
                                <th class="py-1 px-2 border">ASN</th>
                                <th class="py-1 px-2 border">Non-ASN</th>
                                <th class="py-1 px-2 border">ASN</th>
                                <th class="py-1 px-2 border">Non-ASN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datasets as $dataset)
                                <tr class="text-center border-b">
                                    <td class="py-2 px-3 border font-semibold">{{ $dataset->nama_puskesmas }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->dokter_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->dokter_non_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->perawat_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->perawat_non_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->bidan_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->bidan_non_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->sanitarian_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->sanitarian_non_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->ahli_gizi_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->ahli_gizi_non_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->tenaga_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->tenaga_non_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->non_tenaga_asn }}</td>
                                    <td class="py-2 px-3 border">{{ $dataset->non_tenaga_non_asn }}</td>
                                    <td class="py-1 px-1 border text-center">
                                        <div class="flex items-center justify-center space-x-0.5">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('dataset.edit', $dataset->id) }}"
                                                class="bg-yellow-500 text-white flex items-center justify-center w-5 h-5 rounded-sm hover:bg-yellow-600 transition text-[10px] p-0.5">
                                                <i class="bi bi-pencil-square text-[10px]"></i>
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('dataset.destroy', $dataset->id) }}" method="POST"
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
                    </table>
                </div>
                <div class="mt-4">
                    {{ $datasets->links('pagination::bootstrap-4') }}
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

        <
        script >
            document.addEventListener("DOMContentLoaded", function() {
                const content = document.getElementById("dataset-container"); // Ganti dengan ID container tabel kamu
                const paginationLinks = document.querySelectorAll(".pagination a");

                paginationLinks.forEach(link => {
                    link.addEventListener("click", function(e) {
                        e.preventDefault(); // Hindari reload langsung
                        const url = this.href;

                        content.classList.add("fade-out"); // Tambah efek fade-out

                        fetch(url, {
                                headers: {
                                    "X-Requested-With": "XMLHttpRequest"
                                }
                            })
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, "text/html");
                                const newContent = doc.getElementById("dataset-container")
                                    .innerHTML;

                                content.innerHTML = newContent;
                                content.classList.remove("fade-out");
                                content.classList.add("fade-in");
                                window.history.pushState(null, "", url); // Update URL tanpa reload
                            })
                            .catch(error => console.error("Error loading content:", error));
                    });
                });
            });
    </script>

    </script>
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
            background-color: #007bff;
            color: white;
            transform: scale(1.1);
        }

        .pagination .active span {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        #dataset-container {
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            opacity: 1;
            transition: opacity 0.3s ease-in-out, min-height 0.3s ease-in-out;
        }

        table {
            table-layout: fixed;
            width: 100%;
        }

        th:first-child,
        td:first-child {
            font-size: 14px;
            font-weight: bold;
            width: 200px;
        }

        th:not(:first-child),
        td:not(:first-child) {
            font-size: 12px;
            padding: 4px;
        }
    </style>

</x-app-layout>
