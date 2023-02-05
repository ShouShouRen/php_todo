<?php
require_once("pdo.php");
$sql = "SELECT * FROM todo_list,status WHERE todo_list.status=status.code";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="container" id="container">
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
                                            <span><?php echo $row["title"] ?></span>
                                            <div class='job-duration'><?php echo $row['start'] . "-" . $row['end'] ?></div>
                                            <div><?= $row['code_name'] ?></div>
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
            </div>    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="./asset/bootstrap.js"></script>
<script src="./js/todo_list.js"></script>

</html>