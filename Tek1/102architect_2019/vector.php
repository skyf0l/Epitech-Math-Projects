<?php

class Vector{

    public $vector;

    function __construct($x, $y) {
        $this->vector = array(
            (float)$x,
            (float)$y,
            1
        );
    }

    function __destruct() {

    }

    function apply_matrice($matrice) {
        $result = array();

        for ($y = 0; $y < 3; $y++) {
            $result[$y] = $matrice->matrice[$y * 3] * $this->vector[0];
            $result[$y] += $matrice->matrice[$y * 3 + 1] * $this->vector[1];
            $result[$y] += $matrice->matrice[$y * 3 + 2] * $this->vector[2];
        }

        $this->vector = $result;
        return $this;
    }

    function print() {
        echo "(";
        echo number_format($this->vector[0], 2, '.', '');
        echo ", ";
        echo number_format($this->vector[1], 2, '.', '');
        echo ")";
    }

}

?>