<?php
    require_once("pdo.php");
    extract($_POST);
    $sql = "UPDATE users SET user='$user',user_name='$user_name',pw='$pw',role='$role' WHERE id = {$id}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location: member_list.php");
