<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebGIS - Jombang</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="icon" href="{{ asset('assets/logo/kabupaten.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geoman-free@2.14.0/dist/leaflet-geoman.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        }

        #map {
            flex: 1;
            position: relative;
            z-index: 0;
        }

        #sidebar {
            position: absolute;
            left: 0;
            right: 5px;
            top: 8px;
            bottom: 8px;
            width: 300px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            z-index: 1000;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform 0.4s ease, opacity 0.3s ease;
            box-sizing: border-box;
            padding: 60px 20px 10px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            border-right: 2px solid rgba(229, 231, 235, 0.5);
            border-radius: 15px;
        }

        #sidebar.open {
            transform: translateX(0);
            opacity: 1;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
        }

        #sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.6);
        }


        #hamburger {
            position: fixed;
            top: 15px;
            left: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 20%;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 3000;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            backdrop-filter: blur(5px);
        }

        #hamburger i {
            font-size: 20px;
            color: #199a1ea1;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid #ddd;
            margin-bottom: 10px;
            margin-top: 20px;
            width: 92%;
            max-width: 600px;
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;
            justify-content: space-between;
        }

        .tab-button {
            border-radius: 8px;
            flex: 1;
            padding: 12px;
            text-align: center;
            background: #f4f4f4;
            border: 2px solid #ddd;
            cursor: pointer;
            transition: all 0.3s ease;
            box-sizing: border-box;
            font-size: 16px;
            font-weight: normal;
        }

        .tab-button:hover {
            background-color: rgba(61, 172, 20, 0.1);
            transform: scale(1.05);
        }

        .tab-button.active {
            background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9));
            font-weight: bold;
            color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid rgba(61, 172, 20, 0.9);
        }

        .tab-button:not(.active):hover {
            background: rgba(61, 172, 20, 0.1);
        }

        .tab-content {
            padding: 10px;
            box-sizing: border-box;
            width: 100%;
            max-width: 300px;
        }

        .tab-pane {
            display: none;
            border-radius: 10px;
        }

        .tab-pane.active {
            display: block;
            border-radius: 10px;
            overflow-x: hidden;
        }

        .menu-header {
            cursor: pointer;
            font-weight: bold;
            margin: 15px 0;
            padding: 15px;
            background-color: rgba(240, 240, 240, 0.9);
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .menu-header:hover {
            background-color: rgba(181, 228, 151, 0.9);
            transform: translateY(-2px);
        }

        .menu-header i {
            font-size: 16px;
            color: #ffffff;
        }

        .menu-content {
            margin-left: 20px;
            display: none;
            padding-left: 10px;
            border-left: 2px solid #3dac14;
            animation: fadeIn 0.3s ease;
        }

        .menu-content input {
            margin-right: 5px;
        }

        .visible {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        #topbar {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 2000;
            display: flex;
            align-items: center;
            border-bottom: 2px solid #e5e7eb6c;
            border-radius: 15px;
        }

        .topbar-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            box-sizing: border-box;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo-img {
            height: 40px !important;
            margin-top: 5px;
            width: auto;
            margin-right: 0px;
            object-fit: cover;
        }

        .logo-title {
            font-size: 20px;
            font-weight: bold;
            color: #111827;
        }

        .topbar-nav {
            display: flex;
            align-items: center;
        }

        .topbar-search {
            width: 250px;
            height: 35px;
            margin-right: 20px;
            padding: 0 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.2s ease;
        }

        .topbar-search:focus {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }

        .topbar-icons i {
            font-size: 20px;
            color: #111827;
            margin-left: 15px;
            cursor: pointer;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .topbar-icons i:hover {
            color: #4f46e5;
            transform: scale(1.1);
        }

        .popup-table {
            border-collapse: collapse;
            width: 100%;
        }

        .popup-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .popup-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .popup-table tr:hover {
            background-color: #f1f1f1;
        }

        .popup-table td:first-child {
            font-weight: bold;
            text-align: left;
            background-color: #f4f4f4;
        }

        .legend {
            position: absolute;
            top: 80px;
            right: 70px;
            background: rgba(255, 255, 255, 0.9);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            font-size: 14px;
            z-index: 1000;
            max-height: 200px;
            overflow-y: auto;
            width: 250px;
            overflow: visible;
        }

        .legend h4 {
            margin: 0;
            margin-bottom: 5px;
            font-size: 16px;
        }

        .legend ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .legend li {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend .legend-color {
            width: 15px;
            height: 15px;
            margin-right: 10px;
            border-radius: 3px;
        }

        #topbar .logo-title,
        .tab-button,
        .menu-header,
        .topbar-nav,
        .legend h4,
        .tabs {
            text-transform: uppercase;
        }

        .modal {
            position: absolute;
            display: none;
            z-index: 1000;
            background: white;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 250px;
            font-family: Arial, sans-serif;
            font-size: 13px;
            line-height: 1.4;
            color: #333;
        }

        .modal.show {
            display: block;
        }

        .modal-content {
            overflow-y: auto;
        }

        .modal h3 {
            margin: 0 0 8px;
            font-size: 14px;
            color: #555;
            text-align: center;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table th,
        .info-table td {
            padding: 6px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 12px;
        }

        .info-table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .info-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .info-table tr:hover {
            background-color: #f1f1f1;
        }

        .folder-details {
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .folder-details:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .folder-details summary {
            cursor: pointer;
            font-weight: bold;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            padding: 5px;
            margin-bottom: 5px;
            color: #6ada36;
            transition: color 0.3s ease;
        }

        .folder-details summary:hover {
            color: #6ada36;
        }

        .opacity-slider {
            width: 100%;
            margin-top: 5px;
            appearance: none;
            height: 6px;
            background: #ddd;
            outline: none;
            opacity: 0.7;
            transition: opacity .15s ease-in-out;
            border-radius: 5px;
        }

        .opacity-slider:hover {
            opacity: 1;
        }

        .opacity-slider::-webkit-slider-thumb {
            appearance: none;
            width: 16px;
            height: 16px;
            background: #4CAF50;
            border-radius: 50%;
            cursor: pointer;
        }

        .opacity-slider::-moz-range-thumb {
            width: 16px;
            height: 16px;
            background: #4CAF50;
            border-radius: 50%;
            cursor: pointer;
        }



        .layer-control {
            margin-bottom: 10px;
        }

        .custom-swal-popup {
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(34, 193, 195, 0.8), rgba(0, 212, 255, 0.8));
            backdrop-filter: blur(10px);
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            padding: 15px;
            max-width: 400px;
        }

        .custom-swal-title {
            font-family: "Poppins", sans-serif;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 8px;
            color: #185109;
        }

        .custom-swal-text {
            font-family: "Poppins", sans-serif;
            font-size: 15px;
            text-align: justify;
            color: #185109;
        }
    </style>
</head>

<body>
    <header id="topbar">
        <div class="topbar-container">
            <div class="logo">
                <a href="https://www.jombangkab.go.id/beranda">
                    <img src="{{ asset('assets/logo/jombang.png') }}" alt="Logo" class="logo-img">
                </a>
            </div>
            <nav class="topbar-nav">

                <a href="https://sambang.jombangkab.go.id/"><img src="{{ asset('assets/logo/sambang.png') }}"
                        alt="Logo" class="logo-img"></a>

            </nav>
        </div>
    </header>

    <button id="hamburger"><i class="fas fa-bars"></i></button>
    <div id="sidebar">
        {{-- tab navigation --}}
        <div class="tabs">
            <button class="tab-button active" data-tab="menu-tab"><i class="bi bi-folder2"></i> Daftar Layer</button>
        </div>


        <!-- Tab Content -->
        <div class="tab-content">
            <input type="text" id="search-menu" placeholder="Pencarian ..."
                style="font-family: 'Poppins', sans-serif; width: 100%; padding: 10px; margin-top: 10px; margin-bottom: 5px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box;">
            <div id="folder-container"></div>
        </div>
    </div>

    {{-- popup iframe nya --}}
    <div id="iframe-popup"
        style="display:none; position:fixed; top:53%; left:50%; transform:translate(-50%, -50%); background:white; padding:20px; width:80%; max-width:900px; box-shadow:0 4px 8px rgba(0,0,0,0.3); z-index:1001; border-radius:20px; ">
        <button onclick="closePopup()"
            style="float:right; background:none; border:none; font-size:16px; cursor:pointer;">✖</button>
        <div id="iframe-container" style="margin-top:10px;"></div>
    </div>

    <button id="resetViewButton" class="reset-btn">
        <i class="fas fa-dove"></i>
    </button>


    @include('resetview')
    <script>
        // Koordinat default
        const defaultCenter = [-7.55555589792736, 112.22681069495013];
        const defaultZoom = 10;

        // Event untuk reset view
        document.getElementById('resetViewButton').addEventListener('click', function() {
            map.setView([-7.55555589792736, 112.22681069495013], 10);
        });
    </script>


    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "<h2 class='custom-swal-title'>Selamat Datang di WebGIS Jombang!</h2>",
                html: "<p class='custom-swal-text'>WebGIS Kabupaten Jombang siap digunakan. Silakan gunakan menu di kiri untuk navigasi dan jelajahi informasi geospasial yang tersedia.",

                toast: true,
                position: "centre",
                background: "transparent",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                customClass: {
                    popup: "custom-swal-popup",
                    title: "custom-swal-title",
                    htmlContainer: "custom-swal-text"
                }
            });
        });
    </script>




    <script>
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-pane').forEach(tab => tab.classList.remove('active'));

                this.classList.add('active');
                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>

    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-geoman-free@2.14.0/dist/leaflet-geoman.min.js"></script>

    <script>
        const map = L.map('map', {
            zoomControl: false
        }).setView([-7.55555589792736, 112.22681069495013], 10);
        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        // Basemap
        const openStreetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19
        });

        const googleSatellite = L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            attribution: '&copy; <a href="https://www.google.com/maps">Google Maps</a>',
            maxZoom: 19
        });

        // ArcGIS (ESRI) basemap
        const esriWorldImagery = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; <a href="https://www.esri.com">Esri</a> &mdash; Source: Esri, USGS, NOAA',
                maxZoom: 19
            });

        openStreetMap.addTo(map);
        let layers = {};

        const baseMaps = {
            "Peta OSM": openStreetMap,
            "Peta GS": googleSatellite,
            "Peta ESRI": esriWorldImagery
        };

        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');

        L.control.layers(baseMaps, null, {
            position: 'bottomright'
        }).addTo(map);


        var mataAnginImage = "{{ asset('assets/logo/mata-angin.png') }}";

        // kontrol arah mata angin
        L.Control.North = L.Control.extend({
            options: {
                position: 'topright'
            },

            onAdd: function(map) {
                var img = L.DomUtil.create('img');
                img.src = mataAnginImage;
                img.style.width = '75px';
                img.style.height = '75px';
                img.style.background = 'none';
                img.style.border = 'none';
                img.style.padding = '0';
                img.style.boxShadow = 'none';

                return img;
            }
        });

        new L.Control.North().addTo(map);

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
        });

        // Kontrol legend
        const legend = L.control({
            position: "topright"
        });

        // Fungsi kontainer legend
        legend.onAdd = function() {
            const div = L.DomUtil.create("div", "info legend");
            div.id = "legend-container";
            div.style.maxHeight = "400px";
            div.style.overflow = "auto";
            div.style.backgroundColor = "white";
            div.style.borderRadius = "5px";
            div.innerHTML = "<p>Legenda tidak tersedia</p>";

            L.DomEvent.disableScrollPropagation(div);
            L.DomEvent.disableClickPropagation(div);

            return div;
        };

        legend.addTo(map);

        function updateVillageLegend(geojsonData) {
            const legendContainer = document.getElementById("legend-container");
            const villages = {};

            // Mengumpulkan semua nama desa dan warnanya
            geojsonData.features.forEach(feature => {
                const desaName = feature.properties.wadmkd;
                if (!featureColors[desaName]) {
                    featureColors[desaName] = getRandomColor();
                }
                villages[desaName] = featureColors[desaName];
            });

            // Membuat HTML untuk legenda
            let legendHTML =
                '<div style="padding: 6px 8px; background: white; box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px;">';
            legendHTML += '<h4 style="margin: 0 0 5px; color: #777;"></h4>';

            Object.entries(villages).forEach(([desa, color]) => {
                legendHTML += `
                <div style="margin-bottom: 3px;">
                    <i style="display: inline-block; width: 18px; height: 18px; margin-right: 8px; 
                            background: ${color}; opacity: 0.7;"></i>
                    <span style="font-size: 13px;">${desa}</span>
                </div>`;
            });
            legendHTML += '</div>';

            if (legendContainer) {
                legendContainer.innerHTML = legendHTML;
            }
        }

        // Fungsi legend dengan gambar
        function updateLegendWithImage(imagePath, geojsonData = null, isVillageBoundary = false) {
            const legendContainer = document.getElementById("legend-container");

            if (!legendContainer) return;

            if (isVillageBoundary && geojsonData) {
                updateVillageLegend(geojsonData);
            } else if (!isVillageBoundary && imagePath) {
                legendContainer.innerHTML = `
                <img src="${imagePath}" alt="Legenda" style="max-width: 100%; solid #000;">
            `;
            } else if (!isVillageBoundary && !imagePath) {
                legendContainer.innerHTML = "<p>Legenda tidak tersedia</p>";
            }
        }

        // Fungsi GeoJSON dari folder
        function loadGeoJSONFromFolder(folderPath, imageFolderPath) {
            document.addEventListener("DOMContentLoaded", function() {
                const folderContainer = document.getElementById("folder-container");

                if (!folderContainer) {
                    console.error("Element folder-container not found.");
                    return;
                }

                fetch('/list-files')
                    .then(response => response.json())
                    .then(files => {
                        console.log("Files loaded:", files);

                        files.forEach(file => {
                            const geojsonPath = `${folderPath}/${file}`;
                            const imagePath = `${imageFolderPath}/${file.replace(".geojson", ".png")}`;

                            const container = document.createElement("div");
                            container.classList.add("layer-control");

                            const checkbox = document.createElement("input");
                            checkbox.type = "checkbox";
                            checkbox.id = `layer-${file}`;
                            checkbox.dataset.geojsonPath = geojsonPath;
                            checkbox.dataset.imagePath = imagePath;

                            const label = document.createElement("label");
                            label.htmlFor = checkbox.id;
                            label.textContent = file.replace(".geojson", "");

                            const opacitySlider = document.createElement("input");
                            opacitySlider.type = "range";
                            opacitySlider.min = "0";
                            opacitySlider.max = "1";
                            opacitySlider.step = "0.1";
                            opacitySlider.value = "1";
                            opacitySlider.classList.add("opacity-slider");
                            opacitySlider.style.display = "none";

                            container.appendChild(checkbox);
                            container.appendChild(label);
                            container.appendChild(opacitySlider);
                            folderContainer.appendChild(container);

                            console.log("Added layer:", file);

                            checkbox.addEventListener("change", event => {
                                if (event.target.checked) {
                                    toggleGeoJSONLayer(geojsonPath, imagePath, true);
                                    opacitySlider.style.display =
                                        "block";
                                } else {
                                    toggleGeoJSONLayer(geojsonPath, imagePath, false);
                                    opacitySlider.style.display =
                                        "none";
                                }
                            });

                            opacitySlider.addEventListener("input", event => {
                                const opacity = parseFloat(event.target.value);
                                updateLayerOpacity(geojsonPath, opacity);
                            });
                        });
                    })
                    .catch(err => {
                        console.error("Error fetching GeoJSON file list:", err);
                    });
            });
        }

        function updateLayerOpacity(geojsonPath, opacity) {
            if (geojsonLayers[geojsonPath]) {
                geojsonLayers[geojsonPath].setStyle({
                    fillOpacity: opacity,
                    opacity: opacity
                });
            }

            if (markerLayers[geojsonPath]) {
                markerLayers[geojsonPath].eachLayer(layer => {
                    if (layer instanceof L.CircleMarker) {
                        layer.setStyle({
                            fillOpacity: opacity,
                            opacity: opacity
                        });
                    }
                });
            }
        }

        // Fungsi gaya properti
        function styleFeature(feature) {
            const desaName = feature.properties.wadmkd;
            const kecamatanName = feature.properties.kecamatan;
            let fillColor;

            if (kecamatanData[kecamatanName] !== undefined) {
                const percentage = kecamatanData[kecamatanName];
                fillColor = getColor(percentage);
            } else {
                if (!featureColors[desaName]) {
                    featureColors[desaName] = getRandomColor();
                }
                fillColor = featureColors[desaName];
            }

            return {
                fillColor: fillColor,
                weight: 1,
                opacity: 1,
                color: '#000',
                fillOpacity: 0.7
            };
        }

        // Fungsi konten popup
        function onEachFeature(feature, layer, geojsonPath) {
            if (!feature.properties) {
                console.error("Feature properties not found:", feature);
                return;
            }

            const popupContent = generatePopupContent(feature.properties);
            layer.bindPopup(popupContent);

            const lat = feature.properties?.y;
            const lng = feature.properties?.x;
            const opdName = feature.properties?.["Badan OPD"] || "Unknown";

            if (lat == null || lng == null) {
                return;
            }

            if (!markerLayers[geojsonPath]) {
                markerLayers[geojsonPath] = L.layerGroup();
            }

            if (opdName && opdDataByNumber.hasOwnProperty(opdName)) {
                const percentage = opdDataByNumber[opdName];
                const color = getColor(percentage);

                const marker = L.circleMarker([lat, lng], {
                    radius: 10,
                    fillColor: color,
                    color: '#000',
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                });

                console.log("Adding circle marker with color:", color);
                marker.bindPopup(popupContent);
                markerLayers[geojsonPath].addLayer(marker);
            } else {
                const defaultMarker = L.circleMarker([lat, lng], {
                    radius: 8,
                    color: "#800080",
                    fillColor: "#800080",
                    fillOpacity: 0.5,
                });

                defaultMarker.bindPopup(popupContent);
                markerLayers[geojsonPath].addLayer(defaultMarker);
            }
        }

        function toggleGeoJSONLayer(geojsonPath, imagePath, addLayer = true) {
            const legendContainer = document.getElementById("legend-container");

            if (addLayer) {
                fetch(geojsonPath)
                    .then(response => response.json())
                    .then(data => {
                        if (geojsonLayers[geojsonPath]) {
                            console.log(`Removing existing geojsonLayer: ${geojsonPath}`);
                            map.removeLayer(geojsonLayers[geojsonPath]);
                        }

                        if (markerLayers[geojsonPath]) {
                            console.log(`Removing existing markerLayer: ${geojsonPath}`);
                            map.removeLayer(markerLayers[geojsonPath]);
                        }

                        const isVillageBoundary = geojsonPath.toLowerCase().includes('batas_desa') ||
                            (data.features.length > 0 && data.features[0].properties.hasOwnProperty('wadmkd'));

                        geojsonLayers[geojsonPath] = L.geoJson(data, {
                            style: styleFeature,
                            pointToLayer: (feature, latlng) => {
                                return L.circleMarker(latlng, {
                                    radius: 8,
                                    fillColor: "#ff7800",
                                    color: "#000",
                                    weight: 1,
                                    opacity: 1,
                                    fillOpacity: 0.8
                                });
                            },

                            onEachFeature: (feature, layer) => {
                                if (geojsonPath.toLowerCase().includes("persebaran lokasi puskesmas")) {
                                    const popupContent = generatePopupContent(feature.properties);
                                    layer.bindPopup(popupContent);

                                    layer.on("click", function() {
                                        layer.openPopup();
                                        openDataPanel(feature.properties.nampkm);
                                    });

                                    // Sembunyikan legenda jika Persebaran Lokasi Puskesmas dipilih
                                    if (legendContainer) {
                                        legendContainer.style.display = "none";
                                    }
                                }

                                if (typeof onEachFeature === "function") {
                                    onEachFeature(feature, layer, geojsonPath);
                                }
                            }
                        }).addTo(map);

                        if (markerLayers[geojsonPath]) {
                            markerLayers[geojsonPath].addTo(map);
                        }

                        if (isVillageBoundary) {
                            updateLegendWithImage(null, data, true);
                        } else {
                            updateLegendWithImage(imagePath, null, false);
                        }
                    })
                    .catch(error => console.error(`Error loading GeoJSON file ${geojsonPath}:`, error));
            } else {
                console.log(`Removing layers for: ${geojsonPath}`);

                if (geojsonLayers[geojsonPath]) {
                    map.removeLayer(geojsonLayers[geojsonPath]);
                    delete geojsonLayers[geojsonPath];
                    console.log(`GeoJSON layer removed: ${geojsonPath}`);
                }

                if (markerLayers[geojsonPath]) {
                    map.removeLayer(markerLayers[geojsonPath]);
                    delete markerLayers[geojsonPath];
                    console.log(`Marker layer removed: ${geojsonPath}`);
                }

                // Tampilkan kembali legenda jika layer Persebaran Lokasi Puskesmas dihapus
                if (geojsonPath.toLowerCase().includes("persebaran lokasi puskesmas") && legendContainer) {
                    legendContainer.style.display = "block";
                }

                updateLegendWithImage(null);
            }
        }






        function generatePopupContent(properties) {
            let content = "<table style='width:100%; border-collapse:collapse;'><tbody>";

            for (const [key, value] of Object.entries(properties)) {
                content += `<tr>
            <td style='border:1px solid #ddd; padding:8px; font-size:12px;'>${key}</td>
            <td style='border:1px solid #ddd; padding:8px; font-size:12px;'>${value}</td>
        </tr>`;
            }

            content += "</tbody></table>";

            if (properties.nampkm) {
                content += `<button onclick="openDataPanel('${properties.nampkm}')"
            style="
                display: block;
                margin: 10px 0 0 auto;
                padding: 6px 12px;
                background: linear-gradient(90deg, #4CAF50, #66BB6A);
                color: white;
                border: none;
                border-radius: 2px;
                font-size: 13px;
                cursor: pointer;
                transition: background-color 0.2s ease, box-shadow 0.2s ease;
            "
            onmouseover="this.style.background='linear-gradient(90deg, #43A047, #5DAE60)'"
            onmouseout="this.style.background='linear-gradient(90deg, #4CAF50, #66BB6A)'">
            Lihat Selengkapnya
        </button>`;
            }

            return content;
        }


        let puskesmasChartInstance = null;

        function closePanelOnOutsideClick(event) {
            const panel = document.getElementById("data-panel");
            if (panel && !panel.contains(event.target)) {
                panel.style.display = "none";
                panel.classList.remove("active");
                document.removeEventListener("click", closePanelOnOutsideClick);
            }
        }

        function openDataPanel(namaPuskesmas) {
            const panel = document.getElementById("data-panel");
            const title = document.getElementById("panel-title");
            const content = document.getElementById("data-content");

            title.innerText = "";
            content.innerHTML = "";

            fetch(`/api/puskesmas/${encodeURIComponent(namaPuskesmas)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Data tidak ditemukan");
                    }
                    return response.json();
                })
                .then(data => {
                    title.innerText = data.title;
                    content.innerHTML = "";

                    const chartLabels = [];
                    const chartData = [];
                    const chartColors = [];

                    const colors = [
                        "#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF",
                        "#FF9F40", "#FFCD56", "#C9CBCF", "#7FC97F", "#D95F02"
                    ];

                    let colorIndex = 0;

                    for (const [category, values] of Object.entries(data.data)) {
                        content.innerHTML += `<h4 class="font-medium mt-4">${category}</h4>`;

                        for (const [type, amount] of Object.entries(values)) {
                            content.innerHTML += `<li>${type}: <strong>${amount}</strong></li>`;
                            chartLabels.push(`${category} - ${type}`);
                            chartData.push(amount);
                            chartColors.push(colors[colorIndex % colors.length]);
                            colorIndex++;
                        }

                        content.innerHTML += "</ul>";
                    }

                    if (puskesmasChartInstance) {
                        puskesmasChartInstance.destroy();
                    }

                    const ctx = document.getElementById("puskesmasChart").getContext("2d");

                    puskesmasChartInstance = new Chart(ctx, {
                        type: "pie",
                        data: {
                            labels: chartLabels,
                            datasets: [{
                                data: chartData,
                                backgroundColor: chartColors,
                                borderColor: "#ffffff",
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: "bottom",
                                    labels: {
                                        boxWidth: 8,
                                        font: {
                                            size: 8
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            return `${label}: ${context.parsed}`;
                                        }
                                    }
                                }
                            },
                            animation: {
                                animateScale: true,
                                animateRotate: true
                            }
                        }
                    });

                    panel.style.display = "block";
                    panel.style.right = "10px";
                    panel.classList.add("active");

                    setTimeout(() => {
                        document.addEventListener("click", closePanelOnOutsideClick);
                    }, 100);
                })
                .catch(error => {
                    alert(error.message);
                });
        }




        function closePanel() {
            const panel = document.getElementById("data-panel");
            panel.style.display = "none";
        }



        function loadGeoJSONSidebar(folderPath, imageFolderPath) {
            fetch(`${folderPath}/list-files.php`)
                .then(response => response.json())
                .then(files => {
                    const folderContainer = document.getElementById("folder-container");

                    if (files.length === 0) {
                        folderContainer.innerHTML = "<p>Tidak ada data GeoJSON.</p>";
                        return;
                    }
                    files.forEach(item => {
                        const {
                            name,
                            type
                        } = item;

                        if (type === "directory") {
                            const subfolderPath = `${folderPath}/${name}`;
                            const subImageFolderPath = `${imageFolderPath}/${name}`;

                            const detailsElement = document.createElement("details");
                            detailsElement.classList.add("folder-details");

                            const summaryElement = document.createElement("summary");
                            summaryElement.textContent = name;
                            detailsElement.appendChild(summaryElement);

                            const subfolderContainer = document.createElement("div");
                            subfolderContainer.classList.add("subfolder-container");
                            detailsElement.appendChild(subfolderContainer);

                            folderContainer.appendChild(detailsElement);

                            fetch(`${subfolderPath}/list-files.php`)
                                .then(response => response.json())
                                .then(subFiles => {
                                    subFiles.forEach(subItem => {
                                        const {
                                            name: subName,
                                            type: subType
                                        } = subItem;

                                        if (subType === "file" && subName.endsWith('.geojson')) {
                                            const geojsonPath = `${subfolderPath}/${subName}`;
                                            const imagePath =
                                                `${subImageFolderPath}/${subName.replace('.geojson', '.png')}`;
                                            createCheckboxControl(subfolderContainer, subName,
                                                geojsonPath, imagePath);
                                        }
                                    });
                                })
                                .catch(error => console.error(`Error fetching files in subfolder ${name}:`,
                                    error));
                        }
                    });
                })
                .catch(error => console.error("Error fetching GeoJSON files:", error));
        }

        function createCheckboxControl(container, fileName, geojsonPath, imagePath) {
            const checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.id = `toggle-${fileName}`;
            checkbox.dataset.geojsonPath = geojsonPath;
            checkbox.dataset.imagePath = imagePath;

            const label = document.createElement("label");
            label.htmlFor = `toggle-${fileName}`;
            label.innerText = fileName.replace(".geojson", "");

            const opacitySlider = document.createElement("input");
            opacitySlider.type = "range";
            opacitySlider.min = "0";
            opacitySlider.max = "1";
            opacitySlider.step = "0.1";
            opacitySlider.value = "1";
            opacitySlider.classList.add("opacity-slider");
            opacitySlider.style.display = "none";

            //  Event listener buat opacity slider
            opacitySlider.addEventListener("input", event => {
                const opacity = parseFloat(event.target.value);
                updateLayerOpacity(geojsonPath, opacity);
            });

            checkbox.addEventListener("change", event => {
                const geojsonPath = event.target.dataset.geojsonPath;
                const imagePath = event.target.dataset.imagePath;
                const isChecked = event.target.checked;

                toggleGeoJSONLayer(geojsonPath, imagePath, isChecked);

                //  Munculin/hide slider saat layer diaktifkan/nonaktifkan
                opacitySlider.style.display = isChecked ? "block" : "none";
            });

            container.appendChild(checkbox);
            container.appendChild(label);
            container.appendChild(opacitySlider);
            container.appendChild(document.createElement("br"));
        }


        function removeLayerFromMap(geojsonPath) {
            if (layers[geojsonPath]) {
                map.removeLayer(layers[geojsonPath]);
                delete layers[geojsonPath];
            }
        }

        const geojsonLayers = {};
        const markerLayers = {};
        const geojsonFolderPath = "{{ asset('assets/geojson') }}";
        const imageFolderPath = "{{ asset('assets/image') }}";
        loadGeoJSONFromFolder(geojsonFolderPath, imageFolderPath);
        loadGeoJSONSidebar(geojsonFolderPath, imageFolderPath);

        const featureColors = {};

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function getColor(value) {
            if (value <= 50) {
                return '#FF0000';
            } else if (value <= 60) {
                return '#FFFF00';
            } else {
                return '#00FF00';
            }
        }

        const kecamatanData = {
            "Kabuh": 56.82,
            "Jombang": 50.59,
            "Sumobito": 61.91,
            "Wonosalam": 57.21,
            "Tembelang": 47.54,
            "Ploso": 56.89,
            "Plandaan": 52.84,
            "Peterongan": 56.36,
            "Perak": 61.07,
            "Ngusikan": 61.68,
            "Ngoro": 61.63,
            "Mojowarno": 58.35,
            "Mojoagung": 52.15,
            "Megaluh": 57.81,
            "Kudu": 52.97,
            "Kesamben": 51.09,
            "Jogoroto": 55.83,
            "Gudo": 60.28,
            "Diwek": 54.20,
            "Bareng": 56.65,
            "Bandarkedungmulyo": 62.18
        };

        const opdDataByNumber = {
            "Badan Kepegawaian Daerah (BKD)": 48.91,
            "Badan Kesatuan Bangsa dan Politik (Bakesbangpol)": 94.06,
            "Badan Penanggulangan Bencana Daerah (BPBD)": 53.15,
            "Bapenda": 40.65,
            "Badan Pengelola Keuangan dan Aset Daerah (BPKAD)": 78.68,
            "Badan Perencanaan Pembangunan Daerah (Bappeda)": 52.35,
            "Dinas Pariwisata, Kepemudaan, dan Olahraga": 57.55,
            "Dinas Kependudukan dan Pencatatan Sipil": 55.78,
            "Dinas Kesehatan": 49.30,
            "Dinas dan Ketahanan Pangan dan Perikanan": 50.95,
            "Dinas Komunikasi dan Informatika": 38.49,
            "Dinas Koperasi dan Usaha Mikro": 54.87,
            "Dinas Lingkungan Hidup": 35.01,
            "Dinas Perumahan Rakyat dan Kawasan Permukiman": 43.82,
            "Dinas Pemberdayaan Masyarakat dan Desa": 52.38,
            "Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu": 51.23,
            "Dinas Pendidikan dan Kebudayaan": 50.05,
            "Dinas Pengendalian Penduduk dan Keluarga Berencana dan Pemberdayaan Perempuan dan Perlindungan Anak": 56.47,
            "Dinas Perdagangan dan Perindustrian": 54.58,
            "Dinas Perhubungan": 41.22,
            "Dinas Perpustakaan dan Kearsipan": 57.38,
            "Dinas Pertanian": 30.90,
            "Dinas Peternakan": 61.37,
            "Dinas Tenaga Kerja": 22.50,
            "Dinas Sosial": 56.16,
            "Inspektorat": 57.67,
            "RSUD Jombang": 44.29,
            "RSUD Ploso": 47.77,
            "Satpol PP": 57.67,
            "Sekretariat Daerah kabupaten jombang": 55.09,
            "Sekretariat Daerah DPRD": 55.09
        };

        function getColor(percentage) {
            if (percentage <= 50) {
                return 'red';
            } else if (percentage <= 60) {
                return 'yellow'; // Kuning untuk 51-60
            } else {
                return 'green'; // Hijau untuk 61-100
            }
        }
    </script>
    <div id="infoModal" class="modal">
        <div class="modal-content">
            <h3 id="modalTitle"></h3>
            <div id="modalBody"></div>

        </div>
    </div>


    <div id="data-panel" class="sidebar" style="display: none;">
        <button onclick="closePanel()"
            style="position: absolute; top: 5px; right: 5px; background: none; border: none; font-size: 16px; cursor: pointer;">×</button>
        <h2 id="panel-title" class="text-lg font-semibold mb-2">Data Puskesmas</h2>
        <canvas id="puskesmasChart" style="max-height: 50%;"></canvas>
        <div id="data-content" class="overflow-y-auto" style="max-height: 45%;"></div>
    </div>



    <div id="chart-overlay">
        <canvas id="pie-chart" style="width: 300px; height: 300px;"></canvas>
        <button onclick="closeChart()"
            style="position: absolute; top: 5px; right: 5px; background: none; border: none; font-size: 16px; cursor: pointer;">×</button>
    </div>
    <canvas id="dataChart" style="display:none; width:400px; height:400px;"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        #icon-sidebar {
            position: absolute;
            top: 21%;
            right: 20px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 1000;
        }

        .sidebar-icon {
            font-size: 20px;
            color: #515151;
            cursor: pointer;
            padding: 10px;
            background: white;
            border-radius: 15%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
        }

        .sidebar-icon:hover {
            transform: scale(1.1);
            color: #45484b;
        }

        #data-panel {
            position: fixed;
            top: 49%;
            right: 10px;
            transform: translateY(-50%);
            width: 250px;
            max-width: 70vw;
            max-height: 90vh;
            overflow-y: auto;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            padding: 15px;
            z-index: 1000;
            font-size: 10px;
        }

        #data-panel h4 {
            font-size: 10px;
            font-weight: bold;
            margin-top: 10px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 3px;
        }

        #data-panel::-webkit-scrollbar {
            width: 6px;
        }

        #data-panel::-webkit-scrollbar-track {
            background: transparent;
        }

        #data-panel::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
        }

        #data-panel::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        #data-content ul {
            background: #f8f9fa;
            padding: 8px;
            border-radius: 8px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        #data-content li {
            padding: 3px 0;
            font-size: 12px;
            color: #555;
        }

        #data-content li strong {
            font-weight: bold;
            color: #222;
        }



        @media (max-width: 768px) {
            #data-panel {
                width: 30%;
                right: 5%;
                transform: translateY(-50%);
            }
        }

        #chart-overlay {
            display: none;
            position: absolute;
            top: 12%;
            right: 10px;
            z-index: 1000;
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-button {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9));
            color: white;
            border: none;
            border-radius: 5px;
            text-align: left;
            font-size: 14px;
            cursor: pointer;
        }
    </style>

    <script>
        let myPieChart = null;

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".category-button").forEach(button => {
                button.addEventListener("click", function() {
                    const category = this.dataset.category;
                    const location = this.dataset.location;

                    console.log("Kategori:", category, "Lokasi:", location);
                    togglePanel(category, location);
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("checkbox");

            if (!checkbox) {
                console.error("Checkbox tidak ditemukan di DOM!");
                return;
            }

            checkbox.addEventListener("change", event => {
                const geojsonPath = event.target.dataset.geojsonPath;
                const imagePath = event.target.dataset.imagePath;

                toggleGeoJSONLayer(geojsonPath, imagePath, event.target.checked);

                // sidebar otomatis puskesmas
                if (fileName.includes("Sebaran Puskesmas")) {
                    const sidebarIcon = document.querySelector(".bi-hospital");

                    if (event.target.checked) {
                        if (sidebarIcon) {
                            sidebarIcon.click();
                        }
                    } else {
                        closeChart();
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const detailButton = document.querySelector("#pelajari-btn");
            const legendContainer = document.querySelector("#legend-container");

            if (detailButton && legendContainer) {
                detailButton.addEventListener("click", function() {
                    legendContainer.style.display = "none";
                });
            }
        });

        function togglePanel(category, location = null) {
            const panel = document.getElementById("data-panel");
            const title = document.getElementById("panel-title");
            const content = document.getElementById("data-content");

            if (panel.style.display === "block" && title.innerText === dataSets[category].title) {
                closePanel();
                return;
            }

            title.innerText = dataSets[category].title;
            content.innerHTML = "";

            if (dataSets[category].locations) {
                for (const key in dataSets[category].locations) {
                    let button = document.createElement("button");
                    button.classList.add("category-button");
                    button.dataset.category = category;
                    button.dataset.location = key;
                    button.innerText = dataSets[category].locations[key].title;
                    button.onclick = function() {
                        showPieChart(category, key);
                    };
                    content.appendChild(button);
                }
            }

            panel.style.right = "10px";
            panel.style.display = "block";
            panel.classList.add("active");
        }

        function showPieChart(category, location) {
            const chartOverlay = document.getElementById("chart-overlay");
            const ctx = document.getElementById("pie-chart").getContext("2d");

            if (!dataSets[category].locations[location].data) {
                console.log("Tidak ada data untuk lokasi:", location);
                return;
            }

            // Menggabungkan data ASN & Non ASN dalam satu pie chart
            let labels = [];
            let values = [];
            let colors = ["#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0"];

            Object.entries(dataSets[category].locations[location].data).forEach(([key, value], index) => {
                labels.push(`${key} - ASN`);
                values.push(value["ASN"]);
                labels.push(`${key} - Non ASN`);
                values.push(value["Non ASN"]);
            });

            chartOverlay.style.display = "block";

            if (myPieChart) {
                myPieChart.destroy();
            }

            myPieChart = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            "#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0",
                            "#FF9F40", "#9966FF", "#C9CBCF", "#FF6384"
                        ],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    aspectRatio: 2,
                    plugins: {
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                font: {
                                    size: 10
                                },
                                boxWidth: 12,
                                usePointStyle: true
                            }
                        },
                        title: {
                            display: true,
                            text: dataSets[category].locations[location].title,
                            font: {
                                size: 12
                            }
                        }
                    },
                    layout: {
                        padding: {
                            bottom: 10
                        }
                    }
                }
            });
        }

        function showLocationData(category, location) {
            const panel = document.getElementById("data-panel");
            const title = document.getElementById("panel-title");
            const content = document.getElementById("data-content");

            let locationData = dataSets[category].locations[location];

            title.innerText = locationData.title;
            content.innerHTML = "";

            Object.keys(locationData.data).forEach(label => {
                let subList = document.createElement("ul");
                subList.innerHTML = `<b>${label}</b>`;

                Object.keys(locationData.data[label]).forEach(subCategory => {
                    let listItem = document.createElement("li");
                    let checkbox = document.createElement("input");
                    checkbox.type = "checkbox";
                    checkbox.onchange = () => togglePieChart(checkbox, [locationData.data[label][
                        subCategory
                    ]], `${label} - ${subCategory}`);
                    listItem.appendChild(checkbox);
                    listItem.appendChild(document.createTextNode(
                        ` ${subCategory}: ${locationData.data[label][subCategory]}`));
                    subList.appendChild(listItem);
                });

                content.appendChild(subList);
            });
        }

        function closePanel() {
            const panel = document.getElementById("data-panel");
            panel.style.display = "none";
            panel.classList.remove("active"); // Hapus status active
        }

        function togglePieChart(checkbox, label) {
            console.log("Checkbox diklik untuk:", label, "Checked:", checkbox.checked);

            const chartOverlay = document.getElementById("chart-overlay");

            if (checkbox.checked) {
                chartOverlay.style.display = "block";

                const ctx = document.getElementById('pie-chart').getContext('2d');
                if (myPieChart) {
                    myPieChart.destroy();
                }

                const values = JSON.parse(checkbox.dataset.values);

                console.log("Menampilkan chart dengan data:", values);

                myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['ASN', 'Non ASN'],
                        datasets: [{
                            label: label,
                            data: [values["ASN"], values["Non ASN"]],
                            backgroundColor: ['#FF6384', '#36A2EB'],
                            hoverOffset: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: label
                            }
                        }
                    }
                });
            } else {
                closeChart();
            }
        }

        function closeChart() {
            document.getElementById("chart-overlay").style.display = "none";
            if (myPieChart) {
                myPieChart.destroy();
            }
        }
    </script>



</html>
