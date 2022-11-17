<?php
include_once "conexion.php";

echo "<h1>ejecutando script</h1>";

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();
$cont = 0;
$logFile = fopen("log.txt", 'a') or die("Error creando archivo");

$data = file_get_contents("datos.json");
$datos = json_decode($data, true);
 
foreach ($datos as $dato) {
    $clasificaciones = $dato['clasificaciones'];
    $productos = $dato['productos'];
    $comentarios = $dato['comentarios'];
}

for($i=0;$i<count($clasificaciones);$i++){
    $consulta = "INSERT INTO clasificacion (nombre,clase_hija) VALUES ('".$clasificaciones[$i]['nombre']."','".$clasificaciones[$i]['clase_hija']."');";
    $result = $NewConn->ExecuteQuery($consulta);
    if($result['exito']){
        $RowCount = $NewConn->GetCountAffectedRows();
        if($RowCount > 0){
            $cont++;
        }
    }else{
        fwrite($logFile, "\n".date("d/m/Y H:i:s")." Error: ".$result['msj']) or die("Error escribiendo en el archivo");
    }
}

for($i=0;$i<count($productos);$i++){
    $consulta = "INSERT INTO productos (modelo, especificaciones, precio, vistas, marca, foto) VALUES ('".$productos[$i]['modelo']."','".$productos[$i]['especificaciones']."','".$productos[$i]['precio']."','".$productos[$i]['vistas']."','".$productos[$i]['marca']."','".$productos[$i]['foto']."');";
    $result = $NewConn->ExecuteQuery($consulta);
    if($result['exito']){
        $RowCount = $NewConn->GetCountAffectedRows();
        if($RowCount > 0){
            $cont++;
        }
    }else{
        fwrite($logFile, "\n".date("d/m/Y H:i:s")." Error: ".$result['msj']) or die("Error escribiendo en el archivo");
    }
}

for($i=0;$i<count($comentarios);$i++){
    $consulta = "INSERT INTO comentarios (texto, nombre, calificacion, id_producto) VALUES ('".$comentarios[$i]['texto']."','".$comentarios[$i]['nombre']."','".$comentarios[$i]['calificacion']."','".$comentarios[$i]['id_producto']."');";
    $result = $NewConn->ExecuteQuery($consulta);
    if($result['exito']){
        $RowCount = $NewConn->GetCountAffectedRows();
        if($RowCount > 0){
            $cont++;
        }
    }else{
        fwrite($logFile, "\n".date("d/m/Y H:i:s")." Error: ".$result['msj']) or die("Error escribiendo en el archivo");
    }
}

fwrite($logFile, "\n".date("d/m/Y H:i:s")." Registros insertados: ".$cont) or die("Error escribiendo en el archivo");

$NewConn->CloseConnection();
fclose($logFile);

echo "<h2>Termino ejecucion</h2>";
echo '<a href="log.txt">Archivo log</a><br>';
echo '<a href="../install">Regresar</a>';
?>