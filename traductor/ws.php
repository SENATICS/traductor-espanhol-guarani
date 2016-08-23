<?php 
ob_start();
require_once "RestServer.php";
 
$rest = new RestServer('Hello');
$rest->handle();
  
header('Content-type: application/json');

function php_rlike($str) {
   $a1 = array(
   '/[aàáäåãæâAÀÁÄÅÃÂ]/',
   '/[eèéêëEÈÉÊË]/',
   '/[iìíîïIÌÍÎÏ]/',
   '/[oöôõðòóøOÖÔÕÒÓØ]/',
   '/[uüûùúÜÛÙÚ]/',
   '/[yÿýÝ]/',
   '/[nNñÑ]/',
   '/[çÇ]/');

   $a2 = array(
   '[aàáäåãæâAÀÁÄÅÃÂ]',
   '[eèéêëEÈÉÊË]',
   '[iìíîïIÌÍÎÏ]',
   '[oöôõðòóøOÖÔÕÒÓØ]',
   '[uüûùúÜÛÙÚ]',
   '[yÿýÝ]',
   '[nNñÑ]',
   '[çÇ]');

   return preg_replace($a1, $a2, $str);
}


function utf8_encode_deep(&$input) {
    if (is_string($input)) {
        $input = utf8_encode($input);
    } else if (is_array($input)) {
        foreach ($input as &$value) {
            utf8_encode_deep($value);
        }

        unset($value);
    } else if (is_object($input)) {
        $vars = array_keys(get_object_vars($input));

        foreach ($vars as $var) {
            utf8_encode_deep($input->$var);
        }
    }
}

function getCon()
{
    return mysqli_connect("localhost","user","pass","traductor");
}

class Hello
{


     public static function resumen()
     {

        $cantidadguarani = -1;
        $cantidadespanol = -1;
        
        $con=getCon();
        // Check connection
        if (mysqli_connect_errno()) {
            $mensaje = "Fallo de conexion: " . mysqli_connect_error();
            echo json_encode( 
                               array("cantidadguarani" => $cantidadguarani,
                                     "cantidadespanol" => $cantidadespanol,
                                     "mensaje" => $mensaje)
                               );
            return;
        }
        
        $q = "SELECT count(id) as cantidadespanol FROM tr_espanol_guarani;";
        $sth = mysqli_query($con, $q);
        
        while($row = mysqli_fetch_assoc($sth)) {
            $cantidadespanol = utf8_encode($row['cantidadespanol']);
        }
        
        
        $q = "SELECT count(id) as cantidadguarani FROM tr_guarani_espanol;";
        $sth = mysqli_query($con, $q);
        
        while($row = mysqli_fetch_assoc($sth)) {
            $cantidadguarani = utf8_encode($row['cantidadguarani']);
        }
        
        mysqli_close($con);
        echo json_encode( 
                         array("cantidadguarani" => $cantidadguarani,
                               "cantidadespanol" => $cantidadespanol)
                         );
     }
     
     
     public static function buscar($palabra, $traducira)
     {
        $cantidad = -1;
        $resultados = array();
        $mensaje = "";
        
        //$con=mysqli_connect("localhost","traductor","traductor","traductor");
        $con=getCon();
        
        // Check connection
        if (mysqli_connect_errno()) {
            $mensaje = "Fallo de conexion: " . mysqli_connect_error();
            echo json_encode( 
                               array("cantidad" => $cantidad,
                                     "resultados" => $resultados,
                                     "mensaje" => $mensaje)
                               );
            return;
        }
        
        if (strcmp($traducira,"gu") == 0){
            
            //1er caso: si tiene un resultado
            $q = "SELECT * FROM tr_espanol_guarani WHERE palabra = '".$palabra."'";
            $sth = mysqli_query($con, $q);
            $cantidad = mysqli_num_rows($sth);
            
            while($row = mysqli_fetch_assoc($sth)) {
                    $resultados[] = array(
                                           'id' => utf8_encode($row['id']),
                                           'palabra' => utf8_encode($row['palabra']),
                                           'clave_busqueda' => utf8_encode($row['clave_busqueda']),
                                           'significado' => utf8_encode($row['significado'])
                                         );
            }
            
            //2do caso: si no tuvo un unico resultado
            if($cantidad <> 1){
                $palabra = php_rlike($palabra);  
                //$palabra contendrá ahora 'J[oöôõðòóøOÖÔÕÒÓØ]s[eèéêëEÈÉÊË]', lista para
                $q = "SELECT * FROM tr_espanol_guarani WHERE clave_busqueda RLIKE '$palabra'";
                $sth = mysqli_query($con, $q);
                $cantidad = mysqli_num_rows($sth);

                while($row = mysqli_fetch_assoc($sth)) {
                    $resultados[] = array(
                                           'id' => utf8_encode($row['id']),
                                           'palabra' => utf8_encode($row['palabra']),
                                           'clave_busqueda' => utf8_encode($row['clave_busqueda']),
                                           'significado' => utf8_encode($row['significado'])
                                         );
                }
            }


        }else if (strcmp($traducira,"es") == 0){
            
            //1er caso: si tiene un resultado
            $q = "SELECT * FROM tr_guarani_espanol WHERE palabra = '".$palabra."'";
            $sth = mysqli_query($con, $q);
            $cantidad = mysqli_num_rows($sth);
            
            while($row = mysqli_fetch_assoc($sth)) {
                    $resultados[] = array(
                                           'id' => utf8_encode($row['id']),
                                           'palabra' => utf8_encode($row['palabra']),
                                           'clave_busqueda' => utf8_encode($row['clave_busqueda']),
                                           'significado' => utf8_encode($row['significado'])
                                         );
            }
            
            //2do caso: si no tuvo un unico resultado
            if($cantidad <> 1){
                $palabra = php_rlike($palabra);  
                //$palabra contendrá ahora 'J[oöôõðòóøOÖÔÕÒÓØ]s[eèéêëEÈÉÊË]', lista para
                $q = "SELECT * FROM tr_guarani_espanol WHERE clave_busqueda RLIKE '$palabra'";
                $sth = mysqli_query($con, $q);
                $cantidad = mysqli_num_rows($sth);

                while($row = mysqli_fetch_assoc($sth)) {
                    $resultados[] = array(
                                           'id' => utf8_encode($row['id']),
                                           'palabra' => utf8_encode($row['palabra']),
                                           'clave_busqueda' => utf8_encode($row['clave_busqueda']),
                                           'significado' => utf8_encode($row['significado'])
                                         );
                }
            }

            
            
            
        }else{
            $mensaje = "El idioma a traducir no es valido. Ref: ".$traducira;
        }
        
        mysqli_close($con);

        //$palabra2 = php_rlike("".$palabra."");
        //$palabra3 = utf8_encode($palabra2);        
        echo json_encode( 
                           array("cantidad" => $cantidad,
                                 "resultados" => $resultados,
                                 "mensaje" => $mensaje)
                           );
     }
}
ob_end_flush();
?>
