<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($_SERVER['http_reference'])){
    //require_once 'index.php';    
    print_r($_SERVER);
}else{
    require_once 'load_comentarios.php';
}

?>
