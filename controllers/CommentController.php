<?php

require_once "models/User.php";
require_once "models/ProductModel.php";
require_once "models/CategoryModel.php";
require_once "models/OrderModel.php";
require_once "models/CommentModel.php";


class CommentController {
    public function add() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?act=login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_SESSION['user']['id'];
            $product_id = $_POST['product_id'];
            $content = trim($_POST['content']);

            if (!empty($content)) {
                $model = new CommentModel();
                $model->addComment($user_id, $product_id, $content);
            }

            header("Location: index.php?act=product-detail&id=" . $product_id);
        }
    }
}
