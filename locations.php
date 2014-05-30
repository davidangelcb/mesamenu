<?php
/* Pasies */
if(isset($paisId)){
    $id= $paisId;
}else{
    $id= PAISDEFAULT_ID;
}
$query3="select * from locations where idcountry=".$id." and estatus='E'";
$estados = DdMesaMenu::fetchAll($query3);

?>
<select id="htmlselect-locations">    
    <?php         
       $none=false;
        foreach ($estados as $estado) {
            $value ="";
            if(isset($estadoId)){
                if((int)$estado['id']==(int)$estadoId){
                    $value = 'selected="selected"';
                }
            }else{
                if($none){
                    $value = 'selected="selected"';
                    $none=false;
                } 
            }
     ?>
    <option  value="<?php echo $estado['name']?>"  <?php echo $value;?>  data-imagesrc="<?php echo BASE_HOME;?>images/locations/<?php echo strtolower($estado['name']);?>.png" ></option>    
    <?php }?>
</select>