<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            width: 350px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            border-bottom: none;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .btn-primary {
            width: 100%;
        }
        .error-message {
            color: #ff0000;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h3>Đăng Nhập</h3>
        </div>
        <div class="card-body">
            <form method="post" action="login_be.php">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
            </form>
            <div class="error-message">
                <font color="red"><?php    if(!isset($_SESSION['error_login']))
                                                                    {
                                                                        unset($_SESSION['error_login']);
                                                                    }
                                                                    else
                                                                        echo $_SESSION['error_login'];
                                                                    ?></font>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
