<?php



function maxFor($array) {
    $lenght = count($array);
    $max = 0;
    for ($i=0; $i < $lenght; $i++) { 
        if ($array[$i] > $max) $max = $array[$i];
    }
    return $max;
}

function maxWhile($array) {
    $lenght = count($array);
    $max = 0;
    while ($lenght--) { 
        if ($array[$lenght] > $max) $max = $array[$lenght];
    }
    return $max;
}

function maxDo($array) {
    $lenght = count($array) - 1;
    $max = 0;
    do {
        if ($array[$lenght] > $max) $max = $array[$lenght];
    } while ($lenght--);
    return $max;
    
}
function maxForeach($array) {
    $lenght = count($array);
    $max = 0;
    foreach ($array as &$item) {
        if ($item > $max) $max = $item;
    }
    return $max;
}

$array = array_fill(0, 1000, rand(0, 100000));

echo maxFor($array) . " " . maxWhile($array) . " " . maxDo($array) . " " . maxForeach($array);
