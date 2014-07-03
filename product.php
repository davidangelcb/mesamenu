<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
  $data = explode("facebook",$_SERVER['HTTP_REFERER']);
if(count($data)>1){
    echo "<pre>";
    print_r($_GET);
    echo "</pre>";
    require_once 'index.php';        
}else{
    require_once 'load_comentarios.php';
}

?>
