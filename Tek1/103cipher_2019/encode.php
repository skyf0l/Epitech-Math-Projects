<?php

function encode($msg, $key) {
    $key_matrix = get_key_matrix($key);
    print_key_matrix($key_matrix, 0);

    $key_matrix_size = ceil(sqrt(sizeof($key_matrix)));

    $msg_matrix = array();

    for ($k = 0; $k < ceil(strlen($msg) / $key_matrix_size) * $key_matrix_size; $k++) {
        if ($k < strlen($msg))
            $msg_matrix[$k] = ord($msg[$k]);
        else
            $msg_matrix[$k] = 0;
    }

    $msg_matrix = mult_matrix($msg_matrix, $key_matrix);

    echo "Encrypted message:\n";
    for ($row = 0; $row < sizeof($msg_matrix); $row++) {
        echo $msg_matrix[$row];
        if ($row != sizeof($msg_matrix) - 1)
            echo ' ';
    }
}

?>