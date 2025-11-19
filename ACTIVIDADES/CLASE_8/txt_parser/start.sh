#!/bin/bash
echo "Ejecutando"
alumnos=0
grupo1=0
grupo2=0
for i in $(cat /71alumnos.txt); do
	if [[ $i == "#" ]]; then
		alumnos=$((alumnos + 1))
	fi
	if [[ $i == "G1" ]]; then
		grupo1=$((grupo1 + 1))
	fi
	if [[ $i == "G2" ]]; then
		grupo2=$((grupo2 +1 ))
	fi
done
echo "# fecha y hora: $(date)" |cat > datos.log
echo "# Cantidad de alumnos total: $alumnos" |cat >> datos.log
echo "# Cantidad grupo1: $grupo1" |cat >> datos.log
echo "# Cantidad grupo2: $grupo2" |cat >> datos.log
echo "Fin"