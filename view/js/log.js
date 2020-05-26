$(document).ready(function () {

    listarLog_inicioseseion();
    listarLog_tratamiento();
    listarLog_usuario();
    listarLog_paciente();
    listarLog_cita();
});

function listarLog_inicioseseion() {
    $.post
            (
                    "../controller/log_inicioseseion.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center">DNI</th>';
            html += '<th style="text-align:center">NOMBRE COMPLETO</th>';
            html += '<th style="text-align:center">CARGO</th>';
            html += '<th style="text-align:center">TIPO DE USUARIO</th>';
            html += '<th style="text-align:center">FECHA DE OPERACIÓN</th>';
            html += '<th style="text-align:center">HORA DE OPERACION</th>';
            html += '<th style="text-align:center">DIRECCIÓN IP</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombrecompleto +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cargo +     '</td>';
                if(item.tipo === "A")
                    html += '<td align="center" style="font-weight:normal">Administrador</td>';
                if(item.tipo === "D")
                    html += '<td align="center" style="font-weight:normal">Doctor</td>';
                if(item.tipo === "C")
                    html += '<td align="center" style="font-weight:normal">Cliente</td>';

                if(item.tipo === "S")
                    html += '<td align="center" style="font-weight:normal">Super Administrador</td>';

                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_inicioseseion").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listado').DataTable({
                      "paging": true,
                      "lengthChange": true,
                      "searching": true,
                      "ordering": false,
                      "info": false,
                      "autoWidth": false,
                      "sScrollX": false,
                  });
  
           



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_tratamiento() {
    $.post
            (
                    "../controller/log_tratamiento.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_tratamiento" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr style="height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">NOMBRE COMPLETO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">TIPO DE USUARIO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">FECHA DE OPERACIÓN</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">HORA DE OPERACION</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">TIPO DE OPERACION IP</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">IP</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">TRATAMIENTO ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">TRATAMIENTO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tratamiento_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_tratamiento + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_tratamiento").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listadoLog_tratamiento').DataTable({
                      "paging": true,
                      "lengthChange": true,
                      "searching": true,
                      "ordering": false,
                      "info": false,
                      "autoWidth": false,
                      "sScrollX": false,
                  });
  
           



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_cita() {
    $.post
            (
                    "../controller/log_cita.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_cita" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr style="height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">USUARIO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">OPERACION</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">IP</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">CITA ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">FECHA</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">HORA</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DESCRIPCIÓN</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DNI</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DOCTOR ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">ESTADO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">PACIENTE ID</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cita_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha_cita + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.hora_cita + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.descripcion + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id_usuario + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doctor_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.estado + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.paciente_id + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_cita").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listadoLog_cita').DataTable({
                      "paging": true,
                      "lengthChange": true,
                      "searching": true,
                      "ordering": true,
                      "info": true,
                      "autoWidth": true,
                      "sScrollX": true,
                  });
  
           



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_usuario() {
    $.post
            (
                    "../controller/log_usuario.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_usuario" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr style="height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">USUARIO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">OPERACION</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">IP</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DNI</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DIRECCIÓN</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">TELÉFONO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">EMAIL</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">CARGO</th>';
            html += '<th style="text-align:center; background-color: #86fff6">CLAVE</th>';
            html += '<th style="text-align:center; background-color: #86fff6">USUARIO</th>';
            html += '<th style="text-align:center; background-color: #86fff6">ESTADO</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombrecompleto + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.direccion + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.telefono + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.email + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cargo_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.clave + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.estado + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_usuario").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listadoLog_usuario').DataTable({
                      "paging": true,
                      "lengthChange": true,
                      "searching": true,
                      "ordering": true,
                      "info": true,
                      "autoWidth": false,
                      "sScrollX": true,
                  });
  
           



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_paciente() {
    $.post
            (
                    "../controller/log_paciente.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_paciente" class="table table-bordered table-hover">';
            html += '<thead>';
            html += '<tr style="background-color:; height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">USUARIO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">OPERACION</th>';
            html += '<th style="text-align:center; background-color: #25c3ff">IP</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DNI</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">EDAD</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">SEXO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">NATURAL DE</th>';
             html += '<th style="text-align:center; background-color: #7df2ae">ESTADO CIVIL,</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">TELÉFONO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">RESPONSABLE</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">TELÉFONO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">ENFERMEDAD ACTUAL</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id +     '</td>';
                if(item.usuarioqueregistra_tipo === "A")
                    html += '<td align="center" style="font-weight:normal">Administrador</td>';
                if(item.usuarioqueregistra_tipo === "D")
                    html += '<td align="center" style="font-weight:normal">Doctor</td>';
                if(item.usuarioqueregistra_tipo === "C")
                    html += '<td align="center" style="font-weight:normal">Cliente</td>';

                if(item.usuarioqueregistra_tipo === "S")
                    html += '<td align="center" style="font-weight:normal">Super Administrador</td>';

                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.hora +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombres + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellidos + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.edad + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.sexo + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.naturalde + '</td>';

                if(item.estado_civil === "S")
                    html += '<td align="center" style="font-weight:normal">Soltero</td>';
                if(item.estado_civil === "C")
                    html += '<td align="center" style="font-weight:normal">Casado</td>';
                if(item.estado_civil === "V")
                    html += '<td align="center" style="font-weight:normal">Viudo</td>';
                if(item.estado_civil === "D")
                     html += '<td align="center" style="font-weight:normal">Divorsiado</td>';

                html += '<td align="center" style="font-weight:normal">' + item.telefono + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.personaresponsable + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.personaresponsable_telefono + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.descripcion_enfermedad_actual + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_paciente").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listadoLog_paciente').DataTable({
                      "paging": true,
                      "lengthChange": true,
                      "searching": true,
                      "ordering": false,
                      "info": false,
                      "autoWidth": true,
                      "sScrollX": true,
                  });
  
           



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje , "error"); 
    });
}

