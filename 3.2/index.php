<?php
function getDiceRoll($count) {
    $results = array();

    while ($count--) {
        array_push($results, rand(1,6));
    }
    return $results;
}

$diceRolls = $argv[1];

print_r (getDiceRoll($diceRolls));
