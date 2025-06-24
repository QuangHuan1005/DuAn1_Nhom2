<?php require_once './views/layouts/layout_top.php'; ?>


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
      <h1>Thanh toán</h1>

    </div>
    <!-- /page_header -->
    <form action="index.php?act=payment" method="POST" id="checkout-form" novalidate>
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="step first">
            <h3>1. Thông tin người dùng và địa chỉ thanh toán</h3>
            <!-- <ul class="nav nav-tabs" id="tab_checkout" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#tab_1" role="tab"
                aria-controls="tab_1" aria-selected="true">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2"
                aria-selected="false">Login</a>
            </li>
          </ul> -->
            <div class="tab-content checkout">
              <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
                <!-- <div class="form-group">
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" placeholder="Password">
              </div> -->
                <hr>
                <div class="row no-gutters">
                  <div class="col-6 form-group pr-1">
                    <input type="text" name="fullname"
                      class="form-control <?= !empty($errors['fullname']) ? 'is-invalid' : '' ?>" class="form-control"
                      placeholder="Họ và tên " value="<?= htmlspecialchars($oldInput['fullname'] ?? '') ?>" required>
                    <div class="invalid-feedback"><?= $errors['fullname'] ?? 'Vui lòng nhập họ và tên.' ?></div>
                  </div>
                  <div class="col-6 form-group pl-1">
                    <input type="tel" name="phone" class="form-control" placeholder="Số điện thoại"
                      pattern="^[0-9]{9,15}$" value="<?= htmlspecialchars($oldInput['phone'] ?? '') ?>" required>
                    <div class="invalid-feedback">
                      <?= $errors['phone'] ?? 'Vui lòng nhập số điện thoại hợp lệ (9-15 chữ số).' ?>
                    </div>
                  </div>
                </div>
                <!-- /row -->

                <div class="form-group">
                  <input type="email" class="form-control <?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
                    id="email" name="email" placeholder="Nhập địa chỉ email"
                    value="<?= htmlspecialchars($oldInput['email'] ?? '') ?>" required>
                  <div class="invalid-feedback"><?= $errors['email'] ?? 'Vui lòng nhập địa chỉ email hợp lệ.' ?></div>
                </div>

                <!-- <div class="row no-gutters">
                <div class="col-6 form-group pr-1">
                  <input type="text" class="form-control" placeholder="City">
                </div>
                <div class="col-6 form-group pl-1">
                  <input type="text" class="form-control" placeholder="Postal code">
                </div>
              </div> -->
                <!-- /row -->
                <div class="row no-gutters">
  <div class="col-md-12 form-group">
    <div class="custom-select-form">
      <select class="wide add_bottom_15 <?= !empty($errors['province']) ? 'is-invalid' : '' ?>"
        id="province" name="province" required>
        <option value="">Chọn Tỉnh/Thành phố</option>
        <option value="Hà Nội" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hà Nội') ? 'selected' : '' ?>>Hà Nội</option>
        <option value="Hồ Chí Minh" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Hồ Chí Minh') ? 'selected' : '' ?>>Hồ Chí Minh</option>
        <option value="Đà Nẵng" <?= (isset($oldInput['province']) && $oldInput['province'] === 'Đà Nẵng') ? 'selected' : '' ?>>Đà Nẵng</option>
      </select>
      <div class="invalid-feedback"><?= $errors['province'] ?? 'Vui lòng chọn Tỉnh/Thành phố.' ?></div>
    </div>
  </div>
</div>

<div class="row no-gutters">
  <div class="col-md-12 form-group">
    <div class="custom-select-form">
      <select class="wide add_bottom_15 <?= !empty($errors['district']) ? 'is-invalid' : '' ?>"
        id="district" name="district" required>
        <option value="">Chọn Quận/Huyện</option>
        <!-- Options sẽ được thêm bằng JavaScript -->
      </select>
      <div class="invalid-feedback"><?= $errors['district'] ?? 'Vui lòng chọn Quận/Huyện.' ?></div>
    </div>
  </div>
</div>

<div class="form-group">
  <input type="text" class="form-control <?= !empty($errors['address']) ? 'is-invalid' : '' ?>"
    id="address" name="address" placeholder="Số nhà, tên đường..."
    value="<?= htmlspecialchars($oldInput['address'] ?? '') ?>" required>
  <div class="invalid-feedback"><?= $errors['address'] ?? 'Vui lòng nhập địa chỉ chi tiết.' ?></div>
