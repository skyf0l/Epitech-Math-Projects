<?php

function print_help() {
    echo "USAGE\n\n";
    echo "\t./107transfer [num den]\n";
    echo "DESCRIPTION\n\n";
    echo "\tnum\tpolynomial numerator defined by its coefficients\n";
    echo "\tden\tpolynomial denominator defined by its coefficients\n";
    exit (0);
}

function try_help($msg) {
    echo "./107transfer: $msg\n";
    exit (84);
}

function check_args($argv) {
    if (sizeof($argv) >= 2 && strcmp($argv[1], '-h') == 0)
        print_help();
    if (sizeof($argv) < 3 || sizeof($argv) % 2 - 1)
        try_help("invalid argument count");
}

function parse_func($str)
{
    $func = array();
    $tokens = explode("*", $str);

    for ($k = 0; $k < sizeof($tokens); $k++) {
        if (!is_numeric($tokens[$k]))
            return (NULL);
        $func[$k] = (int)$tokens[$k];
    }
    return ($func);
}

function parse_funcs($argv)
{
    $funcs = array();
    for ($k = 0; $k < sizeof($argv) - 1; $k++) {
        $funcs[$k] = parse_func($argv[$k + 1]);
        if (!$funcs[$k])
            return (NULL);
    }
    return ($funcs);
}

function calc_func($func, $x) {
    $y = 0;

    for ($k = 0; $k < sizeof($func); $k++) {
        $y += $func[$k] * pow($x, $k);
    }
    return ($y);
}

function calc_funcs($func1, $func2, $x) {
    $y1 = calc_func($func1, $x);
    $y2 = calc_func($func2, $x);
    if ($y2 == 0)
        try_help("can't divide by 0");
    return ($y1 / $y2);
}

function main($argv) {
    check_args($argv);

    $funcs = parse_funcs($argv);
    if (!$funcs)
        try_help("invalid function");

    for ($x = 0; $x < 1.001; $x += 0.001) {
        $y = 1;
        for ($k = 0; $k < sizeof($funcs) - 1; $k += 2)
            $y *= calc_funcs($funcs[$k], $funcs[$k + 1], $x);
        echo number_format($x, 3, '.', '')." -> ".number_format($y, 5, '.', '')."\n";
    }
}

main($argv);
exit (0);

?>