<?php

require_once "models/User.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";


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
        $limit = 8;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;

        $offset = ($page - 1) * $limit;

        $products = $this->productModel->getProductsByPage($limit, $offset);
        $totalProducts = $this->productModel->getAll();
        $totalPages = ceil($totalProducts / $limit);

        require './views/product/products.php';


    }
    public function category($category_id)
    {

        $category = $this->categoryModel->getById($category_id);
        $products = $this->productModel->getByCategory($category_id);

        require './views/product/category.php';
    }
    public function search($keyword)
    {
        $products = $this->productModel->searchByKeyword($keyword);
        require './views/product/search.php';
    }

    public function getProfile()
    {
        require_once "./views/profile_page.php";
    }

    public function detail($id)
    {
        $product = $this->productModel->getProductDetail($id);
        if ($product) {
            $commentModel = new CommentModel();
            $comments = $commentModel->getCmtsByProduct($id);

            require './views/product/product-detail.php';
        } else {
            echo "Sản phẩm không tồn tại.";
        }
    }
}