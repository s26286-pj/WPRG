<html>
<body>
<?php
    $today = date('Y-m-d');
    $extraOptions = array(
        (object) [
          'value' => '1',
          'label' => 'Popielniczka',
          'isSelected' => false,
        ],
        (object) [
          'value' => '2',
          'label' => 'Klimatyzacja',
          'isSelected' => false,
        ]
        ); 
    $personCountOptions = array(
          (object) [
            'value' => '1',
            'label' => '1',
            'isSelected' => false,
          ],
          (object) [
            'value' => '2',
            'label' => '2',
            'isSelected' => false,
          ],
          (object) [
            'value' => '3',
            'label' => '3',
            'isSelected' => false,
          ],
          (object) [
            'value' => '4',
            'label' => '4',
            'isSelected' => false,
          ]
          );    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $count = $_POST["personCount"];
        $personCountOptions[$count - 1]->isSelected = true;
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $address = $_POST['address'];
        $ccn = $_POST['ccn'];
        $cvv = $_POST['cvv'];
        $start = $_POST['start'];
        $end = $_POST['end'];
        $childBed = isset($_POST['childbed']) ? !!$_POST['childbed'] : false;
        $other = isset($_POST['other']) ? $_POST['other'] : [];
        if (isset($_POST['other'])){
            foreach ($other as $value){
                $extraOptions[$value - 1]->isSelected = true;
            }
        }
        $extraNames = $_POST['extranames'];
        $extraSurnames = $_POST['extrasurnames'];
    } else {
        $count = 1;
        $name = "";
        $surname = "";
        $address = "";
        $ccn = "";
        $cvv = "";
        $start = $today;
        $end = $today;
        $childBed = false;
        $other = [];
        $extraPersons = [];
    }

?>
<form action="/Zjazd2/3/index.php" method="post">
    <label for="personCount">Ilość osób:</label>
    <select name="personCount">
        <?php
            foreach ($personCountOptions as $value){
                echo '<option value="' . $value->value . '" ' . ($value->isSelected ? 'selected' : '') . '>' . $value->label . '</option>';
            }
        ?>
    </select>
    <br/>
    <label for="name">Imię</label>
    <input type="text" name="name" id="name" value="<?php echo $name?>" required><br/>
    <label for="surname">Nazwisko</label>
    <input type="text" name="surname" id="surname" value="<?php echo $surname?>" required><br/>
    <label for="address">Adres</label>
    <textarea type="text" name="address" id="address" rows="3" required><?php echo $address?></textarea>
    <br/>
    <label for="ccn">Numer karty kredytowej</label>
    <!-- https://stackoverflow.com/a/59757039 -->
    <input id="ccn" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" name="ccn"  value="<?php echo $ccn?>" required>
    <br/>
    <label for="cvv">CVV:</label>
    <input id="cvv" type="number" min="100" max="999" name="cvv" value="<?php echo $cvv ?>" required>
    <br/>
    <label for="start">Od</label>
    <input type="date" id="start" name="start"
       value="<?php echo $start ?>"
       min="<?php echo $today ?>">
    <br/>
    <label for="end">Do</label>
    <input type="date" id="end" name="end"
       value="<?php echo $end ?>"
       min="<?php echo $today ?>">
    <br/>
    <label for="childbed">Dostawienie łóżka dziecięcego</label>
    <input type="checkbox" id="childbed" name="childbed" value="childbed" <?php echo $childBed ? "checked" : "" ?> >
    <br/>
    <label for="other">Inne:</label>
    <select name="other[]" id="other" multiple>
        <?php
            foreach ($extraOptions as $value){
                echo '<option value="' . $value->value . '" ' . ($value->isSelected ? 'selected' : '') . '>' . $value->label . '</option>';
            }
        ?>
    </select>
    <br/>
    <?php 
        for ($i = 0; $i < $count-1; $i++){
            ?>
            <span><?php echo $i + 2 ?> osoba</span><br/>
            <label for="name">Imię</label>
            <input type="text" name="extranames[]" value="<?php echo $extraNames[$i]?>"><br/>
            <label for="surname">Nazwisko</label>
            <input type="text" name="extrasurnames[]" value="<?php echo $extraSurnames[$i]?>"><br/>
            <?php
        }
    ?>
    <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
<h2>Podsumowanie</h2>
<table>
    <tbody>
    <tr>
    <td>Ilość osób</td>
    <td><?php echo $count?></td>
    </tr>
    <tr>
    <td>Imię</td>
    <td><?php echo $name?></td>
    </tr>
    <tr>
    <td>Nazwisko</td>
    <td><?php echo $surname?></td>
    </tr>
    <tr>
    <td>Adres</td>
    <td><?php echo $address?></td>
    </tr>
    <tr>
    <td>Numer karty kredytowej</td>
    <td><?php echo $ccn?></td>
    </tr>
    <tr>
    <td>CVV</td>
    <td><?php echo $cvv?></td>
    </tr>
    <tr>
    <td>Od</td>
    <td><?php echo $start?></td>
    </tr>
    <tr>
    <td>Do</td>
    <td><?php echo $end?></td>
    </tr>
    <tr>
    <td>Dostawienie łóżka dziecięcego</td>
    <td><?php echo $childBed ? "Tak" : "Nie" ?></td>
    </tr>
    <tr>
    <td>Inne</td>
    <td>
        <?php
            foreach ($other as $value){
                echo $extraOptions[$value-1]->label . "<br/>";
            }
        ?>
    </td>
    </tr>
    <tr>
    <td>Osoby dodatkowe</td>
    <td>
        <?php
            for ($i = 0; $i < $count-1; $i++){
                echo $extraNames[$i] . ' ' .  $extraSurnames[$i] . ', ';
            }
        ?>
    </td>
    </tr>
    <tr>
    </tbody>
</table>
<?php } ?>

</body>
</html>