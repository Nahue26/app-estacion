#!/bin/bash

while true; do
  echo "Realmente quiere eliminar $1 y todo su contenido?-Si/No"
  read respuesta

  case "$respuesta" in
    [nN][oO])
      echo "Cancelado. No se borró nada."
      exit 0
      ;;

    [sS][iI])
      if [ -d "$1" ]; then
        contador=0

        for item in "$1"/* "$1"/.*; do
          nombre="$item"

          if [ "$nombre" != "$1/." ] && [ "$nombre" != "$1/.." ]; then
            echo "Eliminando $nombre"
            rm -rf "$nombre"
            contador=$((contador + 1))
          fi
        done

        rm -rf "$1"
        echo "Se eliminaron $contador elementos y la carpeta $1."
      else
        echo "La carpeta $1 no existe."
      fi
      exit 0
      ;;

    *)
      echo "Respuesta no válida. Intente de nuevo."
      ;;
  esac
done
