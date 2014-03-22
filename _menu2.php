<!doctype html>
<html lang="es">
    <head>
        <title>Menus desplegable B&aacute;sico</title>
        <meta charset="utf-8">
        <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
        <style type="text/css">
            #menu {
                text-align: center;
                font-size: 0.7em;
                width: 820px;
                margin: 20px auto;
            }
            #menu ul { 
                list-style-type: none;
            }
            #menu ul li.nivel1 { 
                float: left;
                width: 250px;
                margin-right: 2px;
            }
            #menu ul li a {
                display: block;
                text-decoration: none;
                color: #fff;
                border: solid 1px #fff;
                padding: 8px;
                position: relative;
            }
            #menu ul li:hover {
                position: relative;
            }

            #menu ul li a.nivel1 {
                display: block!important;
                display: none;

                position: relative;
            }
            #menu ul li ul {display: none;
            }
            #menu ul li a:hover ul, #menu ul li:hover ul {
                display: block;                                                          
                position: absolute;
                left: 0px;
            }
            #menu ul li a #selector{
                padding-left: 10px;
            }
            #menu ul li ul{
                border: 1px solid red;
            }
            #menu ul li ul li a {
                width: 160px;
                padding: 6px 0px 8px 0px;
                border-top-color: #000;
            }
            #menu ul li ul li a:hover {
                border-top-color: #000;
                position: relative;
            }
            #menu ul li ul li img{
                height: 14px;
                padding: 2px;
                cursor: pointer;
            }
            table.falsa {
                border-collapse:collapse;
                border:0px;
                float: left;
                position: relative;
            }
        </style>
        <script>
            $( document ).ready(function() {
            

                $("#menu ul li #seleccionado").click( function(){
                    $("#menu ul li ul").css( "display", "block" );
                })
                
                $("#menu ul li #selector").click( function(){
                    $("#menu ul li ul").css( "display", "block" );
                })
                
                $("#menu ul li ul li img").click(function () {
                    $("#seleccionado").attr('src',$(this).attr('src'));
                    $("#menu ul li ul").css( "display", "none" );
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
    </head>
    <body>
        <section id="menu">
            <ul>
                <li class="nivel1">
                    <a href="#" class="nivel1">
                        <img  id="seleccionado" onclick="getSlides(1)" height="14" title="AMAZONICA" src="images/secciones/AMAZONICA.png"/>
                        <img id="selector" class="hand" src="images/boton_deslizador.png" height="12"/>
                    </a>
            <!--[if lte IE 6]><a href="#" class="nivel1ie">Menu 2<table class="falsa"><tr><td><![endif]-->
                    <ul>
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
                    <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                </li>

            </ul>
        </section>
    </body>
</html>