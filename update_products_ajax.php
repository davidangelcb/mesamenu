<?php
require 'lib/config.php';
require 'upload_class.php';

$max_size = 1024 * 100000;
$msg = "";

$my_upload = new file_upload;
$my_upload->upload_dir = "temp/"; // the (absolute) folder for the uploaded files 
$my_upload->extensions = array(".csv"); // specify the allowed extensions here

$muestra = false;

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

        require_once("db_access.php");
        
        foreach ($Data as $reg) {
            echo "<pre>";
            print_r($reg);
            echo "</pre>";
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