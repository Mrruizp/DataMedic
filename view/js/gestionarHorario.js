
$(document).ready(function () {
    
    listar();
    cargarCbCodigoSede("#cbSede", "seleccione");
    cargarCbCodigoArea("#cbArea", "seleccione");
    cargarCbCodigoConsultorio2("#cbConsultorio", "seleccione");
    cargarCbCodigoDoctorHorario("#cbDoctor", "seleccione");//muestra todos los doctores
    
});

//cargarCbCodigoDoctor("#doctor", "seleccione");

function listar() {
    $.post
            (
                    "../controller/gestionarHorario.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
             html += '<th style="text-align: center">FECHA</th>';
             html += '<th style="text-align: center">CONSULTORIO</th>';
            html += '<th style="text-align:center">DOCTOR</th>';
            html += '<th style="text-align: center">DETALLE</th>';
            html += '<th style="text-align: center">OPCIONES</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.horario_atencion_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_consultorio + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombresdoctor + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalHorarioDetalle" onclick="listarHorarioDetalle(' + item.doctor_id +')"><ion-icon name="time-outline"></ion-icon></button>';
                html += '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.horario_atencion_id + ')"><ion-icon name="create-outline"></ion-icon></button>';
                html += '&nbsp;&nbsp;'
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.horario_atencion_id + ')"><ion-icon name="trash-sharp"></ion-icon></button>';
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
            "lengthChange": true,
            "searching": true,
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

function listarHorarioDetalle(codigo_doctor) {
    $.post
            (       
                    "../controller/gestionarHorarioDetalle.listar.controller.php",
                        {
                            p_codigo_doctor: codigo_doctor
                        }
                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoHorarioDetalle" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">HORA</th>';
            html += '<th style="text-align: center">HORARIO</th>';
            html += '<th style="text-align: center">ESTADO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                $("#txtDoc_id_paciente1").val(item.doc_id);
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.horario_atencion_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.hora + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.horario + '</td>';
                if(item.estado  === "1")
                    html += '<td align="center" style="font-weight:normal">Disponible</td>';
                else
                    html += '<td align="center" style="font-weight:normal">No Disponible</td>';

                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoHorarioDetalle").html(html);

/*
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "asc"]]
            });

            */
            $('#tabla-listadoHorarioDetalle').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "sScrollX": false
          });
        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje , "error"); 
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

                    var codCita = "";
                    if ($("#txtTipoOperacion").val() === "agregar") {
                        codCita = "0";
                    } else {
                        codCita = $("#txtCodigo").val();
                    }
                    $.post(
                            "../controller/gestionarCita.agregar.editar.controller.php",
                            {
                                p_doc_id:       $("#txtDoc_id").val(),
                                p_fecha:        $("#txtFecha").val(),
                                p_hora:         $("#txtHora").val(),
                                //p_especialidad: $("#especialidad").val(),
                                p_doctor:       $("#doctor").val(),
                                p_descripcion:  $("#txtDescripcion").val(),
                    // Paciente:
                                p_doc_id_paciente:  $("#txtDoc_id_paciente").val(),
                                p_ciudad_paciente:  $("#txtCiudad_paciente").val(),
                                p_estadoCivil_paciente:  $("#estadoCivil_paciente").val(),
                                p_edad_paciente:         $("#edad_paciente").val(),
                                p_nombre_paciente:       $("#txtNombre_paciente").val(),
                                p_apellidos_paciente:    $("#txtApellidos_paciente").val(),
                                p_sexo_paciente:         $("#sexo_paciente").val(),
                                p_ocupacion_paciente:    $("#txtOcupacion_paciente").val(),
                                p_religion_paciente:     $("#txtReligion_paciente").val(),
                                p_domicilio_paciente:    $("#txtDomicilio_paciente").val(),
                                p_telefono_paciente:     $("#txtTelefono_paciente").val(),
                                p_personaResponsable_paciente:   $("#txtPersonaResponsable_paciente").val(),
                                p_telefonoResponsable_paciente:  $("#txtTelefonoResponsable_paciente").val(),

                                p_tipo_ope:     $("#txtTipoOperacion").val(),
                                p_codigo_curso: codCita
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


function leerDatos(codigo_horario) {
    $.post
            (
                    "../controller/gestionarHorario.leer.datos.controller.php",
                    {
                        p_codigo_horario: codigo_horario
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            // Paciente:
            $("#cbSede").val(jsonResultado.datos.sede_id);
            $("#cbArea").val(jsonResultado.datos.area_id);

            $("#cbConsultorio").val(jsonResultado.datos.consultorio_id);
            $("#cbDoctor").val(jsonResultado.datos.doctor_id);
            $("#cbDia").val(jsonResultado.datos.dia_semana);
            $("#cbNumero").val(jsonResultado.datos.numero);
            $("#cbMes").val(jsonResultado.datos.mes);
            $("#cbAno").val(jsonResultado.datos.ano);

           
            $("#titulomodal").html("Datos del Paciente");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function eliminar(codHorario) {
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
                            "../controller/gestionarHorario.eliminar.controller.php",
                            {
                                p_codigo_Horario: codHorario
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

