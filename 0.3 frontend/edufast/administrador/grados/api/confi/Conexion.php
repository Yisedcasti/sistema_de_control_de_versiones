<?php
class conexion{
    public $mysqli;
    const SERVER ="localhost";
    const USER = "root";
    const PASSWORD = "";
    const DATABASE = "edufast";

    public function __construct()
    {
        mysqli_report( MYSQLI_REPORT_STRICT);
        try{
            $this->mysqli = new mysqli(self::SERVER, self::USER, self::PASSWORD, self::DATABASE);
            $this->mysqli->set_charset("utf8mb4");
        }
        catch (mysqli_sql_exception $e){
            http_response_code(500);
            echo"Error al conectar a la base de datos :" . $e->getMessage();
            exit;
        }
    }

    public function __destruct()
    {
        if($this->mysqli){
            $this->mysqli->close();
        }
    }
}

?>