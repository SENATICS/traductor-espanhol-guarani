<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
        <meta>
        <title>Guarani</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Le styles -->
        <link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-theme.min.css" media="screen" rel="stylesheet" type="text/css">
        <link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
	
	
        <!-- Scripts -->
        <!--[if lt IE 9]><script type="text/javascript" src="js/html5shiv.js"></script><![endif]-->
        <!--[if lt IE 9]><script type="text/javascript" src="js/respond.min.js"></script><![endif]-->
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootbox.js"></script>        
        <script type="text/javascript">
                $(function(){														
                    $("#traducir").click(function(){
                          buscar(null);  
                    });                                                            
                });                                

                
                $(document).ready(function () {
                //hide hider and popup_box
                $("#hider").hide();
                $("#popup_box").hide();

                //on click show the hider div and the message
                $("#showpopup").click(function () {
                    $("#hider").fadeIn("slow");
                    $('#popup_box').fadeIn("slow");
                });
                //on click hide the message and the
                $("#buttonClose").click(function () {

                    $("#hider").fadeOut("slow");
                    $('#popup_box').fadeOut("slow");
                });

                });

                function ejemplo(){
                    document.getElementById('selectspanish').checked = true;
                    document.getElementById('palabra').value = 'ja';
                    buscar(null);
                }
                
                function resumen(){
                    $.ajax({
                        url: "ws.php?method=resumen"
        
                    }).then(function(data) {
                         bootbox.alert("<span style='color: red;'>"+ data.cantidadespanol+" palabras espa&ntilde;ol. "+ data.cantidadguarani+" palabras guaran&itilde;</span>");
                    });
               }
        
	</script>
        <script type="text/javascript" src="js/buscar.js"></script>

    </head>

    <body>
        <h2 style="alignment-adjust: central; margin-right:150px; margin-left:0px;">
            Guaran&iacute;
        </h2>
        <div class="container">
            
            <div class="form-group">
                El guaran&iacute;, una lengua americana hablada en 7 pa&iacute;ses de Am&eacute;rica del sur, compartida por ind&iacute;genas 
                y criollos en Paraguay, donde es lengua oficial del Estado por disposici&oacute;n constitucional con cerca de 4 millones 
                de hablantes en Paraguay, donde es lengua materna del 86% de los habitantes. Esta lengua comparte con el castellano
                todo el territorio y todos los estratos sociales del pa&iacute;s. 
                <!--input type="button" data-popup-target="#example-popup" class="btn btn-default" value="... ver m&aacute;s"-->
            </div>
        </div>
        
        
        
       <!--  <h2 style="alignment-adjust: central; margin-right:150px; margin-left:0px;">
            Traductor
             <img src="img/beta.png" onclick="resumen();" alt="spl"/> 
        </h2>--> 
        <h2 style="alignment-adjust: central; margin-right:150px; margin-left:0px;">
            Traductor de Palabras Guaran&iacute; - Espa&ntilde;ol
            <img src="img/info.png" onclick="resumen();" width="32px" height="auto">
        </h2>
        <div class="container">
            <div class="form-group">	
	    <table>
                <tbody>
                    <tr>
                        <td>
                            <input name="palabra" size="100px" id="palabra" placeholder="Ingrese la palabra que desea traducir" type="text" class="form-control" value="" onkeydown="if (event.keyCode == 13) document.getElementById('traducir').click()">    
                            </br>
                            &nbsp;&nbsp;&nbsp;
                            <label for="selectguarani"><input type="radio" name="idioma" id="selectguarani" value="gu" onkeydown="if (event.keyCode == 13) document.getElementById('traducir').click()">&nbsp;al guaran&iacute;</label>
                            &nbsp;&nbsp;&nbsp;
                            <label for="selectspanish"><input type="radio" name="idioma" id="selectspanish" value="es" onkeydown="if (event.keyCode == 13) document.getElementById('traducir').click()">&nbsp;al espa&ntilde;ol</label>
                            &nbsp;&nbsp;&nbsp;
                            <input name="button" type="button" id="traducir" class="btn btn-primary" value="Traducir">
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:ejemplo();">Pruebe un ejemplo</a>
                        </td>

                    </tr>
                </tbody>
	    </table>	               	 
	               
	    <div id="desplegarResultados">
                <div id="myModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- dialog body -->
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    Debe seleccionar un idioma
                            </div>
                            <!-- dialog buttons -->
                            <div class="modal-footer"><button type="button" class="btn btn-primary">OK</button></div>
                        </div>
                    </div>
                 </div>	   
            </div>
                



                
        </div>
    </div>

         </br></br><hr>
        <table style="alignment-adjust: central">
            <tbody>
                <tr>
                    <td style="margin-right:150px; margin-left:0px;">
                            <img src="img/spl.png" alt="spl"/>
                            </br>
                            www.spl.gov.py
                    </td>
                    <td style="width: 150px">
                    </td>
                    <td style="margin-right:0px; margin-left:150px;">
                            &nbsp;&nbsp;&nbsp;
                            <img src="img/senatics.png" alt="senatics"/>
                            </br>
                            &nbsp;&nbsp;&nbsp; 
                            www.senatics.gov.py
                    </td>
                </tr>
            </tbody>
        </table>	               	 
 

<div id="example-popup" class="popup">
    <div class="popup-body">	<span class="popup-exit"></span>
        <div class="popup-content">
            <h2 class="popup-title">Lengua Guaran&iacute;</h2>
                    La Lengua Guarani o Avañe’ê es el medio de comunicación del 87% de la actual población del 
                    paraguay. A lo largo de la historia, desde la colonia hasta 1990, el idioma Guarani sufrió 
                    todas las formas imaginables e inimaginables de persecución, degradación y marginación. Sus 
                    dueños originales, usuarios genuinos de la Lengua Guarani o Avañe’ê, prácticamente están en extinción 
                    en el Paraguay, ya que del total de habitantes, los Indígenas representan aproximadamente un 2%, y de 
                    ese porcentaje, apenas el 1% son indígenas Guarani.
        </div>
    </div>
</div>

<div class="popup-overlay"></div>
<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
jQuery(document).ready(function ($) {

    $('[data-popup-target]').click(function () {
        $('html').addClass('overlay');
        var activePopup = $(this).attr('data-popup-target');
        $(activePopup).addClass('visible');

    });

    $(document).keyup(function (e) {
        if (e.keyCode == 27 && $('html').hasClass('overlay')) {
            clearPopup();
        }
    });

    $('.popup-exit').click(function () {
        clearPopup();

    });

    $('.popup-overlay').click(function () {
        clearPopup();
    });

    function clearPopup() {
        $('.popup.visible').addClass('transitioning').removeClass('visible');
        $('html').removeClass('overlay');

        setTimeout(function () {
            $('.popup').removeClass('transitioning');
        }, 200);
    }
    
});
});//]]>  

</script>

    </body>
</html>
