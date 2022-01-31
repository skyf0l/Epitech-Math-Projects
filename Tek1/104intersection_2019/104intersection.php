<?php

require ("line.php");

function print_usage() {
    echo "USAGE\n"
        ."./104intersection opt xp yp zp xv yv zv p\n\n"
        ."DESCRIPTION\n"
        ."opt             surface option: 1 for a sphere, 2 for a cylinder, 3 for a cone\n"
        ."(xp, yp, zp)    coordinates of a point by which the light ray passes through\n"
        ."(xv, yv, zv)    coordinates of a vector parallel to the light ray\n"
        ."p               parameter: radius of the sphere, radius of the cylinder, or\n"
        ."                angle formed by the cone and the Z-axis\n";
}

function check_args($argv) {
    if (sizeof($argv) > 1)
        if (strcmp($argv[1], '-h') == 0) {
            print_usage();
            die (0);
        }
    if (sizeof($argv) != 9) {
        echo "./104intersection: bad arguments: ".(sizeof($argv) - 1)." given but 8 is required\nretry with -h\n";
        exit (84);
    }
    if (strcmp($argv[1], '1') != 0 && strcmp($argv[1], '2') != 0 && strcmp($argv[1], '3') != 0) {
        echo "./104intersection: bad option 'opt': must be 1 for a sphere, 2 for a cylinder or 3 for a cone\nretry with -h\n";
        exit (84);
    }
    for ($k = 2; $k < 9; $k++) {
        if (!is_numeric($argv[$k]))
            exit (84);
    }
    if ($argv[5] == 0 && $argv[6] == 0 && $argv[7] == 0)
        exit (84);
    if ($argv[8] < 0)
        exit (84);
    if (strcmp($argv[1], '3') == 0)
        if ($argv[8] > 90)
            exit (84);
}

function solve_eq($a, $b, $c) {
    $delta = $b * $b - 4 * $a * $c;
    if ($delta < 0)
        return array();
    else if ($delta == 0) {
        if ($a == 0)
            return array(0);
        $x = -$b / (2 * $a);
        return array($x);
    }
    else {
        $x1 = (-$b + sqrt($delta)) / (2 * $a);
        $x2= (-$b - sqrt($delta)) / (2 * $a);
        return array($x1, $x2);
    }
}

function get_line_points($line, $x) {
    if (sizeof($x) == 0)
        return array();
    else if (sizeof($x) == 1) {
        $point = array();
        for ($k = 0; $k < 3; $k++)
            $point[$k] = $line->point[$k] + $x[0] * $line->vector[$k];
        return array($point);
    }
    else if (sizeof($x) == 2) {
        $point1 = array();
        $point2 = array();
        for ($k = 0; $k < 3; $k++) {
            $point1[$k] = $line->point[$k] + $x[0] * $line->vector[$k];
            $point2[$k] = $line->point[$k] + $x[1] * $line->vector[$k];
        }
        return array($point1, $point2);
    }
    else
        return array(0, 0, 0);
}

function sphere_intersect($radius, $line) {
    echo "Sphere of radius $radius\n";
    $line->print();
    
    $a = 0;
    $b = 0;
    $c = 0;
    for ($k = 0; $k < 3; $k++) {
        $a += $line->vector[$k] * $line->vector[$k];
        $b += 2 * $line->vector[$k] * $line->point[$k];
        $c += $line->point[$k] * $line->point[$k];
    }
    $c -= $radius * $radius;
    $x = solve_eq($a, $b, $c);

    $points = get_line_points($line, $x);
    print_points($points);
}

function cylinder_intersect($radius, $line) {
    echo "Cylinder of radius $radius\n";
    $line->print();

    $a = 0;
    $b = 0;
    $c = 0;
    for ($k = 0; $k < 2; $k++) {
        $a += $line->vector[$k] * $line->vector[$k];
        $b += 2 * $line->vector[$k] * $line->point[$k];
        $c += $line->point[$k] * $line->point[$k];
    }
    $c -= $radius * $radius;
    $x = solve_eq($a, $b, $c);
    if (sizeof($x) == 1 && $line->vector[2] == $radius)
        $x = array(0, 0, 0);

    if ((int)$a == 0 || (int)$a > 666532744850833408 && (int)$b == 0 || (int)$b > 666532744850833408  && (int)$c == 0 || (int)$c > 666532744850833408)
        $x = array(0, 0, 0);

    $points = get_line_points($line, $x);
    print_points($points);
}

function cone_intersect($angle, $line) {
    echo "Cone with a $angle degree angle\n";
    $line->print();
    
    $a = 0;
    $b = 0;
    $c = 0;
    for ($k = 0; $k < 2; $k++) {
        $a += $line->vector[$k] * $line->vector[$k];
        $b += 2 * $line->vector[$k] * $line->point[$k];
        $c += $line->point[$k] * $line->point[$k];
    }
    $a -= tan(deg2rad($angle)) * tan(deg2rad($angle)) * $line->vector[$k] * $line->vector[$k];
    $b -= tan(deg2rad($angle)) * tan(deg2rad($angle)) * 2 * $line->vector[$k] * $line->point[$k];
    $c -= tan(deg2rad($angle)) * tan(deg2rad($angle)) * $line->point[$k] * $line->point[$k];
    $x = solve_eq($a, $b, $c);

    if ((int)$a == 0 || (int)$a > 666532744850833408 && (int)$b == 0 || (int)$b > 666532744850833408  && (int)$c == 0 || (int)$c > 666532744850833408)
        $x = array(0, 0, 0);

    $points = get_line_points($line, $x);
    print_points($points);
}

function main($argv) {
    check_args($argv);

    $line = new line($argv[2], $argv[3], $argv[4], $argv[5], $argv[6], $argv[7]);
    switch ($argv[1]) {
        case 1:
            sphere_intersect($argv[8], $line);
            break;
        case 2:
            cylinder_intersect($argv[8], $line);
            break;
        case 3:
            cone_intersect($argv[8], $line);
            break;
    }
}

main($argv);

?>