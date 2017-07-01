<!DOCTYPE html>
<html lang="en">

<head>
    <title>altas Vehiculos</title>
    <meta charset="UTF-8">

    <?php require_once "../partes/dependencias.php" ?>

</head>
<body>
   <?php require_once "../partes/barraMenu.php" ;?>

        <div class="container col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
            <h2>Alta De Clientes :</h2>
            <h4>*Verifique La lista de clientes antes de registrar uno.</h4>
            <a style="background-color:#C0C0C0" class="btn btn-lg btn-block" href="listaClientes.php">Clientes Registrados</a>
            <br>
        <form class="form-login" onsubmit="Main.Insertar();return false">
            <div class=form-group>
                <label for="nombre" class="sr-only">Nombre</label>
                <input type="text" id="nombre" title="Se necesita el nombre" class="form-control" placeholder="Nombre" required="" autofocus="">
                <label for="apellido" class="sr-only">Apellido</label>
                <input type="text" id="apellido" title="Se necesita el apellido" class="form-control" placeholder="Apellido" required="" autofocus="">
                <label for="dni" class="sr-only">Dni</label>
                <input type="text" id="dni" title="Se necesita el dni" class="form-control" placeholder="Dni" required="" autofocus="">
                <label for="patente" class="sr-only">Patente</label>
                <input type="text" id="patente" title="Se necesita la patente" class="form-control" placeholder="Patente" required="" autofocus="">
                <label for="color" class="sr-only">Color</label>
                <input type="text" id="color" title="Se necesita el color" class="form-control" placeholder="Color" required="" autofocus="">
                <label for="marca" class="sr-only">Marca</label>
                <input type="text" id="marca" title="Se necesita la marca" class="form-control" placeholder="Marca" required="" autofocus="">
                <input type="checkbox" id="discap"> Discapacitado<br><br>
            </div>
            <button style="background-color: #C0C0C0" class="btn btn-lg btn-block" type="submit">Registrar</button>
            <br>
            <div class=form-group id="informe2">

            </div>
        </form>
      
      </div>

   <div/>

</body>

</html>