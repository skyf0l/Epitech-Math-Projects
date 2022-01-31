<?php

function reverse_matrix($matrix) {
    $key_matrix_size = ceil(sqrt(sizeof($matrix)));
    $reverted_matrix;

    if ($key_matrix_size == 1) {
        $reverted_matrix = array(1/$matrix[0]);
    }
    else if ($key_matrix_size == 2) {
        $reverted_matrix = array(0, 0, 0, 0);

        $det = $matrix[0] * $matrix[3] - $matrix[1] * $matrix[2];
        $reverted_matrix[0] = 1/$det * $matrix[3];
        $reverted_matrix[1] = -1/$det * $matrix[1];
        $reverted_matrix[2] = -1/$det * $matrix[2];
        $reverted_matrix[3] = 1/$det * $matrix[0];
    }
    else if ($key_matrix_size == 3) {
        $reverted_matrix = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        $det = 0;

        for( $k = 0; $k < 3; $k++)
          $det += ($matrix[$k] * ($matrix[3 + ($k+1) % 3] * $matrix[6 + ($k+2) % 3] - $matrix[3 + ($k+2) % 3] * $matrix[6 + ($k+1) % 3]));
     
        for($i = 0; $i < 3; $i++)
            for($j = 0; $j < 3; $j++)
                $reverted_matrix[$i + $j * 3] = (($matrix[(($i+1) % 3) * 3 + ($j+1) % 3] * $matrix[(($i+2) % 3) * 3 + ($j+2) % 3]) - ($matrix[(($i+1) % 3) * 3 + ($j+2) % 3]*$matrix[(($i+2) % 3) * 3 + ($j+1) % 3])) / $det;
    }
    else {
        die (84);
    }
    return ($reverted_matrix);
}

function decode($msg, $key) {
    $key_matrix = get_key_matrix($key);
    $key_matrix = reverse_matrix($key_matrix);
    print_key_matrix($key_matrix, 1);

    $msg_matrix = array();
    $msg_parts = explode(" ", $msg);
    for ($k = 0; $k < sizeof($msg_parts); $k++)
        $msg_matrix[$k] = (int)$msg_parts[$k];

    $msg_matrix = mult_matrix($msg_matrix, $key_matrix);

    echo "Decrypted message:\n";
    for ($k = 0; $k < sizeof($msg_matrix); $k++)
        echo chr(round($msg_matrix[$k]));
}

?>