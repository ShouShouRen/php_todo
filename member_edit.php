<?php
require_once("pdo.php");
extract($_GET);
$sql = "SELECT * FROM users WHERE id = {$id}";
$stmt = $pdo->prepare($sql);
$result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form action="member_store.php" method="POST">
            <?php foreach ($result as $row) { ?>
                <div class="py-2">
                    <label for="">使用者帳號</label>
                    <input class="form-control w-50" type="text" name="user" value="<?= $row["user"]; ?>">
                </div>
                <div class="py-2">
                    <label for="">使用者名稱</label>
                    <input class="form-control w-50" type="text" name="user_name" value="<?= $row["user_name"]; ?>">
                </div>
                <div class="py-2">
                    <label for="">使用者密碼</label>
                    <input class="form-control w-50" type="text" name="pw" value="<?= $row["pw"] ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <?php } ?>
            <div class="my-3">
                <input type="submit" value="確認修改" class="btn btn-primary">
            </div>
        </form>
    </div>
</body>

</html>