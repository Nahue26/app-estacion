<?php  

class Administrator {

    public function __construct() {
        $this->index();
    }

    public function index() {

        if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
            header("Location: index.php?v=admin-login");
            exit;
        }

        require_once "models/Usuarios.php";
        require_once "models/Tracker.php";

        $u = new Usuarios();
        $t = new Tracker();

        $cantUsuarios = $u->countUsers();
        $cantClientes = $t->countIPs();

        $tpl = new Enano("administrator");
        $tpl->assignVar([
            "APP_SECTION" => "Administrator",
            "cantUsuarios" => $cantUsuarios,
            "cantClientes" => $cantClientes
        ]);
        $tpl->printToScreen();
    }
}

?>
