<?php
session_start();
require __DIR__ . '/../functions.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["login"];
        $password = $_POST["password"];
        $db = new DatabaseConnection();
        $isAuthenticated = $db->authenticate($login, $password);
        if ($isAuthenticated) {
            echo "Zalogowano!";
            die();
        }
    } else {
        $login = "";
        $password = "";
    }
?>

<form action="/login/index.php" method="POST">
    <label for="login">Login</label>
    <input type="text" name="login" id="login" value="<?php echo $login?>" required><br/>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" value="<?php echo $password?>" required><br/>
    <input type="submit">
</form>
