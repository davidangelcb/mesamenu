<?php
require 'lib/config.php';
  /*require 'config.php';
  require 'bd_access.php';/*
  $conexion=mysql_connect("localhost","asumenu","tJVo4zACwI4Z") or die("Problemas en la conexion");
  mysql_select_db("asumenu",$conexion) or die("Problemas en la selección de la base de datos");
  $clavebuscadah = mysql_query("select id,name from dishes") or die("Problemas en el select1:" . mysql_error()); */
$_SESSION['master'] = base64_encode(md5(microtime() . "sderfd") . md5(microtime() . "tegvfwcrebtneh"));
$randomize = rand(1, 10);

/* categorias o tipos de platos*/
$query="select * from sections  where status='E'";
$categorias = DdMesaMenu::fetchAll($query);

/* Pasies de menudencia */
$query2="select * from countrys where estatus='S' order by 1 desc";
$paises = DdMesaMenu::fetchAll($query2);
$city = CIUDADDEFAULT_ID;
$id=0;
if(isset($_GET['op2'])){
    $departamento = DdMesaMenu::fetchOneBy('name = ?', 'locations', null, trim($_GET['op']),false);
    if($departamento){
        $dep = $departamento['id'];
        $city =$dep;
        $q = "select * from sections where name like '%".trim($_GET['op1'])."%' ";

        $tipoPlato = DdMesaMenu::fetchOne($q);
        if($tipoPlato){
             $tip  = $tipoPlato['id'];
             $randomize = $tipoPlato['id'];
             $query = "select  S.id FROM seccion_lima S  inner join seccions_platos SP on SP.idplato = S.id where S.departamento = ? and SP.idsection = ? and S.plato = ?";
             echo $query;
             $xplato = DdMesaMenu::fetchOne($query,  array($dep,$tip,trim($_GET['op2'])),false);
             if($xplato){
                 $id = $xplato['id'];
             }
        }
    }
}

