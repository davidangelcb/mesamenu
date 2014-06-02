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
     
     $urlName = BASE_URL.$deparName.$tPlato.'/'.$nombre.'/';
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
        <meta property="og:url" content="<?php echo BASE_HOME; ?>" />
        <meta property="og:title" content="Mesa Menu" />
        <meta property="og:description" content="El sitio mas delicioso del Internet" />
        <meta property="og:image" content="<?php echo BASE_HOME; ?>images/shared-mesamenu.png" />
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
        <section style="text-align: center; height: 90%">
            <h1><?php echo $nombre;?></h1>
            <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:comments href="<?php echo $urlName;?>" num_posts="4" width="100%"></fb:comments>
        </section>
    </body>
</html>  