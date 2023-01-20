<?php
require_once("pdo.php");
extract($_GET);
$sql = "SELECT * FROM todo_list WHERE id = {$id}";
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
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="todo_list.php">TODO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll " style="max-height: 100px;">
                    <li class="nav-item">
                        <a href="todo_list.php" class="nav-link">回上一頁</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-5 py-5">
        <form action="update.php" method="POST">
            <?php foreach ($result as $row) { ?>
                <div class="py-2">
                    <label for="">工作名稱</label>
                    <input class="form-control w-50" type="text" name="title" value="<?= $row["title"]; ?>">
                </div>

                <div class="py-2">
                    <label for="">開始時間</label>
                    <select name="start" id="start" class="col-md-3 form-control">
                        <?php
                        for ($i = 0; $i <= 24; $i++) {
                            $zero = sprintf("%02d", $i);
                            $selected = ($row['start'] == $zero) ? 'selected' : '';
                            echo "<option value='$zero' $selected>$zero:00</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="py-2">
                    <label for="">結束時間</label>
                    <select name="end" id="end" class="col-md-3 form-control">
                        <?php
                        for ($i = 0; $i <= 24; $i++) {
                            $zero = sprintf("%02d", $i);
                            $selected = ($row['end'] == $zero) ? 'selected' : '';
                            echo "<option value='$zero' $selected>$zero:00</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="py-2">
                    <label for="">狀態管理</label>
                </div>
                <div>
                    <select name="status" class="custom-select w-50">
                        <option value="0" <?php echo $row["status"] == 0 ? "selected" : "" ?>>進行中</option>
                        <option value="1" <?php echo $row["status"] == 1 ? "selected" : "" ?>>已完成</option>
                        <option value="2" <?php echo $row["status"] == 2 ? "selected" : "" ?>>未完成</option>
                    </select>
                </div>
                <div class="py-2">
                    <label for="">工作敘述</label>
                    <textarea name="content" class="form-control"><?=$row['content']?></textarea>
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