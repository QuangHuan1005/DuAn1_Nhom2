<?php 

session_start(); 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php'; // ✅ Thêm controller người dùng

// Require Models
require_once 'models/UserModel.php'; // ✅ Thêm model người dùng

// Route
$act = $_GET['act'] ?? '/';
$id = $_GET['id'] ?? null;
require_once 'views/layouts/layouts_top.php';
match ($act) {
    '/', 
    'adminDashboard' => (new DashboardController())->index(),


    'userIndex'      => (new UserController())->index(),
    'userCreate'     => (new UserController())->create(),
    'userStore'      => (new UserController())->store(),
    'userEdit'       => (new UserController())->edit($id),
    'userUpdate'     => (new UserController())->update($id),
    'userDelete'     => (new UserController())->delete($id),
    default          => function() {
        echo "404 - Page not found";
    },
};
require_once 'views/layouts/layout_bottom.php';