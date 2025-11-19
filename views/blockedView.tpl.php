<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ titulo }} - {{ APP_NAME }}</title>
    <link rel="stylesheet" href="views/static/css/auth.css">
</head>
<body>

<div class="landing-container">

    <h1 class="landing-title">{{ titulo }}</h1>
    <p class="landing-description">Se procesó la solicitud de bloqueo</p>

    {{ message_div }}

    <div style="margin-top: 20px;">
        <a href="index.php?v=login">Volver al inicio de sesión</a>
    </div>

</div>

</body>
</html>
