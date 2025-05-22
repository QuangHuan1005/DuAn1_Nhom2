<?php
require_once 'models/ProductModel.php';

class ProductController
{
    public function list()
    {
        $model = new ProductModel();
        $products = $model->getAllAvailable();
        require 'views/products/list.php';
    }
}
