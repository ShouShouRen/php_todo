<?php
require_once("pdo.php");
function ShowAll()
{
    global $pdo;
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
    global $pdo;
    extract($_POST);
    $sql = "INSERT INTO todo_list (title,start,end,content,created_at,status,usetodo) VALUES('$title','$start','$end','$content','$now','$status','$usetodo')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location: todo_list.php");
}
function DeleteList()
{
    global $pdo;
    extract($_GET);
    $sql = "DELETE FROM todo_list WHERE id = {$id}";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header("Location:todo_list.php");
}
function EditList()
{
    global $pdo;
    extract($_GET);
    global $stmt;
    global $result;
    $sql = "SELECT * FROM todo_list WHERE id = {$id}";
    $stmt = $pdo->prepare($sql);
    $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}