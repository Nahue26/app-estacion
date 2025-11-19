#!/bin/bash

# Recibe: 1) Carpeta con archivos JPG, 2) Cantidad de archivos por subcarpeta
carpeta="$1"
cantidad="$2"

# Contadores: archivos por grupo y número de subcarpeta
contador=0
sub=1

# Crea la primera subcarpeta
mkdir -p "$carpeta/grupo_$sub"

# Recorre todos los archivos .jpg de la carpeta
for archivo in "$carpeta"/*.jpg; do
  # Mueve archivo a la subcarpeta actual
  mv "$archivo" "$carpeta/grupo_$sub/"

  # Suma uno al contador
  contador=$((contador + 1))

  # Si llegó al límite, reinicia contador y crea nuevo grupo
  if [ "$contador" -eq "$cantidad" ]; then
    sub=$((sub + 1))
    contador=0
    mkdir -p "$carpeta/grupo_$sub"
  fi
done

# Mensaje de confirmación
echo "Archivos organizados en subcarpetas de $cantidad archivos."
