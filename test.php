<?php
/*require 'lib/config.php';
ini_set("display_errors",1);
date_default_timezone_set('America/Lima');


$query = "select id, categoria from seccion_lima";

$result = DdMesaMenu::fetchAll($query);
foreach ($result as $value) {
    $dat = date("Y-m-d H:i:s");
    $params = array(
       'id' => NULL,
       'idplato' => $value['id'],
       'idsection' => $value['categoria'],
       'fecha' => $dat
   );//tipo nuevos refund   ].'|||'.$msg

   $id= DdMesaMenu::insert('seccions_platos', $params);
}*/
?>

<html>
<head>
	<title>Efecto imagen de escala de grises a color</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script language="javascript" type="text/javascript">

</script>
        <style>
            .grises img {
filter: url('#grayscale'); /* Versión SVG para IE10, Chrome 17, FF3.5, Safari 5.2 and Opera 11.6 */
-webkit-filter: grayscale(100%);
-moz-filter: grayscale(100%);
-ms-filter: grayscale(100%);
-o-filter: grayscale(100%);
filter: grayscale(100%); /* Para cuando es estándar funcione en todos */
filter: Gray(); /* IE4-8 and 9 */

-webkit-transition: all 0.5s ease;
-moz-transition: all 0.5s ease;
-ms-transition: all 0.5s ease;
-o-transition: all 0.5s ease;
transition: all 0.5s ease;
}
.grises1 img {
-webkit-filter: grayscale(0%);
-moz-filter: grayscale(0%);
-ms-filter: grayscale(0%);
-o-filter: grayscale(0%);
filter: none;

-webkit-transition: all 0.5s ease;
-moz-transition: all 0.5s ease;
-ms-transition: all 0.5s ease;
-o-transition: all 0.5s ease;
transition: all 0.5s ease;
}
        </style>
        <script>
            function aca(){
                $(".dd-selected").removeClass("grises1").addClass("grises");
            }
            function aca1(){
                $(".dd-selected").removeClass("grises").addClass("grises1");
            }
        </script>    
</head>
<body>
    Imagenes: <a class="dd-selected"><img id="imgS" src="images/sections/1.png"   /></a>
        
    <input type="button" onclick="aca()" value="BUENO"/>
    <input type="button" onclick="aca1()" value="BUENO"/>
    <div style="height: 0; width: 0;"><svg baseProfile="full" version="1.1" xmlns="http://www.w3.org/2000/svg"><filter id="grayscale"><feColorMatrix type="matrix" values="0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0"></feColorMatrix></filter></svg></div>
</body>
</html>