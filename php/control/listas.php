<?php
include_once "../modelo/producto_model.php";

$idc = 0;
if(!empty($_POST['idc'])){
    $idc = $_POST['idc'];
}

$opcion = 0;
if(!empty($_POST['opcion'])){
    $opcion = $_POST['opcion'];
}

function destacados($idc){
    $productos = new Producto();
    $datos = $productos->productos_destacados($idc);
    $texto = '';
    $ids = '0';
    foreach($datos as $dato){
        $ids = $ids.','.$dato['id'];
        $texto = $texto.'<a href="../php/control/producto.php?ids='.$dato['id'].'" target="_blank"><h4>'.$dato['producto'].'</h4><img style="width: 20%; height: 100px;" src="imagen/'.$dato['foto'].'"><p>Precio $'.$dato['precio'].'</p></a><br>';
    }
    $titulo = '<a href="../php/control/producto.php?ids='.$ids.'" target="_blank"><h2>Productos destacados</h2></a>';
    return $titulo.' '.$texto;
}

function ventas($idc){
    $productos = new Producto();
    $datos = $productos->productos_ventas($idc);
    $texto = '';
    $ids = '0';
    foreach($datos as $dato){
        $ids = $ids.','.$dato['id'];
        $texto = $texto.'<a href="../php/control/producto.php?ids='.$dato['id'].'" target="_blank"><h4>'.$dato['producto'].'</h4><img style="width: 20%; height: 100px;" src="imagen/'.$dato['foto'].'"><p>Precio $'.$dato['precio'].'</p></a><br>';
    }
    $titulo = '<a href="../php/control/producto.php?ids='.$ids.'" target="_blank"><h2>Productos mas vendidos</h2></a>';
    return $titulo.' '.$texto;
}

if($opcion == 1){
    echo destacados($idc);
}

if($opcion == 2){
    echo ventas($idc);
}
?>