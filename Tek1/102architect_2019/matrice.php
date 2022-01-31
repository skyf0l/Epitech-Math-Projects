<?php

class Matrice{

    public $matrice;

    function __construct() {
        $this->matrice = array(
            1, 0, 0,
            0, 1, 0,
            0, 0, 1
        );
    }

    function __destruct() {

    }

    // -t
    function translate($i, $j) {
        echo "Translation along vector ($i, $j)";
        $this->matrice[2] += $i;
        $this->matrice[5] += $j;
        echo "\n";
    }

    // -z
    function scale($m, $n) {
        echo "Scaling by factors $m and $n\n";
        $scale = new Matrice();
        $scale->matrice = array(
            $m, 0, 0,
            0, $n, 0,
            0, 0, 1
        );
        $scale->mult_by($this);
        $this->matrice = $scale->matrice;
    }

    function mult_by($matrice) {
        $result = array();
        for ($y = 0; $y < 3; $y++) {
            for ($x = 0; $x < 3; $x++) {
                $result[$x + $y * 3] = 0;
                for ($k = 0; $k < 3; $k++)
                    $result[$x + $y * 3] += $this->matrice[$k + $y * 3] * $matrice->matrice[$x + $k * 3];
            }
        }
        $this->matrice = $result;
    }

    // -r
    function rotate($d) {
        echo "Rotation by a $d degree angle\n";
        $rotate = new Matrice();
        $rotate->matrice = array(
            cos(deg2rad($d)), -sin(deg2rad($d)), 0,
            sin(deg2rad($d)), cos(deg2rad($d)), 0,
            0, 0, 1
        );
        $rotate->mult_by($this);
        $this->matrice = $rotate->matrice;
    }

    // -s
    function reflect($d) {
        echo "Reflection over an axis with an inclination angle of $d degrees\n";
        $reflect = new Matrice();
        $reflect->matrice = array(
            cos(deg2rad(2 * $d)), sin(deg2rad(2 * $d)), 0,
            sin(deg2rad(2 * $d)), -cos(deg2rad(2 * $d)), 0,
            0, 0, 1
        );
        $reflect->mult_by($this);
        $this->matrice = $reflect->matrice;
    }

    function print(){
        for ($k = 0; $k < 3; $k++)
            echo number_format($this->matrice[$k * 3], 2, '.', '')."\t".number_format($this->matrice[$k * 3 + 1], 2, '.', '')."\t".number_format($this->matrice[$k * 3 + 2], 2, '.', '')."\n";
    }

}

?>