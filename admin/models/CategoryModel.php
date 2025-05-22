<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel
{
    protected $table = 'categories';

    public function get_list()
    {
        $sql = "SELECT * FROM {$this->table} WHERE deleted_at IS NULL ORDER BY id DESC";
        return $this->query($sql);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ? AND deleted_at IS NULL";
        return $this->query_one($sql, [$id]);
    }

    public function create($data)
    {
        $sql = "INSERT INTO {$this->table} (name, description, status, created_at) VALUES (?, ?, ?, NOW())";
        return $this->execute($sql, [$data['name'], $data['description'], $data['status']]);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} SET name = ?, description = ?, status = ?, updated_at = NOW() WHERE id = ?";
        return $this->execute($sql, [$data['name'], $data['description'], $data['status'], $id]);
    }

    public function softDelete($id)
    {
        $sql = "UPDATE {$this->table} SET deleted_at = NOW() WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
} 