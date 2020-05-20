$("#frmgrabarUsuario").submit(function (event) {
    event.preventDefault();

    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar los datos ingresados?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) { 

                    $.post(
                            "../controller/registrate.usuario.agregar.controller.php",
                            {
                                p_dni: $("#textDNI").val(),
                                p_nombreCompleto: $("#textNombreCompleto").val(),
                                p_email: $("#textEmail").val(),
                                p_password: $("#textPassword").val()
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar").click(); //Cerrar la ventana 
                           /// listar(); //actualizar la lista
                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

});


$("#btnagregar").click(function () {
    $("#txtTipoOperacion").val("agregar");
    $("#txtCodigo").val("");
    $("#txtDni").val("");
    $("#txtNombre").val("");
    $("#txtApellidos").val("");
    $("#txtDireccion").val("");
    $("#estado_civil").val("");
    $("#txtDepartamento").val("");
    $("#txtProvincia").val("");
    $("#txtEmail").val("");
    $("#txtTelefono").val("");
    $("#sexo").val("");
    $("#edad").val("");
    $("#hijo").val("");
    $("#cuenta").val("");
    $("#contrasenia").val("");
    $("#titulomodal").html("Crear nuevo usuario");
});


$("#myModal").on("shown.bs.modal", function () {
    $("#txtNombre").focus();
});


function leerDatos(codLab) {
    $.post
            (
                    "../controller/laboratorio.leer.datos.controller.php",
                    {
                        p_cod_lab: codLab
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            $("#txtCodigo").val(jsonResultado.datos.codigo_laboratorio);
            $("#txtNombre").val(jsonResultado.datos.nombre);
            $("#cboPais").val(jsonResultado.datos.codigo_pais);
            $("#titulomodal").html("Modificar datos del laboratorio");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}


function eliminar(codLab) {
    swal({
        title: "Confirme",
        text: "¿Esta seguro de eliminar el registro seleccionado?",
        showCancelButton: true,
        confirmButtonColor: '#d93f1f',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../images/eliminar2.png"
    },
            function (isConfirm) {
                if (isConfirm) {
                    $.post(
                            "../controller/laboratorio.eliminar.controller.php",
                            {
                                p_cod_lab: codLab
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;
                        if (datosJSON.estado === 200) { //ok
                            listar();
                            swal("Exito", datosJSON.mensaje, "success");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });

}
