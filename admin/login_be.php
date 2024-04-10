<?php
    session_start();
    include "./connection.php"; // Include file kết nối đến cơ sở dữ liệu

    // Lấy dữ liệu từ cơ sở dữ liệu
    $sql = "SELECT * FROM account";
    $data = $conn->query($sql);

    // Lấy dữ liệu được gửi từ biểu mẫu đăng nhập
    $user = $_POST['username'];
    $pass = $_POST['password']; // Mật khẩu chưa được mã hóa
        // Nếu không tìm thấy thông tin người dùng hoặc thông tin đăng nhập không đúng
        $_SESSION['login'] = false;
        $_SESSION['error_login'] = "User or password is wrong!";
        // echo "wrong";
        // Chuyển hướng người dùng đến trang đăng nhập với thông báo lỗi
        header("Location: login.php");   

    // Lặp qua dữ liệu từ cơ sở dữ liệu
    foreach($data as $d){
        // So sánh tên đăng nhập
        if($d['username'] == $user){
            // Kiểm tra mật khẩu
            if(password_verify($pass, $d['password'])){
                echo "đúng";
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
                $_SESSION['error_login'] = "";

                // Kiểm tra quyền của người dùng
                if($d['roles'] == "user"){
                    $_SESSION['error_login'] = "You don't have permission to access this website!";
                    // Chuyển hướng người dùng đến trang thông báo quyền truy cập bị từ chối
                    header("Location: login.php");
                }
                if($d['roles'] == "admin"){
                    // Chuyển hướng người dùng đến trang chính của admin
                    echo "can";
                    header("Location: home.php");
                }
                break;
            }
        }
    }

?> 
