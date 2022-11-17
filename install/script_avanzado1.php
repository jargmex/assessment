<?php
include_once "conexion.php";

echo "<h1>ejecutando script</h1>";

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();
$cont = 0;
$logFile = fopen("log4.txt", 'a') or die("Error creando archivo");

$query="SELECT * FROM productos;";
$result = $NewConn->Query($query);
if($result){
    foreach($result as $dato){
        $query2 ="SELECT * FROM clasificacion ORDER BY rand() LIMIT 3;";
        $result2 = $NewConn->Query($query2);
        if($result2){
            foreach($result2 as $dato2){
                $consulta = "INSERT INTO categoria_producto (id_clasificacion, id_producto) VALUES (".$dato2['id'].",".$dato['id'].");";
                $respuesta = $NewConn->ExecuteQuery($consulta);
                if($respuesta['exito']){
                    $RowCount = $NewConn->GetCountAffectedRows();
                    if($RowCount > 0){
                        $cont++;
                    }
                }else{
                    fwrite($logFile, "\n".date("d/m/Y H:i:s")." Error: ".$respuesta['msj']) or die("Error escribiendo en el archivo");
                }
            }
            $NewConn->SetFreeResult($result2);
        }
    }
    $NewConn->SetFreeResult($result);
}

fwrite($logFile, "\n".date("d/m/Y H:i:s")." Registros insertados: ".$cont) or die("Error escribiendo en el archivo");

$NewConn->CloseConnection();
echo "<h2>Termino ejecucion</h2>";
echo '<a href="log4.txt">Ver archivo log</a><br>';
echo '<a href="../install">Regresar</a>';
?>