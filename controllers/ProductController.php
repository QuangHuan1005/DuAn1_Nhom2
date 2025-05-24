<?php
require_once "models/User.php";

class ProductController
{
    private $productModel;
    private $categoryModel;
    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }
    public function store()
    {
        $products = $this->productModel->getProducts();
        require_once "./views/page.php";

    }
    public function getProfile()
    {
        require_once "./views/profile_page.php";

    }

    public function detail($id) {
        $product = $this->productModel->getProductDetail($id);
        if ($product) {
            require './views/product-detail.php';
        } else {
            echo "Sản phẩm không tồn tại.";
        }
    }
}
