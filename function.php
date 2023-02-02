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
