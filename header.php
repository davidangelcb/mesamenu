<header>
    <div id="grid">                
        <div id="navleft">
            <ul>
                <li>
                    <?php require_once HOME_DIRFILE.'locations.php'; ?>
                </li>                        
                <li>
                    <?php require_once HOME_DIRFILE.'categoria.php'; ?>
                </li>
                <li><img id="vote" style="display: none" src="<?php echo HOME_DIR;?>images/heart.png"/></li>
            </ul>
        </div>
        <div id="navmiddle">
            <ul>
                <li><img class="active" src="/images/country/brand_perumenu.png"/></li>
                <li></li>
            </ul>
        </div>
        <div id="navright">
            <div id="menuRedesSociales" style="display: none;">
            <ul>
                <li><img src="<?php echo HOME_DIR;?>images/login_with.png" height="20" /></li>
                <li class="facebook hand">
                    <div id="msjfacebook" style="display: none;">
                        <div class="container" style="color:#3B5998;">Login con Facebook</div>
                        <div class="arrow-after"></div>
                    </div>
                    <img id="sharedFacebook" src="<?php echo HOME_DIR;?>images/facebook_icon.png"  onmouseover="this.src='<?php echo HOME_DIR;?>images/facebook_icon_over.png'" onmouseout="this.src='<?php echo HOME_DIR;?>images/facebook_icon.png'"  height="20"/>
                </li>
                <li class="twitter hand">
                    <div id="msjtwitter" style="display: none;">
                        <div class="container" style="color:#0676C1;">Login con Twitter</div>
                        <div class="arrow-after"></div>
                    </div>
                    <img id="sharedTwitter" src="<?php echo HOME_DIR;?>images/twitter_icon.png" height="20"/>
                </li>
                <li class="google hand">
                    <div id="msjgoogle" style="display: none;">
                        <div class="container" style="color:#DD4B39;">Login con Google+</div>
                        <div class="arrow-after"></div>
                    </div>
                    <img id="sharedGoogle" src="<?php echo HOME_DIR;?>images/google+_icon.png" height="20"/>
                </li>
            </ul>
            </div>    
        </div>
    </div>
</header>