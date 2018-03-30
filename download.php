<!doctype html>
<html lang="en">
    <head>
        <title>Descargas - Pérdidas en el trayecto</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/formas.css" rel="stylesheet" type="text/css">
        <meta name="keywords" content="5G,frequency,band,spectrum">
        <meta name="description" content="5G frequency band pathloss calculator">

    </head>

    <body>

        <div class="container">
            <header>
                <div id="logo-pos"><img src="images/posgrado.png"/></div>
                <div id="logotipo"><img src="images/logo.png"/></div>

                <div id="language">
                    <a class="" href="#" onclick="changeLanguage('/en');">English</a>
                </div>

                <div class="encabezado-interno">
                    <h1>Maestría en Ingeniería de las Telecomunicaciones</h1>
                    <div class="linea-sombreada-sup"></div>
                    <div class="clearfix"></div>
                    <div class="linea-sombreada-inf"></div>
                </div>
            </header>
            <nav id="nav-bar" class="navbar navbar-toggleable-md navbar-light bg-faded">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="download.php">Descargas</a>
                    </li>
                </ul>
            </nav>
            <br>

            <section>
                <h3><a id="hdr_calc"></a>Scripts</h3>
                <br>
                <div>
                    <ul style="color:#292B2C">
                        <li><a href="/downloads/RMa.m" download>
                                Rural Macrocell path loss</a></li>
                        <li><a href="/downloads/UMa.m" download>
                                Urban Macrocell path loss</a></li>
                        <li><a href="/downloads/UMi.m" download>
                                Urban Microcell path loss</a></li>
                        <li><a href="/downloads/InH.m" download>
                                Indoor Hotspot path loss</a></li>
                        <li><a href="/downloads/Prlos.m" download>
                                LoS Probability</a></li>
                        <li><a href="/downloads/3GPP_PL.zip" download>
                                3GPP path loss</a></li>
                        <li><a href="/downloads/NYU_PL.zip" download>
                                NYU path loss</a></li>
                    </ul>
                </div>
                <br>
                <h4><a id="hdr_3GPP"></a>Los scripts se pueden ejecutar con la herramienta MATLAB®</h4>

                <br>
                <div>
                    <img src="../images/img_3NY.png" width="auto" height="300"/>
                    <img src="../images/img_hist.png" width="auto" height="300"/>
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