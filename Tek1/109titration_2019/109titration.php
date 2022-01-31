<?php

$GLOBALS['max_it'] = 100;

function print_usage() {
    echo "USAGE\n".
    "\t./109titration file\n".
    "DESCRIPTION\n".
    "\tfile\ta csv file containing \"vol;ph\" lines\n";
    exit (0);
}

function try_help($msg) {
    echo "./109titration : $msg\ntry ./109titration -h\n";
    exit (84);
}

function check_args($argv) {
    if (sizeof($argv) > 1)
        if (strcmp($argv[1], '-h') == 0)
            print_usage();
    if (sizeof($argv) != 2)
        try_help("require one argument");
}

function get_values_from_file($path)
{
    $value_id = 0;
    $values = array();

    $file = @fopen($path, "r");
    if (!$file)
        try_help("cant read file");
    while (($line = fgets($file)) !== false) {
        $tokens = explode(";", $line);
        if (sizeof($tokens) != 2)
            return (NULL);
        if (substr($tokens[1], -1) == "\n")
            $tokens[1] = substr($tokens[1], 0, -1);
        if (!is_numeric($tokens[0]) || !is_numeric($tokens[1]))
            return (NULL);
        $values[$value_id] = [floatval($tokens[0]), floatval($tokens[1])];
        $value_id++;
    }
    fclose($file);
    return ($values);
}

function derive_point($point1, $point2)
{
    if ($point1[0] == $point2[0])
        return (0);
    return (($point2[1] - $point1[1]) / ($point2[0] - $point1[0]));
}

function derive_point_arerage($point_before, $point, $point_after)
{
    $average = 0;
    $area = $point_after[0] - $point_before[0];

    if ($area == 0)
        return (NULL);
    $average += derive_point($point_before, $point) * (($area - ($point[0] - $point_before[0])) / $area);
    $average += derive_point($point, $point_after) * (($area - ($point_after[0] - $point[0])) / $area);
    return ([$point[0], $average]);
}

function derive_points($values)
{
    $derivate = array();

    for ($k = 0; $k < sizeof($values) - 2; $k++) {
        $derivate[$k] = derive_point_arerage($values[$k], $values[$k + 1], $values[$k + 2]);
        if (!$derivate[$k])
            return (NULL);
    }
    return ($derivate);
}

function get_equivalence_point($derivatives)
{
    $max = $derivatives[0][1];
    $max_id = 0;

    for ($k = 1; $k < sizeof($derivatives); $k++)
        if ($derivatives[$k][1] > $max) {
            $max = $derivatives[$k][1];
            $max_id = $k;
        }
    return ($max_id);
}

function get_precise_derivative($derivatives, $equivalence_point_id) {
    $precise_derivatives = array();
    $id = 0;
    $coef_dir = derive_point($derivatives[$equivalence_point_id - 1], $derivatives[$equivalence_point_id]);

    for ($k = $derivatives[$equivalence_point_id - 1][0]; $k <= $derivatives[$equivalence_point_id][0]; $k += 0.1) {
        $precise_derivatives[$id] = [$k, $derivatives[$equivalence_point_id - 1][1] + $coef_dir * ($k - $derivatives[$equivalence_point_id - 1][0])];
        $id++;
    }
    $coef_dir = derive_point($derivatives[$equivalence_point_id], $derivatives[$equivalence_point_id + 1]);
    for ($k = $derivatives[$equivalence_point_id][0] + 0.1; $k <= $derivatives[$equivalence_point_id + 1][0]; $k += 0.1) {
        $precise_derivatives[$id] = [$k, $derivatives[$equivalence_point_id][1] + $coef_dir * ($k - $derivatives[$equivalence_point_id][0])];
        $id++;
    }
    return ($precise_derivatives);
}

function get_second_equivalence_point($derivatives)
{
    $neg = $derivatives[0][1] < 0;

    for ($k = 1; $k < sizeof($derivatives); $k++)
        if (($neg && $derivatives[$k][1] > 0) || (!$neg && $derivatives[$k][1] < 0)) {
            return ($k);
        }
    return (0);
}

function print_format($values)
{
    for ($k = 0; $k < sizeof($values); $k++)
        echo number_format($values[$k][0], 1, '.', '')." ml -> ".number_format($values[$k][1], 2, '.', '')."\n";
}

function main($argv) {
    check_args($argv);

    $values = get_values_from_file($argv[1]);
    if (!$values)
        try_help("invalid file data");

    $derivatives = derive_points($values);
    if (!$derivatives)
        try_help("can't derivate values");
    echo "Derivative:\n";
    print_format($derivatives);

    $equivalence_point_id = get_equivalence_point($derivatives);
    echo "\nEquivalence point at ".number_format($derivatives[$equivalence_point_id][0], 1, '.', '')." ml\n\n";

    $second_derivatives = derive_points($derivatives);
    if (!$derivatives)
        try_help("can't derivate derivative values");
    echo "Second derivative:\n";
    print_format($second_derivatives);

    echo "\nSecond derivative estimated:\n";
    $precise_derivatives = get_precise_derivative($second_derivatives, $equivalence_point_id - 1);
    if (!$precise_derivatives)
        try_help("can't get precise derivative");
    print_format($precise_derivatives);

    $equivalence_point_id = get_second_equivalence_point($precise_derivatives);
    echo "\nEquivalence point at ".number_format($precise_derivatives[$equivalence_point_id][0], 1, '.', '')." ml\n";
}

main($argv);

?>