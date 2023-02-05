<?php
session_start();
if (!isset($_SESSION["AUTH"]) || $_SESSION["AUTH"]["role"] != 0) {
    header("Location: index.php");
}
try {
    require_once("pdo.php");
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./asset/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700;900&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700;900&display=swap");

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Noto Sans TC", sans-serif;
            background: linear-gradient(0deg,
                    slateblue 0%,
                    royalblue 100%);
            height: 100vh;
        }

        .table {
            background: white;
            margin-bottom: 0;
        }

        .border-start {
            border-left: 10px solid #fff;
            padding-left: 10px;
        }

        .wrapper {
            padding-top: 70px;
        }
    </style>
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
            <div class="row align-items-center justify-content-between mb-3">
                <h5 class="font-weight-bolder text-center text-white border-start">工作計畫</h5>
                <?php
                if ($_SESSION["AUTH"]["role"] == 0) {
                    echo '<button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#adduer" >新增使用者</button>';
                }
                ?>
            </div>
            <div class="p-4 bg-white rounded-lg t-shadow">
                <table class="table">
                    <tr>
                        <th>id</th>
                        <th>使用者帳號</th>
                        <th>使用者名稱</th>
                        <th>使用者權限</th>
                        <th>動作</th>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="adduer" tabindex="-1" aria-labelledby="adduerLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="adduerLabel">新增使用者</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-sm">
                                        <div class="d-center">
                                            <div class="wrapper px-5 py-4">
                                                <form action="register_store.php" method="POST">
                                                    <label for="">帳號</label>
                                                    <input type="text" name="user" class="form-control my-2" require>
                                                    <label for="">使用者姓名</label>
                                                    <input type="text" name="user_name" class="form-control my-2" require>
                                                    <label for="">密碼</label>
                                                    <input type="password" name="pw" class="form-control my-2" require>
                                                    <div class="d-flex justify-content-end">
                                                        <input type="submit" class="btn btn-success" value="註冊">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php while ($row = $stmt->fetch()) { ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["user"]; ?></td>
                            <td><?php echo $row["user_name"]; ?></td>
                            <td><?php
                                switch ($row["role"]) {
                                    case 0:
                                        echo "管理員";
                                        break;

                                    case 1:
                                        echo "一般使用者";
                                        break;
                                }
                                ?></td>
                            <td>
                                <?php if ($row["id"] == 1) { ?>
                                    <!-- 隱藏切換權限的連結 -->
                                <?php } elseif ($row["id"] == $_SESSION["AUTH"]["id"]) { ?>
                                    <span class="text-secondary">切換權限</span>
                                <?php } else { ?>
                                    <a href="switch_role.php?role=<?php echo $row["role"]; ?>&id=<?php echo $row["id"]; ?>">切換權限</a>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($row["id"] == 1) { ?>
                                    <!-- 隱藏修改的連結 -->
                                <?php } else { ?>
                                    <a class="btn btn-outline-secondary" data-toggle="modal" data-target="#edit" href="member_edit.php?id=<?php echo $row["id"] ?>">修改</a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editLabel">新增使用者</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-sm">
                                                        <div class="d-center">
                                                            <div class="wrapper px-5 py-4">
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
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="./asset/bootstrap.js"></script>

</html>