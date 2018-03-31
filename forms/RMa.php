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
        <label class="col-sm-3 col-form-label">Frecuencia [0.5 ≤ f<sub>c</sub> ≤ 30]</label><!--Frecuencia de portadora-->
        <input 
            type="number"
            name="txt_freq" 
            id="txt_freq"
            min="0.5" max="30" step="0.001"
            class="col-sm-2 form-control"
            title="La frecuencia debe estar entre 0.5 GHz y 30 GHz"
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
            title="La distancia debe estar entre 10 m y 10 000 m (5 000 m para NLoS)"
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
            title="La distancia debe estar entre 10 m y 10 000 m (5 000 m para NLoS)"/>
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
            <option value="opt_los">LoS</option>
            <option value="opt_nlos">NLoS</option>
        </select>
        <input type="submit" id="btn_calc" value="››&nbsp;Pérdidas de trayecto" class="offset-sm-1 btn btn-success" />
    </div>

    <div id="div_err" class="form-group row" style="display: none">
        <label id="lb_err" class="col-sm-3 form-check-label"></label>
    </div>

</form>