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
        <p class="landing-description">Ingresa tus credenciales para acceder al sistema</p>

        {{ message_div }}

        <form method="POST" action="index.php?v=login">

            <div style="margin-bottom: 20px;">
                <label for="txt_email">Email:</label>
                <input type="email" id="txt_email" name="txt_email" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label for="txt_password">Contraseña:</label>
                <input type="password" id="txt_password" name="txt_password" required>
            </div>

            <button type="submit" class="landing-button">Acceder</button>
        </form>

        <div style="margin-top:20px;">
            <a href="index.php?v=recovery">¿Olvidaste tu contraseña?</a>
        </div>

        <div style="margin-top:10px;">
            <a href="index.php?v=register">¿No tienes una cuenta? Registrarse</a>
        </div>

    </div>

</body>
</html>
