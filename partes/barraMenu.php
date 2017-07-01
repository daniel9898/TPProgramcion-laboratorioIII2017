
<link rel="stylesheet" href="../estilos/estiloMenu.css">

<div class="topnav" id="myTopnav">
  <a class="animated bounceInLeft" href="formularioAlta.php"><span class="glyphicon glyphicon-list-alt">&nbsp;</span>Alta</a>
  <a class="animated bounceInLeft" href="listaRegistros.php"><span class="glyphicon glyphicon-th">&nbsp;</span>Estacionados</a>
  <a class="animated bounceInLeft" href="listaClientes.php"><span class="glyphicon glyphicon-th">&nbsp;</span>Clientes</a>
  <a class="animated bounceInLeft" onclick="LOG.salir()"><span class="glyphicon glyphicon-user">&nbsp;</span>Deslogear</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
</div>
<script>
	/* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>