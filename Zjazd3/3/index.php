<html>
<body>

<form action="/Zjazd3/3/index.php" method="post">
    <label for="href">Odnośnik</label>
    <input type="text" name="href" id="href" required><br/>
    <label for="description">Opis</label>
    <input type="text" name="description" id="description" required><br/>
    <input type="submit">
</form>

<?php
$linksList = "lista.txt";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $href = $_POST["href"];
    $description = $_POST["description"];

    
    $fileDescriptor = fopen($linksList, "a+");
    if ($fileDescriptor) {
        $data = $href . ";" . $description . "\n";
        fputs($fileDescriptor, $data, strlen($data));
        fclose($fileDescriptor);
    }
}

$fileReadDescriptor = fopen($linksList, "r");
echo '<h3>List:</h3>';
while (($line = fgets($fileReadDescriptor)) !== false) {
    echo $line . "<br />";
}
?>

</body>
</html>
