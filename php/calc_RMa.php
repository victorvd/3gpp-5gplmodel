<?php

$dBP = [];
$d3D = [];
$PLRMa = [];
$far = [];
$dar = [];
$sdSF = [];

$h = checkvar($_POST["txt_hab"], 5, 50);
$W = checkvar($_POST["txt_was"], 5, 50);
$hBS = checkvar($_POST["txt_hBS"], 10, 150);
$hUT = checkvar($_POST["txt_hUT"], 1, 10);
$fc = checkvar($_POST["txt_freq"], 0.5, 30);
$d2D = checkvar($_POST["txt_d2D"], 10, 10000);

$c = 300000000;

try {

    switch ($_POST["txt_tab"]) {            //Opciones para tabular
        case "opt_unic":                    //Opción un único valor
            $ite = 1;
            $far = [$fc];
            $dar = [$d2D];

            $d3D[0] = sqrt(pow($dar[0], 2) + pow($hBS - $hUT, 2));

            $dBP[0] = 2 * pi() * $hBS * $hUT * $far[0] * 1000000000 / $c;

            list($PLRMa[0], $sdSF[0]) = pathloss($dar[0], $dBP[0], $d3D[0], $far[0], $h, $W, $hBS, $hUT);

            break;

        case "opt_mfre":                    //Opción múltiples frecuencias

            $dar = [$d2D];

//            if ($_POST["txt_fcmx"] === "") {
//                throw new Exception('Frecuencia máxima fuera de rango.');
//            } else {
            $fcm = checkvar($_POST["txt_fcmx"], $fc, 30);
            $ite = 10;
            $far = linspace($fc, $fcm, $ite);

            $d3D[0] = sqrt(pow($dar[0], 2) + pow($hBS - $hUT, 2));

            for ($i = 0; $i < $ite; $i++) {

                $dBP[$i] = 2 * pi() * $hBS * $hUT * $far[$i] * 1000000000 / $c;

                list($PLRMa[$i], $sdSF[$i]) = pathloss($dar[0], $dBP[$i], $d3D[0], $far[$i], $h, $W, $hBS, $hUT);
            }
//            }
            break;

        case "opt_mdis":                    //Opción múltiples distancias

            $far = [$fc];

//            if ($_POST["txt_d2mx"] === "") {
//                throw new Exception('Distancia máxima fuera de rango.');
//            } else {
            $d2m = checkvar($_POST["txt_d2mx"], $d2D, 10000);
            $ite = 10;
            $dar = linspace($d2D, $d2m, $ite);

            $dBP[0] = 2 * pi() * $hBS * $hUT * $far[0] * 1000000000 / $c;

            for ($i = 0; $i < $ite; $i++) {

                $d3D[$i] = sqrt(pow($dar[$i], 2) + pow($hBS - $hUT, 2));

                list($PLRMa[$i], $sdSF[$i]) = pathloss($dar[$i], $dBP[0], $d3D[$i], $far[0], $h, $W, $hBS, $hUT);
            }
//            }
            $far = $d3D;
            break;
    }

    $table = unArreglo($far, $PLRMa, $sdSF);
    echo json_encode($table);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

function pathloss($dar, $dBP, $d3D, $far, $h, $W, $hBS, $hUT) {
    if ($dar <= $dBP && $dar >= 10) {
        $PLRMa = plLOS($d3D, $far, $h);
        $sdSF = normalDistribution(0, 4);
    } else if ($dar <= 10000 && $dar >= $dBP) {
        $PLRMa = plLOS($dBP, $far, $h) + 40 * log10($d3D / $dBP);
        $sdSF = normalDistribution(0, 6);
    } else {
        throw new Exception('Distancia 2D fuera de rango.');
    }

    if ($_POST["txt_los"] === "opt_nlos") {

        if ($dar <= 5000 && $dar >= 10) {
            $PLRMa_p = plNLOS($W, $h, $hBS, $d3D, $far, $hUT);
            $PLRMa = max($PLRMa, $PLRMa_p);
            $sdSF = normalDistribution(0, 8);
        } else {
            throw new Exception('Distancia 2D fuera de rango para NLOS.');
        }
    }

    return [$PLRMa, $sdSF];
}

function plLOS($d3D, $far, $h) {

    $PL = 20 * log10(40 * pi() * $d3D * $far / 3) + min(0.03 * pow($h, 1.72), 10) * log10($d3D) - min(0.044 * pow($h, 1.72), 14.77) + 0.002 * log10($h) * $d3D;
    return $PL;
}

function plNLOS($W, $h, $hBS, $d3D, $far, $hUT) {

    $PL = 161.04 - 7.1 * log10($W) + 7.5 * log10($h) - (24.37 - 3.7 * pow($h / $hBS, 2)) * log10($hBS) + (43.42 - 3.1 * log10($hBS)) * (log10($d3D) - 3) + 20 * log10($far) - (3.2 * pow(log10(11.75 * $hUT), 2) - 4.97);
    return $PL;
}

//La función checkvar verifica que las variables de entrada estén dentro de rango
function checkvar($nom, $min, $max) {

    if ($nom <= $max && $nom >= $min) {
        return $nom;
    } else {
    throw new Exception('Valor de variable fuera de rango ['.$nom.'].');
    }
}

//La función normalDistribution genera un número aleatorio con una distribución normal con mu y sigma
function normalDistribution($mu, $sigma) {

    $u1 = 0;
    $u2 = 0;

    while ($u1 === 0) {   //Convertir [0,1) a (0,1)
        $u1 = randomFloat();  //Generar un aleatorio float entre 0 y 1
    }
    while ($u2 === 0) {
        $u2 = randomFloat();
    }
    $z0 = sqrt(-2.0 * log($u1)) * cos(pi() * 2 * $u2);
    $z1 = sqrt(-2.0 * log($u1)) * sin(pi() * 2 * $u2);

    return $z0 * $sigma + $mu;
}

function randomFloat($min = 0, $max = 1) {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
}

//Función para crear un array de números espaciados equidistantes
function linspace($a, $b, $n) {

    if (!isset($n)) {
        $n = max(round($b - $a) + 1, 1);
    }
    if ($n < 2) {
        return $n === 1 ? [$a] : [];
    }
    $ret = Array();
    $n--;
    for ($i = 0; $i <= $n; $i++) {
        $ret[$i] = ($i * $b + ($n - $i) * $a) / $n;
    }
    return $ret;
}

//Función para unir 03 arrays en un solo array
function unArreglo($frec, $pathloss, $shadow) {

    if (count($frec) == count($pathloss) && count($pathloss) == count($shadow)) {
        foreach ($frec as $idx => $frec) {
            $result[] = [$frec, $pathloss[$idx], $shadow[$idx]];
        }

        return $result;
    } else {
        throw new Exception('Matrices no coinciden.');
    }
}

?>