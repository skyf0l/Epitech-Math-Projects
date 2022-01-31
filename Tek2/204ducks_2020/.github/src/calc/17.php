<?php
function c_avg_rt($a)
{
    $esp = 0;

    for ($t = 0; $t < 99.999; $t += 0.001)
        $esp += $t * (f($a, $t) / 10);
    return $esp / 99.999;
}

/*