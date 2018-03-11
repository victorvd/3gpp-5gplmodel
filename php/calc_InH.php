<?php

$dBP = [];
$d3D = [];
$PLInH = [];
$far = [];
$dar = [];
$sdSF = [];

$hBS = checkvar($_POST["txt_hBS"], 3, 3);
$hUT = checkvar($_POST["txt_hUT"], 1, 1);
$fc = checkvar($_POST["txt_freq"], 0.5, 100);
$d2D = checkvar($_POST["txt_d2D"], 1, 149.987);

$c = 300000000;

try {

    switch ($_POST["txt_tab"]) {            //Opciones para tabular
        case "opt_unic":                    //Opción un único valor
            $ite = 1;
            $far = [$fc];
            $dar = [$d2D];

            $d3D[0] = sqrt(pow($dar[0], 2) + pow($hBS - $hUT, 2));

            list($PLInH[0], $sdSF[0]) = pathloss($dar[0], $d3D[0], $far[0], $hBS, $hUT);

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
                
                list($PLInH[$i], $sdSF[$i]) = pathloss($dar[0], $d3D[0], $far[$i],$hBS, $hUT);
            }
//            }
            break;

        case "opt_mdis":                    //Opción múltiples distancias

            $far = [$fc];

//            if ($_POST["txt_d2mx"] === "") {
//                throw new Exception('Distancia máxima fuera de rango.');
//            } else {
            $d2m = checkvar($_POST["txt_d2mx"], $d2D, 149.987);
            $ite = 10;
            $dar = linspace($d2D, $d2m, $ite);
            
            for ($i = 0; $i < $ite; $i++) {

                $d3D[$i] = sqrt(pow($dar[$i], 2) + pow($hBS - $hUT, 2));

                list($PLInH[$i], $sdSF[$i]) = pathloss($dar[$i], $d3D[$i], $far[0], $hBS, $hUT);
            }
//            }
            $far = $d3D;
            break;
    }

    $table = unArreglo($far, $PLInH, $sdSF);
    echo json_encode($table);
} catch (Exception $ex) {
    echo $ex->getMessage();
}

function pathloss($dar, $d3D, $far, $hBS, $hUT) {
    if ($d3D <= 150 && $d3D >= 1) {
        $PLInH = 32.4 + 17.3 * log10($d3D) + 20 * log10($far);
        $sdSF = normalDistribution(0, 3);
    } else {
        throw new Exception('Distancia 2D fuera de rango.');
    }

    if ($_POST["txt_los"] === "opt_nlos") {

        if ($d3D <= 150 && $d3D >= 1) {
            $PLInH_p = 17.3 + 38.3 * log10 ($d3D) + 24.9 * log10($far);
            $PLInH = max($PLInH, $PLInH_p);
            $sdSF = normalDistribution(0, 8.03);
        } else {
            throw new Exception('Distancia 2D fuera de rango para NLOS.');
        }
    }

    return [$PLInH, $sdSF];
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