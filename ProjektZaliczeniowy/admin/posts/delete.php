<?php
require __DIR__ . '/../../functions.php';
session_start();
$db = new DatabaseConnection();
$user = new User($_SESSION['user']);

if (isset($_GET['id']) && $user && $user->canPost()) {
    $isDeleted = $db->deletePost($_GET['id']);
    if ($isDeleted) {
        echo "Post usunięty";
    } else {
        echo "Błąd";
    }
}
