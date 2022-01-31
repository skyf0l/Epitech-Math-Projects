<?php

require("vector.php");
require("matrice.php");

function print_usage() {
    echo "USAGE\n"
        ."    ./102architect x y transfo1 arg11 [arg12] [transfo2 arg12 [arg22]] ...\n\n"
        ."DESCRIPTION\n"
        ."    x   abscisse of the original point\n"
        ."    y   ordinate of the original point\n\n"
        ."    transfo arg1 [arg2]\n"
        ."    -t i j  translation along vector (i, j)\n"
        ."    -z m n  scaling by factors m (x-axis) and n (y-axis)\n"
        ."    -r d    rotation centered in O by a d degree angle\n"
        ."    -s d    reflection over the axis passing through O with an inclination\n"
        ."            angle of d degrees\n";
}

function check_args($argv) {
    if (sizeof($argv) > 1) {
        if (strcmp($argv[1], '-h') == 0) {
            print_usage();
            die (0);
        }
    }
    if (sizeof($argv) < 4)
        die (84);
    for ($k = 1; $k < 3; $k++)
        if (!is_numeric($argv[$k]))
            die (84);
    for ($k = 3; $k < sizeof($argv); $k++) {
        if ($argv[$k] == '-t' || $argv[$k] == '-z') {
            if (sizeof($argv) - $k - 1 < 2)
                exit (84);
            if (!is_numeric($argv[$k + 1]) || !is_numeric($argv[$k + 2]))
                exit (84);
            $k += 2;
        }
        else if ($argv[$k] == '-r' || $argv[$k] == '-s') {
            if (sizeof($argv) - $k - 1 < 1)
                exit (84);
            if (!is_numeric($argv[$k + 1]))
                exit (84);
            $k += 1;
        }
        else
            exit (84);
    }
}

function main($argv) {
    check_args($argv);

    $vector = new Vector($argv[1], $argv[2]);
    $matrice = new Matrice();
    $cmd_id = 0;
    $cmd_count = 0;

    for ($k = 3; $k < sizeof($argv); $k++) {
        switch ($argv[$k]) {
        case '-t':
            $matrice->translate($argv[$k + 1], $argv[$k + 2]);
            $k += 2;
            break;
        case '-z':
            $matrice->scale($argv[$k + 1], $argv[$k + 2]);
            $k += 2;
            break;
        case '-r':
            $matrice->rotate($argv[$k + 1]);
            $k++;
            break;
        case '-s':
            $matrice->reflect($argv[$k + 1]);
            $k++;
            break;
        default:
            exit (84);
        }
    }
    $vector->apply_matrice($matrice);
    $matrice->print();
    (new Vector($argv[1], $argv[2]))->print();
    echo " => ";
    $vector->print();
    echo "\n";
}

main($argv);

?>