function verificarUsuario() {

    var usuario = $("#usuario").val();
    var clave = $("#clave").val();

    datos = {
        "usuario": usuario,
        "clave": clave
    };

    var url = "servidor/verificarUsuario.php";

    $.post(url, datos, procesarRespuesta);

    function procesarRespuesta(retorno) {
        if (retorno == "Error al logear.")
            $("#informe").html("Usuario o contraseña incorrecta.");
        else if (retorno == "Administrador logeado")
            window.location.replace("administrador.html");
        else
            window.location.replace("empleado.html");
    }

}