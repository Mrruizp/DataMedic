
$(document).ready(function () {
    
    listar();
    cargarCbCodigoSede("#cbSede", "seleccione");
    cargarCbCodigoArea("#cbArea", "seleccione");
});

function listar() {
    $.post
            (
                    "../controller/gestionarConsultorio.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr class="bg-light">';
            html += '<th style="text-align:center">CODIGO</th>';
            html += '<th style="text-align:center">NOMBRE CONSULTORIO</th>';
            html += '<th style="text-align:center">SEDE</th>';
            html += '<th style="text-align:center">ÁREA</th>';
            html += '<th style="text-align:center">OPCIÓN</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.consultorio_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_consultorio + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.sede_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.area_id + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.consultorio_id + ')"><ion-icon name="create-outline"></ion-icon></button>';
                html += '&nbsp;&nbsp;'
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.consultorio_id + ')"><ion-icon name="trash-sharp"></ion-icon></button>';
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

                    var codSede = "";
                    if ($("#txtTipoOperacion").val() === "agregar") {
                        codSede = "0";
                    } else {
                        codSede = $("#txtCodigo").val();
                    }
                    $.post(
                            "../controller/gestionarSede.agregar.editar.controller.php",
                            {
                                
                                p_Empresa:      $("#txtEmpresa").val(),
                                p_Nombre_Sede:  $("#txtNombre_Sede").val(),
                                p_Departamento: $("#txtDepartamento").val(),
                                p_Provincia:    $("#txtProvincia").val(),
                                p_Distrito:     $("#txtDistrito").val(),
                                p_Direccion:    $("#txtDireccion").val(),
                                p_TipoSede:     $("#tipoSede").val(),
                                p_tipo_ope:     $("#txtTipoOperacion").val(),
                                p_codigo_Sede: codSede
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

function leerDatos(codigo_sede) {
    $.post
            (
                    "../controller/gestionarSede.leer.datos.controller.php",
                    {
                        p_codigo_sede: codigo_sede
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
            $("#txtTipoOperacion").val("editar");
            $("#txtCodigo").val(jsonResultado.datos.sede_id);
            $("#txtEmpresa").val(jsonResultado.datos.sede_id);
            $("#txtNombre_Sede").val(jsonResultado.datos.nombre_sede);
            $("#txtDepartamento").val(jsonResultado.datos.departamento_sede);
            $("#txtProvincia").val(jsonResultado.datos.provincia_sede);
            $("#txtDistrito").val(jsonResultado.datos.distrito_sede);
            $("#txtDireccion").val(jsonResultado.datos.direccion_sede);
            $("#tipoSede").val(jsonResultado.datos.tipo_sede);

           
            $("#titulomodalTratamiento").html("Datos del Tratamiento");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

function eliminar(codSede) {
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
                            "../controller/gestionarSede.eliminar.controller.php",
                            {
                                p_codigo_sede: codSede
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