function verificarUsuario() {

    var usuario = $("#usuario").val();
    var clave = $("#clave").val();

    datos = {
        "usuario": usuario,
        "clave": clave
    };

    var url = "verificarUsuario.php";

    $.post(url, datos, procesarRespuesta);

    function procesarRespuesta(retorno) {
        if (retorno == "Error al logear.")
            $("#informe").html("Usuario o contraseña incorrecta.");
        else if (retorno == "Administrador logeado")
            window.location.replace("administrador.html");//crear archivo
        else
            window.location.replace("logica-empleados/empleado.php");
    }

}