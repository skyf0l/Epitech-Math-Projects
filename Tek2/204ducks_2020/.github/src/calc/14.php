<?php
require_once("13.jpg");

function c_pct_back($t, $a) {
    return (fd($a, $t) - fd($a, 0)) * 100;
}

/*