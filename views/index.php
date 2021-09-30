<?php
class Views{
    function getpage($page){
        switch($page){
            case "meta":
                return include("page/meta.php");
            case "sidebar":
                return include("page/sidebar.php");
            case "header":
                return include("page/header.php");
            case "body":
                return include("page/body.php");
            case "theme-settings":
                return include("page/theme-settings.php");
            case "footer":
                return include("page/footer.php");
            case "meta-add":
                return include("page/meta-add.php");
            case "roblox-checkout":
                return include("page/checkout/roblox.php");   
            case "twitch-checkout":
                return include("page/checkout/twitch.php");  
        }
    }
}

?>