<?php 
    require_once("pdo.php");
    extract($_POST);
    $sql = "INSERT INTO todo_list (title,start,end,content,created_at,status,usetodo) VALUES('$title','$start','$end','$content','$now','$status','$usetodo')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location: todo_list.php");
