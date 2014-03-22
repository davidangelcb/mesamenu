<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>How to create a custom drop down with images using jQuery UI.</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
        <script type="text/javascript" src="jquery.ddslick.min.js"></script>
        <script type="text/javascript" src="script.js"></script>
        <style type="text/css">
            *
            {
                font-size:12px;
                font-family:verdana;
            }
            .demo-content
            {
                background: none repeat scroll 0 0 #DADADA;
                border: 2px solid #DDDDDD;
                font-size: 12px;
                width: 900px;
                padding:20px;
                margin:0px auto;
            }
            .demo-content h3{
                padding:0px;
                margin:0px 0px 20px;
                font-size:18px;
            }
            .spacer {
                clear: both;
                height: 20px;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <!--
                HTML CODE
        -->
        <div class="demo-content">
            <div class="demo-live">
                <h3>Generated with page load</h3>
                <select id="demo-htmlselect-basic">
                    <option data-description="Description with Facebook" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/facebook-icon-32.png" value="0">Facebook</option>
                    <option data-description="Description with Twitter" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/twitter-icon-32.png" value="1">Twitter</option>
                    <option data-description="Description with LinkedIn" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/linkedin-icon-32.png" value="2">LinkedIn</option>
                    <option data-description="Description with Foursquare" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/foursquare-icon-32.png" value="3">Foursquare</option>
                </select>
                <div class="spacer"></div>

                <hr />
                <br />
                <br />
                <!--
                        below drop down will converted to custom drop down.
                        1. data-description
                                attribute display the description for option value.
                        2. data-imagesrc
                                attribute will add image to custom drop down.
                -->
                <h3>
                    Render from HTML select options
                </h3>
                <select id="demo-htmlselect">
                    <option data-description="Description with Facebook" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/facebook-icon-32.png" value="0">Facebook</option>
                    <option data-description="Description with Twitter" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/twitter-icon-32.png" value="1">Twitter</option>
                    <option data-description="Description with LinkedIn" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/linkedin-icon-32.png" value="2">LinkedIn</option>
                    <option data-description="Description with Foursquare" data-imagesrc="http://dl.dropbox.com/u/40036711/Images/foursquare-icon-32.png" value="3">Foursquare</option>
                </select>
                <div class="spacer"></div>
                <!--
                        Two buttons that add and remove custom drop down.
                -->
                <button id="make-it-custom">Make it Custom!</button>
                <button id="restore">Restore to Original</button>
                <br />
                <br />
                <hr />
                <br />
                <br />
                <h3>Result</h3>
                <div id="dd-display-data"></div>
                <br />
                <br />
                <br />
                <br />
            </div>
        </div>
    </body>
</html>