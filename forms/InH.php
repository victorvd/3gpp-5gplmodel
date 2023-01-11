<form class="container" id="frm_parm"  name="frm_parm"  method="POST" action="">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Tabulación</label>
        <select class="form-control col-sm-2" name="txt_tab" id="txt_tab">
            <option value="opt_unic">Un solo valor</option>
            <option value="opt_mfre">Múltiples frec.</option>
            <option value="opt_mdis">Múltiples dist.</option>
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Frecuencia [0.5 ≤ f<sub>c</sub> ≤ 100]</label><!--Frecuencia de portadora-->
        <input 
            type="number"
            name="txt_freq" 
            id="txt_freq"
            min="0.5" max="100" step="0.000001"
            class="col-sm-2 form-control"
            title="La frecuencia debe estar entre 0.5 GHz y 100 GHz"
            required/>
        <div class="input-group-addon">GHz</div>
    </div>
    <div id="div_fcmx" class="form-group row" style="display: none">
        <label class="col-sm-3 form-check-label"><font color="blue">Frecuencia máxima (f<sub>c máx.</sub>)</font></label>
        <input
            type="number"
            name="txt_fcmx"
            id="txt_fcmx"        
            min="0.5" max="100" step="0.000001"
            class="col-sm-2 form-control"
            title="La frecuencia máxima debe estar entre 0.5 y 100 GHz"/>
        <div class="input-group-addon">GHz</div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Distancia 2D [1 ≤ d<sub>2D</sub> ≤ 149.986]</label><!--Distancia 2D entre Tx y Rx-->
        <!--149.986=raiz(150²-2²)-->
        <input
            type="number"
            name="txt_d2D"
            id="txt_d2D"
            min="1" max="149.986" step="0.001"
            class="col-sm-2 form-control"
            title="La distancia debe estar entre 10 m y 149.986 m"
            required/>
        <div class="input-group-addon">m</div>
    </div>
    <div id="div_d2mx" class="form-group row" style="display: none">
        <label class="col-sm-3 form-check-label"><font color="blue">Distancia máxima (d<sub>2D máx.</sub>)</font></label>
        <input
            type="number"
            name="txt_d2mx"
            id="txt_d2mx"
            min="1" max="149.986" step="0.001"
            class="col-sm-2 form-control"
            title="La distancia debe estar entre 10 m y 149.986 m"/>
        <div class="input-group-addon">m</div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Altura BS [h<sub>BS</sub> = 3]</label><!--Altura de la antena para la BS-->
        <input 
            type="text"
            value="3"
            name="txt_hBS"
            id="txt_hBS"
            class="col-sm-2 form-control"
            title="La altura se establece fija a 3 m"
            readonly/>
        <div class="input-group-addon">m</div>  
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Altura UT [h<sub>UT</sub> = 1]</label><!--Altura de la antena para el UT-->
        <input 
            type="text"
            value="1"
            name="txt_hUT"
            id="txt_hUT"
            class="col-sm-2 form-control"
            title="La altura del terminal se establece fija a 1 m"
            readonly/>
        <div class="input-group-addon">m</div>  
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Line of sight</label>
        <select class="form-control col-sm-2" name="txt_los" id="txt_los">
            <option value="opt_los">LoS</option>
            <option value="opt_nlos">NLoS</option>
        </select>
        <input type="submit" id="btn_calc" value="››&nbsp;Pérdidas de trayecto" class="offset-sm-1 btn btn-success" />
    </div>

    <div id="div_err" class="form-group row" style="display: none">
        <label id="lb_err" class="col-sm-3 form-check-label"></label>
    </div>

</form>