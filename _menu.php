<html>
    <head></head>
    <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
    <style>
        #menus #choose  {
            width: 180px;
            padding: 0;
            border: 1px dotted #E5E5E5;
        }
        #menus #choose li{
            margin: 0 auto;
            padding: 0;
            width: 180px;
            list-style-type: none;
            display: inline-block;
        }
        #menus #choose li #selector{
            margin-left: 15px;
        }
        
        
        #menus nav{
            background-color: #FFFFFF;
            width: 180px;
            border: 1px dotted #E5E5E5;
        }
        #menus nav ul{
            background-color: #FFFFFF;
            margin:0 auto;
            padding: 0;
            text-align: left;
            list-style-type: none;
        }
        #menus nav ul li{
            background-color: #FFFFFF;
            margin: 0 auto;
            padding: 0;
            list-style-type: none;
            width: 180px;
        }
        #menus nav ul li img{
            height: 14px;
            margin: 0 auto;
            padding: 0;
            list-style-type: none;
            cursor: pointer;
        }
        .hand{
            cursor: pointer;
        }
        
    </style>
    <script>
        $( document ).ready(function() {
            
            var number = 1 + Math.floor(Math.random() * 10);
            
            
            
            $( "#seleccionado" ).click(function() {
                $("#options").css( "display", "block" );
            });
            
            
            $( "#selector" ).click(function() {
                $("#options").css( "display", "block" );
            });
            
            $("#options li img").click(function () {
                $("#seleccionado").attr('src',$(this).attr('src'));
                $("#options").css( "display", "none" );
            });                                                       
        })
        
        function getSlides(sel) {                
                $.ajax({
                    url: "ajax.php",
                    type: 'post',                    
                    data: {cmd: 'getSlides',dishes: sel},
                    beforeSend: function(){
                        $("#content_images").html('Loading ...');
                    },
                    success: function(response) {
                        var xx = response.split('[|@|@|]');
                        if (xx[0] == 'OK') {
                            $("#content_images").html(xx[1]);
                        } else{
                            alert('errorororoororor');
                        }
                        
                    }
                });            
            }
    </script>
    <body onload="getSlides(<?php echo rand(1, 10); ?>)">
        <div id="menus" style="z-index:9999;overflow: auto;">
            <ul id="choose">
                <li><img id="seleccionado" src="images/secciones/AMAZONICA.png" height="14"/><img id="selector" class="hand" src="images/boton_deslizador.png" height="12"/>
            </ul>
            <nav>
                <ul id="options" style="display: none;z-index: 99999;">
                    <li><img onclick="getSlides(1)" title="AMAZONICA" src="images/secciones/AMAZONICA.png"/></li>
                    <li><img onclick="getSlides(2)"  title="ANDINA" src="images/secciones/ANDINA.png"/></li>
                    <li><img onclick="getSlides(3)"  title="BUFFET" src="images/secciones/BUFFET.png"/></li>
                    <li><img onclick="getSlides(4)"  title="CRIOLLA" src="images/secciones/CRIOLLA.png"/></li>
                    <li><img onclick="getSlides(5)"  title="GOURMET" src="images/secciones/GOURMET.png"/></li>
                    <li><img onclick="getSlides(6)"  title="INTERNACIONAL" src="images/secciones/INTERNACIONAL.png"/></li>
                    <li><img onclick="getSlides(7)"  title="ITALIANA" src="images/secciones/ITALIANA.png"/></li>
                    <li><img onclick="getSlides(8)"  title="JAPONESA" src="images/secciones/JAPONESA.png"/></li>
                    <li><img onclick="getSlides(9)"  title="MARISCOS" src="images/secciones/MARISCOS.png"/></li>
                    <li><img onclick="getSlides(10)"  title="MEDITERRANEO" src="images/secciones/MEDITERRANEO.png"/></li>
                </ul> 
            </nav>
        </div>
        <article id="content_images"></article>
    </body>
</html>
