<?php

#implementacja algorytmu sita Eratostenesa

function generateEratosthenesSieve($testedNumber) {
    $sieve = array_fill(0, $testedNumber + 1, true);
  
    for ($i = 2; $i * $i <= $testedNumber; $i++) {
        if ($sieve[$i]) {
            for ($j = $i * $i; $j <= $testedNumber; $j += $i) {
                $sieve[$j] = false;
            } 
        }
    }
    return $sieve;
}

function isPrime($number) {
    if ($number < 3) {
        return true;
    }
    $sieve = generateEratosthenesSieve($number);
    return $sieve[$number];
}

$number = $argv[1];

if (isPrime($number)) {
    echo "Jest pierwsza \n";
} else {
    echo "Nie jest pierwsza \n";
}
