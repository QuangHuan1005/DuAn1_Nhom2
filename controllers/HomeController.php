<?php

// Đảm bảo các model được nạp. Nếu bạn có autoloader, bạn không cần require_once.
// Nếu không, hãy đảm bảo đường dẫn đúng.
require_once "models/User.php";
require_once "models/ProductModel.php"; // Giả định có file này
require_once "models/CategoryModel.php"; // Giả định có file này


class HomeController
{
    private $productModel;  git add .
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

        // Đảm bảo các biến này có sẵn trong home.php
        require_once "./views/home.php";
    }

    public function getAll()
    {
        $products = $this->productModel->getProducts();
        require_once "./views/page.php"; // Có vẻ đây là trang liệt kê sản phẩm chung
    }

    public function getProfile()
    {
        require_once "./views/profile_page.php";
    }

    public function login()
    {
        $error = null; // Khởi tạo lỗi là null
        include "views/login.php"; // Hiển thị form đăng nhập
    }

    public function handleLogin()
    {
        // Bắt đầu session nếu chưa có
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $username = $_POST['username'] ?? '';
        $passwordInput = $_POST['password'] ?? '';
        $error = null; // Reset lỗi trước khi xử lý

        // Tìm người dùng theo tên đăng nhập
        $user = User::findByUsername($username);

        // Kiểm tra xem người dùng có tồn tại và mật khẩu có khớp không
        // SỬ DỤNG password_verify() ĐỂ SO SÁNH MẬT KHẨU ĐÃ BĂM
        if ($user && password_verify($passwordInput, $user['password'])) {
            $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session

            // Chuyển hướng dựa trên vai trò
            if ($user['role'] === 'admin') {
                header('Location: index.php?act=adminDashboard');
                exit;
            } else {
                header('Location: index.php?act=clientHome');
                exit;
            }
        } else {
            // Đăng nhập thất bại
            $error = "Sai tên đăng nhập hoặc mật khẩu!";
            include "views/login.php"; // Hiển thị lại form với thông báo lỗi
        }
    }

    public function register()
    {
        $error = null; // Khởi tạo lỗi là null
        include "views/register.php"; // Hiển thị form đăng ký
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
        $role = 'client'; // Mặc định vai trò là client
        $avatar = $_FILES['avatar']['name'] ?? 'default.png';
        $error = null; // Reset lỗi trước khi xử lý

        // 1. Kiểm tra dữ liệu đầu vào
        if (empty($username) || empty($email) || empty($password) || empty($confirm) || $password !== $confirm) {
            $error = "Vui lòng điền đầy đủ thông tin và kiểm tra mật khẩu!";
            include "views/register.php";
            return;
        }

        // 2. Kiểm tra tên đăng nhập đã tồn tại
        if (User::findByUsername($username)) {
            $error = "Tên đăng nhập đã tồn tại!";
            include "views/register.php";
            return;
        }

        // 3. Xử lý upload avatar (nếu có)
        if (!empty($_FILES['avatar']['name'])) {
            $targetDir = 'uploads/'; // Đảm bảo thư mục 'uploads/' tồn tại và có quyền ghi
            $targetFile = $targetDir . basename($avatar);
            if (!move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile)) {
                $error = "Có lỗi khi upload ảnh đại diện.";
                include "views/register.php";
                return;
            }
        }

        // 4. Băm (hash) mật khẩu trước khi lưu vào database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // 5. Chuẩn bị dữ liệu để đăng ký
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword, // Lưu mật khẩu đã băm
            'phone' => $phone,
            'fullname' => $fullname,
            'address' => $address,
            'avatar' => $avatar,
            'role' => $role
        ];

        // 6. Thực hiện đăng ký người dùng
        if (User::register($data)) {
            header("Location: index.php?act=login"); // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
            exit;
        } else {
            $error = "Đăng ký thất bại. Vui lòng thử lại!";
            include "views/register.php";
        }
    }

    public function clientHome()
    {
        // echo "Đây là trang dành cho client"; // Có thể bỏ dòng này nếu bạn muốn hiển thị view
        // Nếu clientHome.php là trang chủ của client, hãy include nó
        // Ví dụ: include "./views/clientHome.php";
        // Trong trường hợp này, bạn đang include home.php, nên không cần echo.
        include "./views/home.php";
    }

    public function logout()
    {
        // Bắt đầu session nếu chưa có
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']); // Xóa session người dùng
        session_destroy(); // Hủy toàn bộ session
        header("Location: index.php?act=login"); // Chuyển hướng về trang đăng nhập
        exit;
    }
}