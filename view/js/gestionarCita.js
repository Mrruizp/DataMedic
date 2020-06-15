
function getParameterByName(name) { // extraer el id por get
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

$(document).ready(function () {
    var codigo = "";
    codigo = getParameterByName('id');
   // cargarCbCodigoConsultorioCita("#cbConsultorio", getParameterByName(id), "seleccione");
    cargarDatos(getParameterByName('id'));// horario_atencion_id
    cargarCbCodigoConsultorioCita("#cbConsultorio", codigo, "seleccione");
    //listar();
    
    //cargarCbCodigoFecha("#txtFecha", "seleccione");
   // cargarCbCodigoHora("#txtHora", "seleccione");
   // cargarCbTratamiento("#comboTratamiento", "seleccione");

});

function cargarDatos(codHorario_atencion) {
    $.post
            (
                    "../controller/gestionarHorarioCita.leer.datos.controller.php",
                    {
                        p_codigo_Horario_atencion : codHorario_atencion
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("agregar");
            // Paciente:
            $("#txtFecha").val(jsonResultado.datos.fecha);
            //$("#txtConsultorio").val(jsonResultado.datos.nombre_consultorio);
            $("#txtCodigoConsultorio").val(jsonResultado.datos.consultorio_id);
            $("#txtDoctor").val(jsonResultado.datos.nombresdoctor);

           
            $("#titulomodal").html("Datos del Paciente");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });

                    
}

function listar() {
    $.post
            (
                    "../controller/gestionarCita.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">FECHA</th>';
            html += '<th style="text-align: center">HORA</th>';
            html += '<th style="text-align: center">MENSAJE</th>';
            html += '<th style="text-align: center">USUARIO</th>';
            html += '<th style="text-align: center">DOCTOR</th>';
            html += '<th style="text-align: center">PACIENTE</th>';
            html += '<th style="text-align: center">TRATAMIENTO</th>';
            html += '<th style="text-align: center">ESTADO</th>';
            if(datosJSON.datos[0].tipo !== "C" && (!datosJSON.datos[0].email))
            {
                html += '<th style="text-align: center">HABILITAR</th>';
            }
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.cita_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha + '</td>';

                html += '<td align="center" style="font-weight:normal">' + item.hora + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.descripcion + '</td>';

                html += '<td align="center" style="font-weight:normal">' + item.nombrecompleto + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombresdoctor + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalPaciente" onclick="leerDatos(' + item.paciente_id + ')"><ion-icon name="person-outline"></ion-icon></button>';
                html += '</td>';

                if(item.tipo === "C")
                {
                    if(item.estado === "Cita Atendida")
                    {
                        html += '<td align="center">';
                        html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalTratamientoPaciente" onclick="leerDatosTratamiento(' + item.cita_id + ','+ item.paciente_id +')"><ion-icon name="document-text-outline"></ion-icon></button>';
                        html += '</td>';                    
                    }else
                    {
                       html += '<td align="center" style="font-weight:normal" class="text-warning"><b>NO DISPONIBLE</b></td>';                  
                        html += '</td>'; 
                    }
                }else
                {
                    html += '<td align="center">';
                    html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalTratamientoPaciente" onclick="leerDatosTratamiento(' + item.cita_id + ','+ item.paciente_id +')"><ion-icon name="document-text-outline"></ion-icon></button>';
                    html += '</td>'; 
                }


                
                if(item.estado === "Cita Confirmada" || item.estado === "Cita Atendida" )
                {
                    html += '<td align="center" style="font-weight:normal" class="text-primary"><b>' + item.estado + '</b></td>';
                }else
                    html += '<td align="center" style="font-weight:normal"class="text-success"><b>' + item.estado + '</b></td>';
                
                if(item.tipo !== "C" && (!item.email))
                {
                    html += '<td align="center">';
                    html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalEstadoCita" onclick="leerDatosEstado(' + item.paciente_id + ')"><ion-icon name="checkmark-done-outline"></ion-icon></button>';
                    html += '</td>';
                    html += '</tr>';
                }
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
                                p_consultorio:         $("#txtCodigoConsultorio").val(),
                                //p_especialidad: $("#especialidad").val(),
                                p_doctor:       $("#txtDoctor").val(),
                               
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
                                p_descripcion:  $("#txtDescripcion").val(),

                                p_tipo_ope:     $("#txtTipoOperacion").val(),
                                p_codigo_curso: codCita
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");

                            $("#cbConsultorio").val("");
                            $("#txtDoc_id").val("");
                            $("#txtFecha").val("");
                            $("#txtCodigoConsultorio").val("");
                            $("#txtDoctor").val("");
                            $("#txtDoc_id_paciente").val("");
                            $("#txtCiudad_paciente").val("");
                            $("#estadoCivil_paciente").val("");
                            $("#edad_paciente").val("");
                            $("#txtNombre_paciente").val("");
                            $("#txtApellidos_paciente").val("");
                            $("#sexo_paciente").val("");
                            $("#txtOcupacion_paciente").val("");
                            $("#txtReligion_paciente").val("");
                            $("#txtDomicilio_paciente").val("");
                            $("#txtTelefono_paciente").val("");
                            $("#txtPersonaResponsable_paciente").val("");
                            $("#txtTelefonoResponsable_paciente").val("");
                            $("#txtDescripcion").val("");

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


function leerDatos(codigo_paciente) {
    $.post
            (
                    "../controller/gestionarCita.leer.datos.controller.php",
                    {
                        p_codigo_paciente: codigo_paciente
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            // Paciente:

            $("#txtDoc_id_paciente1").val(jsonResultado.datos.doc_id);
            $("#txtCiudad_paciente1").val(jsonResultado.datos.naturalde);
            $("#estadoCivil_paciente1").val(jsonResultado.datos.estado_civil);
            $("#edad_paciente1").val(jsonResultado.datos.edad);
            $("#txtNombre_paciente1").val(jsonResultado.datos.nombres);
            $("#txtApellidos_paciente1").val(jsonResultado.datos.apellidos);
            $("#sexo_paciente1").val(jsonResultado.datos.sexo);
            $("#txtOcupacion_paciente1").val(jsonResultado.datos.ocupacion);
            $("#txtReligion_paciente1").val(jsonResultado.datos.religion);
            $("#txtDomicilio_paciente1").val(jsonResultado.datos.domicilio);
            $("#txtTelefono_paciente1").val(jsonResultado.datos.telefono);
            $("#txtPersonaResponsable_paciente1").val(jsonResultado.datos.personaresponsable);
            $("#txtTelefono_paciente2").val(jsonResultado.datos.personaresponsable_telefono);

           
            $("#titulomodal").html("Datos del Paciente");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function eliminar(codCurso) {
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
                            "../controller/gestionarCurso.eliminar.controller.php",
                            {
                                p_codigo_curso: codCurso
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

function leerDatosEstado(codigo_paciente) {
    $.post
            (
                    "../controller/gestionarCita.leer.datos.controller.php",
                    {
                        p_codigo_paciente: codigo_paciente
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            //$("#txtTipoOperacionEstado").val("editar");
            // Paciente:
            $("#hab_desh_proc").val(jsonResultado.datos.estado);
            $("#txtCod_citaEstado").val(jsonResultado.datos.cita_id);

           
            $("#titulomodalEstadoCita").html("Datos del Estado");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}


