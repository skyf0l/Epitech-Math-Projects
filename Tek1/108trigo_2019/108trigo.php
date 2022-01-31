<?php

$GLOBALS['max_it'] = 100;

function print_usage() {
    echo "USAGE\n".
    "\t./108trigo fun a0 a1 a2 ...\n".
    "DESCRIPTION\n".
    "\tfun     function to be applied, among at least \"EXP\", \"COS\", \"SIN\", \"COSH\" and \"SINH\"\n".
    "\tai      coeficients of the matrix\n";
    exit (0);
}

function try_help($msg) {
    echo "./108trigo :$msg\ntry ./108trigo -h\n";
    exit (84);
}

function check_args($argv) {
    if (sizeof($argv) > 1)
        if (strcmp($argv[1], '-h') == 0)
            print_usage();
    if (sizeof($argv) < 2 || !in_array($argv[1], array("EXP", "COS", "SIN", "COSH", "SINH")))
        try_help("invalid func");
}

function factorial($x) 
{
    $result = 1;

    for ($k = 2; $k <= $x; $k++) {
        $result *= $k;
    }
    return ($result);
}

function print_matrix($matrix)
{
    $size = sqrt(sizeof($matrix));

    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            if ($x != 0)
                print("\t");
            print(number_format($matrix[$y * $size + $x], 2, '.', ''));
        }
        print("\n");
    }
}

function get_identity_matrix($size) {
    $matrix = array();

    for ($y = 0; $y < $size; $y++)
        for ($x = 0; $x < $size; $x++)
            $matrix[$y * $size + $x] = $x == $y ? 1 : 0;
    return ($matrix);
}

function get_matrix($argv) {
    $size = sqrt(sizeof($argv) - 2);
    if (floor($size) != $size)
        return (NULL);

    $matrix = array();
    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            if (!is_numeric($argv[$y * $size + $x + 2]))
                try_help("invalid value");
            $matrix[$y * $size + $x] = $argv[$y * $size + $x + 2];
        }
    }
    return ($matrix);
}

function add_matrix($m1, $m2) {
    $result = array();

    for ($k = 0; $k < sizeof($m1); $k++)
        $result[$k] = $m1[$k] + $m2[$k];
    return ($result);
}

function sub_matrix($m1, $m2) {
    $result = array();

    for ($k = 0; $k < sizeof($m1); $k++)
        $result[$k] = $m1[$k] - $m2[$k];
    return ($result);
}

function mult_matrix($m1, $m2) {
    $size = sqrt(sizeof($m1));
    $result = array();

    for ($y = 0; $y < $size; $y++) {
        for ($x = 0; $x < $size; $x++) {
            $result[$x + $y * $size] = 0;
            for ($k = 0; $k < $size; $k++)
                $result[$x + $y * $size] += $m1[$k + $y * $size] * $m2[$x + $k * $size];
        }
    }
    return ($result);
}

function mult_matrix_by_one_nb($m, $nb) {
    $result = array();

    for ($k = 0; $k < sizeof($m); $k++)
        $result[$k] = $m[$k] * $nb;
    return ($result);
}

function div_matrix_by_one_nb($m, $nb) {
    $result = array();

    for ($k = 0; $k < sizeof($m); $k++)
        $result[$k] = $m[$k] / $nb;
    return ($result);
}

function pow_matrix($m, $nb) {
    $size = sqrt(sizeof($m));
    $result = $m;

    for ($k = 0; $k < $nb - 1; $k++) {
        $result = mult_matrix($result, $m);
    }
    return ($result);
}

function exp_matrix($matrix) {
    $result = get_identity_matrix(sqrt(sizeof($matrix)));

    for ($k = 1; $k < $GLOBALS['max_it']; $k++)
        $result = add_matrix($result, div_matrix_by_one_nb(pow_matrix($matrix, $k), factorial($k)));
    return ($result);
}

function cos_matrix($matrix) {
    $result = get_identity_matrix(sqrt(sizeof($matrix)));

    for ($k = 1; $k < $GLOBALS['max_it']; $k++)
        if ($k % 2 == 0)
            $result = add_matrix($result, div_matrix_by_one_nb(pow_matrix($matrix, 2 * $k), factorial(2 * $k)));
        else
            $result = sub_matrix($result, div_matrix_by_one_nb(pow_matrix($matrix, 2 * $k), factorial(2 * $k)));
    return ($result);
}

function cosh_matrix($matrix) {
    $result = get_identity_matrix(sqrt(sizeof($matrix)));

    for ($k = 1; $k < $GLOBALS['max_it']; $k++)
        $result = add_matrix($result, div_matrix_by_one_nb(pow_matrix($matrix, 2 * $k), factorial(2 * $k)));
    return ($result);
}

function sin_matrix($matrix) {
    $result = $matrix;

    for ($k = 1; $k < $GLOBALS['max_it']; $k++)
        if ($k % 2 == 0)
            $result = add_matrix($result, div_matrix_by_one_nb(pow_matrix($matrix, 2 * $k + 1), factorial(2 * $k + 1)));
        else
            $result = sub_matrix($result, div_matrix_by_one_nb(pow_matrix($matrix, 2 * $k + 1), factorial(2 * $k + 1)));
    return ($result);
}

function sinh_matrix($matrix) {
    $result = $matrix;

    for ($k = 1; $k < $GLOBALS['max_it']; $k++)
        $result = add_matrix($result, div_matrix_by_one_nb(pow_matrix($matrix, 2 * $k + 1), factorial(2 * $k + 1)));
    return ($result);
}

function main($argv) {
    check_args($argv);

    $matrix = get_matrix($argv);

    if (!$matrix)
        try_help("invalid matrix");
    switch ($argv[1]) {
        case "EXP":
            $matrix = exp_matrix($matrix);
            break;
        case "COS":
            $matrix = cos_matrix($matrix);
            break;
        case "COSH":
            $matrix = cosh_matrix($matrix);
            break;
        case "SIN":
            $matrix = sin_matrix($matrix);
            break;
        case "SINH":
            $matrix = sinh_matrix($matrix);
            break;
    }
    print_matrix($matrix);
}

main($argv);

?>