#!/bin/bash
echo "Ejecutando"
for i in  $(cat /71alumnos.txt); do
	if [[ $i == "#" ]]; then
		echo "Inicia renglon"
	fi
done
echo "Fin"