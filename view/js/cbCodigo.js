function cargarCbCodigoDepartamento(p_nombreCombo, p_tipo){ // se carga todos los departamentos en el combo
    $.post
    (
    "../controller/combo.departamento.listar.controller.php"
    ).done(function(resultado){
    var datosJSON = resultado;
    
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">-</option>';
            }else{
                html += '<option value="0">Lista de departamentos</option>';
            }

            
            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.dep_coddepartamento+'">'+item.dep_nombre+'</option>';
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

function cargarCbCodigoProvinciaDepartamento(p_provincia_id, p_nombreCombo_departamento, p_tipo){
    $.post
    (
        "../controller/comboCodigoProvinciaDepartamento.php",
        {
            p_codigo_departamento: p_nombreCombo_departamento
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
                html += '<option value="'+item.prov_codprovincia+'">'+item.prov_nombre+'</option>';
            });
            
            $(p_provincia_id).html(html);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}

function cargarCbCodigoDistritoProvincia(p_distrito_id, p_nombreCombo_provincia, p_tipo){
    $.post
    (
        "../controller/comboCodigoDistritoProvincia.php",
        {
            p_codigo_provincia: p_nombreCombo_provincia
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
                html += '<option value="'+item.dist_coddistrito+'">'+item.dist_nombre+'</option>';
            });
            
            $(p_distrito_id).html(html);
    }else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
    var datosJSON = $.parseJSON( error.responseText );
    swal("Error", datosJSON.mensaje , "error");
    });
}