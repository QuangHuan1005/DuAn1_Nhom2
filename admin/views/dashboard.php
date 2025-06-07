<?php
// Hàm định dạng tiền tệ
function formatCurrency($number)
{
    return number_format($number, 0, ',', '.') . ' đ';
}
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">


<!-- Mirrored from themesbrand.com/velzon/html/master/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Oct 2024 07:29:52 GMT -->

<head>
    <base href="/duan1_nhom2/admin/">
    <meta charset="utf-8" />
    <title>Dashboard | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- Bootstrap CSS -->
    <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Bundle JS -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!-- CSS -->
    <?php
    require_once "layouts/libs_css.php";
    ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
        <?php
        require_once "layouts/header.php";

        require_once "layouts/siderbar.php";
        ?>

        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">

                            <div class="h-100">
                                <h1>Thống kê tổng quan</h1>

                                <form method="get" class="row mb-4">
                                    <div class="col-md-4">
                                        <label for="start_date">Từ ngày</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="<?= $_GET['start_date'] ?? '' ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end_date">Đến ngày</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="<?= $_GET['end_date'] ?? '' ?>">
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button class="btn btn-primary w-100">Lọc dữ liệu</button>
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card text-white bg-success">
                                            <div class="card-body">
                                                <h5 class="card-title">💰 Doanh thu</h5>
                                                <p class="card-text fs-4"><?= number_format($revenue) ?> đ</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!-- Top 5 Sản Phẩm Bán Chạy -->
                                <div class="card mt-4 shadow">
                                    <div class="card-header bg-success text-white fw-bold">
                                        🔥 Top 5 Sản Phẩm Bán Chạy
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover table-bordered align-middle text-center">
                                            <thead class="table-success">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên</th>
                                                    <th>Ảnh</th>
                                                    <th>Giá</th>
                                                    <th>Đã bán</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($topSelling as $index => $product): ?>
                                                    <tr>
                                                        <td><?= $index + 1 ?></td>
                                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                                        <td>
                                                            <img src="/DuAn1_Nhom2/<?= $product['image_url'] ?>" alt="Ảnh" class="img-thumbnail" width="60">
                                                        </td>
                                                        <td><?= number_format($product['price']) ?> đ</td>
                                                        <td><span class="badge bg-danger"><?= $product['total_sold'] ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Top 5 Sản Phẩm Còn Nhiều Trong Kho -->
                                <div class="card mt-4 shadow">
                                    <div class="card-header bg-info text-white fw-bold">
                                        📦 Top 5 Sản Phẩm Còn Nhiều Trong Kho
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover table-bordered align-middle text-center">
                                            <thead class="table-info">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên</th>
                                                    <th>Ảnh</th>
                                                    <th>Giá</th>
                                                    <th>Tồn kho</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($topStock as $index => $product): ?>
                                                    <tr>
                                                        <td><?= $index + 1 ?></td>
                                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                                        <td>
                                                            <img src="/DuAn1_Nhom2/<?= $product['image_url'] ?>" alt="Ảnh" class="img-thumbnail" width="60">
                                                        </td>
                                                        <td><?= number_format($product['price']) ?> đ</td>
                                                        <td><span class="badge bg-secondary"><?= $product['stock_quantity'] ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <!-- Top 5 khách hàng -->
                                <div class="card mt-4">
                                    <div class="card-header bg-primary text-white">🏆 Top 5 Khách Hàng Mua Nhiều Nhất</div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Khách hàng</th>
                                                <th>Số đơn</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            <?php foreach ($topCustomers as $index => $customer): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= htmlspecialchars($customer['fullname']) ?></td>
                                                    <td><?= $customer['total_orders'] ?></td>
                                                    <td><?= number_format($customer['total_spent']) ?> đ</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>

                                <!-- Đơn hàng chờ xác nhận -->
                                <div class="card mt-4">
                                    <div class="card-header bg-warning">📋 Đơn Hàng Chờ Xác Nhận</div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered text-center">
                                            <tr>
                                                <th>#</th>
                                                <th>Mã đơn</th>
                                                <th>Khách hàng</th>
                                                <th>Ngày tạo</th>
                                                <th>Tổng tiền</th>
                                            </tr>
                                            <?php foreach ($pendingOrders as $i => $order): ?>
                                                <tr>
                                                    <td><?= $i + 1 ?></td>
                                                    <td><?= $order['order_code'] ?></td>
                                                    <td><?= $order['user_id'] ?></td>
                                                    <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                                    <td><?= number_format($order['total_amount']) ?> đ</td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>
                                    </div>
                                </div>







                            </div> <!-- end .h-100-->

                        </div> <!-- end col -->
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <?php
    require_once "layouts/libs_js.php";
    ?>

</body>

</html>