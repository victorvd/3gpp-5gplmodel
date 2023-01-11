// JavaScript Document

$("#txt_tab").change(function () { //función jQuery para escuchar un evento clic
    multiples();
});
$(document).ready(function () {

    //If the #txt_sce was set then apply multiples() function.
    if ($("#txt_sce").find('option:selected').val() != ""){
        multiples();
    };
    $("#frm_parm").submit(function () {
        var scenario = escenario();
        var pos_nam = "../php/calc_" + scenario + ".php";        

        var datosForm = $(this).serialize();
        $.post(pos_nam, datosForm, mostrResul);
        return false;
    });
});

function mostrResul(table) {

    var callres = $('#call_result')[0]; // Usando [0] se obtiene un objeto DOM
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
        var PLoss = jQuery.parseJSON(table);
        var ite = PLoss.length - 1;
        errDiv.style.display = "none";
        //Mostrar división de resultados: tabla y gráfico
        callres.style.display = "";

        //Cambiar la cabecera de la tabla de resultados para frec. o dist.        
        switch ($("#txt_tab")[0].selectedIndex) {
            case 0:
                $("th#fr_ds").text("Frequency fc [GHz]");
                //Cambiar título de eje X para la gráfica
                var xaxe = 'Carrier frequency [GHz]';
                break;
            case 1:
                $("th#fr_ds").text("Frequency fc [GHz]");
                var xaxe = 'Carrier frequency [GHz]';
                break;
            case 2:
                $("th#fr_ds").text("3D distance [m]");
                var xaxe = '3D distance [m]';
                break;
        }
        ;
    }
    ;
    $("#txt_plos").val(PLoss[0][1].toFixed(6));
    $("#txt_shwf").val(PLoss[0][2].toFixed(6));
    $("#txt_plsf").val((PLoss[0][1] + PLoss[0][2]).toFixed(6));  //Mostrar resultados con 6 decimales

    //Tabular
    while (tabla.rows[2]) {
        tabla.deleteRow(2);
    }

    for (var i = 0; i <= ite; i++) {
        var fila = tabla.insertRow(tabla.rows.length);
        fila.insertCell(0).innerHTML = i + 1;
        fila.insertCell(1).innerHTML = (+(PLoss[i][0])).toFixed(6);
        fila.insertCell(2).innerHTML = parseFloat(PLoss[i][1]).toFixed(6);
    }

    tabla.style.textAlign = "center";

    //Graficar
    var grafico = $("#grafic")[0];
    //Seleccionar columnas 1 y 2 del array PLoss
    var col3x = PLoss.map(function (value, index) {
        return value[0];
    });
    var col3y = PLoss.map(function (value, index) {
        return value[1];
    });

    var trace = {
        x: col3x,
        y: col3y,
        name: ' pathloss' + escenario(),
        line: {
            color: '#1b7e4c',
            width: 1}
    };

    var layout = {
        title: escenario() + ' '
            + $("#txt_los option:selected").text() + ' Path loss ',
        titlefont: {
            size: 24,
            color: '#b8092a'
        },
        xaxis: {
            type: 'log', //Graficar en plano semilogarítmico
            title: xaxe,
            titlefont: {
                size: 18,
                color: '#7f0000'
            }
        },
        yaxis: {
            title: 'Path Loss [dB]',
            titlefont: {
                size: 18,
                color: '#7f0000'
            }
        }
        //, showlegend: true
    };

    Plotly.newPlot(grafico, [trace], layout);
}
;
function changeLanguage() {
    var url = window.location.origin + location.pathname.substring(3);
    window.location.replace(url);
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

function escenario() {

    scenario = $("#txt_sce").find('option:selected').val();
    scenario = scenario.substring(4);
    return scenario;
}