
function agregarTecla(letra){
   palabra = $("#palabra").val().toLowerCase();
   $("#palabra").val(palabra + letra.toLowerCase()).focus();
   
}

function buscar(pal){
    var palabra = "";
    
    //Si recibe se toma "pal", sino obtiene del forumulario
    if (pal == null) {
        palabra = $("#palabra").val();
    } else {
        $("#palabra").val(pal);
        palabra = pal;
    }
    
    var traducira = $('input:radio[name=idioma]:checked').val();
    var es = "es";
    var gu = "gu";

    var resultados = "<span style='font-size: 14pt; font-family:Times New Roman; font-style: italic;'>";
    $("#desplegarResultados").html("<span></span>");

    if (!palabra) {
        resultados = resultados + "Introduzca una palabra </span>";
        $("#desplegarResultados").html(resultados);
        bootbox.alert("<span style='color: red;'>Introduzca una palabra</span>");
        return;
    }
    
    if (traducira == es){
        idiomaorigen = 'Guaran&iacute;';
        idiomadestino = 'Espa&ntilde;ol';
        
    }else if (traducira == gu){
        idiomaorigen = 'Espa&ntilde;ol';
        idiomadestino = 'Guaran&iacute;';
        
    }else{
        resultados = resultados + "Debe seleccionar un idioma </span>";
        $("#desplegarResultados").html(resultados);
        bootbox.alert("<span style='color: red;'>Debe seleccionar un idioma</span>");
        return;
    }

    
    //alert("Se llamara via ajax. " + palabra + " al " + traducira);
    $.ajax({
        url: "ws.php?method=buscar&palabra="+palabra+"&traducira="+traducira
    }).then(function(data) {
        
        resultados = "<span style='font-size: 14pt; font-family:Times New Roman; font-style: italic;'>";
        $("#desplegarResultados").html("<span></span>");
    
        if(data.cantidad < 1){
            resultadoninguno = '<br><b>No se encontr&oacute; ninguna sugerencia a su b&uacute;squeda. <br>Ingrese m&aacute;s datos</b>';
            $("#desplegarResultados").html(resultadoninguno);
            
        }else if(data.cantidad === 1){
            
            fila = data.resultados[0];
            
            resultunico = '<div class="tarjeta"><b>Palabra '+ idiomaorigen +': </b>' + fila.palabra;
            
            resultunico = resultunico + '<br><b>Palabra ' + idiomadestino +': </b>'+ fila.significado ;
            
            resultunico = resultunico + '<div class="tarjeta_audio"><b style="vertical-align: top;">Pronunciaci&oacute;n : </b> ';
            
            resultunico = resultunico + '<audio controls>';
            resultunico = resultunico + '<source src="audio/'+traducira+'/'+fila.id+'.wav" type="audio/mpeg">Tu navergador no soporta audio.';
            resultunico = resultunico + 'Favor actualizar a la &uacute;ltima versi&oacute;n</audio><div>';
            resultunico = resultunico + "</div></span>";
            $("#desplegarResultados").html(resultunico);
            
        }else if(data.cantidad > 1){
            //Se recorren los resultados
            var posibleResult = "<h4>Te sugerimos las siguientes palabras: </h4>";
            for (var key in data.resultados) {
                if (data.resultados.hasOwnProperty(key)) {
                    //alert(key + " -> " + cont[key]);
                    //alert(cont[key].palabra)
                    fila = data.resultados[key];

                    posibleResult = posibleResult + '<a href="#" class="resultado_lista" onclick="buscar(\'' + fila.palabra.replace(/'/g, "\\'") + '\')" >' + fila.palabra + '</a>';

                }
            }
            resultados = resultados + posibleResult + "</span>"
            $("#desplegarResultados").html(resultados);
        }

    });
}

function oldbuscar(pal) {
    var resultados = "<span style='font-size: 14pt; font-family:Times New Roman; font-style: italic;'>";
    $("#desplegarResultados").html("<span></span>");
    var encontrado = 0;
    var palabra = "";
    
    if (pal == null) {
        palabra = $("#palabra").val();
    } else {
        $("#palabra").val(pal);
        palabra = pal;
    }

    palabra = palabra.toLowerCase();
    var traducira = $('input:radio[name=idioma]:checked').val();
    var es = "es";
    var gu = "gu";

    if (!palabra) {
        resultados = resultados + "Introduzca una palabra </span>";
        $("#desplegarResultados").html(resultados);
        bootbox.alert("<span style='color: red;'>Introduzca una palabra</span>");
        return;
    }

    var codaudio = 'Pr&oacute;ximamente: <audio controls><source src="audio/1.ogg" type="audio/ogg"><source src="audio/1.mp3" type="audio/mpeg">Tu navergador no soporta audio. Favor actualizar a la última versi&oacute;n</audio>';

    if (traducira == es) {
        for (var ele in spanish) {
            if (ele == palabra) {
                resultados = resultados + spanish[ele] + "</span>";
                resultados = resultados + codaudio;
                $("#desplegarResultados").html(resultados);
                encontrado++;
                break;
            }
        }
    } else if (traducira == gu) {
        for (var ele in guarani) {
            if (ele == palabra) {
                resultados = resultados + guarani[ele] + "</span>";
                resultados = resultados + codaudio;
                $("#desplegarResultados").html(resultados);
                break;
            }
        }
        encontrado = 1;
    } else {
        resultados = resultados + "Debe seleccionar un idioma </span>";
        $("#desplegarResultados").html(resultados);
        bootbox.alert("<span style='color: red;'>Debe seleccionar un idioma</span>");
        return;
    }

    if (encontrado == 0) {
        var posibleResult = "";       
        if(palabra.length > 2){
            palabra = palabra.substring(0, 3);
        }
        for (var kk in spanish) {
            var subk1 = kk.substring(0, 3);
            var subk2 = kk.substring(0, 2);
            if (palabra.length > 2 && palabra == subk1) {                
                posibleResult = posibleResult + '<a href="#" onclick="buscar(\'' + kk.replace(/'/g, "\\'") + '\')" >' + kk + '</a></br>';
            } else if(palabra.length == 2 && palabra == subk2){                
                posibleResult = posibleResult + '<a href="#" onclick="buscar(\'' + kk.replace(/'/g, "\\'") + '\')" >' + kk + '</a></br>';
            }
        }

        resultados = resultados + posibleResult + "</span>"
        $("#desplegarResultados").html(resultados);
    }
}
