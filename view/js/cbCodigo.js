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
                html += '<option value="0">-</option>';
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
                html += '<option value="'+item.fecha+'">'+item.fecha+'</option>';
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

function cargarCbCodigoDoctorHorario(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/comboCodigoDoctorHorario.php"
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
                html += '<option value="'+item.doctor_id+'">'+item.nombrecompleto+'</option>';
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
                html += '<option value="'+item.hora+'">'+item.hora+'</option>';
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

function cargarCbTratamiento(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/gestionarTratamiento.listar.controller.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Lista de tratamientos</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.tratamiento_id+'">'+item.nombre_tratamiento+'</option>';
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

function cargarCbCodigoEmpresa(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/comboCodigoEmpresa.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">-</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.empresa_id+'">'+item.razon_social+'</option>';
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

function cargarCbCodigoSede(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/comboCodigoSede.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">-</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.sede_id+'">'+item.nombre_sede+'</option>';
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

function cargarCbCodigoArea(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/comboCodigoArea.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">-</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.area_id+'">'+item.nombre_area+'</option>';
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

function cargarCbCodigoAreaSede(p_area_id, p_nombreCombo_sede, p_tipo){
    $.post
    (
        "../controller/comboCodigoAreaSede.php",
        {
            p_codigo_sede: p_nombreCombo_sede
        }

    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Todas las áreas</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.area_id+'">'+item.nombre_area+'</option>';
            });
            
            $(p_area_id).html(html);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarCbCodigoConsultorioCita(p_consultorio_id, p_nombreCombo_consultorio, p_tipo){
    $.post
    (
        "../controller/comboCodigoConsultorioCita.php",
        {
            p_codigo_consultorio: p_nombreCombo_consultorio
        }

    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
       /*
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Todos los consultorios</option>';
            }
        */
            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.consultorio_id+'">'+item.nombre_consultorio+'</option>';
            });
            
            $(p_consultorio_id).html(html);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarCbCodigoConsultorio(p_consultorio_id, p_nombreCombo_area, p_tipo){
    $.post
    (
        "../controller/comboCodigoConsultorio.php",
        {
            p_codigo_area: p_nombreCombo_area
        }

    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Todos los consultorios</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.consultorio_id+'">'+item.nombre_consultorio+'</option>';
            });
            
            $(p_consultorio_id).html(html);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarCbCodigoConsultorio2(p_nombreCombo, p_tipo){
    $.post
    (
    "../controller/comboCodigoConsultorio2.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">-</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.consultorio_id+'">'+item.nombre_consultorio+'</option>';
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