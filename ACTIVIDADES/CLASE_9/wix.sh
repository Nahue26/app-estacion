#!/bin/bash

# Pedir al usuario el nombre del proyecto
echo "Escribí el nombre del nuevo proyecto y presioná enter:"
read nombre

# Repetir menú hasta que elijan algo válido
while true; do
  echo ""
  echo "¿Qué tipo de proyecto querés crear?"
  echo "1) Carpeta vacía"
  echo "2) Solo estructura de carpetas"
  echo "3) Con ejemplos cargados"
  echo "4) Salir"
  read -p "Elegí una opción: " opcion

  # Crear carpeta principal e index vacío
  mkdir "$nombre"
  echo "" > "$nombre/index.php"

  case "$opcion" in
    1|"Vacío"|"vacío")
      echo "Se creó el proyecto '$nombre' sin nada dentro."
      exit 0
      ;;
    
    2|"Estructura"|"estructura")
      # Armo la estructura básica de carpetas
      mkdir -p "$nombre/css/user" "$nombre/css/admin"
      mkdir -p "$nombre/img/avatars" "$nombre/img/buttons" "$nombre/img/products" "$nombre/img/pets"
      mkdir -p "$nombre/js/validations" "$nombre/js/effects"
      mkdir -p "$nombre/tpl" "$nombre/php"

      echo "Se armó el proyecto '$nombre' con carpetas listas."
      exit 0
      ;;
    
    3|"Ejemplo"|"ejemplo")
      # CSS
      mkdir -p "$nombre/css/user" "$nombre/css/admin"
      echo "" > "$nombre/css/user/estilo.css"
      echo "" > "$nombre/css/admin/estilo.css"

      # Imágenes
      mkdir -p "$nombre/img/avatars" "$nombre/img/buttons" "$nombre/img/products" "$nombre/img/pets"

      # JS
      mkdir -p "$nombre/js/validations" "$nombre/js/effects"
      echo "" > "$nombre/js/validations/login.js"
      echo "" > "$nombre/js/validations/register.js"
      echo "" > "$nombre/js/effects/panel.js"

      # Plantillas
      mkdir -p "$nombre/tpl"
      for tpl in main login register panel profile crud; do
        echo "" > "$nombre/tpl/$tpl.tpl"
      done

      # PHP
      mkdir -p "$nombre/php"
      for php in create read update delete dbconect; do
        echo "" > "$nombre/php/$php.php"
      done

      # Index con título
      cat <<EOF > "$nombre/index.php"
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>$nombre</title>
</head>
<body>
  <h1>$nombre</h1>
</body>
</html>
EOF

      echo "Se generó el proyecto '$nombre' con ejemplos incluidos."
      exit 0
      ;;

    4|"Salir"|"salir")
      echo "Cerrando el script..."
      exit 0
      ;;
    
    *)
      echo "Opción inválida, probá de nuevo."
      ;;
  esac
done
