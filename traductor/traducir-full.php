<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Traductor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Le styles -->
        <link href="css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css">
        <link href="css/bootstrap-theme.min.css" media="screen" rel="stylesheet" type="text/css">
        <link href="css/style.css" media="screen" rel="stylesheet" type="text/css">
        <script type="text/javascript">
			<?php                        
				$spanish="var spanish=new Array();"."\n";

				$fp = fopen ( "traductor/archivog-e.csv" , "r" ); 				
                                    
				while (( $data = fgetcsv ( $fp , 2048, ',')) !== false ) {		
                                        $linea = "";
					$i = 0;	                                                                                
                                        $contarPalabras = 0;
                                        
					foreach($data as $row) {//cargar los separdos por ,
                                                
						if( $i == 0 && !empty($row)){
                                                    
                                                    $linea.='spanish["'.$row.'"]="';
					
						}else if(!empty($row)){
                                                    $contarPalabras++;
                                                    $linea.=$row.', ';
                                                }				
										
						$i++;	
			
					}
                                        
                                        if($contarPalabras > 0){
                                            $linea=substr($linea, 0, (strlen($linea)-2));                                           
                                        }
                                        
					$linea.="\";";
                                                                                
                                        $spanish.=$linea."\n";                                        
                                        
				}				
	
				fclose($fp);
	
				echo $spanish;
			?>
		</script>		
		<script type="text/javascript">
			<?php
				$guarani="var guarani=new Array();"."\n";

				$fp = fopen ( "traductor/archivoe-g.csv" , "r" ); 	
	
				while (( $data = fgetcsv ( $fp , 2048, ',')) !== false ) {		
                                        $linea = "";
					$i = 0;	
                                        $contarPalabras = 0;
                                         
					foreach($data as $row) {

						if( $i == 0  && !empty($row)){
					
                                                    $linea.='guarani["'.$row.'"]="';
					
						}else if(!empty($row)){
                                                    $linea.=$row.', ';	
                                                    $contarPalabras++;
						}
				
						$i++ ;	
			
					}
	    
					if($contarPalabras > 0){
                                            $linea=substr($linea, 0, (strlen($linea)-2));                                           
                                        }
                                        
					$linea.="\";";
                                                                                
                                        $guarani.=$linea."\n";	    
				}				
	
				fclose($fp);
	
				echo $guarani;
			?>
		</script>			
	
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
	</script>
        <script type="text/javascript" src="js/buscar.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <!--button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button -->
                    <a class="navbar-brand" href=""><img style="width: 55px; height: 49px;" src="img/paraguay_escudo.png" alt=""/>&nbsp;
                    </a>     
                </div>
                <div class="collapse navbar-collapse">

                    <div align="right" style="color:white">
                    </div>
                </div>

            </div>
        </nav>

        <div class="container">            
                <h2 style="margin-right:150px; margin-left:0px;">Traductor </h2>             
                <div class="container">
	               <div class="form-group">	
	               <table>
                            <tbody>
                                    <tr>
                                        <td>
                                            <input name="palabra" id="palabra" placeholder="palabra" type="text" class="form-control" value="">
                                        </td>
                                        <td>
                                            <input name="button" type="button" id="traducir" class="btn btn-default" value="Traducir">
                                        </td>
                                    </tr>
                                    <tr><td><br></td></tr>
                                    <tr>
                                        <td>
                                            <input type="radio" name="idioma" id="selectguarani" value="gu" >al guaraní</input>
                                            <input type="radio" name="idioma" id="selectspanish" value="es" >al español</input>										
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
                  <hr>
                </div>
                    <footer>                        
                        <p>&copy; 2014 Senatics</p>
                    </footer>          
        </div>
    </body>
</html>
