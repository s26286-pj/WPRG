<html>
<body>
<?php
    $operations = array(
          (object) [
            'value' => '1',
            'label' => 'Read',
            'isSelected' => false,
          ],
          (object) [
            'value' => '2',
            'label' => 'Delete',
            'isSelected' => false,
          ],
          (object) [
            'value' => '3',
            'label' => 'Create',
            'isSelected' => false,
          ]
          );    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $path = $_POST["path"];
        $catalog = $_POST["catalog"];
        $operationId = $_POST["operation"];
        $operations[$operationId - 1]->isSelected = true;
    } else {
        $path = "";
        $catalog = "";
        $operations[0]->isSelected = true;
    }
?>
<form action="/Zjazd2/Zestaw2/3/index.php" method="post">
    <label for="operation">Komenda</label>
    <select name="operation" id="operation">
        <?php
            foreach ($operations as $value){
                echo '<option value="' . $value->value . '" ' . ($value->isSelected ? 'selected' : '') . '>' . $value->label . '</option>';
            }
        ?>
    </select>
    <br/>
    <label for="path">Ścieżka</label>
    <input type="text" name="path" id="path" value="<?php echo $path?>" required><br/>
    <label for="catalog">Katalog</label>
    <input type="text" name="catalog" id="catalog" value="<?php echo $catalog?>" required><br/>
    <input type="submit">
</form>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (substr("$path", -1) === "/") {
        switch ($operationId) {
            case "1":
                $isDir = is_dir($path . $catalog);
                if ($isDir) {
                    print_r(scandir($path . $catalog));
                } else {
                    print_r("błąd");
                }
                
                return;
        break;
        case "2":
                $isDir = is_dir($path . $catalog);
                if ($isDir) {
                    $response = rmdir($path . $catalog);
                    if ($response) {
                        print_r("usunięto poprawnie");
                    } else {
                        print_r("błąd");
                    }
                } else {
                    print_r("błąd");
                }
                
                return;
        break;
        case "3":
                $isDir = is_dir($path . $catalog);
                if ($isDir) {
                    print_r("Katalog istnieje");
                    return;
                }
                $response = mkdir($path . $catalog, 0777, true);
                if ($response) {
                    print_r("stworzono poprawnie");
                } else {
                    print_r("błąd");
                }
            return;
        break;
    }
    }

}
?>

</body>
</html>