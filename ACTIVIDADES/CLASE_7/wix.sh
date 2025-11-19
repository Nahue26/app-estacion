#!/bin/bash

echo "==> Ejecutando"

mkdir -p $1
echo $2 | cat > $1/index.php
mkdir $1/CSS
mkdir $1/CSS/USER
echo "" | cat > $1/CSS/USER/estilos.css
mkdir $1/CSS/ADMIN
echo "" | cat > $1/CSS/ADMIN/estilos.css
mkdir $1/IMG
mkdir $1/IMG/avatars
mkdir $1/IMG/buttons
mkdir $1/IMG/products
mkdir $1/IMG/pets
mkdir $1/js
mkdir $1/js/validations
echo "" | cat > $1/js/validations/login.js
echo "" | cat > $1/js/validations/register.js
mkdir $1/js/effects
echo "" | cat > $1/js/effects/panels.php
mkdir $1/tpl
echo "" | cat > $1/tpl/main.tpl
echo "" | cat > $1/tpl/login.tpl
echo "" | cat > $1/tpl/register.tpl
echo "" | cat > $1/tpl/panel.tpl
echo "" | cat > $1/tpl/profile.tpl
echo "" | cat > $1/tpl/crud.tpl
mkdir $1/php
echo "" | cat > $1/php/create.php
echo "" | cat > $1/php/read.php
echo "" | cat > $1/php/update.php
echo "" | cat > $1/php/delete.php
echo "" | cat > $1/php/dbconect.php


echo "==> Fin"