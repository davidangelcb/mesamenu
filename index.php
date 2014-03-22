<?php
  /*require 'config.php';
  require 'bd_access.php';/*
  $conexion=mysql_connect("localhost","asumenu","tJVo4zACwI4Z") or die("Problemas en la conexion");
  mysql_select_db("asumenu",$conexion) or die("Problemas en la selección de la base de datos");
  $clavebuscadah = mysql_query("select id,name from dishes") or die("Problemas en el select1:" . mysql_error()); */
$_SESSION['master'] = base64_encode(md5(microtime() . "sderfd") . md5(microtime() . "tegvfwcrebtneh"));
$randomize = rand(1, 10);

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
        
        <link rel="stylesheet" href="js/libs/normalize-2.0.1/normalize.css">
        <link rel="stylesheet" href="css/styles.css"/>
        <link rel="stylesheet" href="css/icons.css"/>
        <link rel="icon" href="favicon.ico" type="image/x-icon" />        
        <script src="js/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.ddslick.min.js"></script>
        <script src="//platform.twitter.com/widgets.js" type="text/javascript"></script>        
    </head>
    <body>
        <?php require_once 'header.php'; ?>

        <section id="content">

            <article id="content_images" style="display:block;">                
            </article>
            <input type="hidden" id="categoria"/>
            
            <?php require_once 'include/_favorite.php'; ?>
            
            <?php require_once '_includeAboutUs.php'; ?>

            <?php require_once '_includeSponsors.php'; ?>
            
            <?php require_once '_includeAsu.php'; ?>


        </section>
        
            <?php require_once 'footer.php'; ?>
        
        <script>            
            
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
                    url: "ajax.php",
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
                            $("#content_images").html(xx[1]);
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
                    $(this).attr('src','images/heart_over.png');
                });
                
                /*****************************************************************/
                
                /*$("#sharedFacebook").on({
                    "mouseover" : function() {
                        $('#msjfacebook').show();
                    },
                    "mouseout" : function() {
                        $('#msjfacebook').hide();
                    }
                });*/                
                $( "#sharedFacebook" ).click(function() {
                    window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href), 'facebook-share-dialog', 'width=626,height=436');
                }); 
                
                
                /*$("#sharedTwitter").on({
                    "mouseover" : function() {
                        $('#msjtwitter').show();
                    },
                    "mouseout" : function() {
                        $('#msjtwitter').hide();
                    }
                });*/
                $( "#sharedTwitter" ).click(function() {
                    window.open('http://twitter.com/share?text='+encodeURIComponent("@mesamenu, " +" El sitio más delicioso del Internet"),'Popup','menubar=no,toolbar=no,height=290,width=600');                    
                }); 
                
                
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
                        $('#htmlselect-locations div a img').attr("src", "images/locations/"+data.selectedData.value+valor);
                        if ((data.selectedData.value=='arequipa')||((data.selectedData.value=='cusco')) ){
                            $('#content_images').addClass('noFoundData');
                            $('#content_images').html('<br/><br/><br/><br/>Ups... en <b>'+data.selectedData.value+'</b>  aun no tenemos data disponible... :)');
                        }else{
                            /************************************************************************/                            
                            $('#htmlselect-sections').ddslick({
                                
                                onSelected: function(datax){
                                    
                                    $('#htmlselect-sections div a img').attr("src", "images/sections/"+datax.selectedData.value+valor);
                                    
                                    $.ajax({
                                        url: "ajax.php",
                                        type: 'post',
                                        data: {cmd: 'getSlides',dishes: datax.selectedData.value},
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
                                                    
                                                    $('.item_dishes figure ol table tr td a #favorite').on({
                                                        "click" : function (){
                                                            //$('body').css({ filter:alpha(opacity=40), opacity:0.6});
                                                            //$('#show_favorite').show();
                                                            //alert('hola');
                                                            showModal();
                                                        }
                                                    });
                                                    
                                                },1000);
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
                
                $("#favorite").onclick(function (){
                    alert("hola ");
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
                    alert('aaa');
                    $('#bgmodal').hide()
                    $('#bgtransparent').hide();
                    alert('bbbb');
                }
            })
            
            getSlides(<?php echo $randomize; ?>);
        </script>
        <?php
        require_once 'analytics.php';
        ?>
    </body>      
</html>
