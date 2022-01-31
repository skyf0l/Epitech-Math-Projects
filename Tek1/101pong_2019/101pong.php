<?php

require("vector.php");

function print_usage() {
    echo "USAGE\n    php 101pong.php x0 y0 z0 x1 y1 z1 n\n\n";
    echo "DESCRIPTION\n    x0  ball abscissa at time t - 1\n    y0  ball ordinate at time t - 1\n    z0  ball altitude at time t - 1\n    x1  ball abscissa at time t\n    y1  ball ordinate at time t\n    z1  ball altitude at time t\n    n   time shift (greater than or equal to zero, integer)\n";
}

function check_args($argv) {
    if (sizeof($argv) > 1) {
        if (strcmp($argv[1], '-h') == 0) {
            print_usage();
            die (0);
        }
    }
    if (sizeof($argv) != 8)
        die (84);
    for ($k = 1; $k < 8; $k++)
        if (!is_numeric($argv[$k]))
            die (84);
    if ((float)$argv[7] < 0 || (float)$argv[7] != (int)$argv[7])
        die (84);
}

function main($argv) {
    check_args($argv);

    $ball_pos = new Vector($argv[4], $argv[5], $argv[6]);
    $velocity = new Vector((float)$argv[4] - (float)$argv[1], (float)$argv[5] - (float)$argv[2], (float)$argv[6] - (float)$argv[3]);

    echo "The velocity vector of the ball is:\n";
    $velocity->print();

    for ($k = 0; $k < (int)$argv[7]; $k++) {
        $ball_pos->add($velocity);
    }

    echo "At time t + $argv[7], ball coordinates will be:\n";
    $ball_pos->print();

    if ($argv[6] <= 0 && $ball_pos->z >= 0 || $argv[6] >= 0 && $ball_pos->z <= 0)
        echo "The incidence angle is:\n".number_format($velocity->getAngle(), 2, '.', '')." degrees\n";
    else
        echo "The ball won't reach the paddle.\n";
}

main($argv);

?>