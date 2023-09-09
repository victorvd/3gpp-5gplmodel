<?php include_once '../config.php' ?>
<!doctype html>
<html lang="en">
    <head>
        <title>Download - Path loss</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo $GLOBALS['APP_ROOT'] ?>/css/formas.css" rel="stylesheet" type="text/css">
        <meta name="keywords" content="5G,frequency,band,spectrum">
        <meta name="description" content="5G frequency band pathloss calculator">
    </head>
    <body>
        <div class="container">
            <header>
                <div id="logo-pos"><img src="<?php echo $GLOBALS['APP_ROOT'] ?>/images/posgrado.png"/></div>
                <div id="logotipo"><img src="<?php echo $GLOBALS['APP_ROOT'] ?>/images/logo.png"/></div>
                <div id="language">
                    <a class="" href="<?php echo $GLOBALS['APP_ROOT'] ?>">Español</a>
                    <?php include $GLOBALS['SCRIPT_ROOT']."/sponsor/index.php"; ?>
                </div>
                <div class="encabezado-interno">
                    <h1>Master's degree in Telecommunications Engineering</h1>
                    <div class="linea-sombreada-sup"></div>
                    <div class="clearfix"></div>
                    <div class="linea-sombreada-inf"></div>
                </div>
            </header>
            <nav id="nav-bar" class="navbar navbar-toggleable-md navbar-light bg-faded">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $_SERVER['PHP_SELF'];?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/download.php">Download</a>
                    </li>
                </ul>
            </nav>
            <br>

            <section>
                <h3><a id="hdr_calc"></a>Scripts</h3>
                <br>
                <div>
                    <ul style="color:#292B2C">
                        <li><a href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/downloads/RMa.m" download>
                                Rural Macrocell path loss</a></li>
                        <li><a href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/downloads/UMa.m" download>
                                Urban Macrocell path loss</a></li>
                        <li><a href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/downloads/UMi.m" download>
                                Urban Microcell path loss</a></li>
                        <li><a href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/downloads/InH.m" download>
                                Indoor Hotspot path loss</a></li>
                        <li><a href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/downloads/Prlos.m" download>
                                LoS Probability</a></li>
                        <li><a href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/downloads/3GPP_PL.zip" download>
                                3GPP path loss</a></li>
                        <li><a href="<?php echo $GLOBALS['APP_ROOT'] ?>/en/downloads/NYU_PL.zip" download>
                                NYU path loss</a></li>
                    </ul>
                </div>
                <br>
                <h4><a id="hdr_3GPP"></a>Scripts can be executed with MATLAB®</h4>
                <br>
                <div>
                    <img src="<?php echo $GLOBALS['APP_ROOT'] ?>/images/img_3NY.png" width="auto" height="300"/>
                    <img src="<?php echo $GLOBALS['APP_ROOT'] ?>/images/img_hist.png" width="auto" height="300"/>
                </div>
                <br>

            </section>

        </div>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        <script src="js/results.js"></script>

    </body>
</html>