<select id="htmlselect-sections">
    <?php foreach ($categorias as $categoria) {
            $value ="";
            if(isset($categoriaId)){
                if((int)$categoria['id']==(int)$categoriaId){
                    $value = 'selected="selected"';
                }
            }
    ?>
    <option  value="<?php echo $categoria['id']?>"  <?php echo $value;?> data-imagesrc="<?php echo BASE_HOME.$categoria['description'];?>"></option>
    <?php } ?>
</select>