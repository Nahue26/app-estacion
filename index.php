<?php

// Nombre de la app
define("APP_NAME", "App Estación 7° Año");

// URL de la API que vas a consumir con fetch()
define("URL_API", "https://mattprofe.com.ar/proyectos/app-estacion/");

// Colores usados por el motor Enano (necesarios para que no explote)
define("FONDO_PAGINA", "#ffffff");
define("COLOR_PRIMARIO", "#4CAF50");

// Descripción usada en la landing
define("APP_DESCRIPTION", "Sistema de monitoreo meteorológico con estaciones remotas");

// Opcional: evita más errores si tu plantilla usa estas variables
define("COLOR_SECUNDARIO", "#333333");
define("TITULO_PAGINA", "Panel de Estaciones");

// Constantes adicionales para Enano
define("TEXTO_PRINCIPAL", "#000000");
define("FONDO_HEADER_GRADIENTE_INICIO", "#4CAF50");
define("FONDO_HEADER_GRADIENTE_FIN", "#2E7D32");
define("TEXTO_INVERTIDO", "#ffffff");
define("TEXTO_HOVER_NAV", "#cccccc");
define("FONDO_BOTON", "#4CAF50");
define("FONDO_BOTON_HOVER", "#45a049");
define("FONDO_SECCION_CLARA", "#f9f9f9");
define("FONDO_TARJETA", "#ffffff");
define("TITULO_TARJETA", "#333333");
define("FONDO_FOOTER", "#333333");
define("SOMBRA_SUAVE", "0 2px 4px rgba(0,0,0,0.1)");
define("SOMBRA_MUY_SUAVE", "0 1px 2px rgba(0,0,0,0.05)");
define("APP_AUTHOR", "Desarrollador");
define("APP_SLOGAN", "Monitoreo en tiempo real");

require_once __DIR__ . "/librarys/Enano.php";
require_once __DIR__ . "/config_db.php";

// Definir constantes de DB
define("DB_HOST", $host);
define("DB_USER", $user);
define("DB_PASS", $pass);
define("DB_NAME", $dbname);

session_start();

$v = $_GET['v'] ?? 'landing';
$id = $_GET['id'] ?? '';

switch ($v) {

    case 'panel':
        require_once "controllers/panelController.php";
        break;

    case 'detalle':
        require_once "controllers/detalleController.php";
        break;

    case 'login':
        require_once "controllers/loginController.php";
        break;

    case 'recovery':
        require_once "controllers/recoveryController.php";
        break;

    case 'register':
        require_once "controllers/registerController.php";
        break;

    case 'reset':
        require_once "controllers/resetController.php";
        break;

    case 'blocked':
        require_once "controllers/blockedController.php";
        break;

    case 'validate':
        require_once "controllers/validateController.php";
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?v=login");
        exit;

    // LOGIN ADMIN
    case 'admin-login':
        require_once "controllers/adminLoginController.php";
        new adminLoginController();
        break;

    case 'admin-login-auth':
        require_once "controllers/adminLoginController.php";
        new adminLoginController();
        break;

    case 'admin-logout':
        require_once "controllers/adminLoginController.php";
        new adminLoginController();
        break;

    // PANEL ADMINISTRADOR
    case 'administrator':
        require_once "controllers/administratorController.php";
        new Administrator();
        break;

    // MAPA DE CLIENTES
    case 'map':
    require_once "controllers/mapController.php";
    new MapController();
    break;


    // API INTERNA (JSON)
    case 'api':
        require_once "controllers/apiController.php";
        new ApiController();
        break;

    default:
        require_once "controllers/landingController.php";
        break;
}

?>
