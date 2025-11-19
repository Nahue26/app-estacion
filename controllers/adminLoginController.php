<?php

class adminLoginController {

    public function __construct() {
        $action = $_GET["v"] ?? "admin-login";

        if ($action == "admin-login") {
            $this->index();
        } else if ($action == "admin-login-auth") {
            $this->auth();
        } else if ($action == "admin-logout") {
            $this->logout();
        }
    }
    

    public function index() {

        // Carga vista mediante Enano
        $tpl = new Enano("admin_login");
        $tpl->assignVar([]); // si querés pasar variables
        $tpl->printToScreen();
    }

    public function auth() {

        // credenciales del admin
        $adminUser = "admin-estacion";
        $adminPass = "admin1234";

        $user = $_POST["user"] ?? "";
        $pass = $_POST["pass"] ?? "";

        if ($user === $adminUser && $pass === $adminPass) {
            $_SESSION["admin"] = true;
            header("Location: index.php?v=administrator");
            exit;
        } else {
            header("Location: index.php?v=admin-login&error=1");
            exit;
        }
    }

    public function logout() {
        unset($_SESSION["admin"]);
        header("Location: index.php?v=admin-login");
        exit;
    }
}

?>
