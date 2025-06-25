<?php
class ProductModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // 1. Lấy sản phẩm bán chạy
    public function getBestseller()
    {
        $sql = "SELECT * FROM products WHERE status = 1 ORDER BY price DESC LIMIT 8";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);

    }
  
    // 2. Sản phẩm nổi bật ngẫu nhiên
    public function getFeatured()
    {
        $sql = "SELECT * FROM products WHERE status = 1  ORDER BY RAND() LIMIT 5";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Lấy sản phẩm theo danh mục
    public function getByCategory($category_id)
    {
        $sql = "SELECT * FROM products WHERE status = 1 AND category_id = :category_id";
        $data = $this->conn->prepare($sql);
        $data->execute(['category_id' => $category_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Đếm tổng sản phẩm
    public function getAll()
    {
        $sql = "SELECT COUNT(*) FROM products WHERE status = 1 ";
        $data = $this->conn->query($sql);
        return $data->fetchColumn();
    }

    // 5. Phân trang sản phẩm
    public function getProductsByPage($limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE status = 1 LIMIT :limit OFFSET :offset";
        $data = $this->conn->prepare($sql);
        $data->bindParam(':limit', $limit, PDO::PARAM_INT);
        $data->bindParam(':offset', $offset, PDO::PARAM_INT);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    // 6. Chi tiết sản phẩm
    public function getProductDetail($id)
    {
        $sql = "SELECT * FROM products WHERE id = :id AND status = 1 ";
        $data = $this->conn->prepare($sql);
        $data->execute(['id' => $id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    // 7. Tìm kiếm từ khóa
    public function searchByKeyword($keyword)
    {
        $sql = "SELECT * FROM products WHERE status = 1 AND name LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 8. Tìm kiếm sản phẩm có kiểm tra deleted_at
    public function searchProducts($keyword)
    {
            $sql = "SELECT * FROM products 
                WHERE deleted_at IS NULL 
                AND  status = 1
                AND  name LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['keyword' => $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function increaseStockQuantity($product_id, $quantity)
{
    $sql = "UPDATE products SET stock_quantity = stock_quantity + :qty WHERE id = :pid";
    $stmt = $this->conn->prepare($sql);

    $result = $stmt->execute([':qty' => $quantity, ':pid' => $product_id]);

    if (!$result) {
        echo "❌ Không thể cộng lại tồn kho cho sản phẩm ID $product_id - Số lượng $quantity";
    } else {
        echo "✅ Đã cộng lại tồn kho cho sản phẩm ID $product_id - Số lượng $quantity<br>";
    }

    return $result;
}


    // 10. Giảm tồn kho (khi đặt hàng)
    public function decreaseStockQuantity($product_id, $quantity)
    {
        $sql = "UPDATE products 
                SET stock_quantity = stock_quantity - :qty 
                WHERE id = :pid AND stock_quantity >= :qty";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':qty' => $quantity,
            ':pid' => $product_id
        ]);
    }
}
