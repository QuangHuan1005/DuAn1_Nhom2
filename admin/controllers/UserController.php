<?php
require_once './models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

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

    public function edit($id) {
        if ($id == 1) {
            $_SESSION['error'] = 'Không thể chỉnh sửa tài khoản chính.';
            header('Location: index.php?act=userIndex');
            exit;
        }

        $user = $this->userModel->get_detail($id);
        require_once './views/user/edit.php';
    }

    public function update($id) {
        if ($id == 1) {
            $_SESSION['error'] = 'Không thể cập nhật tài khoản chính.';
            header('Location: index.php?act=userIndex');
            exit;
        }

        $data = [
            'role' => $_POST['role'] ?? 'client',
            'status' => isset($_POST['status']) ? (int)$_POST['status'] : 1,
        ];

        $this->userModel->update($id, $data);

        $_SESSION['success'] = 'Cập nhật tài khoản thành công.';
        header('Location: index.php?act=userIndex');
        exit;
    }
}
