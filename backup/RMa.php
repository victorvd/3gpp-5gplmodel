<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/formas.css" rel="stylesheet" type="text/css">
        <title>Pérdidas RMa</title>
        <meta name="keywords" content="5G,frequency,band,spectrum">
        <meta name="description" content="5G frequency band pathloss calculator">

    </head>

    <body>

        <div class="container">
            <header>
                <div id="logotipo"><img src="images/logo.png"/></div>  
                <div id="banner">Maestría Ing. Telecomunicaciones</div>
            </header>

            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="N/A.php">N/A</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="N/A.php">N/A</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="N/A.php">N/A</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <section>
                <h1>Pérdidas en el trayecto de propagación</h1>

                <nav class="nav nav-pills flex-column flex-sm-row">
                    <a class="flex-sm-fill text-sm-center nav-link active" href="RMa.php">Macrocelda rural</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="UMa.php">Macrocelda urbana</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="UMi.php">Microcelda urbana</a>
                    <a class="flex-sm-fill text-sm-center nav-link" href="InH.php">InH/Oficina</a>
                </nav>

                <br>

                <h2><a id="hdr_calc"></a>Calculador de Atenuación</h2>

                <form id="frm_parm"  name="frm_parm"  method="POST" action="">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tabulación</label>
                        <select class="form-control col-sm-2" name="txt_tab" id="txt_tab">
                            <option value="opt_unic">Un sólo valor</option>
                            <option value="opt_mfre">Múltiples frec.</option>
                            <option value="opt_mdis">Múltiples dist.</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Frecuencia [0.5 ≤ f<sub>c</sub> ≤ 30]</label><!--Frecuencia de portadora-->
                        <input 
                            type="number"
                            name="txt_freq" 
                            id="txt_freq"
                            min="0.5" max="30" step="0.001"
                            class="col-sm-2 form-control"
                            title="La frecuencia debe estar entre 0.5 y 30 GHz"
                            required/>
                        <div class="input-group-addon">GHz</div>
                    </div>
                    <div id="div_fcmx" class="form-group row" style="display: none">
                        <label class="col-sm-3 form-check-label"><font color="blue">Frecuencia máxima (f<sub>c máx.</sub>)</font></label>
                        <input
                            type="number"
                            name="txt_fcmx"
                            id="txt_fcmx"        
                            min="0.5" max="30" step="0.001"
                            class="col-sm-2 form-control"
                            title="La frecuencia máxima debe estar entre 0.5 GHz y 30 GHz"/>
                        <div class="input-group-addon">GHz</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Distancia 2D [10 ≤ d<sub>2D</sub> ≤ 10000]</label><!--Distancia 2D entre Tx y Rx-->
                        <input
                            type="number"
                            name="txt_d2D"
                            id="txt_d2D"
                            min="10" max="10000" step="0.001"
                            class="col-sm-2 form-control"
                            title="La distancia debe estar entre 10 m y 10 000 m (5 000 m para NLOS)"
                            required/>
                        <div class="input-group-addon">m</div>
                    </div>
                    <div id="div_d2mx" class="form-group row" style="display: none">
                        <label class="col-sm-3 form-check-label"><font color="blue">Distancia máxima (d<sub>2D máx.</sub>)</font></label>
                        <input
                            type="number"
                            name="txt_d2mx"
                            id="txt_d2mx"
                            min="10" max="10000" step="0.001"
                            class="col-sm-2 form-control"
                            title="La distancia debe estar entre 10 m y 10 000 m (5 000 m para NLOS)"/>
                        <div class="input-group-addon">m</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Altura BS [10 ≤ h<sub>BS</sub> ≤ 150]</label><!--Altura de la antena para la BS-->
                        <input 
                            type="number"
                            name="txt_hBS"
                            id="txt_hBS"
                            min="10" max="150" step="0.001"
                            class="col-sm-2 form-control"
                            title="La altura de la estación debe estar entre 10 m y 150 m"
                            required/>
                        <div class="input-group-addon">m</div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Altura UT [1 ≤ h<sub>UT</sub> ≤ 10]</label><!--Altura de la antena para el UT-->
                        <input 
                            type="number"
                            name="txt_hUT"
                            id="txt_hUT"
                            min="1" max="10" step="0.001"
                            class="col-sm-2 form-control"
                            title="La altura del terminal debe estar entre 1 m y 10 m"
                            required/>
                        <div class="input-group-addon">m</div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Altura de edificios [5 ≤ h ≤ 50]</label><!--Altura promedio de los edificios-->
                        <input 
                            type="number"
                            name="txt_hab"
                            id="txt_hab"
                            min="5" max="50" step="0.001"
                            class="col-sm-2 form-control"
                            title="La altura de los edificios debe estar entre 5 m y 50 m"
                            required/>
                        <div class="input-group-addon">m</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Ancho de calles [5 ≤ W ≤ 50]</label><!--Ancho promedio de las calles-->
                        <input 
                            type="number"
                            name="txt_was"
                            id="txt_was"
                            min="5" max="50" step="0.001"
                            class="col-sm-2 form-control"
                            title="El ancho de las calles debe estar entre 5 m y 50 m"
                            required/>
                        <div class="input-group-addon">m</div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Line of sight</label>
                        <select class="form-control col-sm-2" name="txt_los" id="txt_los">
                            <option value="opt_los">LOS</option>
                            <option value="opt_nlos">NLOS</option>
                        </select>
                        <input type="submit" id="btn_calc" value="››&nbsp;Pérdidas de trayecto" class="offset-sm-1 btn btn-success" />
                    </div>

                    <div id="div_err" class="form-group row" style="display: none">
                        <label id="lb_err" class="col-sm-3 form-check-label"></label>
                    </div>

                </form>
                <div id="call_result" style="display: none">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pathloss (dB)</label>
                        <input name="txt_plos" id="txt_plos" maxlength="7" value="" class="col-sm-2 form-control" type="text" readonly>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Shadow fading (dB)</label>
                        <input name="txt_shwf" id="txt_shwf" maxlength="7" value="" class="col-sm-2 form-control" type="text" readonly>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Pathloss total (dB)</label>
                        <input name="txt_plsf" id="txt_plsf" maxlength="7" value="" class="col-sm-2 form-control" type="text" readonly>
                    </div>

                    <br>

                    <table id="table_freq" class="table_freq">

                        <caption>Tabla de pérdidas en función de las frecuencias</caption>
                        <thead>
                            <tr>
                                <th rowspan="3">Valor</th>
                                <th id="fr_ds" rowspan="3">Frecuencia [MHz]</th>
                                <th rowspan="3">Pathloss [dB]</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr_blanc">
                            </tr>
                        </tbody>
                    </table>

                    <div id="grafic" style="width:auto;height:400px;"></div>

                </div>

                <br>
                <br>
                <h2><a id="hdr_3GPP"></a>3GPP TR <a href="http://www.3gpp.org/DynaReport/38901.htm">38.901</a> (Version 14.2.0 Sept 2017)</h2>

                <p>Los modelos de pérdidas en el trayecto se resumen en la Tabla 7.4.1-1 y las definiciones de distancia se indican en la Figura 7.4.1-1 y la Figura 7.4.1-2. La distribución del shadow fading es log-normal, y su desviación estándar para cada escenario se proporciona en la Tabla 7.4.1-1.</p>

                <div id="img_7411"><img src="images/img_741-1.png" width="auto" height="350"/></div>
                <dl class="row">
                    <dt class="col-sm-1">d<sub>2D</sub></dt><dd class="col-sm-11">2D distance between Tx and Rx</dd>
                    <dt class="col-sm-1">d<sub>3D</sub></dt><dd class="col-sm-11">3D distance between Tx and Rx</dd>
                    <dt class="col-sm-1">f<sub>c</sub></dt><dd class="col-sm-11">center frequency / carrier frequency</dd>
                    <dt class="col-sm-1">h<sub>BS</sub></dt><dd class="col-sm-11">antenna height for BS</dd>
                    <dt class="col-sm-1">h<sub>UT</sub></dt><dd class="col-sm-11">antenna height for UT</dd>
                    <dt class="col-sm-1">h</dt><dd class="col-sm-11">average building height</dd>
                    <dt class="col-sm-1">W</dt><dd class="col-sm-11">average street width</dd>
                </dl>

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
        <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
        <script src="js/results.js"></script>

    </body>
</html>