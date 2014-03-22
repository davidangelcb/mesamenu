<header>
    <div id="grid">                
        <div id="navleft">
            <ul>
                <li><img id="vote" src="images/heart.png"/></li>
                <li>
                    <?php require_once 'locations.php'; ?>
                </li>                        
                <li>
                    <?php require_once 'categoria.php'; ?>
                </li>
            </ul>
        </div>
        <div id="navmiddle">
            <?php require_once 'countrys.php'; ?>
        </div>
        <div id="navright">
            <ul>
                <li><img src="images/login_with.png" height="20" /></li>
                <li class="facebook hand">
                    <div id="msjfacebook" style="display: none;">
                        <div class="container" style="color:#3B5998;">Login con Facebook</div>
                        <div class="arrow-after"></div>
                    </div>
                    <img id="sharedFacebook" src="images/facebook_icon.png" height="20"/>
                </li>
                <li class="twitter hand">
                    <div id="msjtwitter" style="display: none;">
                        <div class="container" style="color:#0676C1;">Login con Twitter</div>
                        <div class="arrow-after"></div>
                    </div>
                    <img id="sharedTwitter" src="images/twitter_icon.png" height="20"/>
                </li>
                <li class="google hand">
                    <div id="msjgoogle" style="display: none;">
                        <div class="container" style="color:#DD4B39;">Login con Google+</div>
                        <div class="arrow-after"></div>
                    </div>
                    <img id="sharedGoogle" src="images/google+_icon.png" height="20"/>
                </li>
            </ul>
        </div>
    </div>
</header>