<?php
    require_once("pdo.php");
    extract($_GET);
    $sql = "DELETE FROM todo_list WHERE id = {$id}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location:todo_list.php");
?>