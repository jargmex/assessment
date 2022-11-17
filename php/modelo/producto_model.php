<?php
include_once "../../install/conexion.php";

class Producto{
    private $NewConn;

    public function __construct(){ 
        $this->NewConn = new ConnectionMySQL();
        $this->NewConn->CreateConnection();
    }

    public function menu($hija){
        $query="SELECT * FROM clasificacion WHERE clase_hija= ".$hija;
        $result = $this->NewConn->Query($query);
        if($result){
            return $result;
            $this->NewConn->SetFreeResult($result);
        }
    }

    public function productos_destacados($id_clasificacion){
        $condicion = "";
        if($id_clasificacion != 0){
            $condicion = "WHERE c.id_clasificacion = ".$id_clasificacion;
        }
        $query="SELECT concat(p.marca,' ',p.modelo) AS producto, id, precio, foto FROM productos p JOIN categoria_producto c ON p.id = c.id_producto ".$condicion." ORDER BY rand() LIMIT 10;";
        $result = $this->NewConn->Query($query);
        if($result){
            return $result;
            $this->NewConn->SetFreeResult($result);
        }
    }

    public function productos_ventas($id_clasificacion){
        $condicion = "";
        if($id_clasificacion != 0){
            $condicion = "JOIN categoria_producto ca ON ca.id_producto = c.id_producto WHERE ca.id_clasificacion = ".$id_clasificacion;
        }
        $query="SELECT concat(p.marca,' ',p.modelo) AS producto, p.id, precio, foto FROM productos p JOIN (SELECT c.id_producto AS idp FROM comentarios c ".$condicion." GROUP BY c.id_producto ORDER BY avg(c.calificacion) DESC LIMIT 10) c ON p.id = c.idp;";
        $result = $this->NewConn->Query($query);
        if($result){
            return $result;
            $this->NewConn->SetFreeResult($result);
        }
    }

    public function producto($id){
        $query="SELECT * FROM productos WHERE id IN (".$id.");";
        $result = $this->NewConn->Query($query);
        if($result){
            return $result;
            $this->NewConn->SetFreeResult($result);
        }
    }

    public function comentarios($id_producto){
        $query="SELECT * FROM comentarios WHERE id_producto IN (".$id_producto.");";
        $result = $this->NewConn->Query($query);
        if($result){
            return $result;
            $this->NewConn->SetFreeResult($result);
        }
    }
}
?>