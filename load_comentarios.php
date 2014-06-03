<?php
require 'lib/config.php';

if (!isset($_GET['idload'])) {
    exit;
}
//http://test.perumenu.dev/Lima/Amazonica/ConchasconUmari/
//
$nombre="";
 $plato = DdMesaMenu::fetchOneBy('id = ?', 'seccion_lima', null, $_GET['idload']);
 if($plato){
     $nombre=trim($plato['plato']);
     //http://test.perumenu.com/
     
     $departamento = DdMesaMenu::fetchOneBy('id = ?', 'locations', null, $plato['departamento']);
     if($plato){
         $deparName = '/'.trim($departamento['name']);
     }
     $tipoPlato = DdMesaMenu::fetchOneBy('id = ?', 'sections', null, $plato['categoria']);
     if($tipoPlato){
     $tPlato = '/'.trim($tipoPlato['name']);
     }
     
     $urlName = BASE_URL.$deparName.$tPlato.'/'.urlencode($nombre).'/';
 }

?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta  charset="UTF-8" />
        <title> Mesa Menu </title>
        <meta name="description" content="Mesa Menú, el sitio más delicioso del Internet"/>           
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta property="fb:app_id" content="<?php echo FACEBOOK;?>">
        <meta property="og:url" content="<?php echo $urlName; ?>" />
        <meta property="og:title" content="Mesa Menu" />
        <meta property="og:description" content="El sitio mas delicioso del Internet" />
        <meta property="og:image" content="<?php echo $urlName; ?>images/shared-mesamenu.png" />
        <script>
            var facebookId = '<?php echo FACEBOOK;?>';
        </script> 
        <link rel="stylesheet" href="<?php echo BASE_HOME; ?>js/libs/normalize-2.0.1/normalize.css">
        <link rel="stylesheet" href="<?php echo BASE_HOME; ?>css/styles.css"/>
        <link rel="stylesheet" href="<?php echo BASE_HOME; ?>css/icons.css"/>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />        
        <script src="<?php echo BASE_HOME; ?>js/jquery-1.8.3.min.js"></script>

        <script type="text/javascript" src="<?php echo BASE_HOME; ?>js/facebook.js"></script> 

    </head>
    <body>
        
<iframe id="f1d28b039342e26" name="f2960819d1a8c56" scrolling="no" style="border: medium none; overflow: hidden; height: 2763px; width: 764px;" 
        title="Facebook Social Plugin" class="fb_ltr" 
        src="https://www.facebook.com/plugins/comments.php?api_key=<?php echo FACEBOOK;?>&amp;channel_url=<?php echo $urlName; ?>
        http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter%2FV80PAcvrynR.js%3Fversion%3D41%23cb%3Df2d4fb764ca45ca%26domain%3Dwww.animeid.tv%26origin%3Dhttp%253A%252F%252Fwww.animeid.tv%252Ff15d59dc1929bee%26relation%3Dparent.parent&amp;href=<?php echo $urlName; ?>&amp;locale=es_LA&amp;mobile=false&amp;numposts=7&amp;sdk=joey&amp;width=764"></iframe>
    </body>
</html>  