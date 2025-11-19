<?php

function listar($ruta) {
    echo "<h2>📁 $ruta</h2>";
    
    $archivos = scandir($ruta);

    echo "<ul>";
    foreach ($archivos as $a) {
        if ($a !== "." && $a !== "..") {
            echo "<li>$a</li>";
        }
    }
    echo "</ul>";
}

listar("controllers");
listar("views");
listar("views/extends");
listar(".");
