<?php

require_once "models/User.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/OrderModel.php";


class UserController
{
    private $productModel;
    private $categoryModel;
    private $userModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->userModel = new UserModel();
    }

    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=login");
            exit;
        }

        $userModel = new UserModel();
        $user = $this->userModel->getUserById($_SESSION['user']['id']);



        require './views/profile.php';
    }



}