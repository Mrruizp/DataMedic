
$(document).ready(function () {
    
    listar();
    
});

//cargarCbCodigoDoctor("#doctor", "seleccione");

function listar() {
    $.post
            (
                    "../controller/gestionarDoctor.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">CÓDIGO COLEGIO</th>';
            html += '<th style="text-align:center">COLEGIO</th>';
            html += '<th style="text-align:center">NOMBRE</th>';
            html += '<th style="text-align:center">APELLIDOS</th>';
            html += '<th style="text-align:center">DIRECCIÓN</th>';
            html += '<th style="text-align:center">TELÉFONO</th>';
            html += '<th style="text-align:center">EMAIL</th>';
            html += '<th style="text-align:center">OPCIÓN</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.doctor_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.codigo_colegio + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.colegio + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellido + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.direccion + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.telefono + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.email + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.doctor_id + ')"><ion-icon name="create-outline"></ion-icon></button>';
                html += '&nbsp;&nbsp;'
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.doctor_id + ')"><ion-icon name="trash-sharp"></ion-icon></button>';
                html += '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listado").html(html);

/*
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "asc"]]
            });

            */
            $('#tabla-listado').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "sScrollX": false,
          });
        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}


$("#frmgrabar").submit(function (event) {
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

                if (isConfirm) { //el usuario hizo clic en el boton SI     
                    //procedo a grabar
                    //Llamar al controlador para grabar los datos

                    //var codLab = ($("#txtTipoOperacion").val()==="agregar")? 

                    var codDoctor = "";
                    if ($("#txtTipoOperacion").val() === "agregar") {
                        codDoctor = "0";
                    } else {
                        codDoctor = $("#txtCodigo").val();
                    }
                    $.post(
                            "../controller/gestionarDoctor.agregar.editar.controller.php",
                            {
                                p_colegio: $("#txtColegio").val(),
                                p_codigo_colegio: $("#txtCodigo_colegio").val(),
                                p_nombre: $("#txtNombre").val(),
                                p_apellido: $("#txtApellido").val(),
                                p_direccion: $("#txtDireccion").val(),
                                p_telefono: $("#txtTelefono").val(),
                                p_email: $("#txtEmail").val(),
                                p_tipo_ope:     $("#txtTipoOperacion").val(),
                                p_codigo_doctor: codDoctor
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar").click(); //Cerrar la ventana 
                            listar(); //actualizar la lista
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
    $("#txtCurso").val("");
$("#titulomodal").html("Agregar nuevo Curso");
});


$("#myModal").on("shown.bs.modal", function () {
    $("#txtPuesto").focus();
});


function leerDatos(codigo_doctor) {
    $.post
            (
                    "../controller/gestionarDoctor.leer.datos.controller.php",
                    {
                        p_codigo_doctor: codigo_doctor
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            // Paciente:
            $("#txtCodigo").val(jsonResultado.datos.doctor_id);
            $("#txtColegio").val(jsonResultado.datos.colegio);
            $("#txtCodigo_colegio").val(jsonResultado.datos.codigo_colegio);
            $("#txtNombre").val(jsonResultado.datos.nombre);
            $("#txtApellido").val(jsonResultado.datos.apellido);
            $("#txtDireccion").val(jsonResultado.datos.direccion);
            $("#txtTelefono").val(jsonResultado.datos.telefono);
            $("#txtEmail").val(jsonResultado.datos.email);

           
            $("#titulomodalDoctor").html("Datos del Doctor");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function eliminar(codDoctor) {
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
                            "../controller/gestionarDoctor.eliminar.controller.php",
                            {
                                p_codigo_doctor: codDoctor
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