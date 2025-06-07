<?php
class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function getAllProduct()
    {
        $products = $this->productModel->get_list();
      
        require_once 'views/Product/list.php';
    }

    public function viewProduct()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "ID sản phẩm không hợp lệ";
            header("Location: index.php?act=product-list");
            return;
        }

        $id = $_GET['id'];
        $product = $this->productModel->getById($id);

        if (!$product) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm";
            header("Location: index.php?act=product-list");
            return;
        }

        require_once 'views/Product/view.php';
    }

    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'category_id' => $_POST['category_id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'stock_quantity' => $_POST['stock_quantity'],
                'status' => $_POST['status'] ?? 1
            ];

            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $basePath = dirname(__DIR__, 2);
                $uploadDir = $basePath . '/uploads/products/';

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $data['image_url'] = 'uploads/products/' . $fileName;
                }
            }


            if ($this->productModel->create($data)) {
                $_SESSION['success'] = "Thêm sản phẩm thành công";
                header("Location: index.php?act=product-list");
                return;
            } else {
                $_SESSION['error'] = "Thêm sản phẩm thất bại";
            }
        }

        $categories = $this->productModel->getAllCategories();
        require_once 'views/Product/add.php';
    }

public function editProduct()
{
    $id = $_GET['id'] ?? null;

    if (!$id) {
        $_SESSION['error'] = 'ID sản phẩm không hợp lệ.';
        header('Location: index.php?act=product-list');
        exit;
    }

    $product = $this->productModel->getById($id);

    if (!$product) {
        $_SESSION['error'] = 'Không tìm thấy sản phẩm.';
        header('Location: index.php?act=product-list');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $category_id = $_POST['category_id'];
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $price = $_POST['price'];
        $stock_quantity = $_POST['stock_quantity'];
        $status = $_POST['status'];

        $image_url = $product['image_url']; // giữ ảnh cũ nếu không thay

        if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === 0) {
            $basePath = dirname(__DIR__, 2);
            $uploadDir = $basePath . '/uploads/products/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image_url = 'uploads/products/' . $fileName;
            }
        }

        $updated = $this->productModel->update($id, [
            'category_id' => $category_id,
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock_quantity' => $stock_quantity,
            'status' => $status,
            'image_url' => $image_url
        ]);

        if ($updated) {
            $_SESSION['success'] = 'Cập nhật sản phẩm thành công.';
            header('Location: index.php?act=product-list');
            exit;
        } else {
            $_SESSION['error'] = 'Lỗi khi cập nhật sản phẩm.';
            header("Location: index.php?act=edit_product&id=" . $id);
            exit;
        }
    }

    $categories = $this->productModel->getAllCategories();
    require_once 'views/Product/edit.php';
}



    public function softDelete()
    {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "ID sản phẩm không hợp lệ";
            header("Location: index.php?act=product-list");
            return;
        }

        $id = $_GET['id'];
        if ($this->productModel->softDelete($id)) {
            $_SESSION['success'] = "Ẩn sản phẩm thành công";
        } else {
            $_SESSION['error'] = "Ẩn sản phẩm thất bại";
        }

        header("Location: index.php?act=product-list");
    }
}
