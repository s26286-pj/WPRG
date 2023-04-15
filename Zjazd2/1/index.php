<html>
<body>

<form action="/Zjazd2/1/index.php" method="post">
    <label for="number1">Liczba 1</label>
    <input type="number" name="number1" id="number1"><br>
    <label for="number1">Liczba 2</label>
    <input type="number" name="number2" id="number2"><br>
    <label for="operation">Operacja</label>
    <select name="operation" id="operation">
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <br>
    <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $number1 = $_POST['number1'];
  $number2 = $_POST['number2'];
  $operation = $_POST['operation'];
  echo $number1 . " " . $operation . " " . $number2 . " = ";
  
  switch ($operation) {
    case "+":
        echo $number1 + $number2;
        break;
    case "-":
        echo $number1 - $number2;
        break;
    case "*":
        echo $number1 * $number2;
        break;
    case "/":
        echo $number1 / $number2;
        break;    
  }
}
?>

</body>
</html>