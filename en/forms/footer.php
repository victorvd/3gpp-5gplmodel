
<div class="container" id="call_result" style="display: none">
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

        <caption>Table: Path loss as a function of f<sub>c</sub> or d<sub>3D</sub></caption>
        <thead>
            <tr>
                <th rowspan="3">Value</th>
                <th id="fr_ds" rowspan="3">Frequency [MHz]</th>
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
<div class="container">
    <h3><a id="hdr_3GPP"></a>3GPP TR <a href="http://www.3gpp.org/DynaReport/38901.htm">38.901</a> (14.3.0 version Jan. 2018)</h3>

    <p>The path loss models are summarized in Table 7.4.1-1 and the distance definitions are indicated in Figure 7.4.1-1 and Figure 7.4.1-2. The shadow fading has a log-normal distribution, and the Table 7.4.1-1 provides the standard deviations for each scenario.</p>

    <div>
        <img src="../images/img_741-1.png" style="float: left; width: 35%; margin-right: 1%; margin-bottom: 0.5em;">
        <img src="../images/img_741-2.png" style="float: left; width: 35%; margin-right: 1%; margin-bottom: 0.5em;">
        <p style="clear: both;"></p>
    </div>
    <dl class="row">
        <dt class="col-sm-1">d<sub>2D</sub></dt><dd class="col-sm-11">2D distance between Tx and Rx</dd>
        <dt class="col-sm-1">d<sub>3D</sub></dt><dd class="col-sm-11">3D distance between Tx and Rx</dd>
        <dt class="col-sm-1">f<sub>c</sub></dt><dd class="col-sm-11">center frequency / carrier frequency</dd>
        <dt class="col-sm-1">h<sub>BS</sub></dt><dd class="col-sm-11">antenna height for BS</dd>
        <dt class="col-sm-1">h<sub>UT</sub></dt><dd class="col-sm-11">antenna height for UT</dd>
        <dt class="col-sm-1">h</dt><dd class="col-sm-11">average building height</dd>
        <dt class="col-sm-1">W</dt><dd class="col-sm-11">average street width</dd>
    </dl>

</div>

<footer>
    <p class="text-center">
        <a href="#" class="btn btn-info">Back to top</a>
    </p>
</footer>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script src="js/results.js"></script>