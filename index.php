<!doctype html>
<html lang="en">
    <head>
        <title>Inicio - Pérdidas en el trayecto</title>
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
                        <a class="nav-link" href="index.php#hdr_calc">Escenarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="descargas.php">Descargas</a>
                    </li>
                </ul>
            </nav>
            <br>

            <section>

                <h3><a id="hdr_perd"></a>Calculador de pérdidas en el trayecto de propagación para frecuencias 5G</h3>
                <br>
                <div>
                    <img src="images/img_path.png" width="auto" height="300"/>
                </div>
                <br>
                <h3><a id="hdr_calc"></a>Escenarios</h3>
                <br>
                <nav class="nav nav-pills flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link" href="RMa.php">Macrocelda rural<img src="images/img_RMa.png"/></a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="UMa.php">Macrocelda urbana<img src="images/img_UMa.png"/></a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="UMi.php">Microcelda urbana<img src="images/img_UMi.png"/></a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="InH.php">InH/Oficina<img src="images/img_InH.png"/></a>
                </nav>

                <br>
                <br>
                <h3><a id="hdr_3GPP"></a>Los modelos de pérdidas en el trayecto se basan en el 3GPP TR <a href="http://www.3gpp.org/DynaReport/38901.htm">38.901</a> (Version 14.3.0 Ene. 2018)</h3>

            </section>

            <footer>
                <p class="text-center">
                    <a href="#" class="btn btn-info">Volver arriba</a>
                </p>
            </footer>

        </div>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

    </body>
</html>
