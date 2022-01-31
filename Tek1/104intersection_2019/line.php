<?php

class line{

    public $point;
    public $vector;

    function __construct($xp ,$yp ,$zp ,$xv ,$yv ,$zv) {
        $this->point = array($xp, $yp, $zp);
        $this->vector = array($xv, $yv, $zv);
    }

    function print() {
        echo "Line passing through the point (".$this->point[0].", ".$this->point[1].", ".$this->point[2].") and parallel to the vector (".$this->vector[0].", ".$this->vector[1].", ".$this->vector[2].")\n";
    }

}

function print_no_intersect() {
    echo "No intersection point.\n";
}

function print_1_intersect($point) {
    echo "1 intersection point:\n";
    echo "(".number_format($point[0], 3, '.', '').", ".number_format($point[1], 3, '.', '').", ".number_format($point[2], 3, '.', '').")\n";
}

function print_2_intersect($point1, $point2) {
    echo "2 intersection points:\n";
    echo "(".number_format($point1[0], 3, '.', '').", ".number_format($point1[1], 3, '.', '').", ".number_format($point1[2], 3, '.', '').")\n";
    echo "(".number_format($point2[0], 3, '.', '').", ".number_format($point2[1], 3, '.', '').", ".number_format($point2[2], 3, '.', '').")\n";
}

function print_inf_intersect() {
    echo "There is an infinite number of intersection points.\n";
}

function print_points($points) {
    if (sizeof($points) == 0)
        print_no_intersect();
    if (sizeof($points) == 1)
        print_1_intersect($points[0]);
    if (sizeof($points) == 2)
        print_2_intersect($points[0], $points[1]);
    if (sizeof($points) == 3)
        print_inf_intersect();
}

?>