<?php

$literations = 0;

#implementacja algorytmu sita Eratostenesa

function generateEratosthenesSieve($testedNumber) {
    global $literations;
    $sieve = array_fill(0, $testedNumber + 1, true);
  
    for ($i = 2; $i * $i <= $testedNumber; $i++) {
        if ($sieve[$i]) {
            for ($j = $i * $i; $j <= $testedNumber; $j += $i) {
                $literations++;
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

?>

<html>
<body>
<?php 
    $number = isset($_POST['number']) ? $_POST['number'] : 0;
?>
<form action="/Zjazd2/4/index.php" method="post">
    <label for="number">Podaj liczbę</label>
    <input type="number" name="number" id="number" min="0" value="<?php echo $number?>" required><br>
    <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (intval($number) > 0 && isPrime($number)) {
        echo "Jest pierwsza - " . $literations . " literacji  \n";
    } else {
        echo "Nie jest pierwsza - " . $literations . " literacji  \n";
    }
}
?>

</body>
</html>