</div>

              </div>
            </div>
          </div>
          <!-- /step -->
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="step middle payments">
            <h3>2. Thanh toán và Vận chuyển</h3>
            <ul>
              <!-- <li>
              <label class="container_radio">Credit Card<a href="#0" class="info" data-bs-toggle="modal"
                  data-bs-target="#payments_method"></a>
                <input type="radio" name="payment" checked>
                <span class="checkmark"></span>
              </label>
            </li>
            <li>
              <label class="container_radio">Paypal<a href="#0" class="info" data-bs-toggle="modal"
                  data-bs-target="#payments_method"></a>
                <input type="radio" name="payment">
                <span class="checkmark"></span>
              </label>
            </li> -->
              <li>
                <label class="container_radio">Thanh toán khi nhận hàng (COD)<a href="#0" class="info"
                    data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                  <input type="radio" name="payment_method" id="cod" value="cod" <?= (empty($oldInput['payment_method']) || $oldInput['payment_method'] === 'cod') ? 'checked' : '' ?>>
                  <span class="checkmark"></span>
                </label>
              </li>
              <!-- <li>
              <label class="container_radio">Bank Transfer<a href="#0" class="info" data-bs-toggle="modal"
                  data-bs-target="#payments_method"></a>
                <input type="radio" name="payment">
                <span class="checkmark"></span>
              </label>
            </li> -->
            </ul>
            <!-- <div class="payment_info d-none d-sm-block">
            <figure><img src="img/cards_all.svg" alt=""></figure>
            <p>Sensibus reformidans interpretaris sit ne, nec errem nostrum et, te nec meliore philosophia. At vix
              quidam periculis. Solet tritani ad pri, no iisque definitiones sea.</p>
          </div> -->

            <h6 class="pb-2">Phương thức vận chuyển</h6>


            <ul>
              <li>
                <label class="container_radio">Standard shipping<a href="#0" class="info" data-bs-toggle="modal"
                    data-bs-target="#payments_method"></a>
                  <input type="radio" name="shipping" checked>
                  <span class="checkmark"></span>
                </label>
              </li>
              <li>
                <label class="container_radio">Express shipping<a href="#0" class="info" data-bs-toggle="modal"
                    data-bs-target="#payments_method"></a>
                  <input type="radio" name="shipping">
                  <span class="checkmark"></span>
                </label>
              </li>

              <!-- Cột phải: Thông tin đơn hàng + thanh toán -->
              <!-- <div class="col-md-6">
                <div class="card p-3 shadow-sm mb-3">
                  <h5 class="mb-3">Đơn hàng của bạn</h5>
                  <table class="table table-bordered align-middle text-center mb-0">
                    <thead class="table-light">
                      <tr>
                        <th class="text-start">Sản phẩm</th>
                        <th>Tạm tính</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total = 0;
                      if (!empty($items) && is_array($items)):
                        foreach ($items as $item):
                          $subtotal = $item['price'] * $item['quantity'];
                          $total += $subtotal;
                          ?>
                          <tr>
                            <td class="text-start"><?= htmlspecialchars($item['name']) ?> × <?= intval($item['quantity']) ?>
                            </td>
                            <td><?= number_format($subtotal, 0, ',', '.') ?> ₫</td>
                          </tr>
                          <?php
                        endforeach;
                      else:
                        ?>
                        <tr>
                          <td colspan="2">Giỏ hàng trống.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="text-start">Tạm tính</th>
                        <td class="text-center"><?= number_format($total, 0, ',', '.') ?> ₫</td>
                      </tr>
                      <tr>
                        <th class="text-start">Phí vận chuyển</th>
                        <td class="text-center">30.000 ₫</td>
                      </tr>
                      <tr>
                        <th class="text-start">Tổng</th>
                        <td class="text-center"><strong><?= number_format($total + 30000, 0, ',', '.') ?> ₫</strong>
                        </td>
                      </tr>
                    </tfoot>


                  </table>
                </div> -->
            </ul>

          </div>
          <!-- /step -->

        </div>
        <div class="col-lg-4 col-md-6">
          <div class="step last">
            <h3>3. Tóm tắt đơn hàng</h3>
            <div class="box_general summary">
              <tbody>

                <ul>
                  <?php
                  $total = 0;
                  if (!empty($items) && is_array($items)):
                    foreach ($items as $item):
                      $subtotal = $item['price'] * $item['quantity'];
                      $total += $subtotal;
                      ?>
                      <li class="clearfix">
                        <em><?= intval($item['quantity']) ?>x - <?= htmlspecialchars($item['name']) ?></em>
                        <span><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> ₫</span>
                      </li>
                      <?php
                    endforeach;
                  else:
                    ?>
                    <tr>
                      <td colspan="2">Giỏ hàng trống.</td>
                    </tr>
                  </ul>
                <?php endif; ?>
                <ul>
                  <li class="clearfix"><em><strong>Tạm tính</strong></em>
                    <span><?= number_format($total, 0, ',', '.') ?> ₫</span>
                  </li>
                  <li class="clearfix"><em><strong>Phí vận chuyển</strong></em> <span>30.000 ₫</span></li>

                </ul>
                <div class="total clearfix">Tổng <span><?= number_format($total + 30000, 0, ',', '.') ?> ₫</span></div>
                <div class="form-group">
                  <!-- <label class="container_check">Register to the Newsletter.
                <input type="checkbox" checked>
                <span class="checkmark"></span> -->
                  </label>
                </div>

                <!-- <a href="confirm.html" class="btn_1 full-width">Confirm and Pay</a> -->
                <button type="submit" class="btn btn-danger w-100">Đặt hàng</button>

            </div>
            <!-- /box_general -->
          </div>
          <!-- /step -->
        </div>
      </div>
    </form>
    <!-- /row -->
  </div>
  <!-- /container -->
