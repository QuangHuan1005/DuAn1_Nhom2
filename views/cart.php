<?php require_once './views/layouts/layout_top.php'; ?>

<h2>Giỏ hàng của bạn</h2>

<?php if (!empty($items)): ?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <form id="cart-form" method="POST" action="index.php?act=cart/update">
        <table class="table table-bordered align-middle text-center">
          <thead class="table-light">
            <tr>
              <th></th>
              <th>Hình ảnh</th>
              <th>Tên sản phẩm</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Tạm tính</th>
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
    <a href="index.php?act=cart/remove&id=<?= $item['id'] ?>" 
       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?');"
       class="text-danger fw-bold"
       style="text-decoration: none;">×</a>
</td>

              <td><img src="<?= htmlspecialchars($item['image_url']) ?>" width="80" /></td>
              <td><?= htmlspecialchars($item['name']) ?></td>
              <td class="price" data-price="<?= $item['price'] ?>"><?= number_format($item['price']) ?>đ</td>
              <td>
                <input type="number" 
                       name="quantities[<?= $item['id'] ?>]" 
                       value="<?= $item['quantity'] ?>" 
                       min="1" 
                       class="form-control quantity-input"
                       style="max-width: 80px; margin: auto;" />
              </td>
              <td class="subtotal"><?= number_format($subtotal) ?>đ</td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

       <div class="text-end d-flex justify-content-between">
  <a href="index.php?act=products" class="btn btn-secondary">← Tiếp tục mua sắm</a>
  <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
</div>

      </form>
    </div>

    <div class="col-md-4">
      <div class="card p-3">
        <h5 class="mb-3">Tổng cộng giỏ hàng</h5>
        <p>Tạm tính: <strong id="subtotal-price"><?= number_format($total) ?>đ</strong></p>
        <p>Tổng: <strong id="total-price"><?= number_format($total) ?>đ</strong></p>

        <a href="index.php?act=payment" class="btn btn-danger w-100 mb-3">Tiến hành thanh toán</a>

        <div>
          <label class="form-label">Mã ưu đãi</label>
          <input type="text" class="form-control" placeholder="Nhập mã giảm giá" />
          <button class="btn btn-outline-success w-100 mt-2">Áp dụng</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const inputs = document.querySelectorAll('.quantity-input');
  const subtotalElem = document.getElementById('subtotal-price');
  const totalElem = document.getElementById('total-price');

  function formatVND(n) {
    return n.toLocaleString('vi-VN') + 'đ';
  }

  function updateTotals() {
    let total = 0;
    inputs.forEach(input => {
      const tr = input.closest('tr');
      const price = parseInt(tr.querySelector('.price').dataset.price);
      let qty = parseInt(input.value);
      if (isNaN(qty) || qty < 1) qty = 1;
      const sub = price * qty;
      tr.querySelector('.subtotal').textContent = formatVND(sub);
      total += sub;
    });
    subtotalElem.textContent = formatVND(total);
    totalElem.textContent = formatVND(total);
  }

  inputs.forEach(input => {
    input.addEventListener('input', updateTotals);
  });
</script>

<?php else: ?>
  <p>Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>

<?php require_once './views/layouts/layout_bottom.php'; ?>
