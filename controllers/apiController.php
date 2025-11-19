<?php
require_once "models/Tracker.php";

class ApiController {

    public function __construct() {
        $this->index();
    }

    public function index() {

        $action = $_GET["action"] ?? "";

        switch ($action) {

            case "list-clients-location":
                $this->listClientsLocation();
                break;

            default:
                $this->errorResponse("Acción no válida");
                break;
        }
    }

    private function listClientsLocation() {

        $tracker = new Tracker();
        $data = $tracker->getClientsLocationGrouped();

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    private function errorResponse($msg) {
        header('Content-Type: application/json');
        echo json_encode(["error" => $msg]);
        exit;
    }
}
?>
