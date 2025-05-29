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



    public function store() {
        $data = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'avatar' => $_FILES['avatar']['name'] ?? 'default.png',
            'password' => $_POST['password'],
            'role' => $_POST['role'],
            'fullname' => $_POST['fullname'] ?? null,
            'address' => $_POST['address'] ?? null,
        ];

        if (!empty($_FILES['avatar']['name'])) {
            move_uploaded_file($_FILES['avatar']['tmp_name'], './uploads/' . $data['avatar']);
        }

        $this->userModel->create($data);
        header('Location: index.php?act=userIndex');
        exit;
    }

    public function edit($id) {
        $user = $this->userModel->get_detail($id);
        require_once './views/user/edit.php';
    }

    public function update($id) {
    $avatar = $_POST['old_avatar']; 

    if (!empty($_FILES['avatar']['name'])) {
        $avatar = $_FILES['avatar']['name'];
        move_uploaded_file($_FILES['avatar']['tmp_name'], './uploads/' . $avatar);
    }

    $status = isset($_POST['status']) ? (int)$_POST['status'] : 1;

    $data = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'avatar' => $avatar,
        'role' => $_POST['role'],
        'status' => $status,  
    ];

    $this->userModel->update($id, $data);

    header('Location: index.php?act=userIndex');
    exit;
}

    
    public function delete($id) {
        $this->userModel->delete($id);
        header('Location: index.php?act=userIndex');
        exit;
    }

}