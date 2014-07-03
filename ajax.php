<?php
require 'lib/config.php';
ini_set("display_errors",1);
date_default_timezone_set('America/Lima');
function saveBook($data) {  
    // iduser  idplato
     $id="";
     if(isset($data['iduser'])){
        $user = DdMesaMenu::fetchOneBy('idusers = ? and idplato=?', 'favoritos', null, array($data['iduser'],$data['plato']));
        $dat = date("Y-m-d H:i:s");
        if(!$user){
            
            $params = array(
               'id' => NULL,
               'idusers' => $data['iduser'],
               'dateup' => $dat,
               'idplato' => $data['plato'],
               'estado' => 'Y'
             );

           $id= DdMesaMenu::insert('favoritos', $params);
        }else{
            $params = array(
                'estado' =>  $data['estado'],
                'dateup' => $dat
            );
            DdMesaMenu::update('favoritos', $params, 'id = ?', $user['id']);
        } 
     }else{
         return "FAIL[|@|@|]No se encontro el Usuario";
     }
    return "OK[|@|@|]".$id;
}
function getIdLogin($data) {  
     $id="";
     $user = DdMesaMenu::fetchOneBy('idfacebook = ?', 'users', null, $data['id']);
     if(!$user){
         $dat = date("Y-m-d H:i:s");
         $params = array(
            'id' => NULL,
            'idfacebook' => $data['id'],
            'dateup' => $dat,
            'ip' => ''
        );//tipo nuevos refund   ].'|||'.$msg
        
        $id= DdMesaMenu::insert('users', $params);
     }else{
         $id = $user['id'];
     } 
    return "OK[|@|@|]".$id;
}
function getSlides($data) {
   $imageshtml = '';
   $platos = array();
   $cateAdd=' SP.idsection = '.(int)$data['dishes'].' and ';
   if(isset($data['iduser'])){
       $user = DdMesaMenu::fetchOneBy('id = ?', 'users', null, $data['iduser']);
        if($user){
            $query = "select  * from favoritos where idusers=? and estado=?";
            $resultS = DdMesaMenu::fetchAll($query,array($user['id'],'Y'));
            foreach ($resultS as $rowF) {
                $platos[$rowF['idplato']]=$rowF['id'];
            }
        }
        if($data['heard']=='SI'){
            $cateAdd ='';
        }
   } 
   $query="";
   $randon = " rand() ";
   $addx="";
   if(isset($data['idplato'])){
       if($data['idplato']>0){
            $randon = " letra";
            $query.= "select 'A' as letra, S.*, l.name,SP.idsection from seccion_lima S  inner join locations l on l.id=S.departamento  inner join seccions_platos SP on SP.idplato = S.id where  S.id= '".$data['idplato']."' UNION ";
            $addx = " and S.id not  in ( '".$data['idplato']."')  ";
       }
   }

    $query.= "select 'B' as letra, S.*, l.name,SP.idsection from seccion_lima S  inner join locations l on l.id=S.departamento  inner join seccions_platos SP on SP.idplato = S.id where ".$cateAdd." l.name = '".$data['city']."'  and S.estatus='E' ".$addx." ORDER BY ".$randon;
    $imageshtml.=  '';
    $tPlato='';
    $result = DdMesaMenu::fetchAll($query);
    $imageshtml .= '<ul>';
    if ($result) {
        foreach ($result as $row) {
            $salta=true;
            if(isset($data['iduser'])){
                if(!isset($platos[$row['id']])){
                    $tdBook= '<td id="cnt_favorite'.$row['id'].'"><span><img class="imgSRC" status ="N" onclick="BookMark(this,'.$row['id'].')" id="favorite'.$row['id'].'"   src="'.HOME_DIR.'images/earth.png"  srcA="'.HOME_DIR.'images/earth.png" data-alt-srcA="'.HOME_DIR.'images/earth_over.png" height="50" width="50"/></span></td>';
                }else{
                    $tdBook= '<td id="cnt_favorite'.$row['id'].'"><span><img class="imgSRC" status ="Y" onclick="BookMark(this,'.$row['id'].')" id="favorite'.$row['id'].'"   src="'.HOME_DIR.'images/earth_over.png"  srcA="'.HOME_DIR.'images/earth.png" data-alt-srcA="'.HOME_DIR.'images/earth_over.png" height="50" width="50"/></span></td>';
                }
            }
            if(isset($data['iduser'])){
                if(isset($data['heard']) && $data['heard']=='SI'){
                    
                    if(!isset($platos[$row['id']])){
                        $salta=false;
                    }
                }
            }
                    $nombre=trim($row['plato']);
                    //http://test.perumenu.com/

                    $departamento = DdMesaMenu::fetchOneBy('id = ?', 'locations', null, $row['departamento']);
                    if($departamento){
                        $deparName = trim($departamento['name']).'/';
                    }
                    $tipoPlato = DdMesaMenu::fetchOneBy('id = ?', 'sections', null, $row['idsection']);
                    if($tipoPlato){
                        $tPlato = trim($tipoPlato['name']).'/';
                    }

                    $urlName = $deparName.$tPlato.$nombre.'/';
            
            if($salta){
                if($row['url']!=''){
                    $urlMenu = ' href="'.$row['url'].'" target="_blank"';
                }else{
                    $urlMenu = '';
                }
                if($row['carta']!=''){
                    $urlCarta = ' href="'.$row['carta'].'" target="_blank"';
                }else{
                    $urlCarta = '';
                }
                
            $imageshtml .= '<li>
                                <div class="item_dishes">
                                    <figure>
                                        <img src="'.HOME_DIR.'images/dishes/' . $row['imagen'] . '" alt=""/>                                                                                        
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
                                                            <div class="container-nube" >Comentarios</div>
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
                                                    <td><a '.$urlMenu.'><img id="table" src="'.HOME_DIR.'images/table.png" height="50" width="50"/></a></td>
                                                    <td><a '.$urlCarta.'><img id="cart" src="'.HOME_DIR.'images/cart.png" height="50" width="50"/></a></td>
                                                    <td><a onclick="alert(09890)" class="iframe" href="load_comentarios.php" id="'.$urlName.'"><img id="shared" src="'.HOME_DIR.'images/social.png"   height="50" width="50"/></a></td>
                                                    '.$tdBook.'
                                                </tr>
                                            </table>                                                                                        
                                        </ol>
                                    </figure>                            
                                </div>
                           </li>';
            }
        }
    } else {
        $imageshtml .= '<li><a href="http://mesamenu.com/" target="_blank"><img src="'.HOME_DIR.'images/dishes/none.jpg" alt=""></a></li>';
    }
    $imageshtml .= '</ul>';
    //return "OK[|@|@|]" . $imageshtml . "[|@|@|]" . "images/secciones/" . $row['name'] . ".png"."[|@|@|]".$row['name']."[|@|@|]".$data['dishes'];
    return "OK[|@|@|]" .$imageshtml;
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
    case 'getIdLogin_': echo getIdLogin($_POST);
        break;
    case 'saveBook': echo saveBook($_POST); break;
    
    
}
?>

