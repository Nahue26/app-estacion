@extends(head)

<header style="text-align: center; padding: 2rem 1rem; background: linear-gradient(135deg, var(--fondo-header-gradiente-inicio), var(--fondo-header-gradiente-fin)); color: var(--texto-invertido);">
    <h1>Panel de Administrador</h1>
    <p>Gestión y monitoreo del sistema</p>
    <div style="margin-top: 1rem;">
        <a href="index.php?v=admin-logout" class="btn" style="margin-right: 1rem;">Cerrar sesión</a>
        <a href="index.php?v=map" class="btn">Mapa de clientes</a>
    </div>
</header>

<section class="features" style="text-align: center;">
    <h3>Estadísticas del Sistema</h3>
    <div class="feature-grid">
        <div class="feature">
            <h4>Usuarios Registrados</h4>
            <p style="font-size: 2rem; font-weight: bold; color: var(--titulo-tarjeta);">{{ cantUsuarios }}</p>
        </div>
        <div class="feature">
            <h4>Clientes (IPs Únicas)</h4>
            <p style="font-size: 2rem; font-weight: bold; color: var(--titulo-tarjeta);">{{ cantClientes }}</p>
        </div>
    </div>
</section>

@extends(footer)
