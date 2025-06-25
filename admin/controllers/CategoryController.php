<?php
require_once 'models/CategoryModel.php';
require_once 'models/ProductModel.php';

class CategoryController
{


    private $categoryModel;
    private $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $categories = $this->categoryModel->get_list();
        require './views/category/list.php';
    }

    //skip trang
    public function listCategories()
    {
        $limit = 10;
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        $categories = $this->categoryModel->getCategoriesLimitOffset($limit, $offset);


        $total = $this->categoryModel->countCategories();
        $totalPages = ceil($total / $limit);

        require_once './views/Category/list.php';
    }


    public function create()
    {
        require 'views/category/add.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
            ];
            $this->categoryModel->create($data);  // Sửa tên hàm
            header('Location: index.php?act=category-list');
            exit();
        }
    }
    public function edit($id)
    {
        $category = $this->categoryModel->getById($id);
        if (!$category) {
            echo "Category not found";
            exit();
        }
        $categories = $this->categoryModel->get_list(); // lấy tất cả danh mục khác để hiển thị trong select
        require 'views/category/edit.php';
    }

    public function view($id)
    {
        $category = $this->categoryModel->getById($id);
        if (!$category) {
            echo "Không tìm thấy danh mục.";
            exit();
        }
        require 'views/category/view.php';
    }



    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
            ];
            $this->categoryModel->update($id, $data);
            header('Location: index.php?act=category-list');
            exit();
        }
    }

    public function softDelete($id)
    {
        $category = $this->categoryModel->getById($id);

         // Không cho ẩn nếu có sản phẩm thuộc danh mục nằm trong giỏ hàng
    if ($category['is_active'] == 1 && $this->categoryModel->hasProductInCartByCategory($id)) {
        $_SESSION['error'] = "Không thể ẩn danh mục vì có sản phẩm thuộc danh mục này trong giỏ hàng.";
        header("Location: index.php?act=category-list");
        return;
    }

        if ($category) {
            $newStatus = $category['is_active'] == 1 ? 0 : 1;
            $this->categoryModel->updateStatus($id, $newStatus);
        }
        $product = $this->productModel->getById($id);

        if ($product) {
            $newStatus = $product['status'] == 1 ? 0 : 1;
            $this->productModel->updateStatus($id, $newStatus);
        }
        header('Location: index.php?act=category-list');
        exit;
    }
}
