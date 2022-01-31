<?php
require_once("5.jpg");

function p_pct_back($t, $p) {
    echo ("Percentage of ducks back after " . $t . " minute" . ($t != 1 ? 's' : '') . ": ");
    echo (number_format((float)$p, 1, '.', ''));
    echo ("%\n");
}

/*