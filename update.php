<?php
require_once 'config/database.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $title = $_GET['title'];
    $description = $_GET['description'];
    $date= $_GET['date'];
    $priority = $_GET['priority'];
    $update = date('Y-m-d H:i:s');

    $pdo = dbConnexion();
    $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, due_date = ?, priority = ?, updated_at = ? WHERE id = ?");
    $stmt->execute([$title, $description, $date, $priority, $update, $id]);

}

header('Location: index.php');
exit;