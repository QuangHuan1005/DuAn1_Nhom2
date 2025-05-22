<?php
require_once "models/User.php";

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
    public function getAll()
    {
        $products = $this->productModel->getProducts();
        require_once "./views/page.php";

    }
    public function getProfile()
    {
        require_once "./views/profile_page.php";

    }
    public function login()
    {
        $error = $error ?? null;
        include "views/login.php";
    }
    public function handleLogin()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByUsername($username);
        if ($user && $password == $user['password']) {
            $_SESSION['user'] = $user;

    public function login()
    {
        $error = null;
        include "views/login.php";
    }

    public function handleLogin()
    {
        $username = $_POST['username'] ?? '';
        $passwordInput = $_POST['password'] ?? '';

        $user = User::findByUsername($username);
        if ($user) {
            if ($passwordInput === $user['password']) {
                $_SESSION['user'] = $user;

            if ($user['role'] === '1') {
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
        include "./views/home.php";
    }
}
                if ($user['role'] === 'admin') {
                    header('Location: index.php?act=adminDashboard');
                    exit;
                } else {
                    header('Location: index.php?act=clientHome');
                    exit;
                }
            } else {
                $error = "Sai tên đăng nhập hoặc mật khẩu!";
                include "views/login.php";
            }
        } else {
            $error = "Sai tên đăng nhập hoặc mật khẩu!";
            include "views/login.php";
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

        if (empty($username) || empty($email) || empty($password) || $password !== $confirm) {
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
            move_uploaded_file($_FILES['avatar']['tmp_name'], 'uploads/' . $avatar);
        }
        $passwordToSave = $password;

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $passwordToSave,
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
        echo "Đây là trang dành cho client";
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: index.php?act=login");
        exit;
    }
}
