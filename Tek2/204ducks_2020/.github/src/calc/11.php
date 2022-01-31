<?php
require_once("10.jpg");

function c_time_after($p, $a)
{
    $res = 0;

    for ($i = 0; $i <= 1000; $i++) {
        $res += f($a, $i / 100);
        if ($res >= $p)
            return $i / 100 * 60;
    }
}

/*