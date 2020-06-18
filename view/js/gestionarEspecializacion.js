
$(document).ready(function () {
    cargarCbCodigoEspecialidad("#txtEspecialidad", "seleccione");
    cargarCbCodigoDoctorHorario("#txtDoctor", "seleccione");
    listar();
    
});

//cargarCbCodigoDoctor("#doctor", "seleccione");

function listar() {
    $.post
            (
                    "../controller/gestionarEspecializacion.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">ESPECIALIDAD</th>';
            html += '<th style="text-align:center">DOCTOR</th>';
            html += '<th style="text-align:center">OPCIÓN</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.doctorespecializacion_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_especialidad + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombresdoctor + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.doctorespecializacion_id + ')"><ion-icon name="create-outline"></ion-icon></button>';
                html += '&nbsp;&nbsp;'
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.doctorespecializacion_id + ')"><ion-icon name="trash-sharp"></ion-icon></button>';
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

                    var codEspecializacion = "";
                    if ($("#txtTipoOperacion").val() === "agregar") {
                        codEspecializacion = "0";
                    } else {
                        codEspecializacion = $("#txtCodigo").val();
                    }
                    $.post(
                            "../controller/gestionarEspecializacion.agregar.editar.controller.php",
                            {
                                p_especialidad_id:  $("#txtEspecialidad").val(),
                                p_doctor_id:        $("#txtDoctor").val(),
                                p_tipo_ope:         $("#txtTipoOperacion").val(),
                                p_codigo_especializacion: codEspecializacion
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


function leerDatos(codigo_especializacion) {
    $.post
            (
                    "../controller/gestionarEspecializacion.leer.datos.controller.php",
                    {
                        p_codigo_especializacion: codigo_especializacion
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            // Paciente:
            $("#txtCodigo").val(jsonResultado.datos.doctorespecializacion_id);
            $("#txtEspecialidad").val(jsonResultado.datos.especialidad_id);
            $("#txtDoctor").val(jsonResultado.datos.doctor_id);

           
            $("#titulomodalTratamiento").html("Datos de la Especialidad");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function eliminar(codEspecializacion) {
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
                            "../controller/gestionarEspecializacion.eliminar.controller.php",
                            {
                                p_codigo_especializacion: codEspecializacion
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