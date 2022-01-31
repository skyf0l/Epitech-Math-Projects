<?php

require("encode.php");
require("decode.php");

function check_args($argv) {
    if (sizeof($argv) != 4)
        exit (84);
    if ((int)$argv[3] != 0 && (int)$argv[3] != 1 || !is_numeric($argv[3]))
        exit (84);
    if ((int)$argv[3] == 1) {
        $msg_parts = explode(" ", $argv[1]);
        for ($k = 0; $k < sizeof($msg_parts); $k++)
            if (!is_numeric($msg_parts[$k]))
                exit (84);
        $msg_parts = explode(" ", $argv[1]);
    }
}

function get_key_matrix($key) {
    $key_matrix_size = ceil(sqrt(strlen($key)));

    $key_matrix = array();
    for ($k = 0; $k < $key_matrix_size * $key_matrix_size; $k++)
        $key_matrix[$k] = 0;
    for ($k = 0; $k < strlen($key) && $k < $key_matrix_size * $key_matrix_size; $k++)
        $key_matrix[$k] = ord($key[$k]);
    return ($key_matrix);
}

function print_key_matrix($key_matrix, $is_float) {
    $key_matrix_size = sqrt(sizeof($key_matrix));

    echo "Key matrix:\n";
    for ($row = 0; $row < $key_matrix_size; $row++) {
        for ($col = 0; $col < $key_matrix_size; $col++) {
            if ($is_float)
                printf("%.3f", $key_matrix[$row * $key_matrix_size + $col]);
            else
                printf("%d", $key_matrix[$row * $key_matrix_size + $col]);
            if ($col < $key_matrix_size - 1)
                echo "\t";
        }
        echo "\n";
    }
    echo "\n";
}

function mult_matrix($msg_matrix, $key_matrix) {
    $key_matrix_size = sqrt(sizeof($key_matrix));

    $result_matrix = array();
    for ($y = 0; $y < sizeof($msg_matrix) / $key_matrix_size; $y++) {
        for ($x = 0; $x < $key_matrix_size; $x++) {
            $result_matrix[$x + $y * $key_matrix_size] = 0;
            for ($k = 0; $k < $key_matrix_size; $k++)
                $result_matrix[$x + $y * $key_matrix_size] += $msg_matrix[$k + $y * $key_matrix_size] * $key_matrix[$x + $k * $key_matrix_size];
        }
    }
    return ($result_matrix);
}

function main($argv) {
    check_args($argv);

    if ($argv[3] == 0)
        encode($argv[1], $argv[2]);
    else
        decode($argv[1], $argv[2]);

    echo "\n";
}

main($argv);
exit (0);

// ./103cipher "26690 21552 11810 19718 16524 13668 25322 22497 14177 28422 26097 16433 12333 11874 5824 27541 23754 14452 17180 17553 7963 26387 22047 13895 18804 14859 12033 27738 23835 15331 21487 16656 13238 21696 15978 6976 20750 23307 14093 16788 11751 8981 22339 24861 15619 21295 16524 13668 26403 23610 15190 29451 25764 16106 26394 23307 14093 3312 5106 5014" "Homer S" 1
// ./103cipher "26690 21552 11810 19718 16524 13668 25322 22497 14177 28422 26097 16433 12333 11874 5824 27541 23754 14452 17180 17553 7963 26387 22047 13895 18804 14859 12033 27738 23835 15331 21487 16656 13238 21696 15978 6976 20750 23307 14093 16788 11751 8981 22339 24861 15619 21295 16524 13668 26403 23610 15190 29451 25764 16106 26394 23307 14093 3312 5106 5014" "Homer S" 1
// ./103cipher "Just because I don't care doesn't mean I don't understand." "Homer S" 0

?>