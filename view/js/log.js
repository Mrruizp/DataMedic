$(document).ready(function () {

    listarLog_inicioseseion();
    listarLog_tratamiento();
    listarLog_especialidad();
    listarLog_doctor();
    listarLog_doctor_especialidad();
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

function listarLog_especialidad() {
    $.post
            (
                    "../controller/log_especialidad.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_especialidad" class="table table-bordered table-hover">';
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
            html += '<th style="text-align:center; background-color: #7df2ae">ESPECIALIDAD ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">ESPECIALIDAD</th>';
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
                html += '<td align="center" style="font-weight:normal">' + item.especialidad_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_especialidad + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_especialidad").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listadoLog_especialidad').DataTable({
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

function listarLog_doctor() {
    $.post
            (
                    "../controller/log_doctor.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_doctor" class="table table-bordered table-hover">';
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
            html += '<th style="text-align:center; background-color: #7df2ae">DOCTOR ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">COLEGIO</th>'
            html += '<th style="text-align:center; background-color: #7df2ae">CÓDIGO COLEGIO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">NOMBRE</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DIRECCION</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">TELEFONO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">EMAIL</th>';
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
                html += '<td align="center" style="font-weight:normal">' + item.doctor_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.colegio +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.codigo_colegio +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellido +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.direccion + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.telefono + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.email + '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_doctor").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listadoLog_doctor').DataTable({
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

function listarLog_doctor_especialidad() { // especialización
    $.post
            (
                    "../controller/log_doctor_especialidad.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_especializacion" class="table table-bordered table-hover">';
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
            html += '<th style="text-align:center; background-color: #7df2ae">ESPECIALIZACIÓN ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">ESPECIALIDAD ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae">DOCTOR ID</th>';
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
                html += '<td align="center" style="font-weight:normal">' + item.doctorespecializacion_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.especialidad_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doctor_id +  '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_especializacion").html(html);
            //$("#tabla-listado").DataTable();

          
            $('#tabla-listadoLog_especializacion').DataTable({
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
            html += '<th style="text-align:center; background-color: #7df2ae">CITA ID</th>';;
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
                    html += '<td align="center" style="font-weight:normal">Super Usuario</td>';

                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.hora +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +     '</td>';
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

