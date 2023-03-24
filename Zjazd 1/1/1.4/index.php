<?php 
function getBirthdateFromPESEL($pesel) {
    $day = $pesel[0] . $pesel[1];
        
    $monthNumber = intval($pesel[2] . $pesel[3]);
    while ($monthNumber > 12) {
        $monthNumber -= 20;
    }
    $month = $monthNumber <= 10 ? '0' . strval($monthNumber) : strval($monthNumber);
    $year = $pesel[4] . $pesel[5];
    return $day. '-' . $month . '-' . $year;
}
$pesel = $argv[1];
echo getBirthdateFromPESEL($pesel);
