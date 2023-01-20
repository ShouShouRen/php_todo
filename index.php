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
    <link rel="stylesheet" href="css/login.css">
    <title>Document</title>
</head>

<body>
    <div class="container-sm">
        <div class="d-center">
            <div class="wrapper px-5 py-4">
                <h2>TODO工作管理系統</h2>
                <form action="auth.php" method="POST">
                    <label for="">帳號</label>
                    <input type="text" name="user" class="form-control my-2" require>
                    <label for="">密碼</label>
                    <input type="password" name="pw" class="form-control my-2" require>
                    <div class="d-flex justify-content-between">
                        <input type="reset" class="btn btn-primary" value="清除">
                        <input type="submit" class="btn btn-success" value="登入">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>