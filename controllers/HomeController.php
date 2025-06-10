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
        $error = null;
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

        if ($user && $passwordInput === $user['password']) {
            // Lưu thông tin user vào session
            $_SESSION['user'] = $user;
            $_SESSION['user_role'] = $user['role'];


         //   Tạo CartModel và lấy cart_id của user
            $cartModel = new CartModel();
            $cart_id = $cartModel->getCartIdByUserId($user['id']);
            if (!$cart_id) {
                $cart_id = $cartModel->createCartForUser($user['id']);
            }
            $_SESSION['cart_id'] = $cart_id;

            // Phân quyền redirect
            if ($user['role'] === 'admin') {
                header('Location: admin/index.php?act=adminDashboard');
                exit;

        }
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

        // Ở đây bạn nên hash password trước khi lưu, ví dụ dùng password_hash()
        $hashedPassword = $password; // Bạn nên thay bằng: password_hash($password, PASSWORD_DEFAULT);

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
        session_destroy();
        header("Location: index.php?act=login");
        exit;
    }
}
