
$(document).ready(function () {
    
    listar();
    //listarHistPaciente();
    cargarCbCodigoEspecialidad("#especialidad", "seleccione");
    cargarCbCodigoFecha("#txtFecha", "seleccione");
    cargarCbCodigoHora("#txtHora", "seleccione");
    
});

//cargarCbCodigoDoctor("#doctor", "seleccione");

function listar() {
    $.post
            (       // gestionarPaciente.listar.controller.php
                    "../controller/gestionarHCPaciente.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">DNI</th>';
            html += '<th style="text-align: center">NOMBRES</th>';
            html += '<th style="text-align: center">APELLIDOS</th>';
            html += '<th style="text-align: center">EDAD</th>';
            html += '<th style="text-align: center">SEXO</th>';
            html += '<th style="text-align: center">LUGAR DE NACIMIENTO</th>';
            html += '<th style="text-align: center">ESTADO CIVIL</th>';
            html += '<th style="text-align: center">OCUPACION</th>';
            html += '<th style="text-align: center">DATOS ADICIONALES</th>';
            html += '<th style="text-align: center">TRATAMIENTOS</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.paciente_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id + '</td>';

                html += '<td align="center" style="font-weight:normal">' + item.nombres + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellidos + '</td>';

                html += '<td align="center" style="font-weight:normal">' + item.edad + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.sexo + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.naturalde + '</td>';

                if(item.estado_civil === "S")
                    html += '<td align="center" style="font-weight:normal">Soltero(a)</td>';
                if(item.estado_civil === "C")
                    html += '<td align="center" style="font-weight:normal">Casado(a)</td>';
                if(item.estado_civil === "V")
                    html += '<td align="center" style="font-weight:normal">Viudo(a)</td>';
                if(item.estado_civil === "D")
                    html += '<td align="center" style="font-weight:normal">Divorciado(a)</td>';

                html += '<td align="center" style="font-weight:normal">' + item.ocupacion + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalPaciente" onclick="leerDatos(' + item.paciente_id + ')"><ion-icon name="person-outline"></ion-icon></button>';
                html += '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModalHTratamiento" onclick="listarHistPaciente(' + item.paciente_id + ')"><ion-icon name="document-text-outline"></ion-icon></button>';
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


$("#frmgrabarDatosAdicionales").submit(function (event) {
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
                    
                    $.post(
                            "../controller/gestionarHCPaciente.agregar.editar.controller.php",
                            {                 
                                p_codigo_paciente: $("#txtcod_paciente").val(),         
                                p_raza: $("#txtRaza").val(),
                                p_procedencia:$("#txtProcedencia").val(),
                                p_instruccion:$("#txtInstruccion").val(),
                                p_religion:$("#txtReligion").val(),
                                p_domicilio:$("#txtDomicilio").val(),
                                p_telefPacHC:$("#txtTelefonoPacHistClinica").val(),
                                p_fechaIngresoPaciente:$("#txtFechaIngresoPaciente").val(),
                                p_horaHistClinica:$("#txtHoraHistClinica").val(),
                                p_modoIngreso:$("#txtModoIngreso").val(),
                                p_fechaHistClinica:$("#txtFechaHistClinica").val(),
                                p_enfermedadActual:$("#txtEnfermedadActual").val(),
                                p_personaResponsable_paciente1:$("#txtPersonaResponsable_paciente1").val(),
                                p_telefono_paciente2:$("#txtTelefono_paciente2").val(),
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
                    "../controller/gestionarHCPaciente.leer.datos.controller.php",
                    {
                        p_codigo_paciente: codigo_paciente
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
           // $("#txtTipoOperacion").val("editar");
            // Paciente:
            $("#txtcod_paciente").val(jsonResultado.datos.paciente_id);
            $("#txtRaza").val(jsonResultado.datos.raza);
            $("#txtProcedencia").val(jsonResultado.datos.procedencia);
            $("#txtInstruccion").val(jsonResultado.datos.instruccion);
            $("#txtReligion").val(jsonResultado.datos.religion);
            $("#txtDomicilio").val(jsonResultado.datos.domicilio);
            $("#txtTelefonoPacHistClinica").val(jsonResultado.datos.telefono);
            $("#txtFechaIngresoPaciente").val(jsonResultado.datos.fecha_ingreso);
            $("#txtHoraHistClinica").val(jsonResultado.datos.hora);
            $("#txtModoIngreso").val(jsonResultado.datos.modoingreso);
            $("#txtFechaHistClinica").val(jsonResultado.datos.fecha_historia_clinica);
            $("#txtEnfermedadActual").val(jsonResultado.datos.descripcion_enfermedad_actual);
            $("#txtPersonaResponsable_paciente1").val(jsonResultado.datos.personaresponsable);
            $("#txtTelefono_paciente2").val(jsonResultado.datos.personaresponsable_telefono);

           
            $("#titulomodal").html("Datos del Paciente");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}


function listarHistPaciente(codigo_paciente) {
    $.post
            (       // gestionarPaciente.listar.controller.php
                    "../controller/gestionarHCPacienteHistorialTratamiento.listar.controller.php",
                        {
                            p_codigo_paciente: codigo_paciente
                        }
                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoHistPaciente" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">FECHA</th>';
            html += '<th style="text-align: center">HORA</th>';
            html += '<th style="text-align: center">DESCRIPCION</th>';
            html += '<th style="text-align: center">TRATAMIENTO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                $("#txtDoc_id_paciente1").val(item.doc_id);
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.historial_tratamiento_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha + '</td>';

                html += '<td align="center" style="font-weight:normal">' + item.hora + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.descripcion + '</td>';

                html += '<td align="center" style="font-weight:normal">' + item.nombre_tratamiento + '</td>';

                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoHistPaciente").html(html);

/*
            $('#tabla-listado').dataTable({
                "aaSorting": [[1, "asc"]]
            });

            */
            $('#tabla-listadoHistPaciente').DataTable({
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

