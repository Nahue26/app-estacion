@extends(head)

<a href="index.php?v=administrator" class="btn" style="margin:20px; display:inline-block;">
    Volver
</a>

<div id="map" style="height:85vh; width:100%;"></div>

<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
// Obtener datos desde la API interna
fetch("index.php?v=api&action=list-clients-location")
    .then(r => r.json())
    .then(data => {

        // Crear mapa
        let map = L.map('map').setView([0, 0], 2);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 18,
        }).addTo(map);

        // Agregar marcadores
        data.forEach(c => {
            if (c.latitud && c.longitud) {
                
                L.marker([c.latitud, c.longitud])
                    .addTo(map)
                    .bindPopup(`
                        <b>IP:</b> ${c.ip}<br>
                        <b>Accesos:</b> ${c.accesos}
                    `);
            }
        });
    });
</script>

@extends(footer)
