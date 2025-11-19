#!/bin/bash
echo "Ejecutando"
grupo1="<h3>G1</h3>"
grupo2="<h3>G2</h3>"
for i in $(cat /71alumnos.txt); do
	if [[ $i == "#" ]]; then
		if [[ $grupo == "G1" ]]; then
			grupo1="$grupo1  <a href="../../CLASE_7/alumno/G1/$carnet">$nombre</a> <br>"
		else
			grupo2="$grupo2  <a href="../../CLASE_7/alumno/G2/$carnet">$nombre</a> <br>"
		fi
		# resetea el contador
		nombre=""
		contador=1
		# guarda los datos de alumno
	elif [[ $contador -eq 1 ]]; then
			carnet=$i
			contador=$((contador + 1))
	elif [[ $contador  -eq 2 ]]; then
		grupo=$i
		contador=$((contador+1))
	else
		nombre=$i
	fi


done
echo $grupo1 | cat > alumnos.html
echo $grupo2 | cat >> alumnos.html
for i in $(cat ./datos.log); do
	if [[ $i == "#" ]]; then
		listado="$listado <p>$data</p>"
		data=""
	else 
		data="$data $i"
	fi
done
echo $listado | cat >> alumnos.html

echo "Fin"