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
						<li>Page active</li>
					</ul>
				</div>
				<h1>Shoes - Grid listing</h1>
			</div>
		</div>
		<img src="./assets/allaia/img/bg_cat_shoes.jpg" class="img-fluid" alt="">

	</div>
	<!-- /top_banner -->

	<div id="stick_here"></div>
	<div class="toolbox elemento_stick">
		<div class="container">
			<ul class="clearfix">
				<li>
					<div class="sort_select">
						<select name="sort" id="sort">
							<option value="popularity" selected="selected">Sort by popularity</option>
							<option value="rating">Sort by average rating</option>
							<option value="date">Sort by newness</option>
							<option value="price">Sort by price: low to high</option>
							<option value="price-desc">Sort by price: high to
						</select>
					</div>
				</li>
				<li>
					<a href="#0"><i class="ti-view-grid"></i></a>
					<a href="listing-row-1-sidebar-left.html"><i class="ti-view-list"></i></a>
				</li>
				<li>
					<a data-bs-toggle="collapse" href="#filters" role="button" aria-expanded="false"
						aria-controls="filters">
						<i class="ti-filter"></i><span>Filters</span>
					</a>
				</li>
			</ul>
			<div class="collapse" id="filters">
				<div class="row small-gutters filters_listing_1">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="dropdown">
							<a href="#" data-bs-toggle="dropdown" class="drop">Categories</a>
							<div class="dropdown-menu">
								<div class="filter_type">
									<ul>
										<li>
											<label class="container_check">Men <small>12</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Women <small>24</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Running <small>23</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Training <small>11</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
									</ul>
									<a href="#0" class="apply_filter">Apply</a>
								</div>
							</div>
						</div>
						<!-- /dropdown -->
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="dropdown">
							<a href="#" data-bs-toggle="dropdown" class="drop">Color</a>
							<div class="dropdown-menu">
								<div class="filter_type">
									<ul>
										<li>
											<label class="container_check">Blue <small>06</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Red <small>12</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Orange <small>17</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Black <small>43</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
									</ul>
									<a href="#0" class="apply_filter">Apply</a>
								</div>
							</div>
						</div>
						<!-- /dropdown -->
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="dropdown">
							<a href="#" data-bs-toggle="dropdown" class="drop">Brand</a>
							<div class="dropdown-menu">
								<div class="filter_type">
									<ul>
										<li>
											<label class="container_check">Adidas <small>11</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Nike <small>08</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Vans <small>05</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">Puma <small>18</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
									</ul>
									<a href="#0" class="apply_filter">Apply</a>
								</div>
							</div>
						</div>
						<!-- /dropdown -->
					</div>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="dropdown">
							<a href="#" data-bs-toggle="dropdown" class="drop">Price</a>
							<div class="dropdown-menu">
								<div class="filter_type">
									<ul>
										<li>
											<label class="container_check">$0 — $50<small>11</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">$50 — $100<small>08</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">$100 — $150<small>05</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
										<li>
											<label class="container_check">$150 — $200<small>18</small>
												<input type="checkbox">
												<span class="checkmark"></span>
											</label>
										</li>
									</ul>
									<a href="#0" class="apply_filter">Apply</a>
								</div>
							</div>
						</div>
						<!-- /dropdown -->

					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /toolbox -->

	<div class="container margin_30">
		<div class="row small-gutters">

			<?php foreach ($products as $product): ?>
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<span class="ribbon off">-30%</span>
						<figure>
							<a href="?act=product-detail&id=<?= $product['id'] ?>">
								<img class="img-fluid lazy" src="<?= $product['image_url'] ?>" data-src="" alt="">
							</a>
							<div data-countdown="2019/05/15" class="countdown"></div>
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
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
									title="Add to cart"><i class="ti-shopping-cart"></i><span>Add to cart</span></a>
							</li>
						</ul>
					</div>
					<!-- /grid_item -->
				</div>
			<?php endforeach; ?>
			<!-- /col -->


		</div>
		<!-- /row -->

		<!-- <div class="pagination__wrapper">
			<ul class="pagination">
				<li><a href="#0" class="prev" title="previous page">&#10094;</a></li>
				<li>
					<a href="#0" class="active">1</a>
				</li>
				<li>
					<a href="#0">2</a>
				</li>
				<li>
					<a href="#0">3</a>
				</li>
				<li>
					<a href="#0">4</a>
				</li>
				<li><a href="#0" class="next" title="next page">&#10095;</a></li>																							
			</ul>
		</div> -->

	</div>
	<!-- /container -->
</main>
<?php require './views/layouts/layout_bottom.php'; ?>