?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta  charset="UTF-8" />
        <title> Mesa Menu </title>
        <meta name="description" content="Mesa Menú, el sitio más delicioso del Internet"/>           
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <meta property="og:url" content="http://mesamenu.com" />
        <meta property="og:title" content="Mesa Menu" />
        <meta property="og:description" content="El sitio mas delicioso del Internet" />
        <meta property="og:image" content="http://mesamenu.com/images/shared-mesamenu.png" />
        
        <link rel="stylesheet" href="<?php echo BASE_HOME;?>js/libs/normalize-2.0.1/normalize.css">
        <link rel="stylesheet" href="<?php echo BASE_HOME;?>css/styles.css"/>
        <link rel="stylesheet" href="<?php echo BASE_HOME;?>css/icons.css"/>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />        
        <script>
            var facebookId = '<?php echo FACEBOOK;?>';
        </script>    
        <script src="<?php echo BASE_HOME;?>js/jquery-1.8.3.min.js"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo BASE_HOME;?>js/jquery.ddslick.min.js"></script>
        <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>  
        <link rel="stylesheet" href="<?php echo BASE_HOME;?>css/colorbox.css" />

        <script src="<?php echo BASE_HOME;?>js/jquery.colorbox.js"></script>        
        <script type="text/javascript" src="<?php echo BASE_HOME;?>js/facebook.js"></script> 
        
        <script>
        var idUser = "";     
        function createLoginFace(foto, nombre){
            var html ="";
            html = "<div style='position:relative;'>";
            html += '<div style="position:absolute;height:40px; width:40px;right:0px;top:0px"><img title="'+nombre+'" src="'+foto+'" style="border-radius:50%;width:40px;"/></div>';
            html += '<div style="position:absolute; right:0px; margin-right:40px;"><img  style="margin-top:25px;margin-right:10px;width:40%" src="<?php echo HOME_DIR;?>images/flecha_slide.png" onmouseover="menux(1,0);"   onmouseout="menux(2,0);"/></div>';
            html += menu;
            html += '</div>';            
            return html;
        }
        //<p><a class='iframe' href="http://wikipedia.com">Outside Webpage (Iframe)</a></p>
                
        </script>
    </head>
    <body style="margin-bottom: 10px">
        <?php require_once  HOME_DIRFILE.'header.php'; ?>

        <section id="content">

            <article id="content_images" style="display:block;">                
            </article>
            <input type="hidden" id="categoria"/>
            
            <?php require_once HOME_DIRFILE.'include/_favorite.php'; ?>
            
            <?php require_once HOME_DIRFILE.'_includeAboutUs.php'; ?>

            <?php require_once HOME_DIRFILE.'_includeSponsors.php'; ?>
            
            <?php require_once HOME_DIRFILE.'_includeAsu.php'; ?>


        </section>
        
            <?php require_once HOME_DIRFILE.'footer.php'; ?>
        
        <script>            
        function getIdLogin(idLogin){
            if(idLogin){
                $.ajax({
                        url: "<?php echo HOME_DIR;?>ajax.php",
                        type: 'post',
                        data: {cmd: 'getIdLogin_',id: idLogin},
                        success: function(response) {
                            var xx = response.split('[|@|@|]');                        
                            if (xx[0] == 'OK') {
                                idUser=xx[1]; 
                            } else{ 
                                alert("Error: Please try later, CODE 152!");
                            }                        
                        }
                    });
            }
        }            
            /*****************************************************************/
            var sourceSwap = function () {
                var $this = $(this);
                var newSource = $this.data('alt-src');
                $this.data('alt-src', $this.attr('src'));
                $this.attr('src', newSource);
            }

            function sendMail(){
                if($("#name").val().length < 1){      
                    $("#name").focus();
                    alert("El nombre es obligatorio");
                    return false;
                }
                if($("#email").val().length < 1){
                    $("#email").focus();
                    alert("El email es obligatorio");
                    return false;
                }
                $.ajax({
                    url: "<?php echo HOME_DIR;?>ajax.php",
                    type: 'post',
                    data: {cmd: 'sendMail',name: $('#name').val(),email:$('#email').val()},
                    beforeSend: function(){
                        $("#msj").html('Enviando Correo ...');
                    },
                    success: function(response) {
                        var xx = response.split('[|@|@|]');                        
                        if (xx[0] == 'OK') {
                            alert('Intentelo de nuevo, Gracias ... ');
                        } else{
                            $('#name').val('');
                            $('#email').val('');
                            $("#msj").html(xx[1]);                            
                        }                        
                    }
                })
            }
            
        /******************************************************/
            function setModalOpen(){
                $(".iframe").colorbox({iframe:true, width:"60%", height:"70%",onClosed:verificaSession, onOpen:bueno}); 
                
            }
            function bueno(){
                
                var a  = $(this).attr('href');
                var id  = $(this).attr('id');
                window.history.pushState(a, ".: Mesa Menu :.", "/index.php");
                window.history.pushState(a, "Titulo", id);
                return false;
            }
            function verificaSession(){
                //alert(123);
                window.history.pushState("Home", ".: Mesa Menu :.", "/index.php");
            }
            var LastSel=null;
            var LastCiudad=null;
            var OnlyHeard='NO';
            function getSlides(sel,ciudad) {
                LastSel=sel;
                LastCiudad=ciudad;
                $.ajax({
                    url: "<?php echo HOME_DIR;?>ajax.php",
                    type: 'post',
                    data: {cmd: 'getSlides',idplato:<?php echo $id;?>, dishes: sel,city: ciudad,iduser:idUser,heard:OnlyHeard},
                    beforeSend: function(){
                        $("#content_images").html('Loading ...');
                    },
                    success: function(response) {
                        var xx = response.split('[|@|@|]');
                        if (xx[0] == 'OK') {
                            //$("#seleccionado").attr('src',xx[2]);
                            $("#content_images").html(xx[1]);
                            var ask =  setTimeout("setModalOpen()",1000);
                             
                            /*$("#htmlselect-sections").ap*/                            
                            //$("#categoria").attr('value',xx[3]);
                        } else{
                            alert('errorororoororor');
                        }
                        
                    }
                });            
            }
            $( document ).ready(function() {
                /**********************POPUP****************************/
                var ancho = 400; 
                var alto = 350;

                $(window).resize(function(){
                        // dimensiones de la ventana
                        var wscr = $(window).width();
                        var hscr = $(window).height();

                        // estableciendo dimensiones de background
                        $('#bgtransparent').css("width", wscr);
                        $('#bgtransparent').css("height", hscr);

                        // definiendo tamaño del contenedor
                        $('#bgmodal').css("width", ancho+'px');
                        $('#bgmodal').css("height", alto+'px');

                        // obtiendo tamaño de contenedor
                        var wcnt = $('#bgmodal').width();
                        var hcnt = $('#bgmodal').height();

                        // obtener posicion central
                        var mleft = ( wscr - wcnt ) / 2;
                        var mtop = ( hscr - hcnt ) / 2;

                        // estableciendo posicion
                        $('#bgmodal').css("left", mleft+'px');
                        $('#bgmodal').css("top", mtop+'px');
                });
                
                /*****************************************************************/
                $("#htmlselect-countrys  option[value='peru']").attr('selected', 'selected'); 
                $("#htmlselect-locations  option[value='lima']").attr('selected', 'selected');           
                $("#htmlselect-sections  option[value='<?php echo $randomize; ?>']").attr('selected', 'selected');
                
                $('#htmlselect-countrys').ddslick({  
                    onSelected: function(data){  
                        if(data.selectedIndex > 0) {
                            //$('#htmlselect-countrys div a img').attr("src", "images/locations/"+data.selectedData.value+valor);
                        }   
                    }    
                });                              
                
                /*cambiando imagenes del header*/                
                $('#country li').click(function(){
                    alert('Muy pronto :) ');
                    $(this).siblings('li').removeClass('unactive');
                    $(this).addClass('active');
                });
                                    
                
                $( "#vote" ).click(function() {
                    if(OnlyHeard=='SI'){
                        OnlyHeard='NO';
                        $(this).attr('src','/images/heart.png');
                    }else{
                        OnlyHeard='SI';
                        $(this).attr('src','/images/heart_over.png');                        
                    }
                    getSlides(LastSel,LastCiudad);
                });
                
                /*****************************************************************/
                $( "#sharedFacebook" ).click(function() {
                    login();
                });
                /*$("#sharedFacebook").on({
                    "mouseover" : function() {
                        $('#msjfacebook').show();
                    },
                    "mouseout" : function() {
                        $('#msjfacebook').hide();
                    }
                });*/                
               /* $( "#sharedFacebook" ).click(function() {
                    window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href), 'facebook-share-dialog', 'width=626,height=436');
                }); */
                
                
                /*$("#sharedTwitter").on({
                    "mouseover" : function() {
                        $('#msjtwitter').show();
                    },
                    "mouseout" : function() {
                        $('#msjtwitter').hide();
                    }
                });*/
               /* $( "#sharedTwitter" ).click(function() {
                    window.open('http://twitter.com/share?text='+encodeURIComponent("@mesamenu, " +" El sitio más delicioso del Internet"),'Popup','menubar=no,toolbar=no,height=290,width=600');                    
                }); /*
                
                
                /*$("#sharedGoogle").on({
                    "mouseover" : function() {
                        $('#msjgoogle').show();
                    },
                    "mouseout" : function() {
                        $('#msjgoogle').hide();
                    }
                });*/
                $( "#sharedGoogle" ).click(function() {
                    window.open('https://m.google.com/app/plus/x/?v=compose&content='+"Peru Menu"+'%20='+encodeURIComponent(window.location.href),'gplusshare','menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=290,width=600');                    
                });
                                                
                /*****************************************************************/
                /*for about us*/               
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
                
                /*for sponsors*/
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
                
                /*for ASU*/                
                $( ".barClosePopup" ).click(function(){                
                    if($("#content_asu").is(":visible")){
                        $("#content_sponsors").hide();
                        $("#content_about").hide();
                        $("#content_asu").hide();
                        $("#content_images").show();
                    }                   
                });
                
                $( "#asu" ).click(function(){                
                    if($("#content_sponsors").is(":hidden")){
                        $("#content_asu").show();
                        $("#content_about").hide();
                        $("#content_images").hide();
                    }                  
                });                
                
                /*for #show_favorite*/
                
                $( "#favorite" ).click(function(){                
                    if($("#show_favorite").is(":hidden")){
                        $("#show_favorite").show();
                    }               
                }); 
                
                /*for load images*/
                $('#htmlselect-locations').ddslick({
                    onSelected: function(data){
                        valor = "_pm.png";
                        $('#htmlselect-locations div a img').attr("src", "/images/locations/"+data.selectedData.value.toLowerCase()+valor);
                        var ciudadText = data.selectedData.value;
                        if ((data.selectedData.value=='arequipa')||((data.selectedData.value=='cusco')) ){
                            $('#content_images').addClass('noFoundData');
                            $('#content_images').html('<br/><br/><br/><br/>Ups... en <b>'+data.selectedData.value+'</b>  aun no tenemos data disponible... :)');
                        }else{
                            /************************************************************************/                            
                            $('#htmlselect-sections').ddslick({
                                
                                onSelected: function(datax){
                                    
                                    $('#htmlselect-sections div a img').attr("src", "/images/sections/"+datax.selectedData.value+valor);
                                    LastSel=datax.selectedData.value;
                                    LastCiudad=ciudadText;

                                    OnlyHeard='NO';
                                    $("#vote").attr('src','/images/heart.png');
                                    $.ajax({
                                        url: "<?php echo HOME_DIR;?>ajax.php",
                                        type: 'post',
                                        data: {cmd: 'getSlides',idplato:<?php echo $id;?>,dishes: datax.selectedData.value,city:ciudadText,iduser:idUser,heard:OnlyHeard},
                                        beforeSend: function(){
                                            $("#content_images").html('Loading ...');
                                        },
                                        success: function(response) {
                                            var xx = response.split('[|@|@|]');
                                            if (xx[0] == 'OK') {
                                                $("#content_images").html(xx[1]);
                                                setTimeout(function () {
                                                    $('.item_dishes figure ol table tr td a img').hover(sourceSwap, sourceSwap);
                                                    
                                                    $('.item_dishes figure ol table tr td a #table').on({
                                                        "mouseover" : function() {
                                                            $('.msjtable').css({ opacity: 1 });
                                                        },
                                                          "mouseout" : function() {
                                                            $('.msjtable').css({ opacity: 0 });
                                                        }
                                                    });
                                                    
                                                    $('.item_dishes figure ol table tr td a #shared').on({
                                                        "mouseover" : function() {
                                                            $('.msjshared').css({ opacity: 1 });
                                                        },
                                                          "mouseout" : function() {
                                                            $('.msjshared').css({ opacity: 0 });
                                                        }
                                                    });
                                                    
                                                    $('.item_dishes figure ol table tr td a #cart').on({
                                                        "mouseover" : function() {
                                                            $('.msjcart').css({ opacity: 1 });
                                                        },
                                                          "mouseout" : function() {
                                                            $('.msjcart').css({ opacity: 0 });
                                                        }
                                                    });
                                                    
                                                    $('.item_dishes figure ol table tr td a #favorite').on({
                                                        "mouseover" : function() {
                                                            $('.msjfavorite').css({ opacity: 1 });
                                                        },
                                                          "mouseout" : function() {
                                                            $('.msjfavorite').css({ opacity: 0 });
                                                        }
                                                    });
                                                    
                                                    
                                                    
                                                },1000);
                                                var ask =  setTimeout("setModalOpen()",1000);
                                            } else{
                                                alert('errorororoororor');
                                            }

                                        }
                                    });
                                }
                            });
                            /*********************************************************************/
                        }                        
                    }
                });                              
                /*for 4 icons*/                                
                /*********************************************************************/
                function showModal(){		
                    var wscr = $(window).width();
                    var hscr = $(window).height();

                    $('#bgtransparent').css("width", wscr);
                    $('#bgtransparent').css("height", hscr);
                    
                    $('#bgmodal').show();
                    $(window).resize();
                }
                
                function closeModal(){
                     
                    $('#bgmodal').hide()
                    $('#bgtransparent').hide();
                    
                }
            });
            var facebookShare = function(url){
               
                    window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(url), 'facebook-share-dialog', 'width=626,height=436');
                
            };
            var BookMark = function(thiss, idplato){
               if(idUser==""){
                   alert("Please Login firsts!");
                   return;
                   //alert($(thiss).attr("data-alt-src"));
               }else{
                   var dato="";
                   var status =  $(thiss).attr("status");
                   var statusN='';
                   if(status=='N'){
                       dato= "Was added to Bookmarks";
                       statusN='Y';
                   }else{
                       dato= "Was removed to Bookmarks";
                       statusN='N';
                   } 
                    var xd = thiss.id;
                    var  srccActivo = $("#"+xd).attr("srcA");
                    var  srccOver = $("#"+xd).attr("data-alt-srcA");
                    if(statusN=='N'){
                        $(thiss).attr("src",srccActivo); 
                        
                    }else{
                        $(thiss).attr("src",srccOver);
                        
                    }
                    $(thiss).attr("status",statusN);
                    
                    //saveBook
                    //iduser  idplato
                    $.ajax({
                    url: "<?php echo HOME_DIR;?>ajax.php",
                    type: 'post',
                    data: {cmd: 'saveBook',iduser: idUser,plato: idplato,estado:statusN},
                        success: function(response) {
                            var xx = response.split('[|@|@|]');
                            if (xx[0] == 'OK') {
                                 alert(dato);

                            } else{
                                alert(xx[1]);
                            }

                        }
                    });
               }
            };
            getSlides(<?php echo $randomize; ?>,'<?php echo $city; ?>');
        </script>
        <script type="text/javascript" src="<?php echo BASE_HOME;?>js/functions.js"></script>
        <?php
        require_once HOME_DIR.'analytics.php';
        ?>
    </body>      
</html>
