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
            left: 0px;
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
            border-right: 2px solid #e5e7eb82;
            border-radius: 15px;
        }

        #sidebar.open {
            transform: translateX(0);
            opacity: 1;
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
            margin-bottom: 5px;
            margin-top: 20px;
            width: 92%;
            max-width: 600px;
            box-sizing: border-box;
            margin-left: auto;
            margin-right: auto;
        }

        .tab-button {
            border-radius: 5px;
            flex: 1;
            padding: 10px;
            text-align: center;
            background: #f4f4f4;
            border: none;
            transition: background-color 0.3s;
            box-sizing: border-box;
        }

        .tab-button.active {
            background: linear-gradient(135deg, rgba(61, 172, 20, 0.95), rgba(34, 112, 10, 0.9));
            font-weight: bold;
            box-sizing: border-box;
            color: white;
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
            right: 10px;
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
            <button class="tab-button active" data-tab="menu-tab"><i class="bi bi-folder2"></i> Daftar OPD</button>
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

    <script>
        function showPopup(iframeId) {
            const iframeContent = {
                'iframe-bpkad': '<iframe width="100%" height="400" seamless frameborder="0" scrolling="yes" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vSv4fcd29BLBBvk8A7aWa-mJiW-NH1gW-RVAyIubJ1fvuKdWLv-LjqPpzgbdwaSDzuRnlFqx8vRc4Ug/pubchart?oid=2123918905&amp;format=interactive"></iframe><p>Sumber : Badan Pengelolaan Keuangan dan Aset Daerah</p>'
            };
            document.getElementById('iframe-container').innerHTML = iframeContent[iframeId] || '';
            document.getElementById('iframe-popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('iframe-popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('iframe-container').innerHTML = '';
        }
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
    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>

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
                <img src="${imagePath}" alt="Legenda" style="max-width: 100%; border: 1px solid #000;">
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
                        files.forEach(file => {
                            const checkbox = document.createElement("input");
                            checkbox.type = "checkbox";
                            checkbox.id = `layer-${file}`;
                            checkbox.dataset.geojsonPath = `${folderPath}/${file}`;
                            checkbox.dataset.imagePath =
                                `${imageFolderPath}/${file.replace(".geojson", ".png")}`;

                            const label = document.createElement("label");
                            label.htmlFor = checkbox.id;
                            label.textContent = file.replace(".geojson", "");

                            const container = document.createElement("div");
                            container.appendChild(checkbox);
                            container.appendChild(label);
                            folderContainer.appendChild(container);

                            checkbox.addEventListener("change", event => {
                                const geojsonPath = event.target.dataset.geojsonPath;
                                const imagePath = event.target.dataset.imagePath;

                                if (event.target.checked) {
                                    toggleGeoJSONLayer(geojsonPath, imagePath, true);
                                } else {
                                    toggleGeoJSONLayer(geojsonPath, imagePath, false);
                                }
                            });
                        });
                    })
                    .catch(err => {
                        console.error("Error fetching GeoJSON file list:", err);
                    });
            });
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
            const popupContent = generatePopupContent(feature.properties);
            layer.bindPopup(popupContent);

            const lat = feature.properties.Lintang;
            const lng = feature.properties.Bujur;

            if (lat !== undefined && lng !== undefined) {
                const no = feature.properties.No;
                const percentage = opdDataByNumber[no];
                const color = percentage ? getColor(percentage) : '#000000';

                if (!markerLayers[geojsonPath]) {
                    markerLayers[geojsonPath] = L.layerGroup();
                }

                const marker = L.circleMarker([lat, lng], {
                    radius: 10,
                    fillColor: color,
                    color: '#000',
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                });

                marker.bindPopup(popupContent);
                markerLayers[geojsonPath].addLayer(marker);
            }
        }

        function toggleGeoJSONLayer(geojsonPath, imagePath, addLayer = true) {

            if (addLayer) {

                fetch(geojsonPath)
                    .then(response => response.json())
                    .then(data => {
                        if (geojsonLayers[geojsonPath]) {
                            map.removeLayer(geojsonLayers[geojsonPath]);
                        }
                        if (markerLayers[geojsonPath]) {
                            map.removeLayer(markerLayers[geojsonPath]);
                        }

                        const isVillageBoundary = geojsonPath.toLowerCase().includes('batas_desa') ||
                            (data.features.length > 0 && data.features[0].properties.hasOwnProperty('wadmkd'));

                        geojsonLayers[geojsonPath] = L.geoJson(data, {
                            style: styleFeature,
                            onEachFeature: (feature, layer) => {
                                const popupContent = generatePopupContent(feature.properties);
                                layer.bindPopup(popupContent);

                                onEachFeature(feature, layer, geojsonPath);
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
                if (geojsonLayers[geojsonPath]) {
                    map.removeLayer(geojsonLayers[geojsonPath]);
                    delete geojsonLayers[geojsonPath];
                }

                if (markerLayers[geojsonPath]) {
                    map.removeLayer(markerLayers[geojsonPath]);
                    delete markerLayers[geojsonPath];
                }

                updateLegendWithImage(null);
            }
        }

        function generatePopupContent(properties) {
            let content = "<table style='width:100%; border-collapse:collapse;'>";
            content += "<tbody>";
            for (const [key, value] of Object.entries(properties)) {
                content += `<tr>
                <td style='border:1px solid #ddd; padding:8px; font-size:12px;'>${key}</td>
                <td style='border:1px solid #ddd; padding:8px; font-size:12px;'>${value}</td>
            </tr>`;
            }
            content += "</tbody></table>";
            return content;
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

            checkbox.addEventListener("change", event => {
                const geojsonPath = event.target.dataset.geojsonPath;
                const imagePath = event.target.dataset.imagePath;

                toggleGeoJSONLayer(geojsonPath, imagePath, event.target.checked);
            });

            container.appendChild(checkbox);
            container.appendChild(label);

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
            1: 48.91, // BKPSDM
            2: 94.06, // Bakesbangpol
            3: 53.15, // BPBD
            4: 40.65, // Bapenda
            5: 78.68, // BPKAD
            6: 52.35, // Bappeda
            7: 57.55, // Disparpor
            8: 55.78, // Disdukcapil
            9: 49.30, // Dinkes
            10: 50.95, // DKPP
            11: 38.49, // Diskominfo
            12: 54.87, // Diskop UKM
            13: 35.01, // DLH
            14: 43.82, // DPU PR
            15: 52.38, // DPMD
            16: 51.23, // DPMPTSP
            17: 50.05, // Disdikbud
            18: 56.47, // DP3AKB
            19: 54.58, // Dispargin
            20: 41.22, // Dishub
            21: 57.38, // Dispusp
            22: 30.90, // Distan
            23: 61.37, // Disperink
            24: 22.50, // Disnaker
            25: 56.16, // Dinsos
            26: 57.67, // Inspektorat
            27: 44.29, // RSUD Jombang
            28: 47.77, // RSUD Ploso
            29: 57.67, // Satpol PP
            30: 55.09, // Setda
            31: 55.09 // Setwan
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
</body>

</html>
