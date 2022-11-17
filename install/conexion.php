<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'assessment001');

class ConnectionMySQL
{
    private $host;
    private $user;
    private $password;
    private $database;
    private $conn;
     
    public function __construct(){ 
        $this->host=HOST;
        $this->user=USER;
        $this->password=PASSWORD;
        $this->database=DATABASE;
    }
      
    public function CreateConnection(){
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if($this->conn->connect_errno) {
            die("Error al conectarse a MySQL: (".$this->conn->connect_errno.")".$this->conn->connect_error);
        }
    }
      
    public function CloseConnection(){
        $this->conn->close();
    }
      
    public function ExecuteQuery($sql){
        $result = $this->conn->query($sql);
        if($result){
            $resp['exito'] = true;
        }else{
            $resp['exito'] = false;
            $resp['msj']= 'Error: '.mysqli_error($this->conn);
        }
        return $resp;
    }

    public function Query($sql){
        $result = $this->conn->query($sql);
        return $result;
    }
      
    public function GetRows($result){
        return $result->fetch_row();
    }

    public function GetCountAffectedRows(){
        return $this->conn->affected_rows;
    }
      
    public function SetFreeResult($result){
        $result->free_result();
    }     
}
?>