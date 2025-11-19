@extends(head)

<div class="login-box">

    <h3>Login Administrador</h3>

    <?php if(isset($_GET["error"])): ?>
        <p class="error">Usuario o contraseña incorrectos</p>
    <?php endif; ?>

    <form action="index.php?v=admin-login-auth" method="POST">
        <input type="text" name="user" placeholder="Usuario" required>
        <input type="password" name="pass" placeholder="Contraseña" required>
        <button type="submit">Ingresar</button>
    </form>

</div>

@extends(footer)
