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


            if ($user['role'] === 'admin') {
                header('Location: index.php?act=adminDashboard');
                exit;
            } else {
                header('Location: index.php?act=clientHome');
                exit;
            }
        } else {
            $error = "Sai thông tin đăng nhập!";
            include "./views/login.php";
        }
    }
    public function clientHome()
    {
        echo "Đây là trang dành cho client";
        // Hoặc include view clientHome.php nếu có
        include "./views/home.php";
    }
}