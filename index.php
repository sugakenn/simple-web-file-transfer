<?php
    require_once('./language.php');

    function getDir() {
        $ret = "";
        for($i = strlen($_SERVER['REQUEST_URI'])-2; 0 <= $i; $i--) {
            if (substr($_SERVER['REQUEST_URI'],$i,1)==='/') {
                return htmlspecialchars(substr($_SERVER['REQUEST_URI'],0,$i+1));
            }
        } 
    
        return '/';
    }

    $strTargetUrl ='http://'.gethostbyname(php_uname('n')).getDir().'upload.php';
?>
<!DOCTYPE html>
    <html lang="<?php echo $GLOBALS['lang']; ?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $GLOBALS['messages']['link-page-title']; ?></title>
        <script src="./lib/jquery-3.6.0.min.js"></script>
        <script src="./lib/jquery.qrcode.min.js"></script>
    </head>    
    <body>
        <h1><?php echo $GLOBALS['messages']['link-h1-title']; ?></h1>
        <div id="qrcodearea"></div>
        <p><?php echo $GLOBALS['messages']['link-ip']."<a href='$strTargetUrl'>$strTargetUrl</a>"; ?></p>
        <script>
            <?php echo "let strQr='$strTargetUrl';"; ?>
            jQuery(function($){$('#qrcodearea').qrcode({width: 128, height: 128, text: strQr});});
        </script>
    </body>
</html>

