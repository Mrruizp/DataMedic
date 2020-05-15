function cargarCbCodigoDoctor(p_doctor_id, p_nombreCombo_especialidad, p_tipo){
    $.post
    (
    	"../controller/comboCodigoDoctor.php",
        {
            p_codigo_especialidad: p_nombreCombo_especialidad
        }

    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Todos los doctores</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.doctor_id+'">'+item.nombres+'</option>';
            });
            
            $(p_doctor_id).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarCbCodigoEspecialidad(p_nombreCombo, p_doctor_id, p_tipo){
    $.post
    (
	"../controller/comboCodigoEspecialidad.php"
    ).done(function(resultado){
	var datosJSON = resultado;
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Todas las especialidades</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.especialidad_id+'">'+item.nombre_especialidad+'</option>';
            });
            
            $(p_nombreCombo).html(html);
           // cargarCbCodigoDoctor(p_doctor_id, p_nombreCombo, p_tipo);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarCbCodigoFecha(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/comboCodigoFecha.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Fechas disponibles</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.fecha_id+'">'+item.fecha+'</option>';
            });
            
            $(p_nombreCombo).html(html);
           // cargarCbCodigoDoctor(p_doctor_id, p_nombreCombo, p_tipo);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarCbCodigoHora(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/comboCodigoHora.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Horas disponibles</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.fecha_id+'">'+item.hora+'</option>';
            });
            
            $(p_nombreCombo).html(html);
           // cargarCbCodigoDoctor(p_doctor_id, p_nombreCombo, p_tipo);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}