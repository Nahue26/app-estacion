#!/bin/bash

echo " ==> Ejecuntando"
mascara=$1
carpeta=$2

if [ -z "$mascara" ] || [ -z "$carpeta" ]; then
  echo " Uso: ./autorename.sh <mascara> <carpeta>"
  exit 1
fi


if [ ! -d "$carpeta" ]; then
  echo "La carpeta '$carpeta' no existe"
  exit 1
fi

cd "$carpeta"

for archivo in *.jpg; do
  mv "$archivo" "${mascara}_$archivo"
done

echo "Archivos renombrados correctamente con la máscara '$mascara_'"


echo "==> Fin"