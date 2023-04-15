<html>
<body>

<?php
    $ipList = [];
    $fileDescriptor = fopen("iplist.txt", "r+");
    if ($fileDescriptor) {
        while (($line = fgets($fileDescriptor)) !== false) {
            array_unshift($ipList, rtrim($line));
        }
    }
    $currentClientIp = $_SERVER['REMOTE_ADDR'];
    $showAlternativePage = (array_search($currentClientIp, $ipList) !== false);
    if ($showAlternativePage) {
        include("./alternative.php");
    } else {
        include("./standard.php");
    }
?>

</body>
</html>
