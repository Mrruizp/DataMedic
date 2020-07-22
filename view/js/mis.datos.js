
$(document).ready(function () {
    
   // listar();
    cargarCbCodigoDepartamento("#cbDepartamento", "seleccione");
    cargarCbCodigoDepartamento("#cbDepartamentoEmp", "seleccione");// departamento para empresa
    
});




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

function leerDatosTratamiento(codigo_cita, codigo_paciente, p_fechahisttratamiento, p_hora) {
    $.post
            (
                    "../controller/gestionarHistorialTratamiento.leer.datos.controller.php",
                    {
                        p_codigo_cita: codigo_cita,
                        p_codigo_paciente: codigo_paciente,
                        p_fechahisttratamiento_cita: p_fechahisttratamiento,
                        p_hora_tratamiento: p_hora
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
            $("#txtHorario").val(jsonResultado.datos.horario);
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
                        var p_horario = "";
                        var p_descripcionHistTratamiento = "";
                        
                            p_cod_tratamiento            = $("#comboTratamiento").val();
                            p_cod_citaTratamiento        = $("#txtCod_citaTratamiento").val();
                            p_cod_paciente               = $("#txtCod_paciente").val();
                            p_fechaHistTratamiento       = $("#txtFechaTratamiento").val();
                            p_horaHistTratamiento        = $("#txtHoraTratamiento").val();
                            p_horario                    = $("#txtHorario").val();
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
                                p_horario:                    $("#txtHorario").val(),
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