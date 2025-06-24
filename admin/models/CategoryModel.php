<?php
class CategoryModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
        if (!$this->conn) {
            die("Kết nối database thất bại");
        }
    }

    // Lấy danh sách category chưa bị xóa
    public function get_list()
    {
        $sql = "SELECT * FROM categories  ORDER BY id DESC ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 category theo id
    public function getById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ? ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //skip trang
    public function getCategoriesLimitOffset($limit, $offset)
    {
        $sql = "SELECT * FROM categories ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countCategories()
    {
        $sql = "SELECT COUNT(*) AS total FROM categories";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }


    // Thêm mới category
    public function create($data)
    {
        $name = $data['name'];
        $description = $data['description'];
        $sql = "INSERT INTO categories (name, description, created_at) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $description]);
    }

    // Cập nhật category theo id
    public function update($id, $data)
    {
        $sql = "UPDATE categories SET name = :name, description = :description, updated_at = NOW() WHERE id = :id AND deleted_at IS NULL";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':description' => $data['description'] ?? null,
            ':id' => $id
        ]);
    }

    // Xóa mềm (soft delete) category

    // public function updateStatus($id, $status)
    // {
    //     $stmt = $this->conn->prepare("UPDATE categories SET is_active = ? WHERE id = ?");
    //     return $stmt->execute([$status, $id]);
    // }
    public function updateStatus($id, $status)
    {
        // Cập nhật trạng thái danh mục
        $sql = "UPDATE categories SET is_active = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':status' => $status, ':id' => $id]);

        // Cập nhật trạng thái tất cả sản phẩm thuộc danh mục
        $sql2 = "UPDATE products SET status = :status WHERE category_id = :category_id";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute([':status' => $status, ':category_id' => $id]);
    }


}
