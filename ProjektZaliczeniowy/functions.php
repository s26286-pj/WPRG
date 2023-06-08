<?php
    $servername = "mysql";
    $username = "root";
    $password = "root";
    $dbname = "db";

    $database = new mysqli($servername, $username, $password, $dbname);

    if ($database->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    function authenticate($login, $password) {
        var_dump('kotek');
        var_dump($login);
        $passwordHash = hash("sha256", $password);
        $sql = "SELECT * from users WHERE login = '$login' AND password = '$passwordHash'";
        return $sql;
    }