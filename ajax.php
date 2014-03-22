<?php

date_default_timezone_set('America/Lima');

function getSlides($data) {
    $imageshtml = '';
    $conexion = mysql_connect("localhost", "asumenu", "tJVo4zACwI4Z") or die("Problemas en la conexion");
    mysql_select_db("asumenu", $conexion) or die("Problemas en la selección de la base de datos");
    /* $clavebuscadah = mysql_query("select * from rest_dishes where iddishes=" . $data['dishes'], $conexion) or die("Problemas en el select1:" . mysql_error());

      while ($row = mysql_fetch_array($clavebuscadah)) {
      $imageshtml .= '<img src="images/dishes/' . $row['image'] . '" alt=""> ';
      } */
    //$query = "SELECT * FROM sections WHERE id=" . (int) $data['dishes'];
    /*$query = "select rest_sections.image,restaurant.link,sections.name
                from rest_sections 
                inner join restaurant on rest_sections.idrestaurants=restaurant.id
                inner join sections on rest_sections.idsections=sections.id
                and rest_sections.idsections=" . (int) $data['dishes'] ." ORDER BY rand()";*/
    $query = "select  * from seccion_lima where categoria = ".(int)$data['dishes']." and estatus='E' ORDER BY rand()";
    $result = mysql_query($query);
    $imageshtml .= '<ul>';
    if (mysql_num_rows($result) > 0) {
        while ($row = mysql_fetch_array($result)) {
            $imageshtml .= '<li>
                                <div class="item_dishes">
                                    <figure>
                                        <img src="images/dishes/' . $row['imagen'] . '" alt=""/>                                                                                        
                                        <ol style="position: absolute; top:70%;float:left;">
                                            <table border="0">
                                                <tr>
                                                    <td>
                                                        <div class="msjtable">
                                                            <div class="container-nube">Mesa</div>
                                                            <div class="arrow-after"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="msjcart">
                                                            <div class="container-nube">Carta</div>
                                                            <div class="arrow-after"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="msjshared">
                                                            <div class="container-nube">Compartir</div>
                                                            <div class="arrow-after"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="msjfavorite">
                                                            <div class="container-nube">Favorito</div>
                                                            <div class="arrow-after"></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a><img id="table" src="images/table.png" height="50" width="50"/></a></td>
                                                    <td><a><img id="cart" src="images/cart.png" height="50" width="50"/></a></td>
                                                    <td><a><img id="shared" src="images/social.png" height="50" width="50"/></a></td>
                                                    <td><a><img id="favorite" src="images/earth.png" data-alt-src="images/earth_over.png" height="50" width="50"/></a></td>
                                                </tr>
                                            </table>                                                                                        
                                        </ol>
                                    </figure>                            
                                </div>
                           </li>';
        }
    } else {
        $imageshtml .= '<li><a href="http://mesamenu.com/" target="_blank"><img src="images/dishes/none.jpg" alt=""></a></li>';
    }
    $imageshtml .= '</ul>';
    //return "OK[|@|@|]" . $imageshtml . "[|@|@|]" . "images/secciones/" . $row['name'] . ".png"."[|@|@|]".$row['name']."[|@|@|]".$data['dishes'];
    return "OK[|@|@|]" . $imageshtml;
}

function sendMail($data) {
    $status = "";
    if ((!isset($data['name'])) || (!isset($data['email']))) {
        header('Location: http://perumenu.com/');
    }
    require_once('lib/phpmailer/config.php');
    require_once('lib/phpmailer/class.phpmailer.php');

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = MXHOST;
    $mail->SMTPAuth = true;
    $mail->Username = MXUSER;
    $mail->Password = MXPASS;
    $mail->From = "auspiciadores@mesamenu.com";
    $mail->FromName = "Mesa Menu Auspiciadores";
    $mail->AddAddress('lruizcaceres@gmail.com', $data['name']);
    $mail->IsHTML(true);
    $mail->Subject = "Auspiciador para Mesa Menu";
    $body = <<<HTMLSTR
<table width="100%" border="0" cellpadding="0" cellspacing="0">      
    <tr>
        <td style="font-family:Verdana;font-size:13px;"><b>Nombre</b></td>
        <td style="font-family:Verdana;font-size:13px;">{$data['name']}&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"  style="font-family:Verdana;font-size:13px;">&nbsp;</td>
    </tr>
    <tr>
        <td style="font-family:Verdana;font-size:13px;"><b>Email</b></td>
        <td style="font-family:Verdana;font-size:13px;">{$data['email']}&nbsp;</td>
    </tr>
    <tr>
        <td colspan="2"  style="font-family:Verdana;font-size:13px;">&nbsp;</td>
    </tr>	   
</table>
HTMLSTR;
    $mail->Body = $body;
    $mail->AltBody = $body;
    if ($mail->Send()) {
        $status =  "Pronto nos contactaremos con Usted <br> Gracias ...";
    } else {
        $status = "Error";
    }
    return "|@X@|" .$status;
}

switch ($_REQUEST['cmd']) {

    case 'getSlides': echo getSlides($_POST);
        break;

    case 'sendMail': echo sendMail($_POST);
        break;
}
?>

