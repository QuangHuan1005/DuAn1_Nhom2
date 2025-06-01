<?php
require_once 'models/CategoryModel.php';

class CategoryController {
    
   
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function index() {
        $categories = $this->categoryModel->get_list();
        require 'views/category/list.php';
    }

    //skip trang
     public function listCategories() {
        $limit = 10; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit;

        $categories = $this->categoryModel->getCategoriesLimitOffset($limit, $offset);

        
        $total = $this->categoryModel->countCategories();
        $totalPages = ceil($total / $limit);

        require_once 'views/Category/list.php';
    }
    

    public function create() {
        require 'views/category/add.php';
    }

    public function store() {
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
public function edit($id) {
    $category = $this->categoryModel->getById($id);
    if (!$category) {
        echo "Category not found";
        exit();
    }
    $categories = $this->categoryModel->get_list(); // lấy tất cả danh mục khác để hiển thị trong select
    require 'views/category/edit.php';
}

public function view($id) {
    $category = $this->categoryModel->getById($id);
    if (!$category) {
        echo "Không tìm thấy danh mục.";
        exit();
    }
    require 'views/category/view.php';
}



   public function update($id) {
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


    public function softDelete($id) {
        $this->categoryModel->softDelete($id);
        header('Location: index.php?act=category-list');
        exit();
    }
}
