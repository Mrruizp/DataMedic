$(document).ready(function () {



    listarLog_especialidad();
    listarLog_usuario();
    listarLog_curso();
    listarLog_prueba();
    listarLog_pregunta();
});

function listarLog_especialidad() {
    $.post
            (
                    "../controller/log_inicioseseion.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoEspecialidad" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
             html += '<th style="text-align:center; background-color: #25c3ff;">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">FECHA DE OPERACION</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">HORA DE OPERACION</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">IP</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">OPERACION</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">CODIGO ESPECIALIDAD</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">ESPECIALIDAD</th>';
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombres +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellidos + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cargo +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +        '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoEspecialidad").html(html);


            $('#tabla-listadoEspecialidad').dataTable({
                "aaSorting": [[1, "asc"]],
                "scrollX": true
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
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
            html += '<table id="tabla-listadoLog_usuario" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff;">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">IP</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">OPERACION</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">DNI</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">DIRECCIÓN</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">TELEFONO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">EMAIL</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CARGO_ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CURSO</th>';
            html += '<th style="text-align:center; background-color: #86fff6;">CLAVE</th>';
            html += '<th style="text-align:center; background-color: #86fff6;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #86fff6;">ESTADO</th>';  
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_apellidos +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +       '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +             '</td>';                
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.doc_id +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombres +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.apellidos +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.direccion +      '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.telefono +       '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.email +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cargo_id +       '</td>';                
                html += '<td align="center" style="font-weight:normal">' + item.nombre_curso +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.clave +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo +           '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.estado +         '</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_usuario").html(html);


            $('#tabla-listadoLog_usuario').dataTable({
                "aaSorting": [[1, "asc"]],
                "scrollX": true
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_curso() {
    $.post
            (
                    "../controller/log_curso.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_curso" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff;">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">IP</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">OPERACIÓN</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CURSO ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CURSO</th>';
            
            
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_apellidos +'</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +          '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +             '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion + '</td>'
                html += '<td align="center" style="font-weight:normal">' + item.curso_id +       '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_curso +   '</td>';
                ;
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_curso").html(html);


            $('#tabla-listadoLog_curso').dataTable({
                "aaSorting": [[1, "asc"]],
                "scrollX": true
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_prueba() {
    $.post
            (
                    "../controller/log_prueba.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_prueba" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff;">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">IP</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">OPERACIÓN</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">PRUEBA ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CANTIDAD PREGUNTA</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">TIEMPO</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">APROBACIÓN ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">INSTRUCCIONES</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">CURSO ID</th>';
            
            
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_apellidos +'</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +             '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +            '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.prueba_id +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.cant_preguntas +    '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo_prueba +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.puntaje_aprobacion +'</td>';
                html += '<td align="center" style="font-weight:normal">' + item.instrucciones +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.curso_id +          '</td>'                
                html += '<td align="center" style="font-weight:normal">' + item.ip +                '</td>';              
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_prueba").html(html);


            $('#tabla-listadoLog_prueba').dataTable({
                "aaSorting": [[1, "asc"]],
                "scrollX": true
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

function listarLog_pregunta() {
    $.post
            (
                    "../controller/log_pregunta.listar.controller.php"

                    ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listadoLog_pregunta" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            html += '<th style="text-align:center; background-color: #25c3ff;">DNI</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">NOMBRES</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">APELLIDOS</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">CARGO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">TIPO</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">FECHA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">HORA</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">IP</th>';
            html += '<th style="text-align:center; background-color: #25c3ff;">OPERACIÓN</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">PREGUNTA ID</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">PREGUNTA</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">ALTETNATIVA 1</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">ALTETNATIVA 2</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">ALTETNATIVA 3</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">ALTETNATIVA 4</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">RESPUESTA</th>';
            html += '<th style="text-align:center; background-color: #7df2ae;">PRUEBA ID</th>';
            
            
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_doc_id +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_nombres +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_apellidos +'</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_cargo_id + '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.usuarioqueregistra_tipo +     '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.fecha +         '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tiempo +        '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.ip +'</td>';
                html += '<td align="center" style="font-weight:normal">' + item.tipo_operacion +'</td>';
                html += '<td align="center" style="font-weight:normal">' + item.pregunta_id +   '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.nombre_pregunta+'</td>';
                html += '<td align="center" style="font-weight:normal">' + item.alternativa1 +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.alternativa2 +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.alternativa3 +  '</td>';
                html += '<td align="center" style="font-weight:normal">' + item.alternativa4 +  '</td>';                
                html += '<td align="center" style="font-weight:normal">' + item.respuesta +     '</td>';      
                html += '<td align="center" style="font-weight:normal">' + item.prueba_id+      '</td>';              
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#listadoLog_pregunta").html(html);


            $('#tabla-listadoLog_pregunta').dataTable({
                "aaSorting": [[1, "asc"]],
                "scrollX": true
            });



        } else {
            //swal("Mensaje del sistema", resultado , "warning");
        }

    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        //swal("Error", datosJSON.mensaje , "error"); 
    });
}

