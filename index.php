<?php 
session_start();

// Require file Common
require_once './commons/env.php';      
require_once './commons/function.php';  
// Require Controllers
require_once './controllers/HomeController.php';
require_once './admin/controllers/DashboardController.php';



// Require Models
require_once './models/User.php';

// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    '/'                 => (new HomeController())->index(),
    'home'              => (new HomeController())->index(),
    'login'             => (new HomeController())->login(),    
    'handle-login'      => (new HomeController())->handleLogin(), 
    'register'          => (new HomeController())->register(),      
    'handle-register'   => (new HomeController())->handleRegister(), 
    'adminDashboard'    => (new DashboardController())->index(),
    'clientHome'        => (new HomeController())->clientHome(),
    default             => header("Location: ./?act=home") 
};
