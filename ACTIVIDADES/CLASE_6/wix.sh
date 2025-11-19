#!/bin/bash

echo "==> Ejecutando"

mkdir -p proyecto
echo "" | cat > proyecto/index.php
mkdir proyecto/CSS
mkdir proyecto/CSS/USER
echo "" | cat > proyecto/CSS/USER/estilos.css
mkdir proyecto/CSS/ADMIN
echo "" | cat > proyecto/CSS/ADMIN/estilos.css
mkdir proyecto/IMG
mkdir proyecto/IMG/avatars
mkdir proyecto/IMG/buttons
mkdir proyecto/IMG/products
mkdir proyecto/IMG/pets
mkdir proyecto/js
mkdir proyecto/js/validations
echo "" | cat > proyecto/js/validations/login.js
echo "" | cat > proyecto/js/validations/register.js
mkdir proyecto/js/effects
echo "" | cat > proyecto/js/effects/panels.php
mkdir proyecto/tpl
echo "" | cat > proyecto/tpl/main.tpl
echo "" | cat > proyecto/tpl/login.tpl
echo "" | cat > proyecto/tpl/register.tpl
echo "" | cat > proyecto/tpl/panel.tpl
echo "" | cat > proyecto/tpl/profile.tpl
echo "" | cat > proyecto/tpl/crud.tpl
mkdir proyecto/php
echo "" | cat > proyecto/php/create.php
echo "" | cat > proyecto/php/read.php
echo "" | cat > proyecto/php/update.php
echo "" | cat > proyecto/php/delete.php
echo "" | cat > proyecto/php/dbconect.php


echo "==> Fin"