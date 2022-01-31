<?php

$GLOBALS['end'] = 5000;
$GLOBALS['nb_intervals'] = 10000;
$GLOBALS['precision'] = 10;

function print_usage() {
    echo "USAGE\n"
        ."\t./110borwein n\n\n"
        ."DESCRIPTION\n"
        ."\tn\tconstant defining the integral to be computed\n";
    exit (0);
}

function try_help($msg) {
    echo "./110borwein : $msg\ntry ./110borwein -h\n";
    exit (84);
}

function check_args($argv) {
    if (sizeof($argv) > 1)
        if (strcmp($argv[1], '-h') == 0)
            print_usage();
    if (sizeof($argv) != 2)
        try_help("require one argument");
    if (!is_numeric($argv[1]) || strpos($argv[1], '.') !== false)
        try_help("n must be a positive int");
    if ((int)$argv[1] < 0)
        try_help("n must be a positive number");
}

function print_data($name, $n, $result)
{
    echo "$name:\n";
    echo "I$n = ".number_format($result, 10, '.', '')."\n";
    echo "diff = ".number_format(M_PI / 2 - $result, 10, '.', '')."\n";
}

function calc($start, $n)
{
    $result = 1;

    for ($k = 0; $k <= $start; $k++)
        if ($n != 0)
            $result *= (sin($n / ((2 * $k) + 1)) / ($n / ((2 * $k) + 1)));
    return ($result);
}

function Midpoint($n)
{
    $result = 0;
    $h = ($GLOBALS['end']) / $GLOBALS['nb_intervals'];

    for ($k = 0; $k < $GLOBALS['nb_intervals']; $k++)
        $result += calc($n, $k * $h);
    $result *= $h;

    print_data(__FUNCTION__, $n, $result);
}

function Trapezoidal($n)
{
    $result = 0;
    $h = ($GLOBALS['end']) / $GLOBALS['nb_intervals'];

    for ($i = 1; $i < $GLOBALS['nb_intervals']; $i++)
        $result = $result + calc($n, ($i * $h));
    $result = (($result * 2) + calc($n, 0) + calc($n, $GLOBALS['end'])) * (($GLOBALS['end']- $n) / (2 * $GLOBALS['nb_intervals']));

    print_data(__FUNCTION__, $n, $result);
}

function Simpson($n)
{
    $h = ($GLOBALS['end']) / $GLOBALS['nb_intervals'];
    $result1 = 0;
    $result2 = 0;
    $result = 0;

    for ($k = 1; $k < $GLOBALS['nb_intervals']; $k++)
        $result1 += calc($n, $k * $h);

    for ($k = 0; $k < $GLOBALS['nb_intervals']; $k++)
        $result2 += calc($n, ($k * $h) + $h / 2);

    $result = (($result1 * 2) + ($result2 * 4) + calc($n, 0) + calc($n, 5000)) * (($GLOBALS['end']) / (6 * $GLOBALS['nb_intervals']));

    print_data(__FUNCTION__, $n, $result);
}

function main($argv) {
    check_args($argv);
    Midpoint((int)$argv[1]);
    echo "\n";
    Trapezoidal((int)$argv[1]);
    echo "\n";
    Simpson((int)$argv[1]);
}

main($argv);

?>