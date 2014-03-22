<html>
    <head>



        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script>
            $(function()
            {
                var container = $("#container");
                container
                .hover(
                // fade background div out when cursor enters, 
                function() 
                { 
                    $(".background", this).stop().animate({opacity:0}); 
                }, 
                // fade back in when cursor leaves
                function() 
                { 
                    $(".background", this).stop().animate({opacity:1}) 
                })
                // allow positioning child div relative to parent
                .css('position', 'relative')
                // create and append background div 
                // (initially visible, obscuring parent's background)
                .append( $("<div>")
                .attr('class', 'background')
                .css({
                    backgroundColor:'blue',
                    position: 'absolute',
                    top:0,
                    left:0,
                    zIndex:-1,
                    width:container.width(), 
                    height:container.height()
                }) 
            );
            });
        </script>
    </head>
    <body style="background-color:yellow">
        <!-- by default, "see through" to parent's background color -->
        <div id="container"> 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
            Aenean nec magna. Nulla eu mi sit amet nibh pellentesque vehicula. 
            Vivamus congue purus non purus. Nam cursus mollis lorem.    
        </div>
    </body>
</html>