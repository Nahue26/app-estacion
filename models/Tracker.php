<?php
require_once "DBAbstract.php";

class Tracker extends DBAbstract {

    private function escape($str) {
        return $this->getConnection()->real_escape_string($str);
    }

    public function save($data) {

        $ip        = $this->escape($data['ip']);
        $latitud   = $this->escape($data['latitud']);
        $longitud  = $this->escape($data['longitud']);
        $pais      = $this->escape($data['pais']);
        $navegador = $this->escape($data['navegador']);
        $sistema   = $this->escape($data['sistema']);

        $token = bin2hex(random_bytes(16));

        $sql = "INSERT INTO tracker (token, ip, latitud, longitud, pais, navegador, sistema)
                VALUES (
                    '$token',
                    '$ip',
                    '$latitud',
                    '$longitud',
                    '$pais',
                    '$navegador',
                    '$sistema'
                )";

        return $this->query($sql);
    }

    public function getClientsLocationGrouped() {
        $sql = "
            SELECT ip, latitud, longitud, COUNT(*) AS accesos
            FROM tracker
            GROUP BY ip, latitud, longitud
        ";
        return $this->query($sql);
    }

    public function countIPs() {
        $res = $this->query("SELECT COUNT(DISTINCT ip) AS total FROM tracker");
        return $res[0]["total"] ?? 0;
    }
}
