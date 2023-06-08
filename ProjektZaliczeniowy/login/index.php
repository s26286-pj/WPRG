<?php
    require __DIR__ . '/../functions.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        var_dump("kotek");
        $login = $_POST["login"];
        $password = $_POST["password"];
        $resp = authenticate($login, $password);
        var_dump($resp);
        var_dump("kotek");
    } else {
        $login = "";
        $password = "";
    }
?>

<form action="/login" method="post">
    <label for="login">Login</label>
    <input type="text" name="login" id="login" value="<?php echo $login?>" required><br/>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" value="<?php echo $password?>" required><br/>
    <input type="submit">
</form>
