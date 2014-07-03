<?php
require 'lib/config.php';
$salta=true;
//Array ( [op] => Lima [op1] => Andina [op2] => Canilla de Cordero ) 
if(isset($_GET['carga'])){
   $salta=true;
}

//Array ( [carga] => 1 [op] => Lima [op1] => Autor [op2] => MollejitaCrilladas ) 
if($salta){
    $departamento = DdMesaMenu::fetchOneBy('name = ?', 'locations', null, trim($_GET['op']),false);
    if($departamento){
        $dep = $departamento['id'];
        $q = "select * from sections where name like '%".trim($_GET['op1'])."%' ";

        $tipoPlato = DdMesaMenu::fetchOne($q);
        if($tipoPlato){
             $tip  = $tipoPlato['id'];
             $query = "select  S.id FROM seccion_lima S  inner join seccions_platos SP on SP.idplato = S.id where S.departamento = ? and SP.idsection = ? and S.plato = ?";
             $xplato = DdMesaMenu::fetchOne($query,  array($dep,$tip,trim($_GET['op2'])),false);
             if($xplato){
                 $_GET['idload'] = $xplato['id'];
             }else{
                 echo "No hay Plato";
                 exit;
             }
        }
    }
}


//http://test.perumenu.dev/Lima/Amazonica/ConchasconUmari/
//
$nombre="";
 //$plato = DdMesaMenu::fetchOneBy('id = ?', 'seccion_lima', null, $_GET['idload']);
 $query = "select  S.*, SP.idsection FROM seccion_lima S  inner join seccions_platos SP on SP.idplato = S.id where  S.id = ?";
 $plato = DdMesaMenu::fetchOne($query,  array($_GET['idload']),false); 
 if($plato){
     $nombre=trim($plato['plato']);
     //http://test.perumenu.com/
     
     $departamento = DdMesaMenu::fetchOneBy('id = ?', 'locations', null, $plato['departamento']);
     if($plato){
         $deparName = '/'.trim($departamento['name']);
     }
     $tipoPlato = DdMesaMenu::fetchOneBy('id = ?', 'sections', null, $plato['idsection']);    
     
     if($tipoPlato){
        $tPlato = '/'.trim($tipoPlato['name']);
     }
     $nombre = urlencode($nombre);
     $urlName = BASE_URL.$deparName.$tPlato.'/'.$nombre.'/';
     
     $utlImg = BASE_URL.'/images/dishes/' . $plato['imagen'];
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
        <meta property="og:image" content="<?php echo $utlImg; ?>" />
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
        <section style="text-align: center; height: 95%">
            <h1><?php echo urldecode($nombre);?></h1>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=<?php echo FACEBOOK;?>&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

            <fb:comments  href="<?php echo $urlName;?>" num_posts="4" width="100%"></fb:comments>
        </section>
    </body>
</html>  