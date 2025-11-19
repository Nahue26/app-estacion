#!/bin/bash

echo '==> Ejecutando';

mkdir -p marionettes
echo " echo 'Hola soy Lima.' " | cat > marionettes/lime.sh 
echo " echo 'Hola soy Cereza.' " | cat > marionettes/cherry.sh 
echo " echo 'Hola soy Zarzamora.' " | cat > marionettes/bloodberry.sh 

echo '==> Fin';