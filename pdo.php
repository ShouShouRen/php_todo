<?php
$db_host = "localhost";
$db_name = "todo";
$db_user = "peter";
$db_pw = "12345678";
$db_charset = "utf8mb4";

$dsn = "mysql:host={$db_host};dbname={$db_name};charset={$db_charset}";
date_default_timezone_set("Asia/Taipei");

$now = date("Y-m-d H:i:s");

try {
    $pdo = new PDO($dsn, $db_user, $db_pw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo $e->getMessage();
};
