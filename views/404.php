<?php
/*
 * @Developed by : Ahmed Mosa .
 * @Developer Site: http//www.elmosamem.com 
 */
$site_settings->global_settings();
($site_settings->Site_Status == 0) ? $models->redirect_to(URL .$_SESSION['language_alias']. '/site_closed') : null;
?>
<html>
    <head>
        <title>404 Error Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo URL; ?>templates/css/style.css"  />
    </head>
    <body>
        <!--page-content-->
        <section class="row page-content" id="error">
            <div class="container">
                <text>
                <?php echo $language->Error_Message; ?>
                <a href="<?php echo URL . $_SESSION['language_alias']; ?>"><?php echo $language->Go_Home; ?></a>
                </text>

            </div>
        </section>
        <!--End page-content-->
    </body>
</html>


