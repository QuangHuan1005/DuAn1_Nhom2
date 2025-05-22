<?php
require_once 'controllers/CategoryController.php';
class CategoryController
{
  
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    public function getAllCategories()
    {
        $categories = $this->categoryModel->get_list();
        require_once 'views/Category/list.php';
    }

    public function viewCategory()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "ID danh mục không hợp lệ";
            header("Location: index.php?act=category-list");
            return;
        }

        $id = $_GET['id'];
        $category = $this->categoryModel->getById($id);

        if (!$category) {
            $_SESSION['error'] = "Không tìm thấy danh mục";
            header("Location: index.php?act=category-list");
            return;
        }

        require_once 'views/Category/view.php';
    }

    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'status' => $_POST['status'] ?? 1
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

    public function editCategory()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error'] = 'ID danh mục không hợp lệ.';
            header('Location: index.php?act=category-list');
            exit;
        }

        $category = $this->categoryModel->getById($id);

        if (!$category) {
            $_SESSION['error'] = 'Không tìm thấy danh mục.';
            header('Location: index.php?act=category-list');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $status = $_POST['status'];

            $updated = $this->categoryModel->update($id, [
                'name' => $name,
                'description' => $description,
                'status' => $status
            ]);

            if ($updated) {
                $_SESSION['success'] = "Cập nhật danh mục thành công";
                header('Location: index.php?act=category-list');
                exit;
            } else {
                $_SESSION['error'] = 'Lỗi khi cập nhật danh mục.';
                header("Location: index.php?act=edit_category&id=" . $id);
                exit;
            }
        }

        require_once 'views/Category/edit.php';
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