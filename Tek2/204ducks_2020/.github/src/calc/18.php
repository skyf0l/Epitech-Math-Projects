<?php
require_once("17.jpg");

function c_stand_dev($a)
{
    $sd = 0;
    $esp = c_avg_rt($a);

    for ($t = 0; $t < 99.999; $t += 0.001)
        $sd += pow(($t - $esp), 2) * (f($a, $t) / 10);
    return pow(($sd / 99.999), 0.5);
}

/*