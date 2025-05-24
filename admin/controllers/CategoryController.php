<?php
require_once 'controllers/CategoryController.php';
class CategoryController {
    public $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
    }

    public function getAllCategories() {
        $categories = $this->categoryModel->get_list();
        require "./views/category/list.php";
    }

    public function editCategory() {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "Thiếu ID danh mục";
            header('Location: index.php?act=category-list');
            exit;
        }

        $id = intval($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $category = $this->categoryModel->getById($id);
            if (!$category) {
                $_SESSION['error'] = "Không tìm thấy danh mục";
                header('Location: index.php?act=category-list');
                exit;
            }
            require "./views/category/edit.php";
            return;
        }

        // Xử lý cập nhật
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name === '') {
            $_SESSION['error'] = "Tên danh mục không được để trống";
            header("Location: index.php?act=edit_category&id=$id");
            exit;
        }

        $data = [
            'name' => $name,
            'description' => $description,
        ];

        if ($this->categoryModel->update($id, $data)) {
            $_SESSION['success'] = "Cập nhật danh mục thành công!";
            header("Location: index.php?act=category-list");
        } else {
            $_SESSION['error'] = "Cập nhật thất bại!";
            header("Location: index.php?act=edit_category&id=$id");
        }
    }
    public function addCategory()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            // Xóa dòng dưới đây đi vì không còn dùng status nữa
            // 'status' => $_POST['status'] ?? 1
        ];

        if ($this->categoryModel->create($data)) {
            $_SESSION['success'] = "Thêm danh mục thành công";
            header("Location: index.php?act=category-list");
            return;
        } else {
            $_SESSION['error'] = "Thêm danh mục thất bại";
        }
    }

    require_once 'views/Category/add.php';
}


    public function softDelete()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "ID danh mục không hợp lệ";
            header("Location: index.php?act=category-list");
            return;
        }

        $id = $_GET['id'];
        if ($this->categoryModel->softDelete($id)) {
            $_SESSION['success'] = "Xóa danh mục thành công";
        } else {
            $_SESSION['error'] = "Xóa danh mục thất bại";
        }

        header("Location: index.php?act=category-list");
    }
} 