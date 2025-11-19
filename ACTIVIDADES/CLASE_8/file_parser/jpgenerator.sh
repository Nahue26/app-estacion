#!/bin/bash

echo "==> Ejecutando"

mkdir -p fotos

for (( i = 0; i <= 1024; i++ )); do
	echo "" | cat > fotos/$i.jpg
done

echo "==> Fin"
