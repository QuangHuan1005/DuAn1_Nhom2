<?php
require './views/layouts/layout_top.php'; ?>
<main>

	<div id="carousel-home">
		<div class="owl-carousel owl-theme">
			<div class="owl-slide cover" style="background-image: url(./assets/allaia/img/slides/slide_home_2.jpg);">
				<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
					<div class="container">
						<div class="row justify-content-center justify-content-md-end">
							<div class="col-lg-6 static">
								<div class="slide-text text-end white">
									<h2 class="owl-slide-animated owl-slide-title"></h2>
									<p class="owl-slide-animated owl-slide-subtitle">
										
									</p>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/owl-slide-->
			<div class="owl-slide cover" style="background-image: url(./assets/allaia/img/slides/slide_home_1.jpg);">
				<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
					<div class="container">
						<div class="row justify-content-center justify-content-md-start">
							<div class="col-lg-6 static">
								<div class="slide-text white">
									<h2 class="owl-slide-animated owl-slide-title">Attack Air<br>VaporMax Flyknit 3</h2>
									<p class="owl-slide-animated owl-slide-subtitle">
										Limited items available at this price
									</p>
									<div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
											href="listing-grid-1-full.html" role="button">Shop Now</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/owl-slide-->
			<div class="owl-slide cover" style="background-image: url(./assets/allaia/img/slides/slide_home_3.jpg);">
				<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(255, 255, 255, 0.5)">
					<div class="container">
						<div class="row justify-content-center justify-content-md-start">
							<div class="col-lg-12 static">
								<div class="slide-text text-center black">
									<h2 class="owl-slide-animated owl-slide-title">Attack Air<br>Monarch IV SE</h2>
									<p class="owl-slide-animated owl-slide-subtitle">
										Lightweight cushioning and durable support with a Phylon midsole
									</p>
									<div class="owl-slide-animated owl-slide-cta"><a class="btn_1"
											href="listing-grid-1-full.html" role="button">Shop Now</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/owl-slide-->
			</div>
		</div>
		<div id="icon_drag_mobile"></div>
	</div>

	<div class="container margin_60_35">
		<div class="main_title">
			<h2>Mới nhất</h2>
			<span>Sản phẩm</span>
		</div>

		<div class="row small-gutters">
			<?php foreach ($bestsellers as $product): ?>
				<div class="col-6 col-md-4 col-xl-3">
					<div class="grid_item">
						<figure>
							<!-- <span class="ribbon off">-30%</span> -->
							<a href="?act=product-detail&id=<?= $product['id'] ?>">
								<img class="img-fluid lazy" src="<?= $product['image_url'] ?>" data-src="" alt=""
									width="400" height="400">
							</a>
							<!-- <div data-countdown="2025/05/25" class="countdown"></div> -->
						</figure>
						<!-- <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
								class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div> -->
						<a href="?act=product-detail&id=<?= $product['id'] ?>">
							<h3><?= $product['name'] ?></h3>
						</a>
						<div class="price_box">
							<?php if (!empty($product['discount_price']) && $product['discount_price'] < $product['price']): ?>
								<span class="new_price"><?= number_format($product['discount_price']) ?>₫</span>
								<span class="old_price"><del><?= number_format($product['price']) ?>₫</del></span>
							<?php else: ?>
								<span class="new_price"><?= number_format($product['price']) ?>₫</span>
							<?php endif; ?>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
									title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
									title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
							</li>
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
	</div>
	<!-- /container -->

	<div class="featured lazy" data-bg="url(./assets/allaia/img/slides/slide_home_1.jpg)">
		<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container margin_60">
				<div class="row justify-content-center justify-content-md-start">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<h3>Armor<br>Air Color 720</h3>
						<p>Lightweight cushioning and durable support with a Phylon midsole</p>
						<div class="feat_text_block">
							<div class="price_box">
								<span class="new_price">$90.00</span>
								<span class="old_price">$170.00</span>
							</div>
							<a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /featured -->

	<div class="container margin_60_35">
		<div class="main_title">
			<h2>Nổi bật</h2>
			<span>Sản phẩm</span>
		</div>
		<div class="owl-carousel owl-theme products_carousel">
			<?php foreach ($featureds as $product): ?>

				<div class="item">
					<div class="grid_item">
						<span class="ribbon new">New</span>
						<figure>
							<a href="?act=product-detail&id=<?= $product['id'] ?>">
								<img class="owl-lazy img-fluid" src="<?= $product['image_url'] ?>" data-src="" alt=""
									width="400" height="400">
							</a>
						</figure>
						<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i
								class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div>
						<a href="?act=product-detail&id=<?= $product['id'] ?>">
							<h3><?= $product['name'] ?></h3>
						</a>
						<div class="price_box">
							<?php if (!empty($product['discount_price']) && $product['discount_price'] < $product['price']): ?>
								<span class="new_price"><?= number_format($product['discount_price']) ?>₫</span>
								<span class="old_price"><del><?= number_format($product['price']) ?>₫</del></span>
							<?php else: ?>
								<span class="new_price"><?= number_format($product['price']) ?>₫</span>
							<?php endif; ?>
						</div>
						<ul>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
									title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
							<li><a href="#0" class="tooltip-1" data-bs-toggle="tooltip" data-bs-placement="left"
									title="Add to compare"><i class="ti-control-shuffle"></i><span>Add to compare</span></a>
							</li>
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
			<!-- /item -->
			<!-- /item -->
		</div>
		<!-- /products_carousel -->
	</div>
	<!-- /container -->

	<div class="bg_gray">
		<div class="container margin_30">
			<div id="brands" class="owl-carousel owl-theme">
				<div class="item">
					<a href="#0"><img src="./assets/allaia/img/brands/placeholder_brands.png"
							data-src="./assets/allaia/img/brands/logo_1.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="./assets/allaia/img/brands/placeholder_brands.png"
							data-src="./assets/allaia/img/brands/logo_2.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="./assets/allaia/img/brands/placeholder_brands.png"
							data-src="./assets/allaia/img/brands/logo_3.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="./assets/allaia/img/brands/placeholder_brands.png"
							data-src="./assets/allaia/img/brands/logo_4.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="./assets/allaia/img/brands/placeholder_brands.png"
							data-src="./assets/allaia/img/brands/logo_5.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
				<div class="item">
					<a href="#0"><img src="./assets/allaia/img/brands/placeholder_brands.png"
							data-src="./assets/allaia/img/brands/logo_6.png" alt="" class="owl-lazy"></a>
				</div><!-- /item -->
			</div><!-- /carousel -->
		</div><!-- /container -->
	</div>
	<!-- /bg_gray -->

	<div class="container margin_60_35">
		<div class="main_title">
			<h2>Tin tức mới nhất</h2>
			<span>Blog</span>
			<!-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset</p> -->
		</div>
		<div class="row">
			<div class="col-lg-6">
				<a class="box_news" href="blog.html">
					<figure>
						<img src="./assets/allaia/img/blog-thumb-placeholder.jpg"
							data-src="./assets/allaia/img/blog-thumb-1.jpg" alt="" width="400" height="266"
							class="lazy">
						<figcaption><strong>28</strong>Dec</figcaption>
					</figure>
					<ul>
						<li>by Mark Twain</li>
						<li>20.11.2017</li>
					</ul>
					<h4>Pri oportere scribentur eu</h4>
					<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
						vidisse....</p>
				</a>
			</div>
			<!-- /box_news -->
			<div class="col-lg-6">
				<a class="box_news" href="blog.html">
					<figure>
						<img src="./assets/allaia/img/blog-thumb-placeholder.jpg"
							data-src="./assets/allaia/img/blog-thumb-2.jpg" alt="" width="400" height="266"
							class="lazy">
						<figcaption><strong>28</strong>Dec</figcaption>
					</figure>
					<ul>
						<li>By Jhon Doe</li>
						<li>20.11.2017</li>
					</ul>
					<h4>Duo eius postea suscipit ad</h4>
					<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
						vidisse....</p>
				</a>
			</div>
			<!-- /box_news -->
			<div class="col-lg-6">
				<a class="box_news" href="blog.html">
					<figure>
						<img src="./assets/allaia/img/blog-thumb-placeholder.jpg"
							data-src="./assets/allaia/img/blog-thumb-3.jpg" alt="" width="400" height="266"
							class="lazy">
						<figcaption><strong>28</strong>Dec</figcaption>
					</figure>
					<ul>
						<li>By Luca Robinson</li>
						<li>20.11.2017</li>
					</ul>
					<h4>Elitr mandamus cu has</h4>
					<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
						vidisse....</p>
				</a>
			</div>
			<!-- /box_news -->
			<div class="col-lg-6">
				<a class="box_news" href="blog.html">
					<figure>
						<img src="./assets/allaia/img/blog-thumb-placeholder.jpg"
							data-src="./assets/allaia/img/blog-thumb-4.jpg" alt="" width="400" height="266"
							class="lazy">
						<figcaption><strong>28</strong>Dec</figcaption>
					</figure>
					<ul>
						<li>By Paula Rodrigez</li>
						<li>20.11.2017</li>
					</ul>
					<h4>Id est adhuc ignota delenit</h4>
					<p>Cu eum alia elit, usu in eius appareat, deleniti sapientem honestatis eos ex. In ius esse ullum
						vidisse....</p>
				</a>
			</div>
			<!-- /box_news -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</main>
<?php require_once './views/layouts/layout_bottom.php'; ?>
<!-- /main -->