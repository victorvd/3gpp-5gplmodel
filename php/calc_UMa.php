<?php

$dBP = [];
$d3D = [];
$PLUMa = [];
$far = [];
$dar = [];
$sdSF = [];

$hBS = checkvar($_POST["txt_hBS"], 1, 50);
$hUT = checkvar($_POST["txt_hUT"], 1.5, 22.5);
$fc = checkvar($_POST["txt_freq"], 0.5, 100);
$d2D = checkvar($_POST["txt_d2D"], 10, 5000);

$c = 300000000;

$hE = 1;
$h_BS = $hBS - $hE;
$h_UT = $hUT - $hE;

try {

    switch ($_POST["txt_tab"]) {            //Opciones para tabular
        case "opt_unic":                    //Opción un único valor
            $ite = 1;
            $far = [$fc];
            $dar = [$d2D];

            $d3D[0] = sqrt(pow($dar[0], 2) + pow($hBS - $hUT, 2));

            $dBP[0] = 4 * $h_BS * $h_UT * $far[0] * 1000000000 / $c;

            list($PLUMa[0], $sdSF[0]) = pathloss($dar[0], $dBP[0], $d3D[0], $far[0], $hBS, $hUT);

            break;

        case "opt_mfre":                    //Opción múltiples frecuencias

            $dar = [$d2D];

//            if ($_POST["txt_fcmx"] === "") {
//                throw new Exception('Frecuencia máxima fuera de rango.');
//            } else {
            $fcm = checkvar($_POST["txt_fcmx"], $fc, 100);
            $ite = 10;
            $far = linspace($fc, $fcm, $ite);

            $d3D[0] = sqrt(pow($dar[0], 2) + pow($hBS - $hUT, 2));

            for ($i = 0; $i < $ite; $i++) {

                $dBP[$i] = 4 * $h_BS * $h_UT * $far[$i] * 1000000000 / $c;

                list($PLUMa[$i], $sdSF[$i]) = pathloss($dar[0], $dBP[$i], $d3D[0], $far[$i],$hBS, $hUT);
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

            $dBP[0] = 4 * $h_BS * $h_UT * $far[0] * 1000000000 / $c;

            for ($i = 0; $i < $ite; $i++) {

                $d3D[$i] = sqrt(pow($dar[$i], 2) + pow($hBS - $hUT, 2));

                list($PLUMa[$i], $sdSF[$i]) = pathloss($dar[$i], $dBP[0], $d3D[$i], $far[0], $hBS, $hUT);
            }
//            }
            $far = $d3D;
            break;
    }

    $table = unArreglo($far, $PLUMa, $sdSF);
    echo json_encode($table);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

function pathloss($dar, $dBP, $d3D, $far, $hBS, $hUT) {
    if ($dar <= $dBP && $dar >= 10) {
        $PLUMa = 28 + 22 * log10($d3D) + 20 * log10($far);
        $sdSF = normalDistribution(0, 4);
    } else if ($dar <= 5000 && $dar >= $dBP) {
        $PLUMa = 28 + 40 * log10($d3D) + 20 * log10($far) - 9 * log10(pow($dBP, 2) + pow($hBS - $hUT,2));
        $sdSF = normalDistribution(0, 4);
    } else {
        throw new Exception('Distancia 2D fuera de rango.');
    }

    if ($_POST["txt_los"] === "opt_nlos") {

        if ($dar <= 5000 && $dar >= 10) {
            $PLUMa_p = 13.54 + 39.08 * log10 ($d3D) + 20 * log10($far) - 0.6 * ($hUT - 1.5);
            $PLUMa = max($PLUMa, $PLUMa_p);
            $sdSF = normalDistribution(0, 6);
        } else {
            throw new Exception('Distancia 2D fuera de rango para NLOS.');
        }
    }

    return [$PLUMa, $sdSF];
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

//Función para crear un array de números espaciadosequidistantes
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