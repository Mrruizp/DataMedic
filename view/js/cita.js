
$(document).ready(function () {
    
    listar();
    cargarCbTratamiento("#comboTratamiento", "seleccione");
    /*
    cargarCbCodigoEspecialidad("#especialidad", "seleccione");
    cargarCbCodigoFecha("#txtFecha", "seleccione");
    cargarCbCodigoHora("#txtHora", "seleccione");
    
    */
});

//cargarCbCodigoDoctor("#doctor", "seleccione");

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
            html += '<th style="text-align: center">USUARIO</th>';
            html += '<th style="text-align:center">FECHA</th>';
            html += '<th style="text-align:center">CONSULTORIO</th>';
             html += '<th style="text-align: center">DOCTOR</th>';
            html += '<th style="text-align: center">MENSAJE</th>';
            html += '<th style="text-align: center">PACIENTE</th>';
            html += '<th style="text-align: center">TRATAMIENTO</th>';
            html += '<th style="text-align: center">ESTADO</th>';
            if(datosJSON.datos[0].cliente_id !== "C" && datosJSON.datos[0].doctor_id !== "D" )
            {
                html += '<th style="text-align: center">HABILITAR</th>';
            }
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.cita_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombrecompleto + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_consultorio + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_doctor + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.descripcion + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.paciente_id + ')"><ion-icon name="person-outline"></ion-icon></button>';
                html += '</td>';
                /*
                if(item.cliente_id === "C" )
                {*/
                    if(item.estado === "Cita Atendida" || item.estado === "Cita Confirmada")
                    {
                        html += '<td align="center">';
                        html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalTratamientoPaciente" onclick="leerDatosTratamiento(' + item.cita_id + ','+ item.paciente_id +')"><ion-icon name="document-text-outline"></ion-icon></button>';
                        html += '</td>';                    
                    }else
                    {
                       html += '<td align="center" style="font-weight:normal" class="text-warning"><b>NO DISPONIBLE</b></td>';                  
                        html += '</td>'; 
                    }
                /*}else
                {
                    html += '<td align="center">';
                    html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalTratamientoPaciente" onclick="leerDatosTratamiento(' + item.cita_id + ','+ item.paciente_id +')"><ion-icon name="document-text-outline"></ion-icon></button>';
                    html += '</td>'; 
                }

                */
                
                if(item.estado === "Cita Confirmada" || item.estado === "Cita Atendida" )
                {
                    html += '<td align="center" style="font-weight:normal" class="text-primary"><b>' + item.estado + '</b></td>';
                }else
                    html += '<td align="center" style="font-weight:normal"class="text-success"><b>' + item.estado + '</b></td>';
                
                if(item.cliente_id !== "C" && item.doctor_id !== "D")
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
                            "../controller/cita.editar.controller.php",
                            {
                               
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
                                p_codigo_cita: codCita
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
            // usuario
            $("#txtCodigo").val(jsonResultado.datos.cita_id);
            $("#txtDoc_id").val(jsonResultado.datos.doc_usuario);
            //$("#txtFecha").val(jsonResultado.datos.fecha);
            //$("#txtHora").val(jsonResultado.datos.hora);
           // $("#especialidad").val(jsonResultado.datos.nombre_doctor);
           // $("#doctor").val(jsonResultado.datos.nombre_doctor);
            $("#txtDescripcion").val(jsonResultado.datos.descripcion);

            // Paciente:
            $("#txtDoc_id_paciente").val(jsonResultado.datos.doc_paciente);
            $("#txtCiudad_paciente").val(jsonResultado.datos.naturalde);
            $("#estadoCivil_paciente").val(jsonResultado.datos.estado_civil);
            $("#edad_paciente").val(jsonResultado.datos.edad);
            $("#txtNombre_paciente").val(jsonResultado.datos.nombres);
            $("#txtApellidos_paciente").val(jsonResultado.datos.apellidos);
            $("#sexo_paciente").val(jsonResultado.datos.sexo);
            $("#txtOcupacion_paciente").val(jsonResultado.datos.ocupacion);
            $("#txtReligion_paciente").val(jsonResultado.datos.religion);
            $("#txtDomicilio_paciente").val(jsonResultado.datos.domicilio);
            $("#txtTelefono_paciente").val(jsonResultado.datos.telefono);
            $("#txtPersonaResponsable_paciente").val(jsonResultado.datos.personaresponsable);
            $("#txtTelefonoResponsable_paciente").val(jsonResultado.datos.personaresponsable_telefono);
           
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

$("#frmgrabarEstado").submit(function (event) {
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
                            "../controller/gestionarEstado.editar.controller.php",
                            {
                                p_cod_citaEstado:  $("#txtCod_citaEstado").val(),
                                p_estado_cita:         $("#hab_desh_proc").val()

                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar").click(); //Cerrar la ventana 
                            listar(); //actualizar la lista
                            $("#btncerrarEstado").click(); //Cerrar la ventana 
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

function leerDatosTratamiento(codigo_cita, codigo_paciente) {
    $.post
            (
                    "../controller/gestionarHistorialTratamiento.leer.datos.controller.php",
                    {
                        p_codigo_cita: codigo_cita,
                        p_codigo_paciente: codigo_paciente
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            
            $("#comboTratamiento").val(jsonResultado.datos.tratamiento_id);
            $("#txtCod_citaTratamiento").val(jsonResultado.datos.cita_id);
            $("#txtCod_paciente").val(jsonResultado.datos.paciente_id);
            $("#txtFechaTratamiento").val(jsonResultado.datos.fecha);
            $("#txtHoraTratamiento").val(jsonResultado.datos.hora);
            $("#txtDescripcionTratamientoPaciente").val(jsonResultado.datos.descripcion);
           
            $("#titulomodalTratamientoPaciente").html("Detalle del tratamiento");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

$("#frmgrabarTratamientoPaciente").submit(function (event) {
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

                        var p_cod_tratamiento = "";
                        var p_cod_citaTratamiento = "";
                        var p_cod_paciente = "";
                        var p_fechaHistTratamiento = "";
                        var p_horaHistTratamiento = "";
                        var p_descripcionHistTratamiento = "";
                            
                            p_cod_tratamiento            = $("#comboTratamiento").val();
                            p_cod_citaTratamiento        = $("#txtCod_citaTratamiento").val();
                            p_cod_paciente               = $("#txtCod_paciente").val();
                            p_fechaHistTratamiento       = $("#txtFechaTratamiento").val();
                            p_horaHistTratamiento        = $("#txtHoraTratamiento").val();
                            p_descripcionHistTratamiento = $("#txtDescripcionTratamientoPaciente").val();


                            //alert(p_cod_citaTratamiento+", "+p_cod_paciente+", "+p_fechaHistTratamiento+", "+p_horaHistTratamiento+", "+p_cod_tratamiento+", "+p_descripcionHistTratamiento);
                            
                    $.post(
                            "../controller/gestionarHistorialTratamiento.agregar.editar.controller.php",
                            {
                                p_cod_tratamiento:            $("#comboTratamiento").val(),
                                p_cod_citaTratamiento:        $("#txtCod_citaTratamiento").val(),
                                p_cod_paciente:               $("#txtCod_paciente").val(),
                                p_fechaHistTratamiento:       $("#txtFechaTratamiento").val(),
                                p_horaHistTratamiento:        $("#txtHoraTratamiento").val(),
                                p_descripcionHistTratamiento: $("#txtDescripcionTratamientoPaciente").val()

                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            swal("Exito", datosJSON.mensaje, "success");
                            $("#btncerrar").click(); //Cerrar la ventana 
                            listar(); //actualizar la lista
                            $("#btncerrarTratamientoPaciente").click(); //Cerrar la ventana 
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