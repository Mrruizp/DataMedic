
$(document).ready(function () {
    
    //listar();
    
});

//cargarCbCodigoDoctor("#doctor", "seleccione");

function listar(mes, numero, ano, estado) {
    $.post
            (
                    "../controller/dashboard.listar.controller.php",
                    {
                        p_mes: mes,
                        p_numero: numero,
                        p_ano: ano,
                        p_estado: estado
                    }

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
            html += '<th style="text-align:center">HORA</th>';
            html += '<th style="text-align:center">HORARIO</th>';
            html += '<th style="text-align:center">CONSULTORIO</th>';
            html += '<th style="text-align:center">DOCTOR</th>';
            html += '<th style="text-align:center">OPCIÓN</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.cita_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.hora + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.horario + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_consultorio + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_doctor + '</td>';
                html += '<td align="center">';
                html += '<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#myModal" onclick="leerDatos(' + item.tratamiento_id + ')"><ion-icon name="create-outline"></ion-icon></button>';
                html += '&nbsp;&nbsp;'
                html += '<button type="button" class="btn btn-danger btn-xs" onclick="eliminar(' + item.tratamiento_id + ')"><ion-icon name="trash-sharp"></ion-icon></button>';
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
   
                   
                    $.post(
                            "../controller/dashboard.listar.controller.php",
                            {
                              p_mes:     $("#cbMes").val(),
                              p_numero:  $("#cbNumero").val(),
                              p_ano:     $("#cbAno").val(),
                              p_estado:  $("#txtEstado").val()
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            var cont = 0;
                            var html = "";

                            html += '<small>';
                            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
                            html += '<thead>';
                            html += '<tr class="bg-light">';
                            html += '<th style="text-align:center">CODIGO</th>';
                            html += '<th style="text-align:center">FECHA</th>';
                            html += '<th style="text-align:center">HORA</th>';
                            html += '<th style="text-align:center">HORARIO</th>';
                            html += '<th style="text-align:center">CONSULTORIO</th>';
                            html += '<th style="text-align:center">DOCTOR</th>';
                            html += '<th style="text-align:center">PACIENTE</th>';
                            html += '</tr>';
                            html += '</thead>';
                            html += '<tbody>';
                            $.each(datosJSON.datos, function (i, item) {
                                html += '<tr>';
                                html += '<td align="center" style="font-weight:normal">' + item.cita_id + '</td>';
                                html += '<td align="center" style="font-weight:normal">' + item.fecha + '</td>';
                                html += '<td align="center" style="font-weight:normal">' + item.hora + '</td>';
                                html += '<td align="center" style="font-weight:normal">' + item.horario + '</td>';
                                html += '<td align="center" style="font-weight:normal">' + item.nombre_consultorio + '</td>';
                                html += '<td align="center" style="font-weight:normal">' + item.nombre_doctor + '</td>';
                                html += '<td align="center" style="font-weight:normal">' + item.nombrespaciente + '</td>';
                                
                                html += '</tr>';
                                cont ++;
                            });

                            html += '</tbody>';
                            html += '</table>';
                            html += '</small>';
                            $("#textTotalCitas").val(cont);
                            $("#listado").html(html);
                            

                /*
                            $('#tabla-listado').dataTable({
                                "aaSorting": [[1, "asc"]]
                            });

                            */
                           

                            
                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

              

});
/*
function leerDatos() {
    $.post
            (
                    "../controller/dashboard.listar.controller.php",
                    {
                          p_mes:     $("#cbMes").val(),
                          p_numero:  $("#cbNumero").val(),
                          p_ano:     $("#cbAno").val(),
                          p_estado:  $("#txtEstado").val()
                    }
            ).done(function (resultado) {
        var jsonResultado = resultado;
        if (jsonResultado.estado === 200) {
          
            $("#cbMes").val(jsonResultado.datos.consultorio_id);
            $("#cbNumero").val(jsonResultado.datos.nombre_consultorio);
            $("#cbAno").val(jsonResultado.datos.sede_id);
            $("#txtEstado").val(jsonResultado.datos.area_id);

            $("#titulomodalConsultorio").html("Datos del Consultorio");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}
*/