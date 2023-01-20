<?php
require_once("pdo.php");
$sql = "SELECT * FROM todo_list,status WHERE todo_list.status=status.code";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
session_start();
if (!isset($_SESSION["AUTH"]) || $_SESSION["AUTH"]["role"] != 0) {
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
    <title>Document</title>
</head>

<body>
    <div class="container" id="container">
        <table class="table">
            <tr>
                <th>#</th>
                <th>標題</th>
                <th>開始時間</th>
                <th>結束時間</th>
                <th>內容</th>
                <th>備註</th>
                <th>動作</th>
                <th>狀態</th>
            </tr>
            <?php foreach ($result as $row) { ?>
                <tr>

                    <td><?php echo $row["id"] ?></td>
                    <td><?php echo $row["title"] ?></td>
                    <td><?php echo $row["start"] ?></td>
                    <td><?php echo $row["end"] ?></td>
                    <td><?php echo $row["content"] ?></td>
                    <td><a class="btn btn-danger" href="todo_delete.php?id=<?php echo $row["id"] ?>" onclick="return confirm('確定要刪除?')">刪除</a></td>
                    <td><a class="btn btn-secondary" href="todo_edit.php?id=<?php echo $row["id"] ?>">修改</a></td>
                    <td><?php
                        switch ($row["status"]) {
                            case 0:
                                echo "<span class='badge bg-primary'>進行中</span>";
                                break;
                            case 1:
                                echo "<span class='badge bg-success'>已完成</span>";
                                break;
                            case 2:
                                echo "<span class='badge bg-danger'>未完成</span>";
                                break;
                        }
                        ?></td>
                    <div><?php #echo $row['code_name']
                            ?></div>
                </tr>
            <?php  }  ?>
        </table>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="./asset/bootstrap.js"></script>
<script>
    let currentState = 0;
    let states = ["modle_row.php", "modle_calendar.php"];
    $("#switch").click(function() {
        currentState = (currentState + 1) % states.length;
        $.get(states[currentState], function(data) {
            $("#container").html(data);
        });
    });
</script>

</html>