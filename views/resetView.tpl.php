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

        <h1 class="landing-title">Restablecer Contraseña</h1>
        <p class="landing-description">Ingresá tu nueva contraseña</p>

        {{ message_div }}

        <form method="POST">

            <div style="margin-bottom:20px;">
                <label>Nueva contraseña:</label>
                <input type="password" name="txt_password" required 
                       style="width:100%; padding:10px; border-radius:5px; border:1px solid #ccc;">
            </div>

            <div style="margin-bottom:20px;">
                <label>Repetir contraseña:</label>
                <input type="password" name="txt_repeat_password" required 
                       style="width:100%; padding:10px; border-radius:5px; border:1px solid #ccc;">
            </div>

            <button type="submit" class="landing-button">Restablecer</button>
        </form>

        <div style="margin-top:20px; text-align:center;">
            <a href="index.php?v=login">Volver al Login</a>
        </div>

    </div>

</body>
</html>
