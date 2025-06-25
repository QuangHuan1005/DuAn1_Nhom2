<?php
require_once 'models/OrderStatusModel.php';

class OrderStatusModel {
    private $conn;

    public function __construct() {
        // Thay your_db_name, root, "" bằng thông tin của bạn
        $this->conn = new PDO("mysql:host=localhost;dbname=da1_nhom2", "root", "");
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Lấy tất cả trạng thái
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM order_statuses ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy 1 trạng thái theo id
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM order_statuses WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật trạng thái
    public function update($id, $name, $description) {
        $stmt = $this->conn->prepare("UPDATE order_statuses SET name = ?, description = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $id]);
    }

    // Thêm trạng thái mới
    public function create($name, $description) {
        $stmt = $this->conn->prepare("INSERT INTO order_statuses (name, description) VALUES (?, ?)");
        return $stmt->execute([$name, $description]);
    }

    // Xóa trạng thái
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM order_statuses WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
