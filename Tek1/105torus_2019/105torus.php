<?php

ini_set("precision", "100");

function print_help() {
    echo "USAGE\n";
    echo "\t./105torus opt a0 a1 a2 a3 a4 n\n\n";
    echo "DESCRIPTION\n";
    echo "\topt\tmethod option:\n";
    echo "\t\t\t1 for the bisection method\n";
    echo "\t\t\t2 for Newton’s method\n";
    echo "\t\t\t3 for the secant method\n";
    echo "\ta[0-4]\tcoefficients of the equation\n";
    echo "\tn\tprecision (the application of the polynomial to the solution should\n";
    echo "\t\t\tbe smaller than 10ˆ-n)\n";
    exit (0);
}

function print_try_help($msg) {
    echo "105torus: $msg\n";
    echo "Try './105torus -h' for more information.\n";
    exit (84);
}

function check_args($argv) {
    if (sizeof($argv) >= 2 && strcmp($argv[1], '-h') == 0)
        print_help();
    if (sizeof($argv) != 8)
        print_try_help("invalid argument : 7 require, ".(sizeof($argv) - 1)." given");
    for ($k = 1; $k < 8; $k++)
        if (!is_numeric($argv[$k]))
            print_try_help("invalid argument : argmument $k isn't a numeric argument");
    if (strcmp($argv[1], '1') != 0 && strcmp($argv[1], '2') != 0 && strcmp($argv[1], '3') != 0)
        print_try_help("invalid argument : argmument 'opt' isn't 1, 2 or 3");
    if ($argv[7] < 0)
        print_try_help("invalid argument : precision must be a positive int");
    if ($argv[7] > 100)
        print_try_help("invalid argument : precision can't is greater than 100");
}

function f($x, $function) {
    $y = pow($x, 4) * $function[4];
    $y += pow($x, 3) * $function[3];
    $y += pow($x, 2) * $function[2];
    $y += $x * $function[1];
    $y += $function[0];
    return ($y);
}

function print_x($x, $precision) {
    if (strlen($x) - 1 > $precision)
        echo "x = ".number_format($x, $precision, '.', '')."\n";
    else
        echo "x = ".$x."\n";
}

function bisection_method($function, $precision)
{
    $max_itteration = 500;
    $a = 0;
    $b = 1;

    while (abs($a - $b) > 1 / pow(10, $precision) && $max_itteration) {
        $c = ($a + $b) / 2;
        if (f($c, $function) > 0)
            $b = $c;
        else
            $a = $c;
        print_x($c, $precision);
        $max_itteration--;
    }
}

function derive($function) {
    $derive = array();
    $derive[0] = $function[1] * 1;
    $derive[1] = $function[2] * 2;
    $derive[2] = $function[3] * 3;
    $derive[3] = $function[4] * 4;
    $derive[4] = 0;
    return $derive;
}

function newtons_method($function, $precision)
{
    $max_itteration = 500;
    $derive = derive($function);
    $x_last = 0;
    $x = 0.5;
    if ($derive[0] == 0 && $derive[1] == 0 && $derive[2] == 0 && $derive[3] == 0)
        print_try_help("invalid argument : Can't be devide by 0");

    while (abs($x - $x_last) >= 1 / pow(10, $precision) && $max_itteration) {
        $x_last = $x;
        if (f($x_last, $derive) == 0)
            print_try_help("invalid argument : Can't be devide by 0");
        $x = $x_last - f($x_last, $function) / f($x_last, $derive);
        print_x($x_last, $precision);
        $max_itteration--;
    }
}

function secant_method($function, $precision)
{
    $max_itteration = 500;
    $a = 0;
    $b = 1;

    do {
        if (f($b, $function) - f($a, $function) == 0)
            print_try_help("invalid argument : Can't be devide by 0");
        $c = ($a * f($b, $function) - $b * f($a, $function)) / (f($b, $function) - f($a, $function));
        $a = $b;
        $b = $c;
        print_x($c, $precision);
        $max_itteration--;
    }
    while (abs(f($c, $function)) >= 1 / pow(10, $precision) && $max_itteration);

}

function main($argv) {
    check_args($argv);

    $function = array($argv[2], $argv[3], $argv[4], $argv[5], $argv[6]);
    if (strcmp($argv[1], '1') == 0)
        bisection_method($function, (int)$argv[7]);
    if (strcmp($argv[1], '2') == 0)
        newtons_method($function, (int)$argv[7]);
    if (strcmp($argv[1], '3') == 0)
        secant_method($function, (int)$argv[7]);
    exit (0);
}

try {
    main($argv);
}
catch (Exception $e) {
    exit (84);
}

?>