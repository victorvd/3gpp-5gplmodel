<form class="container" id="frm_parm"  name="frm_parm"  method="POST" action="">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tabulation</label>
        <select class="form-control col-sm-2" name="txt_tab" id="txt_tab">
            <option value="opt_unic">Single value</option>
            <option value="opt_mfre">Multiple freq.</option>
            <option value="opt_mdis">Multiple dist.</option>
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Frequency [0.5 ≤ f<sub>c</sub> ≤ 100]</label>
        <input 
            type="number"
            name="txt_freq" 
            id="txt_freq"
            min="0.5" max="100" step="0.000001"
            class="col-sm-2 form-control"
            title="Frequency must be in the range of 0.5 - 100 GHz"
            required/>
        <div class="input-group-addon">GHz</div>
    </div>
    <div id="div_fcmx" class="form-group row" style="display: none">
        <label class="col-sm-3 form-check-label"><font color="blue">Maximum Frequency (f<sub>c máx.</sub>)</font></label>
        <input
            type="number"
            name="txt_fcmx"
            id="txt_fcmx"        
            min="0.5" max="100" step="0.000001"
            class="col-sm-2 form-control"
            title="Maximum frequency must be in the range of 0.5 - 30 GHz"/>
        <div class="input-group-addon">GHz</div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">2D distance [1 ≤ d<sub>2D</sub> ≤ 149.986]</label>
        <input
            type="number"
            name="txt_d2D"
            id="txt_d2D"
            min="1" max="149.986" step="0.001"
            class="col-sm-2 form-control"
            title="Distance must be in the range of 10 - 149.986 m"
            required/>
        <div class="input-group-addon">m</div>
    </div>
    <div id="div_d2mx" class="form-group row" style="display: none">
        <label class="col-sm-3 form-check-label"><font color="blue">Maximum distance (d<sub>2D máx.</sub>)</font></label>
        <input
            type="number"
            name="txt_d2mx"
            id="txt_d2mx"
            min="10" max="10000" step="0.001"
            class="col-sm-2 form-control"
            title="Maximum distance must be in the range of 10 - 149.986 m"/>
        <div class="input-group-addon">m</div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">BS height [h<sub>BS</sub> = 3]</label>
        <input 
            type="text"
            value="3"
            name="txt_hBS"
            id="txt_hBS"
            class="col-sm-2 form-control"
            title="Antenna height is fixed at 3 m"
            readonly/>
        <div class="input-group-addon">m</div>  
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">UT height [h<sub>UT</sub> = 1]</label>
        <input 
            type="text"
            value="1"
            name="txt_hUT"
            id="txt_hUT"
            class="col-sm-2 form-control"
            title="Terminal height is fixed at 1 m"
            readonly/>
        <div class="input-group-addon">m</div>  
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Line of sight</label>
        <select class="form-control col-sm-2" name="txt_los" id="txt_los">
            <option value="opt_los">LoS</option>
            <option value="opt_nlos">NLoS</option>
        </select>
        <input type="submit" id="btn_calc" value="››&nbsp;Path loss" class="offset-sm-1 btn btn-success" />
    </div>

    <div id="div_err" class="form-group row" style="display: none">
        <label id="lb_err" class="col-sm-3 form-check-label"></label>
    </div>

</form>