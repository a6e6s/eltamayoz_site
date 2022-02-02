<?php

/* 
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
$site_settings->global_settings();
$site_settings->site_settings($_SESSION['site_id']);
$message = '1';
if ($site_settings->Main_Site_Status != 0) {
    if ($site_settings->Site_Status != 0) {
        isset($_SESSION['site_alias']) ? $models->redirect_to(URL . $_SESSION['language_alias'].'/'.$_SESSION['site_alias']) : $models->redirect_to(URL) ;
    }else
    {
        $message = $site_settings->SiteClosedMessage;
    }
}else
{
    $message = $site_settings->mainSiteClosedMessage;
}
?>
<html>
    <head>
        <title>Site Closed</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/style.css"  />
    </head>
    <body>
        <!--page-content-->
        <section class="row page-content" id="error">
            <div class="container">
                <text>
                <?php echo $message;  ?>
                </text>
            </div>
        </section>
        <!--End page-content-->
    </body>
</html>

