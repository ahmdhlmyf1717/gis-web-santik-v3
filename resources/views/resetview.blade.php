<style>
    .reset-btn {
        position: fixed;
        bottom: 190px;
        right: 12px;
        background-color: white;
        border: 2px solid #bababa;
        border-radius: 10%;
        width: 45px;
        height: 45px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        z-index: 1000;
    }

    .reset-btn:hover {
        background-color: #f1f1f1;
    }

    .reset-btn i {
        color: #7f7f7f;
    }
</style>
<script>
    //reset view
    var latitude = -7.55555589792736;
    var longitude = 112.22681069495013;
    var zoomLevel = 10;

    var resetButton = L.Control.extend({
        options: {
            position: 'topright'
        },

        onAdd: function(map) {
            var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
            var link = L.DomUtil.create('a', 'leaflet-control-reset', container);
            link.href = '#';
            link.title = 'Reset View';

            var icon = L.DomUtil.create('i', 'fa-solid fa-dove', link);

            L.DomEvent.on(link, 'click', function(e) {
                L.DomEvent.stopPropagation(e);

                map.setView([latitude, longitude], zoomLevel);
            });

            return container;
        }
    });
    map.addControl(new resetButton());
</script>
