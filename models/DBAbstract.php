<?php 

class DBAbstract
{
    protected $db; // ← mejor en protected para que los modelos puedan usarlo si lo necesitan
    
    function __construct()
    {
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->db->connect_error) {
            die("Error de conexión: " . $this->db->connect_error);
        }

        // UTF8 obligatorio para que no rompa caracteres
        $this->db->set_charset("utf8mb4");
    }

    // Obtener la conexión (USADO POR escape())
    public function getConnection() {
        return $this->db;
    }

    // Ejecuta SELECT / INSERT / UPDATE / DELETE
    public function query($ssql)
    {
        $response = $this->db->query($ssql);

        if ($response === false) {
            throw new Exception("Error en la consulta: " . $this->db->error . " — SQL: $ssql");
        }

        $type_query = strtoupper(strtok(trim($ssql), " "));

        switch ($type_query) {

            case 'SELECT':
                return $response->fetch_all(MYSQLI_ASSOC);

            case 'INSERT':
                return $this->db->insert_id;

            case 'UPDATE':
            case 'DELETE':
                return $this->db->affected_rows;

            default:
                return $response;
        }
    }
}

?>
