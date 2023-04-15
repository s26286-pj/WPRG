<html>
<body>

<?php
    $counterFileName = "licznik.txt";
    if (!is_file($counterFileName)) {
        file_put_contents($counterFileName, "0"); 
    }
    $fileDescriptor = fopen($counterFileName, "r+");
    if ($fileDescriptor) {
        $count = intval(fgets($fileDescriptor));
        $count++;
        fseek($fileDescriptor, 0);
        fputs($fileDescriptor, $count, strlen($count));
        echo $count;
        fclose($fileDescriptor);
    }
?>

</body>
</html>
