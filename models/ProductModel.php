<?php
class ProductModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy sản phẩm bán chạy, kèm trạng thái danh mục
    public function getBestseller()
    {
        $sql = "SELECT p.*, c.is_active AS category_active
                FROM products p
                JOIN categories c ON p.category_id = c.id
                ORDER BY p.price DESC
                LIMIT 8";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    // Sản phẩm nổi bật ngẫu nhiên
    public function getFeatured()
    {
        $sql = "SELECT p.*, c.is_active AS category_active
                FROM products p
                JOIN categories c ON p.category_id = c.id
                ORDER BY RAND()
                LIMIT 5";
        $data = $this->conn->prepare($sql);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }
    // sản phẩm liên quan
    public function getRelatedProducts($product_id, $category_id)
{
    $sql = "SELECT p.*, c.is_active AS category_active
            FROM products p
            JOIN categories c ON p.category_id = c.id
            WHERE p.category_id = ? AND p.id != ? AND c.is_active = 1
            ORDER BY RAND()
            LIMIT 8";
    
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$product_id, $category_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Lấy sản phẩm theo danh mục (vẫn cần trả về kể cả khi danh mục ẩn)
    public function getByCategory($category_id)
    {
        $sql = "SELECT p.*, c.is_active AS category_active
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.category_id = :category_id";
        $data = $this->conn->prepare($sql);
        $data->execute(['category_id' => $category_id]);
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tổng số lượng sản phẩm
    public function getAll()
    {
        $sql = "SELECT COUNT(*) FROM products";
        $data = $this->conn->query($sql);
        return $data->fetchColumn();
    }

    // Phân trang sản phẩm
    public function getProductsByPage($limit, $offset)
    {
        $sql = "SELECT p.*, c.is_active AS category_active
                FROM products p
                JOIN categories c ON p.category_id = c.id
                LIMIT :limit OFFSET :offset";
        $data = $this->conn->prepare($sql);
        $data->bindParam(':limit', $limit, PDO::PARAM_INT);
        $data->bindParam(':offset', $offset, PDO::PARAM_INT);
        $data->execute();
        return $data->fetchAll(PDO::FETCH_ASSOC);
    }

    // Chi tiết sản phẩm
    public function getProductDetail($id)
    {
        $sql = "SELECT p.*, c.is_active AS category_active
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.id = :id";
        $data = $this->conn->prepare($sql);
        $data->execute(['id' => $id]);
        return $data->fetch(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm từ khóa (có kèm kiểm tra trạng thái danh mục)
    public function searchByKeyword($keyword)
    {
        $sql = "SELECT p.*, c.is_active AS category_active
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.name LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm sản phẩm (phiên bản khác có kiểm tra deleted_at)
    public function searchProducts($keyword)
    {
        $sql = "SELECT p.*, c.is_active AS category_active
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.deleted_at IS NULL 
                AND p.name LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['keyword' => $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
