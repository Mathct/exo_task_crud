<?php
require_once 'config/database.php';

if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    $pdo = dbConnexion();
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;