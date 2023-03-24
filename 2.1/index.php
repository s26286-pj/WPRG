<?php

function getValueOfRandomValuesArray($index) {
    $array = array_fill(0, 1000, rand(0, 100000));
    return $array[$index];
}

$index = $argv[1];

echo getValueOfRandomValuesArray($index);
