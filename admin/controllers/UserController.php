<?php
require_once './models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Danh sách user
    public function index() {
        $keyword = $_GET['keyword'] ?? '';
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $users = $this->userModel->get_list_paged($keyword, $limit, $offset);
        $totalUsers = $this->userModel->count_users($keyword);
        $totalPages = ceil($totalUsers / $limit);

        require_once './views/user/index.php';
    }

    // Hiển thị form sửa user
    public function edit($id) {
        $user = $this->userModel->get_detail($id);
        require_once './views/user/edit.php';
    }

    // Cập nhật chỉ role và status
    public function update($id) {
        $data = [
            'role' => $_POST['role'],
            'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1,
        ];

        $this->userModel->update($id, $data);

        header('Location: index.php?act=userIndex');
        exit;
    }

    // Xóa user
    public function delete($id) {
        $this->userModel->delete($id);
        header('Location: index.php?act=userIndex');
        exit;
    }
}
