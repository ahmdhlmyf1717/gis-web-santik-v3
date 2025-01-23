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
