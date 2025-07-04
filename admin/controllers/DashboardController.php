<?php
require_once "models/ProductModel.php";
require_once "models/OrderModel.php";
class DashboardController
{
  protected $productModel;
  protected $orderModel;

  public function __construct()
  {
    $this->productModel = new ProductModel();
    $this->orderModel = new OrderModel();
  }
  public function index()
  {
    $startDate = $_GET['start_date'] ?? null;
    $endDate = $_GET['end_date'] ?? null;

    $revenue = $this->orderModel->getTotalRevenue($startDate, $endDate);
    $topCustomers = $this->orderModel->getTopCustomers($startDate, $endDate);
    $pendingOrders = $this->orderModel->getPendingOrders();
    $topSelling = $this->productModel->getTopSellingProducts();
    $topStock = $this->productModel->getTopStockProducts();

    // $chartData = $this->orderModel->getRevenueWeekdays($startDate, $endDate);

    // $labels = [];
    // $data = [];

    // foreach ($chartData as $row) {
    //   $date = date('d/m', strtotime($row['date']));
    //   $weekday = date('l', strtotime($row['date'])); // Monday, Tuesday,...
    //   $labels[] = $weekday . ' (' . $date . ')';
    //   $data[] = $row['revenue'];
    // }

    require_once __DIR__ . '/../views/dashboard.php';
  }
}
