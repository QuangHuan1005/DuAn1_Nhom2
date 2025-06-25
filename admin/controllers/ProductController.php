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
        // $products = $this->productModel->get_list();

        $keyword = $_GET['keyword'] ?? null;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $products = $this->productModel->get_list_by_keyword($keyword, $limit, $offset);
        $totalProducts = $this->productModel->count_all_by_keyword($keyword);
        $totalPages = ceil($totalProducts / $limit);


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
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $category_id = $_POST['category_id'];
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            $price = $_POST['price'];
            $stock_quantity = $_POST['stock_quantity'];
            $status = $_POST['status'] ?? 1;
            $image = $_FILES['image'];

            // Validate category
            if (empty($category_id)) {
                $errors['category_id'] = "Vui lòng chọn danh mục.";
            }

            // Validate name
            if (empty($name)) {
                $errors['name'] = "Tên sản phẩm không được để trống.";
            }

            // Validate description
            if (empty($description)) {
                $errors['description'] = "Mô tả sản phẩm không được để trống.";
            }


            // Validate price
            if ($price === '') {
                $errors['price'] = "Giá sản phẩm không được để trống.";
            } elseif (!is_numeric($price) || $price <= 0) {
                $errors['price'] = "Giá sản phẩm phải là số và lớn hơn 0.";
            }

            // Validate stock quantity
            if ($stock_quantity === "") {
                $errors['stock_quantity'] = "Tồn kho không được để trống";
            } elseif (!is_numeric($stock_quantity) || $stock_quantity < 0) {
                $errors['stock_quantity'] = "Tồn kho phải là số và không âm.";
            }

            // Validate image (nếu có)
            if (!empty($image['name']) && $image['error'] === 0) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                if (!in_array($image['type'], $allowedTypes)) {
                    $errors['image'] = "Ảnh không đúng định dạng. Chỉ cho phép JPG, PNG, WEBP.";
                }
            }


            // Nếu có lỗi thì hiển thị
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $_POST;
                $categories = $this->productModel->getAllCategories();
                require_once 'views/Product/add.php';
                return;
            }


            $data = [
                'category_id' => $_POST['category_id'],
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'discount_price' => $_POST['discount_price'],
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

            // Kiểm tra xem sản phẩm có nằm trong giỏ hàng nào không
            if ($product['status'] == 1 && $this->productModel->isProductInAnyCart($id)) {
                $_SESSION['error'] = "Không thể ẩn sản phẩm vì đang tồn tại trong giỏ hàng.";
                header("Location: index.php?act=product-list");
                return;
            }

            // Cập nhật status thành 0 (ẩn)
            $newStatus = $product['status'] == 1 ? 0 : 1;

            if ($this->productModel->updateStatus($id, $newStatus)) {
                $_SESSION['success'] = $newStatus == 1 ? "Sản phẩm đã được hiển thị" : "Sản phẩm đã được ẩn";
            } else {
                $_SESSION['error'] = "Cập nhật trạng thái sản phẩm thất bại.";
            }

            // Xử lý ảnh nếu có ảnh mới
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



    public function softDelete($id)
    {
        if (!isset($_GET['id'])) {
            $_SESSION['error'] = "ID sản phẩm không hợp lệ";
            header("Location: index.php?act=product-list");
            return;
        }

        $id = $_GET['id'];

        // Lấy thông tin sản phẩm hiện tại
        $product = $this->productModel->getById($id);
        if (!$product) {
            $_SESSION['error'] = "Không tìm thấy sản phẩm.";
            header("Location: index.php?act=product-list");
            return;
        }


        // Kiểm tra xem sản phẩm có nằm trong giỏ hàng nào không
        if ($product['status'] == 1 && $this->productModel->isProductInAnyCart($id)) {
            $_SESSION['error'] = "Không thể ẩn sản phẩm vì đang tồn tại trong giỏ hàng.";
            header("Location: index.php?act=product-list");
            return;
        }

        // Cập nhật status thành 0 (ẩn)
        $newStatus = $product['status'] == 1 ? 0 : 1;

        if ($this->productModel->updateStatus($id, $newStatus)) {
            $_SESSION['success'] = $newStatus == 1 ? "Sản phẩm đã được hiển thị" : "Sản phẩm đã được ẩn";
        } else {
            $_SESSION['error'] = "Cập nhật trạng thái sản phẩm thất bại.";
        }

        header("Location: index.php?act=product-list");
    }
    
}
