<?php
require './views/layouts/layout_top.php'; ?>
<main>
	<div class="top_banner">
		<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
			<div class="container">
				<div class="breadcrumbs">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Category</a></li>
						<li>Trang sản phẩm</li>
					</ul>
				</div>
				<!-- <h1>Trang sản phẩm</h1> -->
			</div>
		</div>
		<img src="./assets/allaia/img/bg_cat_shoes.jpg" class="img-fluid" alt="">
	</div>
	<!-- /top_banner -->

	<div id="stick_here"></div>
	<div class="toolbox elemento_stick">

	</div>
	<!-- /toolbox -->

	<div class="container margin_30">
		<div class="row small-gutters">

			<?php foreach ($products as $product): ?>
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<span class="ribbon off"> <?php
						$original = $product['price'] ?? 0;
						$discount = $product['discount_price'] ?? 0;
						$percent = 0;

						if ($original > 0 && $discount < $original) {
							$percent = round((($original - $discount) / $original) * 100);
						}
						?>

							<?php if ($percent > 0): ?>
								-<?= $percent ?>%
							<?php endif; ?></span>
						<figure>
							<a href="?act=product-detail&id=<?= $product['id'] ?>">
								<img class="img-fluid lazy" src="<?= $product['image_url'] ?>" data-src="" alt="">
							</a>
							<!-- <div data-countdown="2019/05/15" class="countdown"></div> -->
						</figure>
						<a href="?act=product-detail&id=<?= $product['id'] ?>">
							<h3><?= $product['name'] ?></h3>
						</a>
						<?php if ($product['category_active'] == 0 || $product['status'] == 0): ?>
							<div class="price_box">
								<span class="text-danger">Sản phẩm đã ngừng kinh doanh</span>
							</div>
							<!-- <button class="btn btn-secondary" disabled>Không thể mua</button> -->
						<?php else: ?>
							<div class="price_box">
								<?php if (!empty($product['discount_price']) && $product['discount_price'] < $product['price']): ?>
									<span class="new_price"><?= number_format($product['discount_price']) ?>₫</span>
									<span class="old_price"><del><?= number_format($product['price']) ?>₫</del></span>
								<?php else: ?>
									<span class="new_price"><?= number_format($product['price']) ?>₫</span>
								<?php endif; ?>
							</div>

						<?php endif; ?>

						<ul>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
									title="Add to favorites"><i class="ti-heart"></i><span>Add to
										favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
									title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to
										compare</span></a></li>
							<li>
								<form action="./?act=cart/add" method="post" style="display:inline;" class="tooltip-1"
									data-bs-toggle="tooltip" data-bs-placement="left" title="Add to cart">
									<input type="hidden" name="product_id" value="<?= $product['id'] ?>">
									<input type="hidden" name="quantity" value="1">
									<button type="submit" class="icon-btn" style="
			background: white; 
			border-radius: 5px; 
			border: 1px solid #ddd; 
			padding: 6px 10px; 
			cursor: pointer;
			">
										<i class="ti-shopping-cart"></i>
									</button>
								</form>
							</li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
			<?php endforeach; ?>
			<!-- /col -->



		</div>
		<!-- /row -->

		<div class="pagination__wrapper">
			<ul class="pagination">
				<?php if ($page > 1): ?>
					<li>
						<a href="?act=products&page=<?= $page - 1 ?>" class="prev" title="previous page">&#10094;</a>
					</li>
				<?php endif; ?>
				<?php for ($i = 1; $i <= $totalPages; $i++): ?>
					<?php if ($i == $page): ?>
						<li>
							<a href="" class="active"><?= $i ?></a>
						</li>
					<?php else: ?>
						<li>
							<a href="index.php?act=products&page=<?= $i ?>"><?= $i ?> </a>
						</li>
					<?php endif; ?>
				<?php endfor; ?>

				<?php if ($page < $totalPages): ?>
					<li>
						<a href="index.php?act=products&page=<?= $page + 1 ?>" class="next" title="next page">&#10095;</a>
					</li>

				<?php endif; ?>
			</ul>
		</div>

	</div>
	<!-- /container -->
</main>
<?php require './views/layouts/layout_bottom.php'; ?>