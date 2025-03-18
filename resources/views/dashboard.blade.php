<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 shadow-md rounded-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Admin</h3>
                        <p class="text-2xl font-bold">{{ $totalAdmins ?? 10 }}</p>
                    </div>
                    <i class="fas fa-user-cog text-gray-500 text-3xl"></i>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 shadow-md rounded-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Dataset</h3>
                        <p class="text-2xl font-bold">{{ $totalDatasets ?? 25 }}</p>
                    </div>
                    <i class="fas fa-database text-gray-500 text-3xl"></i>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 shadow-md rounded-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Total Maps</h3>
                        <p class="text-2xl font-bold">{{ $totalMaps ?? 15 }}</p>
                    </div>
                    <i class="fas fa-map-marked-alt text-gray-500 text-3xl"></i>
                </div>
            </div>


        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentIndex = 0;
            const slides = document.querySelectorAll(".slider-item");
            const totalSlides = slides.length;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.style.display = i === index ? "block" : "none";
                });
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                showSlide(currentIndex);
            }

            showSlide(currentIndex);
            setInterval(nextSlide, 3000); // Ganti slide tiap 3 detik
        });
    </script>
</x-app-layout>
