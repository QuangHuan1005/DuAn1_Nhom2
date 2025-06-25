<?php

require_once "models/User.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/CartModel.php";

class HomeController
{
    private $productModel;
    private $categoryModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->getAll();
        $bestsellers = $this->productModel->getBestseller();
        $featureds = $this->productModel->getFeatured();

        require_once "./views/home.php";
    }

    public function login()
    {
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);
        include "views/login.php";
    }

    public function handleLogin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $passwordInput = $_POST['password'] ?? '';
        $error = null;

        $user = User::findByUsername($username);


        if (!$user || $passwordInput !== $user['password']) {
            $error = "Sai tên đăng nhập hoặc mật khẩu!";
            include "views/login.php";
            return;
        }

        if (isset($user['status']) && $user['status'] == 0) {
            $_SESSION['error'] = "Tài khoản của bạn đã bị ngừng hoạt động.";
            header("Location: index.php?act=login");
            exit;
        }

        $_SESSION['user'] = $user;
        $_SESSION['user_role'] = $user['role'];

        $cartModel = new CartModel();
        $cart_id = $cartModel->getCartIdByUserId($user['id']);
        if (!$cart_id) {
            $cart_id = $cartModel->createCartForUser($user['id']);
        }
        $_SESSION['cart_id'] = $cart_id;

        if ($user['role'] === 'admin') {
            header('Location: index.php?act=adminDashboard');
        } else {
            header('Location: index.php?act=clientHome');
        }
        exit;
    }

    public function register()
    {
        $error = null;
        include "views/register.php";
    }

    public function handleRegister()
    {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm = $_POST['confirm'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $fullname = $_POST['fullname'] ?? '';
        $address = $_POST['address'] ?? '';
        $role = 'client';
        $avatar = $_FILES['avatar']['name'] ?? 'default.png';
        $error = null;

        if (empty($username) || empty($email) || empty($password) || empty($confirm) || $password !== $confirm) {
            $error = "Vui lòng điền đầy đủ thông tin và kiểm tra mật khẩu!";
            include "views/register.php";
            return;
        }

        if (User::findByUsername($username)) {
            $error = "Tên đăng nhập đã tồn tại!";
            include "views/register.php";
            return;
        }

        if (!empty($_FILES['avatar']['name'])) {
            $targetDir = 'uploads/';
            $targetFile = $targetDir . basename($avatar);
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                $error = "Có lỗi khi upload ảnh đại diện.";
                include "views/register.php";
                return;
            }
        }
   $hashedPassword = $password; 

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'phone' => $phone,
            'fullname' => $fullname,
            'address' => $address,
            'avatar' => $avatar,
            'role' => $role
        ];

        if (User::register($data)) {
            header("Location: index.php?act=login");
            exit;
        } else {
            $error = "Đăng ký thất bại. Vui lòng thử lại!";
            include "views/register.php";
        }
    }

    public function clientHome()
    {
        $categories = $this->categoryModel->getAll();
        $bestsellers = $this->productModel->getBestseller();
        $featureds = $this->productModel->getFeatured();

        include "./views/home.php";
    }

    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        unset($_SESSION['user']);
        unset($_SESSION['user_role']);
        unset($_SESSION['cart_id']);
        session_destroy();

        header("Location: index.php?act=login");
        exit;
    }
}
