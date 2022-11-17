<?php
include_once "conexion.php";
include_once "lorem.php";

echo "<h1>ejecutando script</h1>";

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();
$cont = 0;
$logFile = fopen("log3.txt", 'a') or die("Error creando archivo");

$data = file_get_contents("datos.json");
$datos = json_decode($data, true);

foreach ($datos as $dato) {
    $comentarios = $dato['comentarios'];
}

$lorem = new Lorem();

for($i=0;$i<1000;$i++){
    $nombre = $comentarios[rand(0,9)]['nombre'];
    $calificacion = rand(1,9);
    $id_producto = rand(1,210);
    $texto = $lorem->ipsum(1);
    $consulta = "INSERT INTO comentarios (nombre, texto, calificacion, id_producto) VALUES ('".$nombre."','".$texto."','".$calificacion."','".$id_producto."');";
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
echo '<a href="log3.txt">Archivo log</a><br>';
echo '<a href="../install">Regresar</a>';
?>