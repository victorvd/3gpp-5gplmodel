// JavaScript Document

$("#txt_tab").click(function () { //función jQuery para escuchar un evento clic
    multiples();
});

$(document).ready(function () {

    multiples();

    $("#frm_parm").submit(function () {

        var datosForm = $(this).serialize();

        $.post("calc_RMa.php", datosForm, mostrResul);

        return false;
    });
});

function mostrResul(table) {

    var callres = $('#call_result')[0];
    var errDiv = $('#div_err')[0];

    //Manejar el error
    if (table[0][0] !== "[") {
        errDiv.style.display = "";
        $("#lb_err").html("<font color=red>" + table + "</font>");

        callres.style.display = "none";
        return;
    } //Fin de manejo de error

    else {
        var tabla = $("#table_freq")[0];
        var PLRMa = jQuery.parseJSON(table);
        var ite = PLRMa.length - 1;

        errDiv.style.display = "none";

        //Mostrar división de resultados: tabla y gráfico
        callres.style.display = "";

        //Cambiar la cabecera de la tabla de resultados para frec. o dist.
        switch ($("#txt_tab")[0].selectedIndex) {
            case 0:
                $("th#fr_ds").text("Frecuencia [MHZ]");
                break;
            case 1:
                $("th#fr_ds").text("Frecuencia [MHZ]");
                break;
            case 2:
                $("th#fr_ds").text("Distancia [m]");
                break;
        }
        ;
    }
    ;

    $("#txt_plos").val(PLRMa[ite][1].toFixed(1));
    $("#txt_shwf").val(PLRMa[ite][2].toFixed(1));
    $("#txt_plsf").val((PLRMa[ite][1] + PLRMa[ite][2]).toFixed(1));

    while (tabla.rows[2]) {
        tabla.deleteRow(2);
    }

    for (var i = ite; i >= 0; i--) {
        var fila = tabla.insertRow(tabla.rows.length);
        fila.insertCell(0).innerHTML = ite - i + 1;
        fila.insertCell(1).innerHTML = (+(PLRMa[i][0])).toFixed(2);
        fila.insertCell(2).innerHTML = parseFloat(PLRMa[i][1]).toFixed(2);
    }

    tabla.style.textAlign = "center";

    var grafico = $("#grafic")[0];

    //Seleccionar columnas 1 y 2 del array PLRMa
    var col3x = PLRMa.map(function (value, index) {
        return value[0];
    });
    var col3y = PLRMa.map(function (value, index) {
        return value[1];
    });

    Plotly.purge(grafico);
    Plotly.plot(grafico, [{
            x: col3x,
            y: col3y}], {
        margin: {t: 0}});

}
;

//Función para habilitar los casilleros de frecuencia y distancia máximas
function multiples() {

    var fcDiv = $('#div_fcmx')[0]; // Usando [0] se obtiene un objeto DOM
    var d2Div = $('#div_d2mx')[0];
    var fcInp = $('#txt_fcmx');
    var d2Inp = $('#txt_d2mx');

    //$("#txt_fcmx").val(""); //$ usa funciones jQUERY para limpiar valores
    //$("#txt_d2mx").val("");

    //Mostrar los casilleros de frecuencia o distancia máximas
    switch ($("#txt_tab")[0].selectedIndex) {
        case 0:
            fcDiv.style.display = "none";
            d2Div.style.display = "none";
            fcInp.attr('required', false);
            d2Inp.attr('required', false);
            break;
        case 1:
            fcDiv.style.display = "";
            d2Div.style.display = "none";
            fcInp.attr('required', true);
            d2Inp.attr('required', false);
            break;
        case 2:
            fcDiv.style.display = "none";
            d2Div.style.display = "";
            fcInp.attr('required', false);
            d2Inp.attr('required', true);
            break;
    }
    ;
}