<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estaciones</title>
    <link rel="stylesheet" href="views/static/css/panel.css">
</head>
<body>

<header class="panel-header">
    <div style="text-align: right; margin-bottom: 10px;">
        <a href="index.php?v=logout" style="color: #333; text-decoration: none; font-weight: bold;">Cerrar Sesión</a>
    </div>
    <h1>Panel de Estaciones</h1>
    <p>Seleccioná una estación para ver sus datos.</p>
</header>

<section class="panel-container">
    <ul id="lista" class="estaciones-grid"></ul>

    <template id="tpl">
        <li class="estacion-card">
            <div class="estacion-content">
                <div class="estacion-apodo"></div>
                <div class="estacion-ubicacion"></div>
                <div class="estacion-visitas"></div>
            </div>
        </li>
    </template>
</section>

<script>


  document.addEventListener("DOMContentLoaded", async () => {
  console.log("Script panelView cargado correctamente");

  try {
    
    const res = await fetch("datos.php?mode=list-stations");
    const data = await res.json();



    console.log(" Datos recibidos:", data);

    const lista = document.querySelector("#lista");
    const tpl = document.querySelector("#tpl");

    data.forEach(estacion => {
      const clon = tpl.content.cloneNode(true);
      clon.querySelector(".estacion-apodo").textContent = estacion.apodo;
      clon.querySelector(".estacion-ubicacion").textContent = estacion.ubicacion;
      clon.querySelector(".estacion-visitas").textContent = estacion.visitas;
      lista.appendChild(clon);
      const li = lista.lastElementChild;
      li.addEventListener('click', () => {
        window.location.href = `?v=detalle&id=${estacion.chipid}`;
      });
    });

  } catch (error) {
    console.error("Error cargando estaciones:", error);
    const lista = document.querySelector("#lista");
    if (lista) {
      lista.innerHTML = `<p style='color:red; text-align:center;'> Error al cargar estaciones.</p>`;
    }
  }
});

</script>

</body>
</html>