<?php
function generateMultipllyArray($count) {
    echo "|\t";
    for ($k=0; $k < $count; $k++) {
        echo "|" . $k . "\t";
    }
    echo "|\n";

    for ($i=0; $i < $count; $i++) {
        echo "|" . $i . "\t|";
        for ($j=0; $j < $count; $j++) {
            echo  $i * $j . "\t ";
        }
        echo "\n";
    }
}

$count = $argv[1];

generateMultipllyArray($count);
