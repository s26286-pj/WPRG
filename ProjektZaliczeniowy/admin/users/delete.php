<?php
require __DIR__ . '/../../functions.php';
$db = new DatabaseConnection();
if (isset($_GET['id'])) {
    $isDeleted = $db->deleteUser($_GET['id']);
    if ($isDeleted) {
        echo "Użytkownik usunięty";
    } else {
        echo "Błąd";
    }
} 