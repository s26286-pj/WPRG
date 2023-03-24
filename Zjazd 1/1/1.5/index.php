<?php

function get_parameter($parameter) {
    return readline("Wprowadź parametr " . $parameter . ": ");
}
function triangle() {
    $a = get_parameter("a");
    $h = get_parameter("h");
    echo $a * $h / 2;
}

function rectangle() {
    $a = get_parameter("a");
    $b = get_parameter("b");
    return $a * $b;
}

function trapeze() {
    $a = get_parameter("a");
    $b = get_parameter("b");
    $h = get_parameter("h");
    return ($a + $b) *  $h /2;
}

$figure = $argv[1];
switch ($figure) {
     case "trójkąt":
        return triangle();
    break;
    case "prostokąt":
        return rectangle();
    break;
    case "trapez":
        return trapeze();
    break;
}