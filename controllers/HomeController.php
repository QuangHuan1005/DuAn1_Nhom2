<?php
require_once "models/User.php";

class HomeController
{
    public function index()
    {
        echo "Đây là trang chủ";
    }

   public function login()
{
    $error = $error ?? null; 
    include "views/login.php";
}
public function handleLogin() {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = User::findByUsername($username); 
    if ($user && $password == $user['password']) {
        $_SESSION['user'] = $user;


        if ($user['role'] === 'admin') {
            header('Location: index.php?act=adminDashboard');
            exit;
        } else {
            header('Location: index.php?act=clientHome');
            exit;
        }
    } else {
        $error = "Sai thông tin đăng nhập!";
        include "views/login.php";
    }
}
public function clientHome()
{
    echo "Đây là trang dành cho client";
    // Hoặc include view clientHome.php nếu có
    // include "views/clientHome.php";
}
}