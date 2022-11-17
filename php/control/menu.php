<?php
include_once "../modelo/producto_model.php";

function menu(){
    $productos = new Producto();
    $datos = $productos->menu(0);
    
    $hija = 0;
    $texto = "";
    foreach($datos as $dato){
      $cont = 0;
      $subdatos = $productos->menu($dato['id']);
      foreach($subdatos as $subvalor){
        $cont++;
      }
      if($cont > 0){
        $texto = $texto.'<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$dato['nombre'].' <b class="caret"></b></a><ul class="dropdown-menu">';
        $texto = $texto.'<li><a href="javascript:lstProductos('.$dato['id'].')">'.$dato['nombre'].'</a></li>';
        foreach($subdatos as $subvalor){
          $texto = $texto.'<li><a href="javascript:lstProductos('.$subvalor['id'].')">'.$subvalor['nombre'].'</a></li>';
        }
        $texto = $texto.'</ul></li>';
      }else{
        $texto = $texto.'<li><a href="javascript:lstProductos('.$dato['id'].')">'.$dato['nombre'].'</a></li>';
      }
    }
    return $texto;
}

echo menu();
?>