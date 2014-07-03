<?php
require 'lib/config.php';
require 'upload_class.php';
$depa = 1;
$query="select * from sections  where status='E'";
$categorias = DdMesaMenu::fetchAll($query);
$categoriasQ = array();
foreach ($categorias as $value) {
    $categoriasQ[trim($value['name'])] = $value['id'];
}        
        

$max_size = 1024 * 100000;
$msg = "";

$my_upload = new file_upload;
$my_upload->upload_dir = "temp/"; // the (absolute) folder for the uploaded files 
$my_upload->extensions = array(".csv"); // specify the allowed extensions here

$muestra = false;
/*
Array
(
    [0] => Arroz con Pollo
    [1] => LaCarreta-ArrozconPollo
    [2] => LaCarreta
    [3] => http://www.restaurantelacarreta.com/
    [4] => Activado
    [5] => Criolla
    [6] => 
    [7] => http://www.restaurantelacarreta.com/reservas
    [8] => http://www.restaurantelacarreta.com/la-carta
 *  */
if (isset($_FILES['csvUpload']['name'])) {
    $my_upload->the_temp_file = $_FILES['csvUpload']['tmp_name'];
    $my_upload->the_file = $_FILES['csvUpload']['name'];
    $my_upload->http_error = $_FILES['csvUpload']['error'];
    if ($my_upload->upload()) {
        // read csv
        $file_to_parse = 'temp/' . $my_upload->pathFile;
        require_once ('csv/csv_reader.php');
        $read = new CSV_Reader;
        $read->strFilePath = $file_to_parse;
        $read->strOutPutMode = 0; // 1 will show as HTML 0 will return an array
        $read->setDefaultConfiguration();
        $read->readTheCsv();
        $Data = $read->arrOutPut;
        $read = null;
        // procesamos la lista 
        $Lista = array();
        $dat = date("Y-m-d H:i:s");
        //select plato, imagen , restaurant, url, estatus, id, departamento,carta from seccion_lima
        foreach ($Data as $reg) {
            if($reg[5]!='Categories'){
                $estatus ='E';
                if(trim($reg[4])!='Activado'){
                    $estatus ='D';
                }
                $params = array(
                   'id' => NULL,
                   'plato' => trim($reg[0]),
                   'imagen' => trim($reg[1]),
                   'restaurant' => trim($reg[2]),
                   'url' => trim($reg[7]),
                   'estatus' => $estatus,
                   'departamento' => $depa,
                   'carta' => trim($reg[7])
                  
               );//tipo nuevos refund   ].'|||'.$msg
                /*echo "<pre>";
                print_r($params);
                echo "<pre>";
                $id=100;*/
               $id= DdMesaMenu::insert('seccion_lima', $params);
               $categorias_  = explode(",", $reg[5]);
               for($i=0; $i<count($categorias_);$i++){
                $params1 = array(
                    'id' => NULL,
                    'idplato' => $id,
                    'idsection' => $categoriasQ[trim($categorias_[$i])],
                    'fecha' => $dat 
                ); 
                /*echo "<pre>";
                print_r($params1);
                echo "<pre>";*/
                DdMesaMenu::insert('seccions_platos', $params1);
               }
            }
        }
        $muestra = true;
        @unlink($file_to_parse);
    } else {
        $msg = strip_tags($my_upload->message);
    }
}
?>
<script>
<?php if ($muestra) { ?>
        alert("Your Order Info has been processed.");
<?php } else { ?> 
        alert("<?php echo $msg; ?>");
<?php } ?>
</script>
<pre>
    <?php //print_r($Lista);  ?>
</pre>
<?php ?>