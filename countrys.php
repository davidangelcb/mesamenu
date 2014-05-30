<select id="htmlselect-countrys">    
    <?php         
        foreach ($paises as $pais) {
            $value ="";
            if(isset($paisId)){
                if((int)$pais['id']==(int)$paisId){
                    $value = 'selected="selected"';
                }
            }else{
                if((int)$pais['id']==PAISDEFAULT_ID){
                    $value = 'selected="selected"';
                } 
            }
     ?>
    <option  value="<?php echo $pais['id']?>"  <?php echo $value;?>  data-imagesrc="<?php echo BASE_HOME;?>images/country/<?php echo strtolower($pais['name']);?>.png" ></option>
    <?php }?>
</select>
