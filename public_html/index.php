<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="../public_html/css/bootstrap.css" rel="stylesheet">
    <script src="../public_html/js/jquery.min.js"></script>
    <script src="../public_html/js/bootstrap.min.js"></script>
    <style>
    body{
      background: #212121;
    }
    
    h1{
      color: #FFF;
    }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-11">
          <h1>Public_html</h1>
        </div>
        <div class="col-sm-1">
          <br>
          <a href="../index.php" class="btn btn-success" role="button">Inicio</a>
        </div>
      </div>

      <nav class="navbar navbar-default" role="navigation">
        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse"
                  data-target=".navbar-ex1-collapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav" id="menu_productos">
          </ul>
        </div>
		  </nav>

      <div class="row" align="center">
        <div class="col-md-6 bg-success">
          <div id="lst_productos"> 
          </div>
        </div>

        <div class="col-md-6 bg-info">
          <div id="lst_productos_ventas"> 
          </div>
        </div>
      </div>

    </div>

    <script>
      function menu(){
          $.ajax({
            url: "../php/control/menu.php",
            success: function(result) {
              $("#menu_productos").html(result);
            }
          });
      }

      menu();

      destacados(0);

      function destacados(id){
        $.ajax({
          url: "../php/control/listas.php",
          method: "POST",
          data: {idc: id, opcion: 1},
          success: function(resp) {
            $("#lst_productos").html(resp);
          }
        });
      }

      ventas(0);

      function ventas(id){
        $.ajax({
          url: "../php/control/listas.php",
          method: "POST",
          data: {idc: id, opcion: 2},
          success: function(resp) {
            $("#lst_productos_ventas").html(resp);
          }
        });
      }

      function lstProductos(id){
        destacados(id);
        ventas(id);
      }
    </script>
  </body>
</html>