<?php

class Vector{

    public $x;
    public $y;
    public $z;

    function __construct($x, $y, $z) {
        $this->x = (float)$x;
        $this->y = (float)$y;
        $this->z = (float)$z;
    }

    function __destruct() {

    }

    function add($velocity) {
        $this->x += $velocity->x;
        $this->y += $velocity->y;
        $this->z += $velocity->z;
    }

    function getAngle() {
        $ps = sqrt(pow($this->x, 2) + pow($this->y, 2) + pow($this->z, 2));
        $angle = 90 - (acos((abs($this->z)) / $ps)) * 180 / M_PI;
        return ($angle);
    }

    function print() {
        echo "(";
        echo number_format($this->x, 2, '.', '');
        echo ", ";
        echo number_format($this->y, 2, '.', '');
        echo ", ";
        echo number_format($this->z, 2, '.', '');
        echo ")\n";
    }

}

?>