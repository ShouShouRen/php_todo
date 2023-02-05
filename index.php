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
    <!-- <link rel="stylesheet" href="./css/login.css"> -->
    <style>
        body {
            font-family: "Noto Sans TC", sans-serif;
            /* background: rgba(0,0,0); */
            background: linear-gradient(0deg,
                    slateblue 0%,
                    royalblue 100%);
            height: 100vh;
        }

        .wrapper {
            max-width: 600px;
            backdrop-filter: blur(10px);
            background-color: #fff;
            box-shadow: 0 0 10px darkslateblue;
        }

        .d-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,50%);
        }

        h2 {
            color: royalblue;
            padding-bottom: 8px;
        }
    
    </style>

    <title>Document</title>
</head>

<body>
    <div class="container-sm">
        <div class="position-relative">
            <div class="d-center">
                <div class="wrapper p-5 rounded-lg">
                    <h2>TODO工作管理系統</h2>
                    <form action="auth.php" method="POST">
                        <label for="">帳號</label>
                        <input type="text" name="user" class="form-control my-2" require>
                        <label for="">密碼</label>
                        <input type="password" name="pw" class="form-control my-2" require>
                        <div class="d-flex justify-content-between my-4">
                            <input type="reset" class="btn btn-outline-primary" value="清除">
                            <input type="submit" class="btn btn-primary" value="登入">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>