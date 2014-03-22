<?php
  /*require 'config.php';
  require 'bd_access.php';/*
  $conexion=mysql_connect("localhost","asumenu","tJVo4zACwI4Z") or die("Problemas en la conexion");
  mysql_select_db("asumenu",$conexion) or die("Problemas en la selección de la base de datos");
  $clavebuscadah = mysql_query("select id,name from dishes") or die("Problemas en el select1:" . mysql_error()); */
$_SESSION['master'] = base64_encode(md5(microtime() . "sderfd") . md5(microtime() . "tegvfwcrebtneh"));
$randomize = rand(1, 10);

if (isset($_GET['alias'])) {
    $file = 'index.php';
    if (isset ($_GET['file'])) {
        if (trim($_GET['file']) != '') {
            $file = trim($_GET['file']);
        }
    }
    
}
?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta  charset="UTF-8" />
        <title> Peru Menu </title>
        <meta name="description" content="Mesa Menu, la mesa es escenario y el plato la estrella"/>           
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" href="js/libs/normalize-2.0.1/normalize.css">
        <link rel="stylesheet" href="css/styles.css"/>
        <link rel="stylesheet" href="css/icons.css"/>
        <script src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.ddslick.min.js"></script>
        <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>        
    </head>
    <body>
        <header>
            <div id="grid">                
                <div id="navleft">
                    <ul>
                        <li><img src="images/lima_icon.png" height="15" /></li>
                        <li><img id="vote" src="images/heart.png"/></li>
                        <li>
                            <?php require_once 'selected4.php'; ?>
                        </li>
                    </ul>
                </div>
                <div id="navmiddle">
                    <img src="images/logo_perumenu.png" height="40" />
                </div>
                <div id="navright">
                    <ul>
                        <li class="facebook hand"><img id="sharedFacebook" src="images/facebook_icon.png" height="16"/></li>
                        <li class="twitter hand"><img id="sharedTwitter" src="images/twitter_icon.png" height="16"/></li>
                        <li class="google hand"><img id="sharedGoogle" src="images/google+_icon.png" height="16"/></li>
                    </ul>
                </div>
            </div>
        </header>

        <section id="content">

            <article id="content_images" style="display:block;">                
            </article>
            <input type="hidden" id="categoria"/>

            <article id="content_about"  style="display: none;">
                <div id="popupAboutUs">
                    <div class="barClosePopup">Close [X]</div>
                    <h1>Nosotros:</h1>
                    <p>PeruMenu nace como un proyecto social,  nuestro compromiso son los niños en riesgo de desnutrición y abandono, es por tal que su labor consta en ser un nexo de empresas o personas de diferentes habilidades  que deseen hacer  voluntariado con dichas entidades como orfanatos y comedores, apoyando en diferentes programas  o  con donaciones según sus necesidades.</p>
                    <h3>Danna Huaman Pantoja | <span>C M O</span></h3>
                    <div id="Danna">                        
                        <div id="photoDanna"><img src="images/danna.png" height="100" /></div>
                        <div id="descriptionDanna">
                            <ul>
                                <li><b>Marketing</b></li>
                                <li><b>Publicidad</b></li>
                                <li><b>PR</b></li>
                                <li></li>
                                <li>danna@perumenu.com</li>
                                <li>Tel: 221.1003</li>
                            </ul>
                        </div>
                    </div>

                    <h3>Olga Sánchez Miranda | <span>C O O</span></h3>
                    <div id="Olga">                        
                        <div id="photoOlga"><img src="images/olga.png" height="100" /></div>
                        <div id="descriptionOlga">
                            <ul>
                                <li><b>Business Manager</b></li>
                                <li><b>Ad Sales</b></li>
                                <li><b>Customer Service</b></li>
                                <li></li>
                                <li>olga@perumenu.com</li>
                                <li>Tel: 221.1003</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </article>

            <article id="content_sponsors"   style="display: none;" >
                <div id="popupSponsors">
                    <div class="barClosePopup" title="cerrar" >Close [ X ]</div>
                    <h1>Auspiciadores:</h1>
                    <p>Auspicia tu marca o producto contamos con el respaldado de Marca Perú y se parte de nuestro compromiso social. Envíanos tus datos y un asesor de servicio se comunicara contigo en la brevedad posible.</p>                    
                    <ul>
                        <li>
                            <label>Nombre : </label>
                            <input type="text" id="name" required="required"  placeholder="Ingrese Nombre y Apellidos">
                        </li>
                        <li>
                            <label>Correo Electrónico : </label>
                            <input type="email" id="email" required="required" placeholder="Ingrese Correo Electrónico">
                        </li>
                        <li class="algright" >
                            <input onclick="sendMail()" type="submit" value="submit">
                        </li>
                        <li></li>
                        <li><label id="msj"></label></li>
                        <li></li>
                        <li>
                            <label class="messageBottom">Recibe nuestras novedades.</label>
                        </li>
                    </ul>                                                                                                    
                </div>
            </article>
            
            <article id="content_asu" style="display: none;">
                <div id="popupAsu">
                    <div class="barClose barClosePopup">Close(x)</div>
                    <div id="photoAsu">
                        <img src="images/asu_brand.png">
                    </div>
                    <p>
                        Premia a los restaurantes que buscan y logran un nivel internacional , basandonos en:        
                    </p>
                        
                    <ul>
                        <li><b>A</b>mbientes de lujo , exclusivos, vanguardistas. </li>
                        <li><b>S</b>abores de diferentes cocinas de alto nivel para una experiencia de calidad. </li>
                        <li><b>U</b>tillidad servicio de amables profesionales en atención al cliente. </li>
                    </ul>
                        
                    <div id="contentAsu">
                        <div id="imgAsu"><img src="images/asu.png"><font><b>Placa para restaurants <br><br> premiados ASU</b></font></div>
                        <div id="imgCaption"></div>
                    </div>
                </div>
            </article>


        </section>
        <footer>
            <section>
                <img id="banner" src="images/barra_black.png"/>
            </section>
            <ul>
                <li>
                    <span class="fs1" aria-hidden="true" data-icon="&#xe000;"></span>
                    <span id="aboutus" >Acerca de nosotros</span>
                </li>
                <li>|</li>
                <li>
                    <span class="fs1" aria-hidden="true" data-icon="&#xe002;"></span>
                    <span id="sponsors" >Auspiciadores</span>
                </li>
                <li>               
            </ul>
        </footer>
        <script>            

            function sendMail(){
                $.ajax({
                    url: "ajax.php",
                    type: 'post',
                    data: {cmd: 'sendMail',name: $('#name').val(),email:$('#email').val()},
                    beforeSend: function(){
                        $("#msj").html('Enviando Correo ...');
                    },
                    success: function(response) {
                        var xx = response.split('[|@|@|]');
                        if (xx[0] == 'OK') {
                            $('#name').val('');
                            $('#email').val('');
                            $("#msj").html('Pronto nos contactaremos con Usted <br> Gracias ...');
                        } else{
                            alert('errorororoororor emaillllllllllllllllllll');
                        }                        
                    }
                })
            }
            
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
                            //$("#seleccionado").attr('src',xx[2]);
                            var url='http://<?php echo $_SERVER['HTTP_HOST']; ?>/'+xx[3];
                            $(location).attr('href',url);
                            $("#content_images").html(xx[1]);
                            /*$("#demo-htmlselect").ap*/                            
                            //$("#categoria").attr('value',xx[3]);
                        } else{
                            alert('errorororoororor');
                        }
                        
                    }
                });            
            }
            $( document ).ready(function() {                
                
                /*****************************************************************/                
                $("#demo-htmlselect  option[value='<?php echo $randomize; ?>']").attr('selected', 'selected');
                
                
                $( "#vote" ).click(function() {
                    $(this).attr('src','images/heart_over.png');
                });
                
                /*****************************************************************/
                
                $( "#sharedFacebook" ).click(function() {
                    window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href), 'facebook-share-dialog', 'width=626,height=436');
                }); 
                
                $( "#sharedTwitter" ).click(function() {
                    window.open('http://twitter.com/share?text='+encodeURIComponent(window.location.href +" @perumenu "+$("#categoria").val() ),'Popup','menubar=no,toolbar=no,height=290,width=600');                    
                }); 
                
                $( "#sharedGoogle" ).click(function() {
                    window.open('https://m.google.com/app/plus/x/?v=compose&content='+"Peru Menu"+'%20='+encodeURIComponent(window.location.href),'gplusshare','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=290,width=600');                    
                });
                                
                /*****************************************************************/
                                
                $( ".barClosePopup").click(function(){                   
                    if($("#content_about").is(":visible")){
                        $("#content_about").hide();
                        $("#content_sponsors").hide();
                        $("#content_asu").hide();
                        $("#content_images").show();
                    }                  
                });
                
                $( "#aboutus" ).click(function(){                
                    if($("#content_about").is(":hidden")){
                        $("#content_about").show();
                        $("#content_sponsors").hide();
                        $("#content_images").hide();
                        $("#content_asu").hide();
                    }                 
                });
                
                $( ".barClosePopup").click(function(){                   
                    if($("#content_sponsors").is(":visible")){
                        $("#content_sponsors").hide();
                        $("#content_about").hide();
                        $("#content_asu").hide();
                        $("#content_images").show();
                    }                  
                });
                
                $( "#sponsors" ).click(function(){                
                    if($("#content_sponsors").is(":hidden")){
                        $("#content_sponsors").show();
                        $("#content_about").hide();
                        $("#content_images").hide();
                        $("#content_asu").hide();
                    }                  
                });
                $('#demo-htmlselect').ddslick({
                    onSelected: function(data){
                        $.ajax({
                            url: "ajax.php",
                            type: 'post',
                            data: {cmd: 'getSlides',dishes: data.selectedData.value},
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
                });
            })
            
            getSlides(<?php echo $randomize; ?>);
        </script>
    </body>    
</html>
