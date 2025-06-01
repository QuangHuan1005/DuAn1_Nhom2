<?php

class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function get_list($keyword = '') {
        $sql = "SELECT id, username, email, phone, avatar, role FROM users WHERE 1";
        
        if (!empty($keyword)) {
            $sql .= " AND (username LIKE :kw OR email LIKE :kw OR phone LIKE :kw)";
        }

        $stmt = $this->conn->prepare($sql);
        
        if (!empty($keyword)) {
            $kw = '%' . $keyword . '%';
            $stmt->bindParam(':kw', $kw);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_detail($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function update($id, $data) {
    $sql = "UPDATE users 
            SET username = ?, email = ?, phone = ?, avatar = ?, role = ?, status = ? 
            WHERE id = ?";
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute([
        $data['username'],
        $data['email'],
        $data['phone'],
        $data['avatar'],
        $data['role'],
        $data['status'],  // thêm trường status
        $id
    ]);
}

    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
   public function get_list_paged($keyword = '', $limit = 10, $offset = 0) {
    $sql = "SELECT * FROM users";

    if (!empty($keyword)) {
        $sql .= " WHERE username LIKE :kw OR email LIKE :kw OR phone LIKE :kw";
    }

    $sql .= " ORDER BY id DESC";

    $sql .= " LIMIT $limit OFFSET $offset";

    $stmt = $this->conn->prepare($sql);

    if (!empty($keyword)) {
        $kw = "%$keyword%";
        $stmt->bindValue(':kw', $kw, PDO::PARAM_STR);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function count_users($keyword = '') {
    $sql = "SELECT COUNT(*) FROM users WHERE username LIKE :kw OR email LIKE :kw OR phone LIKE :kw";
    $stmt = $this->conn->prepare($sql);
    $kw = "%$keyword%";
    $stmt->bindValue(':kw', $kw, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn();
}

public function find($id)
    {
        $id = intval($id);
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
