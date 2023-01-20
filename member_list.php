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
            background: rgb(238, 174, 202);
            background: radial-gradient(circle,
                    #eeaeca 0%,
                    #94bbe9 100%);
        }

        .table {
            border: 3px solid #000;
            background: white;
            margin-bottom: 0;
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
                        <?php
                        if ($_SESSION["AUTH"]["role"] == 0) {
                            echo '<a class="nav-link" href="register.php">新增使用者</a>';
                        }
                        ?>
                    </li>
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
    <div class="container my-5 py-5">
        <table class="table">
            <tr>
                <th>id</th>
                <th>使用者帳號</th>
                <th>使用者名稱</th>
                <th>使用者權限</th>
                <th>動作</th>
            </tr>
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
                            <a class="btn btn-secondary" href="member_edit.php?id=<?php echo $row["id"] ?>">修改</a>
                        <?php } ?>
                    </td>


                </tr>
            <?php } ?>
        </table>
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="./asset/bootstrap.js"></script>

</html>