<?php
include_once "conexion.php";

echo "<h1>ejecutando script</h1>";

$NewConn = new ConnectionMySQL();
$NewConn->CreateConnection();
$cont = 0;
$logFile = fopen("log2.txt", 'a') or die("Error creando archivo");

$data = file_get_contents("datos.json");
$datos = json_decode($data, true);
 
foreach ($datos as $dato) {
    $productos = $dato['productos'];
}

for($i=0;$i<200;$i++){
    $modelo = $productos[rand(0,9)]['modelo'];
    $texto = $productos[rand(0,9)]['especificaciones'];
    $precio = $productos[rand(0,9)]['precio'];
    $marca = $productos[rand(0,9)]['marca'];
    $foto = rand(0,9).'.jpg';
    $consulta = "INSERT INTO productos (modelo, especificaciones, precio, marca, foto) VALUES ('".$modelo."','".$texto."','".$precio."','".$marca."','".$foto."');";
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
echo '<a href="log2.txt">Archivo log</a><br>';
echo '<a href="../install">Regresar</a>';
?>