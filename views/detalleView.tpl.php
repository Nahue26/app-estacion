<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ nombre }}</title>

    <link rel="stylesheet" href="views/static/css/detalle.css">
</head>
<body>

<section class="detalle">
  <div class="detalle__contenedor">
    <h2 class="detalle__titulo">{{ nombre }}</h2>
    <p class="detalle__texto">Visualización de los datos de la estación en tiempo real.</p>
    <a href="?v=panel" class="detalle__boton">← Volver al panel</a>

    <div class="graficos">
      <div class="grafico-card">
        <h3>Temperatura (°C)</h3>
        <canvas id="chartTemp"></canvas>
      </div>
      <div class="grafico-card">
        <h3>Humedad (%)</h3>
        <canvas id="chartHum"></canvas>
      </div>
      <div class="grafico-card">
        <h3>Presión (hPa)</h3>
        <canvas id="chartPres"></canvas>
      </div>
      <div class="grafico-card">
        <h3>Viento (km/h)</h3>
        <canvas id="chartViento"></canvas>
      </div>
      <div class="grafico-card">
        <h3>Riesgo de Incendio</h3>
        <canvas id="chartRiesgo"></canvas>
      </div>
    </div>
  </div>
</section>

<!-- Librería Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", async () => {
  const params = new URLSearchParams(window.location.search);
  const chipid = params.get("id");
  if (!chipid) return;

  const crear = (id, label, color) =>
    new Chart(document.getElementById(id), {
      type: 'line',
      data: { labels: [], datasets: [{ label, data: [], borderColor: color, fill: false }] },
      options: { responsive: true }
    });

  const chartTemp = crear("chartTemp", "Temperatura", "#E63946");
  const chartHum = crear("chartHum", "Humedad", "#1D3557");
  const chartPres = crear("chartPres", "Presión", "#457B9D");
  const chartViento = crear("chartViento", "Viento", "#2A9D8F");
  const chartRiesgo = crear("chartRiesgo", "FWI", "#F4A261");

  async function actualizar() {
    try {
      // Pedimos los datos reales de la API
      const res = await fetch(`datos.php?chipid=${chipid}&cant=1`);
      const datos = await res.json();

      if (!Array.isArray(datos) || !datos.length) return;

      const d = datos[0];
      const hora = new Date().toLocaleTimeString();

      const push = (chart, v) => {
        if (chart.data.labels.length > 10) {
          chart.data.labels.shift();
          chart.data.datasets[0].data.shift();
        }
        chart.data.labels.push(hora);
        chart.data.datasets[0].data.push(v);
        chart.update();
      };

      push(chartTemp, parseFloat(d.temperatura));
      push(chartHum, parseFloat(d.humedad));
      push(chartPres, parseFloat(d.presion));
      push(chartViento, parseFloat(d.viento));
      push(chartRiesgo, parseFloat(d.fwi));

    } catch (error) {
      console.error("Error cargando datos:", error);
    }
  }

  actualizar();
  setInterval(actualizar, 60000);
});

</script>

</body>
</html>
