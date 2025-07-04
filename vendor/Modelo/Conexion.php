<?php 
class Conexion{
	private static $db_host = "localhost";
	private static $db_user = "root";
	private static $db_password = "";
	protected $db_name = "turnero";

	private $conn;

	public $resultado;
	public $filas;

	private function abrir_conexion(){
		try {
            $this->conn = new PDO("mysql:host=".self::$db_host.";dbname=".$this->db_name, self::$db_user, self::$db_password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
	}
	private function cerrar_conexion(){
		$this->conn = null;
	}

	public function buscar_query($sql){
		$this->abrir_conexion();
		$this->resultado = $this->conn->query($sql);
		$this->filas = $this->resultado->rowCount();
		$this->cerrar_conexion();
	}

	public function obtener_resultado(){
		return $this->resultado;
	} 

	public function obtener_filas(){
		return $this->filas;
	}

	public function ejecutar_query($sql){
		$this->abrir_conexion();
		$result = $this->conn->exec($sql);
		$this->cerrar_conexion();

		return $result;
	}
	
	public function ejecutar_query_preparado($sql, $params){
		try {
			$this->abrir_conexion();
			$stmt = $this->conn->prepare($sql);
			$result = $stmt->execute($params);
			$this->cerrar_conexion();
	
			return $result ? $stmt->rowCount() : 0;
		} catch (PDOException $e) {
			die("Error al ejecutar la consulta preparada: " . $e->getMessage());
		}
    }

}

 ?>