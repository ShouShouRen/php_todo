<?php
require_once("pdo.php");
extract($_POST);
if (isset($_POST['title'])) {
    $sql = "UPDATE todo_list SET title='$title',start='$start',end='$end',content='$content',status='$status' WHERE id = {$id}";
    header("Location:todo_list.php");
}else{
    $sql = "UPDATE todo_list SET start='$start',end='$end' WHERE id = {$id}";
    header("Location:todo_list.php");
}
$stmt = $pdo->prepare($sql);
$stmt->execute();