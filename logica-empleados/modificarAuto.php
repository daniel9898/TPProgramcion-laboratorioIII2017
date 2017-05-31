<!DOCTYPE html>
<html lang="en">

<head>
    <title>altas Vehiculos</title>
    <meta charset="UTF-8">

    <?php require_once "../partes/dependencias.php" ?>

</head>
<body>
   <?php
    require_once "../partes/barraMenu.php" ;
    require_once "../clases/consultasSql.php";
    
    $idAuto = $_GET['id'];
    $autoAmodificar = Automovil::TraerRegistro($idAuto);
   ?> 
  
        <div class="container col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
        <form class="form-login" onsubmit="Modificar();return false">
            <br><br>
            <h2 class="form-ingreso-heading">Modificar Vehiculo :</h2><br>
            <div class=form-group>
                <label for="patente" class="sr-only">Patente</label>
                <input type="text" id="patente" title="Se necesita la patente" class="form-control" placeholder="Patente" value= "<?php echo $autoAmodificar->GetPatente();?>" required="" autofocus="">
                <label for="color" class="sr-only">Color</label>
                <input type="text" id="color" title="Se necesita el color" class="form-control" placeholder="Color" value="<?php echo $autoAmodificar->GetColor(); ?>" required="" autofocus="">
                <label for="marca" class="sr-only">Marca</label>
                <input type="text" id="marca" title="Se necesita la marca" class="form-control" placeholder="Marca" value="<?php echo $autoAmodificar->GetMarca(); ?>" required="" autofocus="">
            </div>
            <button class="btn btn-lg btn-success btn-block" type="submit">Registrar</button>
            <div class=form-group id="informe2">

            </div>
        </form>
      
      </div>

   <div/>

</body>

</html>