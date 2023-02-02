<?php
require("function.php");
ShowAll();
session_start();
if (!isset($_SESSION["AUTH"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/bootstrap.css">
    <link rel="stylesheet" href="./css/todo_list.css">
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="javascript:;">TODO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll " style="max-height: 100px;">
                    <li class="nav-item">
                        <?php
                        if ($_SESSION["AUTH"]["role"] == 0) {
                            echo '<a class="nav-link" href="register.php">新增使用者</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        if ($_SESSION["AUTH"]["role"] == 0) {
                            echo '<a class="nav-link" href="member_list.php">會員列表</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <div class="nav-link">
                            <?php
                            if (isset($_SESSION["AUTH"])) {
                                echo $_SESSION["AUTH"]["user"] . "你好";
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION["AUTH"])) {
                            echo '<a class="nav-link" href="logout.php">登出</a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="wrapper">
        <div class="row align-items-center justify-content-between">
                <h2><?php
                    if ($_SESSION["AUTH"]["role"] == 0) {
                        echo '管理者專區';
                    } else {
                        echo '一般會員專區';
                    }
                    ?></h2>
                <h5 class="font-weight-bolder text-center">工作內容</h5>
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        建立工作
                    </button>
                    <button type="button" class="btn btn-primary" id="switch">
                        切換
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">TODO工作管理</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="todo_store.php" method="POST">
                                    <div class="py-2">
                                        <label for="">工作名稱</label>
                                        <input class="form-control" type="text" name="title">
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
                                        <label for="status">處理情形：</label>
                                        <select name="status" class="col-md-3 form-control">
                                            <option value="0">未處理</option>
                                            <option value="1">處理中</option>
                                            <option value="2">已完成</option>
                                        </select>
                                    </div>
                                    <div class="py-2">
                                        <label for="usetodo">優先情況:</label>
                                        <select name="usetodo" class="col-md-3 form-control">
                                            <option value="0">普通件</option>
                                            <option value="1">速件</option>
                                            <option value="2">最速件</option>
                                        </select>
                                    </div>
                                    <div class="py-2">
                                        <label for="">工作敘述</label>
                                        <textarea name="content" class="form-control"></textarea>
                                    </div>
                                    <input class="btn btn-primary" type="submit" value="建立" id="add-button">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="container">
                <div class="row">
                    <div class="table-left col-md-2 text-light bg-primary p-0">
                        <?php
                        for ($i = 0; $i < 24; $i = $i + 2) {
                            $hours = sprintf("%02d - %02d", $i, ($i + 2));
                        ?>
                            <div style="height:6.5vh" class="d-flex align-items-center justify-content-center border-right border-bottom border-light"><?= $hours; ?></div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="table-right col-10 p-0">
                        <?php
                        for ($i = 0; $i < 24; $i++) {
                            $hour = sprintf("%02d", $i);
                            $bottom = ($i % 2 == 1) ? 'border-bottom' : '';
                        ?>
                            <div data-hours="<?= $hour; ?>" class="time-line d-100 border-right <?= $bottom; ?> border-gray position-relative" style="height:3.25vh">
                                <div class="content-grid content-box">
                                    <?php
                                    foreach ($result as $row) {
                                        if ($row["start"] == $hour) {
                                    ?>
                                            <div class="card position-absolute" style="height: 13vh; z-index: 1000;" draggable="true" data-id="<?= $row['id'] ?>" data-start="<?= $row['start'] ?>">
                                                <div class="row">
                                                    <div class="col p-1">
                                                        <span><?php echo $row["title"] ?></span>
                                                        <div class='job-duration'><?php echo $row['start'] . "-" . $row['end'] ?></div>

                                                    </div>
                                                    <div class="col p-1">
                                                        <div><?=$row['code_name']?></div>
                                                        <div><?=$row['codes_name']?></div>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <div><a class="btn btn-danger" href="todo_delete.php?id=<?php echo $row["id"] ?>" onclick="return confirm('確定要刪除?')">刪除</a></div>
                                                    <div><a class="btn btn-secondary" href="todo_edit.php?id=<?php echo $row["id"] ?>">修改</a></div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="./asset/bootstrap.js"></script>
<script src="./js/todo_list.js"></script>

</html>