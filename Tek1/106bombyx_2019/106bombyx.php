<?php

if (sizeof($argv) > 1 && strcmp($argv[1], '-h') == 0) {
    echo "./106bombyx -h\n";
    echo "USAGE\n";
    echo "\t./106bombyx n [k | i0 i1]\n";
    echo "DESCRIPTION\n";
    echo "\tn\tnumber of first generation individuals\n";
    echo "\tk\tgrowth rate from 1 to 4\n";
    echo "\ti0\tinitial generation (included)\n";
    echo "\ti1\tfinal generation (included)\n";
    goto exitSuccess;
}

if (sizeof($argv) != 3 && sizeof($argv) != 4) {
    echo "./106bombyx : invalid argument size, ".sizeof($argv)." given but 2 or 3 requiered\n";
    goto tryHelp;
}

if (!is_numeric($argv[1]) || $argv[1] < 0) {
    echo "./106bombyx : invalid argument value, n must be a positive number\n";
    goto tryHelp;
}

$x1 = $argv[1];

if (sizeof($argv) == 3) {
    if (!is_numeric($argv[2]) || $argv[2] < 1 || $argv[2] > 4 || strlen(substr($argv[2], strpos($argv[2], '.') + 1)) > 2) {
        echo "./106bombyx : invalid argument value, k must be varying from 1 to 4 by 0.01 steps\n";
        goto tryHelp;
    }
    $k = $argv[2];
    $iMin = 1;
    $iMax = 100;

    $xi = $x1;
    $i = 1;
    basicEvolution : {
        echo $i." ".number_format($xi, 2, '.', '')."\n";
        $xi = $k * $xi * (1000 - $xi) / 1000;
        $i++;
        if ($i <= $iMax)
            goto basicEvolution;
    }
}
else {
    if (!is_numeric($argv[2]) || strpos($argv[2], '.') !== false || !is_numeric($argv[3]) || strpos($argv[3], '.') !== false || $argv[2] > $argv[3] || $argv[2] < 0 || $argv[3] < 0) {
        echo "./106bombyx : invalid argument value, i0 and i1 must be an integer\n";
        goto tryHelp;
    }
    $iMin = (int)$argv[2];
    $iMax = (int)$argv[3];

    $xi = $x1;
    $k = 1;
    varyingK : {
        $i = 1;
        varyingI : {
            if ($i <= $iMin) {
                initI : {
                    $xi = $k * $xi * ((1000 - $xi) / (float)1000);
                    $i++;
                    if ($i < $iMin)
                        goto initI;
                }
            }
            $xi = $k * $xi * ((1000 - $xi) / (float)1000);
            echo number_format($k, 2, '.', '')." ".number_format($xi, 2, '.', '')."\n";
            $i++;
            if ($i <= $iMax)
                goto varyingI;
        }
        $k += 0.01;
        if ($k <= 4)
            goto varyingK;
    }
}

exitSuccess: exit (0);

tryHelp : echo "retry with ./106bombyx -h\n";
exitError: exit (84);

?>