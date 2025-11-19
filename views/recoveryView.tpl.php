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

        <h1 class="landing-title">Recuperar Contraseña</h1>
        <p class="landing-description">Ingresa tu email para restablecer tu contraseña</p>

        {{ message_div }}

        <form method="POST" action="index.php?v=recovery" style="background: rgba(255, 255, 255, 0.9); padding: 30px; border-radius: 15px; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);">

            <div style="margin-bottom: 25px;">
                <label for="txt_email" style="display: block; margin-bottom: 8px; font-weight: bold; color: #333;">Email:</label>
                <input type="email" id="txt_email" name="txt_email" required style="width: 100%; padding: 12px; border-radius: 8px; border: 2px solid #ddd; font-size: 16px; transition: border-color 0.3s; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; padding: 12px; background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%); color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: transform 0.2s;">Enviar</button>
        </form>

        <div style="margin-top:20px; text-align:center;">
            <a href="index.php?v=login">Volver al inicio de sesión</a>
        </div>

    </div>

</body>
</html>
