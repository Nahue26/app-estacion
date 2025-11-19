<?php

class MapController {

    public function __construct() {
        $this->index();
    }

    public function index() {

        // Solo el admin puede entrar
        if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
            header("Location: index.php?v=panel");
            exit;
        }

        // Renderizar vista del mapa
        $tpl = new Enano("map");
        $tpl->assignVar([
            "APP_SECTION" => "Mapa de Clientes"
        ]);
        $tpl->printToScreen();
    }
}

?>
