<html>
<body>

<form action="/Zjazd3/1/index.php" method="post" enctype="multipart/form-data">
    <label for="avatar">Wybierz plik:</label>
    <input type="file" id="file" name="file" accept="text/plain">
    <input type="submit">    
</form>

<?php
$lines = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_FILES['file'])) {
        $fileDescriptor = fopen($_FILES['file']['tmp_name'], "r");
        if ($fileDescriptor) {
            
            while (($line = fgets($fileDescriptor)) !== false) {
                array_unshift($lines, $line);
            }
        
            fclose($fileDescriptor);
        }
    }
}
if (count($lines)) {
    echo '<h3>Results:</h3>';
    echo implode("<br/>", $lines);
}
?>

</body>
</html>
