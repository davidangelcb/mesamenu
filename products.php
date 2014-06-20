<html>
    <head>
        <title>Actualizar productos</title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="update_products_ajax.php" target="dow" method="post">
            Chosse File CSV : <input type="file"  name="csvUpload" id="csvUpload" accept="application/msexcel">
            <br><br>
            <input type="submit" value="Process">
            
        </form>
        <br><br>
        <iframe style="width: 600px; height: 500px;" id="dow" name="dow">
            
        </iframe>
    </body>
</html>