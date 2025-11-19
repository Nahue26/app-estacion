#!/bin/bash

cantidad=$1
carpeta=$2

if [ -z "$cantidad" ] || [ -z "$carpeta" ]; then
  echo " Uso: ./order.sh <cantidad_por_carpeta> <carpeta>"
  exit 1
fi

if [ ! -d "$carpeta" ]; then
  echo " La carpeta '$carpeta' no existe"
  exit 1
fi

if ! [[ "$cantidad" =~ ^[0-9]+$ ]]; then
  echo " El primer parámetro debe ser un número"
  exit 1
fi

cd "$carpeta"

items=( * )
total=${#items[@]}
index=0
carpeta_num=1

while [ $index -lt $total ]; do
  nombre_carpeta="$carpeta_num"
  mkdir "$nombre_carpeta"
  
  for ((i=0; i<$cantidad && $index<$total; i++)); do
    mv "${items[$index]}" "$nombre_carpeta/"
    ((index++))
  done
  
  ((carpeta_num++))
done

echo "Se movieron $total elementos en carpetas de $cantidad"