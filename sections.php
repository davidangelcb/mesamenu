<?php
$conexion = mysql_connect("localhost", "asumenu", "tJVo4zACwI4Z") or die("Problemas en la conexion");
mysql_select_db("asumenu", $conexion) or die("Problemas en la selección de la base de datos");
$clavebuscadah = mysql_query("select  * from sections where status='E'") or die("Problemas en el select1:" . mysql_error());
$rows = array();
while ($row = mysql_fetch_array($clavebuscadah))
    $rows[] = $row;
?>

<select id="htmlselect-sections">
    <?php foreach ($rows as $row) { ?>
    <option  value="<?php echo $row["id"] ?>"  data-imagesrc="images/sections/<?php echo strtoupper($row['name']); ?>.png"></option>    
    <?php } ?>
</select>