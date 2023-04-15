<?php 
    function factorial($number){
        $returned = 1;
        for ($i = 1; $i <= $number; $i++) {
            $returned = $returned * $i;
        }
        return $returned;
    }

    function factorialRecursive($number){
        if ($number <= 1){
            return 1;
        }
        else {
            return $number * factorial($number - 1);
        }
    }

    
    $number = intval($argv[1]);
    $beforeOperation = microtime(true);
    $result = factorial($number);
    $afterOperation = microtime(true);
    $clasicTime = $afterOperation - $beforeOperation;

    $beforeOperationRecusrive = microtime(true);
    $resultRecursive = factorialRecursive($number);
    $afterOperationRecusrive = microtime(true);
    $recursiveTime = $afterOperationRecusrive - $beforeOperationRecusrive;

    if ($result === $resultRecursive) {
        echo "Wynik zgodny = " . $result . "\n";
    }

    if ($recursiveTime < $clasicTime) {
        echo "factorialRecursive jest szybsza o:" . $clasicTime - $recursiveTime;
    } else {
        echo "factorial jest szybsza o:" . $recursiveTime - $clasicTime ;
    }
    echo "\n";

