<?php
function ShowAll()
{
    require_once("pdo.php");
    global $result;
    $sql = "SELECT * FROM todo_list 
    JOIN status ON todo_list.status = status.code
    JOIN usetodo ON todo_list.usetodo = usetodo.codes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
function StoreList()
{
    require_once("pdo.php");
    extract($_POST);
    $sql = "INSERT INTO todo_list (title,start,end,content,created_at,status,usetodo) VALUES('$title','$start','$end','$content','$now','$status','$usetodo')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location: todo_list.php");
}
