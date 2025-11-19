#!/bin/bash

# Crea una carpeta y una cantidad específica de archivos JPG

# Primer parámetro: nombre de la carpeta
carpeta="$1"

# Segundo parámetro: cantidad de archivos a crear
cantidad="$2"

# Crea la carpeta (si no existe)
mkdir -p "$carpeta"

# Crea los archivos JPG vacíos
for ((i=1; i<=cantidad; i++)); do
  echo "" > "$carpeta/$i.jpg"
done

# Mensaje final
echo "Se generaron $cantidad archivos JPG en la carpeta $carpeta."
