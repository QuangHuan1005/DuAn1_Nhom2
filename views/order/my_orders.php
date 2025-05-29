<?php
require './views/layouts/layout_top.php'; ?>

<?php if (count($orders) > 0): ?>

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
				<h1>Danh sách đơn hàng của bạn</h1>
			</div>
			<!-- /page_header -->
			<table class="table table-striped product-list mb-5">
				<thead>
					<tr>
						<th>
							Mã đơn hàng
						</th>
						<th>
							Giá
						</th>
						<!-- <th>
							Địa chỉ
						</th> -->
						<th>
							Trạng thái
						</th>
						<th>
							Ngày tạo
						</th>
						<th>

						</th>
					</tr>
				</thead>
				<?php foreach ($orders as $order): ?>
					<tbody>
						<tr>
							<td>
								<!-- <div class="thumb_product">
									<img src="img/products/product_placeholder_square_small.jpg"
										data-src="img/products/shoes/1.jpg" class="lazy" alt="Image">
								</div> -->
								<span class="item_product"><!-- <a href="#"> -->
									#ew33r<?= $order['id'] ?>
							</td>
							<td>
								<strong><?= number_format($order['total_amount']) ?>₫</strong>
							</td>
							<!-- <td>
								<strong><?= $order['shipping_address'] ?></strong>
							</td> -->
							<?php if ($order['status_id'] == 1): ?>
								<td>
									<span class="badge rounded-pill bg-warning">Đang xử lý</span>
								</td>
							<?php elseif ($order['status_id'] == 2): ?>
								<td>
									<span class="badge rounded-pill bg-success">Hoàn thành</span>
								</td>
							<?php endif; ?>

							<td>
								<strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></strong>
							</td>
							<td>
								<a href="?act=order_detail">Xem chi tiết</a>
							</td>
						</tr>
					</tbody>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<p>Bạn chưa có đơn hàng nào.</p>
		<?php endif; ?>
		</table>
	</div>
	<!-- /container -->
</main>