<?php require_once './views/layouts/layout_top.php'; ?>

<?php if (!empty($items)): ?>

  <main class="bg_gray">
    <div class="container margin_30">
      <div class="page_header">
        <div class="breadcrumbs">
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Category</a></li>
            <li>Page active</li>
          </ul>
        </div>
        <!-- /page_header -->
        <form id="cart-form" method="POST" action="index.php?act=cart/update">
          <table class="table table-striped cart-list">
            <thead>
              <tr>
                <th>
                  Sản phẩm
                </th>
                <th>
                  Giá
                </th>
                <th>
                  Số lượng
                </th>
                <th>
                  Thành tiền
                </th>
                <th>

                </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $total = 0;
              foreach ($items as $item):
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
                ?>
                <tr>
                  <td>
                    <div class="thumb_cart">
                      <img src="<?= htmlspecialchars($item['image_url']) ?>" data-src="" class="lazy" alt="Image">
                    </div>
                    <span class="item_cart"><?= htmlspecialchars($item['name']) ?></span>
                  </td>
                  <td>
                    <strong><?= number_format($item['price']) ?>đ</strong>
                  </td>
                  <td>
                    <div class="numbers-row">
                      <input type="text" value="<?= $item['quantity'] ?>" min="1" id="quantity_1" class="qty2"
                        name="quantities[<?= $item['id'] ?>]">
                      <div class="inc button_inc">+</div>
                      <div class="dec button_inc">-</div>
                    </div>
                  </td>
                  <td>
                    <strong><?= number_format($subtotal) ?>đ</strong>
                  </td>
                  <td class="options">
                    <a href="index.php?act=cart/remove&id=<?= $item['id'] ?>"
                      onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');"><i class="ti-trash"></i></a>
                  </td>
                </tr>
              <?php endforeach; ?>

            </tbody>
          </table>


          <div class="row add_top_30 flex-sm-row-reverse cart_actions">
            <div class="col-sm-4 text-end">
              <button type="submit" class="btn_1 gray">Cập nhập giỏ hàng</button>
            </div>
            <!-- <div class="col-sm-8">
          <div class="apply-coupon">
            <div class="form-group">
              <div class="row g-2">
                <div class="col-md-6"><input type="text" name="coupon-code" value="" placeholder="Promo code"
                    class="form-control"></div>
                <div class="col-md-4"><button type="button" class="btn_1 outline">Apply Coupon</button></div>
      <h1>Giỏ hàng</h1>
    </div>


            <!-- /container -->

            <div class="box_cart">
              <div class="container">
                <div class="row justify-content-end">
                  <div class="col-xl-4 col-lg-4 col-md-6">
                    <ul>
                      <li><span>Tạm tính</span> <?= number_format($total) ?>đ</li>
                      <!-- <li><span>Phí ship</span> $7.00</li> -->
                      <li><span>Tổng</span> <?= number_format($total) ?>đ</li>
                    </ul>
                    <a href="index.php?act=payment" class="btn_1 full-width cart">Tiến hành thanh toán</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- /box_cart -->
</main>
<?php require_once './views/layouts/layout_bottom.php'; ?>

          <?php else: ?>

            <main class="bg_gray">
              <div class="container margin_30">
                <p>Giỏ hàng của bạn đang trống.</p>
              </div>
            </main>

          <?php endif; ?>

          <script>
            // JS xử lý update tổng tiền nếu muốn (có thể chỉnh lại tùy ý)
            const inputs = document.querySelectorAll('.quantity-input');

            function formatVND(n) {
              return n.toLocaleString('vi-VN') + 'đ';
            }

            function updateTotals() {
              let total = 0;
              inputs.forEach(input => {
                const tr = input.closest('tr');
                const priceText = tr.querySelector('td:nth-child(2) strong').textContent.replace(/[^\d]/g, '');
                const price = parseInt(priceText) || 0;
                let qty = parseInt(input.value);
                if (isNaN(qty) || qty < 1) qty = 1;
                const sub = price * qty;
                tr.querySelector('.subtotal strong').textContent = formatVND(sub);
                total += sub;
              });
              // Cập nhật tổng tiền trên giao diện
              document.querySelector('.box_cart ul li span').nextSibling.textContent = formatVND(total);
              document.querySelector('.box_cart ul li:nth-child(3) span').nextSibling.textContent = formatVND(total);
            }

            inputs.forEach(input => {
              input.addEventListener('input', updateTotals);
            });
          </script>