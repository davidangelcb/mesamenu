<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
file_put_contents('facebook.log', print_r($_SERVER,true));
  $data = explode("facebook",$_SERVER['HTTP_REFERER']);
if(count($data)>1){
    
    require_once 'index.php';        
}else{
    require_once 'load_comentarios.php';
}

?>