</main>
<?php if (!empty($_SESSION['order_success'])): ?>
  <div class="alert alert-success">
    <?= htmlspecialchars($_SESSION['order_success']) ?>
  </div>
  <?php unset($_SESSION['order_success']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['order_error'])): ?>
  <div class="alert alert-danger">
    <?= htmlspecialchars($_SESSION['order_error']) ?>
  </div>
  <?php unset($_SESSION['order_error']); ?>
<?php endif; ?>

<?php require_once './views/layouts/layout_bottom.php'; ?>

</section>
<script>
  (function () {
    const districtsByProvince = {
      "Hà Nội": ["Quận Ba Đình", "Quận Hoàn Kiếm", "Quận Đống Đa"],
      "Hồ Chí Minh": ["Quận 1", "Quận 3", "Quận 5"],
      "Đà Nẵng": ["Quận Hải Châu", "Quận Thanh Khê", "Quận Sơn Trà"]
    };

    const provinceSelect = document.getElementById('province');
    const districtSelect = document.getElementById('district');

    // Hàm cập nhật dropdown Quận/Huyện theo Tỉnh/Thành phố
    function updateDistricts() {
      const selectedProvince = provinceSelect.value;
      const districts = districtsByProvince[selectedProvince] || [];

      districtSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
      districts.forEach(d => {
        const opt = document.createElement('option');
        opt.value = d;
        opt.textContent = d;
        districtSelect.appendChild(opt);
      });

      // Giữ lại giá trị cũ nếu có
      const oldDistrict = <?= json_encode($oldInput['district'] ?? '') ?>;
      if (oldDistrict) {
        districtSelect.value = oldDistrict;
      }
    }

    provinceSelect.addEventListener('change', updateDistricts);
  });
  // Khởi tạo khi load trang
  updateDistricts();

  (() => {
    'use strict';
    const form = document.getElementById('checkout-form');

    form.addEventListener('submit', function (event) {
      // Reset lại trạng thái validation
      [...form.elements].forEach(el => {
        el.classList.remove('is-invalid');
      });

      let valid = true;

      // Kiểm tra fullname
      const fullname = form.fullname.value.trim();
      if (!fullname) {
        valid = false;
        form.fullname.classList.add('is-invalid');
      }

      // Kiểm tra phone với regex
      const phone = form.phone.value.trim();
      const phonePattern = /^[0-9]{9,15}$/;
      if (!phonePattern.test(phone)) {
        valid = false;
        form.phone.classList.add('is-invalid');
      }

      // Kiểm tra email
      const email = form.email.value.trim();
      const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailPattern.test(email)) {
        valid = false;
        form.email.classList.add('is-invalid');
      }

      // Kiểm tra province
      if (!form.province.value) {
        valid = false;
        form.province.classList.add('is-invalid');
      }

      // Kiểm tra district
      if (!form.district.value) {
        valid = false;
        form.district.classList.add('is-invalid');
      }

      // Kiểm tra address
      const address = form.address.value.trim();
      if (!address) {
        valid = false;
        form.address.classList.add('is-invalid');
      }

      if (!valid) {
        event.preventDefault();
        event.stopPropagation();
      }
    });
  })();
</script>
<?php require './views/layouts/layout_bottom.php'; ?>
