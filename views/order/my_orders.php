<?php
require './views/layouts/layout_top.php'; ?>
<?php if (!empty($orders) && count($orders) > 0): ?>
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
						<th>
							Trạng thái đơn hàng
						</th>
						<th>
							Tình trạng thanh toán
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
								<div class="thumb_product">
									<img src="./assets/allaia/img/products/shoes/2.jpg" data-src="" class="lazy" alt="Image">
								</div>
								<span class="item_product"><a href="?act=order_detail&id=<?= $order['id'] ?>">
										#<?= $order['order_code'] ?>
							</td>
							<td>
								<strong><?= number_format($order['total_amount'] + 30000) ?>₫</strong>
							</td>
							<!-- <td>
								<strong><?= $order['shipping_address'] ?></strong>
							</td> -->
							<?php
							$status_id = $order['status_id'];
							$statusMap = [
								1 => ['class' => 'bg-warning'],
								2 => ['class' => 'bg-secondary'],
								3 => ['class' => 'bg-info'],
								4 => ['class' => 'bg-primary'],
								5 => ['class' => 'bg-danger'],
								6 => ['class' => 'bg-success'],
							];

							if (isset($statusMap[$status_id])): ?>
								<td>
									<span class="badge rounded-pill <?= $statusMap[$status_id]['class'] ?>">
										<?= $order['status_name'] ?>

									</span>
								</td>
							<?php endif; ?>


							<td>
								<span class="badge rounded-pill bg-warning"><?= ($order['payment_status']) ?></span>
							</td>


							<td>
								<strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></strong>
							</td>
							<td>
							<td class="options">
								<a href="index.php?act=order_detail&id=<?= $order['id'] ?>" title="Xem chi tiết">
									<i class="ti-eye text-info"></i>
								</a>

								<?php
								// Danh sách trạng thái được phép hủy
								$cancelable_statuses = ['1', '2'];
								?>
								<?php if (in_array($order['status_id'], $cancelable_statuses)): ?>
									<!-- Cho phép hủy đơn hàng -->
									<form action="index.php?act=my_orders_complete" method="POST"
										onsubmit="return confirm('Bạn chắc chắn muốn hủy đơn hàng?');" style="display:inline;">
										<input type="hidden" name="order_id" value="<?= $order['id'] ?>">
										<button type="submit" class="btn" style="background:none; border:none; padding:0;"
											title="Hủy đơn hàng">
											<i class="ti-trash text-danger"></i>
										</button>
									</form>
								<?php else: ?>
									<!-- Không cho phép hủy -->
									<a href="#"
										onclick="alert('Đơn hàng đang được giao hoặc đã giao, không thể hủy.'); return false;"
										title="Không thể hủy đơn hàng">
										<i class="ti-trash text-muted"></i>
									</a>
								<?php endif; ?>

							</td>
						</tr>
					</tbody>
				<?php endforeach; ?>

			</table>
			<div class="pagination__wrapper">
				<ul class="pagination">
					<?php if ($page > 1): ?>
						<li>
							<a href="index.php?act=my_orders&page=<?= $page - 1 ?>" class="prev"
								title="previous page">&#10094;</a>
						</li>
					<?php endif; ?>
					<?php for ($i = 1; $i <= $totalPages; $i++): ?>
						<?php if ($i == $page): ?>
							<li>
								<a href="" class="active"><?= $i ?></a>
							</li>
						<?php else: ?>
							<li>
								<a href="index.php?act=my_orders&page=<?= $i ?>"><?= $i ?> </a>
							</li>
						<?php endif; ?>
					<?php endfor; ?>

					<?php if ($page < $totalPages): ?>
						<li>
							<a href="index.php?act=my_orders&page=<?= $page + 1 ?>" class="next" title="next page">&#10095;</a>
						</li>

					<?php endif; ?>
				</ul>
			</div>
		</div>
		<!-- /container -->
	</main>
<?php else: ?>
	<p>Không có đơn hàng nào.</p>
<?php endif; ?>


<?php require_once './views/layouts/layout_bottom.php'; ?>