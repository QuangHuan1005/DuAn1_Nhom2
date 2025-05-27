<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kết quả tìm kiếm sản phẩm</title>
  <!-- Bootstrap CSS CDN -->
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Header -->
  <header class="bg-primary text-white p-3">
    <div class="container">
      <h1 class="h3">Trang tìm kiếm sản phẩm</h1>
    </div>
  </header>

  <!-- Main content -->
  <main class="flex-fill">
    <div class="container my-4">
      <h2>Kết quả tìm kiếm cho: <em><?= htmlspecialchars($_GET['keyword'] ?? '') ?></em></h2>
      
      <?php if (!empty($products)): ?>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
          <?php foreach ($products as $product): ?>
            <div class="col">
              <div class="card h-100">
                <img src="<?= htmlspecialchars($product['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($product['name']) ?>">
                <div class="card-body d-flex flex-column">
                  <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                  <p class="card-text"><?= htmlspecialchars($product['description']) ?></p>
                  <p class="card-text mt-auto">
                    Giá: 
                    <?php if ($product['discount_price']): ?>
                      <span class="text-muted text-decoration-line-through"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                      <span class="fw-bold text-danger ms-2"><?= number_format($product['discount_price'], 0, ',', '.') ?>đ</span>
                    <?php else: ?>
                      <span class="fw-bold"><?= number_format($product['price'], 0, ',', '.') ?>đ</span>
                    <?php endif; ?>
                  </p>
                  <p class="card-text">Số lượng còn: <?= $product['stock_quantity'] ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p class="alert alert-warning mt-3">Không tìm thấy sản phẩm nào phù hợp.</p>
      <?php endif; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-auto">
    <div class="container">
      Bản quyền &copy; 2025
    </div>
  </footer>

  <!-- Bootstrap JS Bundle (Popper + JS) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
