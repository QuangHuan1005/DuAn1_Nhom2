<?php
require_once 'models/OrderStatusModel.php';

class OrderStatusController
{
    private $model;

    public function __construct()
    {
        $this->model = new OrderStatusModel();
    }

    // Hiển thị danh sách trạng thái
    public function index()
    {
        $statuses = $this->model->getAll();
        include 'views/order_status/index.php';
    }

    // Hiển thị form chỉnh sửa trạng thái
    public function edit($id)
    {
        $status = $this->model->getById($id);
        include __DIR__ . '/../views/order_status/edit.php';
    }

    // Cập nhật trạng thái
    public function update()
    {
        if (isset($_POST['id'], $_POST['name'], $_POST['description'])) {
            $this->model->update($_POST['id'], $_POST['name'], $_POST['description']);
            header("Location: index.php?act=order-status-list");
            exit;
        }
    }

    // Hiển thị form thêm mới trạng thái
    public function createForm()
    {
        include 'views/order_status/create.php';
    }

    // Thêm trạng thái mới
    public function create()
    {
        if (isset($_POST['name'], $_POST['description'])) {
            $this->model->create($_POST['name'], $_POST['description']);
            header("Location: index.php?act=order-status-list");
            exit;
        }
    }

    // Xóa trạng thái
    public function delete($id)
    {
        $this->model->delete($id);
        header("Location: index.php?act=order-status-list");
        exit;
    }
}
