<?php
session_start();
try {
    require_once("pdo.php");
    extract($_POST);
    $sql = "SELECT * FROM users WHERE user = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row || $row["pw"] != $pw) {
        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
        }
        $_SESSION['login_attempts']++;
        if ($_SESSION['login_attempts'] > 3) {
            echo '超過三次';
            unset($_SESSION["login_attempts"]);
            header("Location: error.php");
            return;
        }
        echo "帳號密碼錯誤";
        header("Refresh:1;url=index.php");
        return;
    }
    // 登入成功
    $_SESSION["AUTH"] = $row;
    header("Location: todo_list.php");
} catch (PDOException $e) {
    echo $e->getMessage();
}
