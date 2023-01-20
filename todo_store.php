<?php 
    require_once("pdo.php");
    extract($_POST);
    $sql = "INSERT INTO todo_list (title,start,end,content,created_at,status) VALUES('$title','$start','$end','$content','$now','$status')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location: todo_list.php");
