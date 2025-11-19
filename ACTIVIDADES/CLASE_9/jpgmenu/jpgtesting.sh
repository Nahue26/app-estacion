#!/bin/bash

# Menú interactivo para probar scripts JPG

while true; do
  # Mostrar menú principal
  echo ""
  echo "Testing de scripts JPG:"
  echo "1) Generar JPGs"
  echo "2) Ordenar JPGs"
  echo "3) Eliminar JPGs"
  echo "4) Salir"
  read -p "Seleccione una opción: " opcion

  # Opción 1: Generar JPGs
  if [ "$opcion" = "1" ]; then
    # Solicita carpeta y cantidad, luego ejecuta jpgenerator
    read -p "Ingrese el nombre de la carpeta: " carpeta
    read -p "Ingrese la cantidad de archivos JPG a crear: " cantidad
    ./jpgenerator.sh "$carpeta" "$cantidad"
    echo "Se ha generado $carpeta y $cantidad JPGs dentro."

  # Opción 2: Ordenar JPGs
  elif [ "$opcion" = "2" ]; then
    # Solicita carpeta y cuenta archivos sin usar wc
    read -p "Ingrese el nombre de la carpeta: " carpeta
    total=0
    for archivo in "$carpeta"/*.jpg; do
      [ -f "$archivo" ] && total=$((total + 1))
    done

    echo "$carpeta contiene $total archivos"
    read -p "Ingrese cantidad de archivos por carpeta: " porcarpeta
    ./order.sh "$carpeta" "$porcarpeta"

  # Opción 3: Eliminar JPGs
  elif [ "$opcion" = "3" ]; then
    # Solicita nombre de carpeta y ejecuta jpgdelete
    read -p "Ingrese el nombre de la carpeta a eliminar: " carpeta
    ./jpgdelete.sh "$carpeta"

  # Opción 4: Salir del menú
  elif [ "$opcion" = "4" ]; then
    echo "Saliendo..."
    exit 0

  # Si la opción no es válida, mostrar mensaje
  else
    echo "Opción no válida. Intente nuevamente."
  fi
done
