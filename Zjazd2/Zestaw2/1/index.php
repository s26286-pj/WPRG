<html>
<body>
<?php 
    $today = new DateTime();
    $date = isset($_GET["date"]) ? htmlspecialchars($_GET["date"]) : $today;
?>
<form action="/Zjazd2/Zestaw2/1/index.php" method="get">
    <input type="date" id="date" name="date" value="<?php echo $date ?>">
    <br/>
    <input type="submit">
</form>
<?php 
    if (isset($_GET["date"])){
        $datetime = new DateTime($_GET["date"]);
        echo "Dzień tygodnia: " . $datetime->format('l') . ", ";
        $years = $today->diff($datetime)->format('%Y');
        echo "ilość lat: " . $years . ", ";

        $nextBirthdate = clone $datetime;
        $nextBirthdate->modify(date('Y') . '-' . $nextBirthdate->format('m-d'));
        if ($nextBirthdate < $today) {
            $nextBirthdate->modify('+1 year');
        }
        $daysToBirthday = $today->diff($nextBirthdate)->days;
        echo "dni do urodzin: " . $daysToBirthday  . "\n";
    }
?>
</body>
</html>
