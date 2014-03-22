<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <link type="text/css" rel="stylesheet" href="modal.css" />
        <script type="text/javascript" src="jquery-1.2.3.min.js"></script>
        <script type="text/javascript" src="modal.js"></script>

        <title>Modal JavaScript</title>
    </head>

    <body style="background-color: red;" >
        
        <input type="button" id="button" onclick="showModal()" value="Mostrar Ventana" />  
        <div id="bgtransparent" class="bgtransparent" >
        </div>
        
        <div id="bgmodal" class="bgmodal" style="display: none;" >
            <input type="button" value="cerrar" onclick="closeModal()" />
        </div>
        
    </body>
</html>
