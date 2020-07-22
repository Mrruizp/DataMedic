

$("#frmgrabarUsuario").submit(function (event) {
    event.preventDefault();

 

               

                    $.post(
                            "../controller/registrate.usuario.agregar.controller.php",
                            {
                                p_email: $("#textEmailR").val(),
                                p_password: $("#textPassword1").val()
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            alertify.success("<p class = 'text-white'>Se registró su usuario</p>");
                            setTimeout("location.href='../view/index.php'",2000);
                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        //var datosJSON = $.parseJSON(error.responseText);
                        //swal("Error", datosJSON.mensaje, "error");
                        alertify.error("<p class = 'text-white'>El usuario ya existe</p>");
                            setTimeout("location.href='../view/login.view.php'",2000);
                    });

             

});