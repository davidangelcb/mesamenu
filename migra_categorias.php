<?php
require 'lib/config.php';
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
}