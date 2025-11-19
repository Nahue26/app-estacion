#!/bin/bash

echo "==> Ejecutando"

mkdir framework
echo "" | cat > framework/.env
echo "" | cat > framework/.gitignore
echo "" | cat > framework/.htaccess
echo "" | cat > framework/README.md
mkdir framework/app
mkdir framework/http
mkdir framework/controllers
echo "" | cat > framework/controllers/LandingControllers.php
echo "" | cat > framework/controllers/NotFoundController.php
mkdir framework/models
echo "" | cat > framework/models/User.php
echo "" | cat > framework/models/Client.php
mkdir framework/database
mkdir framework/database/mysqli
echo "" | cat > framework/database/mysqli/Connect.php
mkdir framework/public
echo "" | cat > framework/public/index.php
mkdir framework/resources
mkdir framework/resources/css
echo "" | cat > framework/resources/css/style.css
mkdir framework/resources/js
echo "" | cat > framework/resources/js/defaul.js
mkdir framework/views
mkdir framework/views/landing
echo "" | cat > framework/views/landing/index.tpl.php
mkdir framework/views/notfound
echo "" | cat > framework/views/notfound/index.tpl.php
mkdir framework/router
echo "" | cat > framework/router/RouterHandler.php
mkdir framework/vendor

echo "==> Fin"