<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Productos</title>
    <link href="../public_html/css/bootstrap.css" rel="stylesheet">
    <script src="../public_html/js/jquery.min.js"></script>
    <script src="../public_html/js/bootstrap.min.js"></script>
    <style>
    body{
      background: #205721;
    }
    
    h3{
      color: #FFF;
    }

    p{
      color: #FFF;
    }

    b{
      color: #FFF;
    }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row" align="center">
        <div class="col-md-6 bg-success">
<?php
include_once "../modelo/producto_model.php";

$ids = 0;
if(!empty($_GET['ids'])){
    $ids = $_GET['ids'];
}

$productos = new Producto();
$datos = $productos->producto($ids);
$texto = '<div>';
foreach($datos as $dato){
  $datos_comentarios = $productos->comentarios($dato['id']);
  $texto = $texto.'<hr><h3>Marca :'.$dato['marca'].'</h3><h3>Modelo :'.$dato['modelo'].'</h3><img style="width: 30%;" src="../../public_html/imagen/'.$dato['foto'].'"><p><b>Precio $'.$dato['precio'].'<b></p><p>'.$dato['especificaciones'].'</p><h4>Comentarios: </h4>';
  foreach($datos_comentarios as $comentarios){
    $texto = $texto.'<div align="left"><b>'.$comentarios['nombre'].':</b><br><p>'.$comentarios['texto'].':</p></div>';
  }
}

echo $texto.'</div>';
?>
        </div>
      </div>
    </div>
  </body>
</html>