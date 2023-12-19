<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="header__nav d-none d-lg-flex" data-js-position-desktop="menu">
		<nav class="menu js-menu js-position" data-js-position-name="menu">

		<ul class="menu__panel menu__list menu__level-01 d-flex flex-column flex-lg-row flex-lg-wrap menu__panel--bordered list-unstyled">
			<div class="menu__curtain d-none position-lg-absolute"></div>
			<?
			$previousLevel = 0;
			foreach($arResult as $arItem):?>

			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</li></ul>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]):?>

				<li class="<?if ($arItem["SELECTED"]):?>active <?endif?>menu__item menu__item--has-children">

					<a href="<?=$arItem["LINK"]?>" class="d-flex align-items-center px-lg-7">
						<span><?=$arItem["TEXT"]?></span> 
						<i class="d-none d-lg-inline position-lg-relative">
							<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-229" viewBox="0 0 24 24">
								<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z" />
							</svg>
						</i>
						<i class="d-lg-none ml-auto">
							<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-231" viewBox="0 0 24 24">
								<path d="M10.806 7.232l3.75 3.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .877.877 0 0 1-.215-.127.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l3.32-3.301L9.907 8.13a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.058.45.176z" />
							</svg>
						</i>
					</a>
					<div class="menu__megamenu d-lg-none position-lg-absolute">
						<div class="container py-lg-40">
							<ul class="menu__grid menu__list menu__level-02 row">


								<div class="menu__item menu__back d-lg-none"><a href="collection.html">Shop</a></div>
								<div class="menu__item menu__item--has-children col-lg-2">

									<a href="collection.html" class="menu__title d-flex align-items-center mb-lg-10"><span>Collection Layouts</span>
										<i class="d-lg-none ml-auto">
											<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-231" viewBox="0 0 24 24">
												<path d="M10.806 7.232l3.75 3.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .877.877 0 0 1-.215-.127.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l3.32-3.301L9.907 8.13a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.058.45.176z" />
											</svg>
										</i></a>
									<div class="menu__list menu__level-03 row">
										<div class="menu__item menu__back d-lg-none"><a href="collection.html">Collection Layouts</a>
										</div>
										<div class="col-lg">
											<div class="menu__list--styled">

												<div class="menu__item"><a href="collection-list.html" class="d-flex align-items-center px-lg-5"><span>List Collection V1</span></a>
												</div>
												<div class="menu__item"><a href="collection-list-02.html" class="d-flex align-items-center px-lg-5"><span>List Collections V2</span></a>
												</div>
												<div class="menu__item"><a href="collection-2-products-per-row.html?products-view=reset" class="d-flex align-items-center px-lg-5"><span>2 Products per Row</span></a>
												</div>
												<div class="menu__item"><a href="collection.html?products-view=reset" class="d-flex align-items-center px-lg-5"><span>3 Products per Row</span></a>
												</div>
												<div class="menu__item"><a href="collection-4-products-per-row.html?products-view=reset" class="d-flex align-items-center px-lg-5"><span>4 Products per Row</span></a>
												</div>
												<div class="menu__item"><a href="collection-list-products.html?products-view=reset" class="d-flex align-items-center px-lg-5"><span>List Products</span></a>
												</div>
												<div class="menu__item"><a href="collection-left-sidebar.html" class="d-flex align-items-center px-lg-5"><span>Left Sidebar</span></a>
												</div>
												<div class="menu__item"><a href="collection-right-sidebar.html" class="d-flex align-items-center px-lg-5"><span>Right Sidebar</span></a>
												</div>
												<div class="menu__item"><a href="collection-without-sidebar.html" class="d-flex align-items-center px-lg-5"><span>Without Sidebar</span></a>
												</div>
												<div class="menu__item"><a href="collection-without-sidebar-with-banner.html" class="d-flex align-items-center px-lg-5"><span>Without Sidebar with Banner</span></a>
												</div>
												<div class="menu__item"><a href="collection-look-book.html" class="d-flex align-items-center px-lg-5"><span>Look Book</span><span class="menu__label menu__label--hot px-3 ml-5 order-1">HOT</span></a>
												</div>
												<div class="menu__item"><a href="collection-look-book-02.html" class="d-flex align-items-center px-lg-5"><span>Look Book V2</span></a>
												</div>
												<div class="menu__item"><a href="collection-catalog-mode.html" class="d-flex align-items-center px-lg-5"><span>Catalog Mode</span></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="menu__item menu__item--has-children col-lg-2">

									<a href="product.html" class="menu__title d-flex align-items-center mb-lg-10"><span>Single Product Layouts</span>
										<i class="d-lg-none ml-auto">
											<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-231" viewBox="0 0 24 24">
												<path d="M10.806 7.232l3.75 3.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .877.877 0 0 1-.215-.127.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l3.32-3.301L9.907 8.13a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.058.45.176z" />
											</svg>
										</i></a>
									<div class="menu__list menu__level-03 row">
										<div class="menu__item menu__back d-lg-none"><a href="product.html">Single Product Layouts</a>
										</div>
										<div class="col-lg">
											<div class="menu__list--styled">

												<div class="menu__item"><a href="product.html" class="d-flex align-items-center px-lg-5"><span>Product V1 — Classic</span></a>
												</div>
												<div class="menu__item"><a href="product-02.html" class="d-flex align-items-center px-lg-5"><span>Product V2 — Thumbs List</span></a>
												</div>
												<div class="menu__item"><a href="product-03.html" class="d-flex align-items-center px-lg-5"><span>Product V3 — 3 Columns</span></a>
												</div>
												<div class="menu__item"><a href="product-04.html" class="d-flex align-items-center px-lg-5"><span>Product V4 — Sticky Side</span></a>
												</div>
												<div class="menu__item"><a href="product-06.html" class="d-flex align-items-center px-lg-5"><span>Product V6 — Slider</span></a>
												</div>
												<div class="menu__item"><a href="product-02-with-column.html" class="d-flex align-items-center px-lg-5"><span>Product V2 — With Column</span></a>
												</div>
												<div class="menu__item"><a href="product-with-column.html" class="d-flex align-items-center px-lg-5"><span>Product V1 — With Column</span></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="menu__item menu__item--has-children col-lg-2">

									<a href="other-login.html" class="menu__title d-flex align-items-center mb-lg-10"><span>User Account Pages</span>
										<i class="d-lg-none ml-auto">
											<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-231" viewBox="0 0 24 24">
												<path d="M10.806 7.232l3.75 3.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .877.877 0 0 1-.215-.127.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l3.32-3.301L9.907 8.13a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.058.45.176z" />
											</svg>
										</i></a>
									<div class="menu__list menu__level-03 row">
										<div class="menu__item menu__back d-lg-none"><a href="other-login.html">User Account Pages</a>
										</div>
										<div class="col-lg">
											<div class="menu__list--styled">

												<div class="menu__item">
													<a href="other-login.html" class="d-flex align-items-center px-lg-5"><span>Login</span></a>
												</div>
												<div class="menu__item">
													<a href="other-register.html" class="d-flex align-items-center px-lg-5"><span>Register</span></a>
												</div>
												<div class="menu__item">
													<a href="other-account.html" class="d-flex align-items-center px-lg-5"><span>Account</span></a>
												</div>
												<div class="menu__item">
													<a href="other-cart.html" class="d-flex align-items-center px-lg-5"><span>Cart</span></a>
												</div>
												<div class="menu__item">
													<a href="other-wishlist.html" class="d-flex align-items-center px-lg-5"><span>Wishlist</span></a>
												</div>
												<div class="menu__item">
													<a href="other-compare.html" class="d-flex align-items-center px-lg-5"><span>Compare</span></a>
												</div>
												<div class="menu__item">
													<a href="other-search.html" class="d-flex align-items-center px-lg-5"><span>Search</span></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 d-none d-lg-block mb-lg-30"><a href="product.html" class="menu__title mb-lg-10">Featured products</a>
									<div class="menu__products row">
										<div class="col-lg-6">

											<div class="product-search d-flex flex-row flex-lg-column align-items-start align-items-lg-stretch mb-10">
												<div class="product-search__image position-relative mr-10 mr-lg-0">
													<a href="product.html" class="d-block">
														<div class="rimage" style="padding-top:128.2307692%;">
															<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_67eb2dce-35d8-4dfa-8d93-fee6c4b56c49_{width}x.progressive.jpg?v=1542543797" data-aspect-ratio="0.7798440311937612" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_67eb2dce-35d8-4dfa-8d93-fee6c4b56c49_200x.progressive.jpg?v=1542543797 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_67eb2dce-35d8-4dfa-8d93-fee6c4b56c49_200x@2x.progressive.jpg?v=1542543797 2x" alt="Blend Field Jacket">
														</div>
													</a>
												</div>
												<div class="product-search__content d-flex flex-column align-items-start mt-lg-15">
													<div class="product-search__title mb-3">
														<h3 class="h6 m-0">
															<a href="product.html">Blend
																Field Jacket</a>
														</h3>
													</div>
													<div class="product-search__price mb-10">
														<span class="price" data-js-product-price><span><span class=money>$470.00</span></span></span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6">

											<div class="product-search d-flex flex-row flex-lg-column align-items-start align-items-lg-stretch mb-10">
												<div class="product-search__image position-relative mr-10 mr-lg-0">
													<a href="product.html" class="d-block">
														<div class="rimage" style="padding-top:128.2307692%;">
															<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_2_3_1_86b90065-d75b-4519-a95e-a02ae468f4e9_{width}x.progressive.jpg?v=1543244602" data-aspect-ratio="0.7798440311937612" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_2_3_1_86b90065-d75b-4519-a95e-a02ae468f4e9_200x.progressive.jpg?v=1543244602 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_2_3_1_86b90065-d75b-4519-a95e-a02ae468f4e9_200x@2x.progressive.jpg?v=1543244602 2x" alt="Jersey Graphic Tee">
														</div>
													</a>
												</div>
												<div class="product-search__content d-flex flex-column align-items-start mt-lg-15">
													<div class="product-search__title mb-3">
														<h3 class="h6 m-0">
															<a href="product.html">Jersey
																Graphic Tee</a>
														</h3>
													</div>
													<div class="product-search__price mb-10">
														<span class="price" data-js-product-price><span><span class=money>$330.00</span></span></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-2 d-none d-lg-block mb-lg-30"><a href="collection.html" class="menu__title mb-lg-10">Top
										brands</a>
									<div class="menu__group menu__group--offset-small row">
										<div class="col-lg-6 d-none d-lg-block px-lg-5 mb-lg-10">


											<div class="promobox promobox--type-03 d-flex justify-content-center">
												<a href="collection.html" class="image-animation-trigger position-relative w-100">

													<div class="image-animation image-animation--from-default image-animation--to-default">
														<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand1_{width}x.png?v=1540454668" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand1_80x.png?v=1540454668 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand1_80x@2x.png?v=1540454668 2x" alt="">
														</div>
													</div>
													<div class="promobox__border absolute-stretch"></div>
												</a>
											</div>
										</div>
										<div class="col-lg-6 d-none d-lg-block px-lg-5 mb-lg-10">


											<div class="promobox promobox--type-03 d-flex justify-content-center">
												<a href="collection.html" class="image-animation-trigger position-relative w-100">

													<div class="image-animation image-animation--from-default image-animation--to-default">
														<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand2_{width}x.png?v=1540454864" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand2_80x.png?v=1540454864 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand2_80x@2x.png?v=1540454864 2x" alt="">
														</div>
													</div>
													<div class="promobox__border absolute-stretch"></div>
												</a>
											</div>
										</div>
										<div class="col-lg-6 d-none d-lg-block px-lg-5 mb-lg-10">


											<div class="promobox promobox--type-03 d-flex justify-content-center">
												<a href="collection.html" class="image-animation-trigger position-relative w-100">

													<div class="image-animation image-animation--from-default image-animation--to-default">
														<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand3_{width}x.png?v=1540454883" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand3_80x.png?v=1540454883 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand3_80x@2x.png?v=1540454883 2x" alt="">
														</div>
													</div>
													<div class="promobox__border absolute-stretch"></div>
												</a>
											</div>
										</div>
										<div class="col-lg-6 d-none d-lg-block px-lg-5 mb-lg-10">


											<div class="promobox promobox--type-03 d-flex justify-content-center">
												<a href="collection.html" class="image-animation-trigger position-relative w-100">

													<div class="image-animation image-animation--from-default image-animation--to-default">
														<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand4_{width}x.png?v=1540454899" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand4_80x.png?v=1540454899 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand4_80x@2x.png?v=1540454899 2x" alt="">
														</div>
													</div>
													<div class="promobox__border absolute-stretch"></div>
												</a>
											</div>
										</div>
										<div class="col-lg-6 d-none d-lg-block px-lg-5 mb-lg-10">


											<div class="promobox promobox--type-03 d-flex justify-content-center">
												<a href="collection.html" class="image-animation-trigger position-relative w-100">

													<div class="image-animation image-animation--from-default image-animation--to-default">
														<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand5_{width}x.png?v=1540454917" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand5_80x.png?v=1540454917 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand5_80x@2x.png?v=1540454917 2x" alt="">
														</div>
													</div>
													<div class="promobox__border absolute-stretch"></div>
												</a>
											</div>
										</div>
										<div class="col-lg-6 d-none d-lg-block px-lg-5 mb-lg-10">


											<div class="promobox promobox--type-03 d-flex justify-content-center">
												<a href="collection.html" class="image-animation-trigger position-relative w-100">

													<div class="image-animation image-animation--from-default image-animation--to-default">
														<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand6_{width}x.png?v=1540454931" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand6_80x.png?v=1540454931 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand6_80x@2x.png?v=1540454931 2x" alt="">
														</div>
													</div>
													<div class="promobox__border absolute-stretch"></div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</ul>
						</div>
					</div>

					<ul>


				<?/*if ($arItem["DEPTH_LEVEL"] == 1):?>
					<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?else:?>
					<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
						<ul>
				<?endif*/?>

			<?else:?>

				<li class="<?if ($arItem["SELECTED"]):?>active <?endif?>menu__item">

					<a href="<?=$arItem["LINK"]?>" class="d-flex align-items-center px-lg-7">
						<span><?=$arItem["TEXT"]?></span> 
						<!-- <i class="d-none d-lg-inline position-lg-relative" style="opacity: 0;">
							<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-229" viewBox="0 0 24 24">
								<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z" />
							</svg>
						</i>
						<i class="d-lg-none ml-auto" style="opacity: 0;">
							<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-231" viewBox="0 0 24 24">
								<path d="M10.806 7.232l3.75 3.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .877.877 0 0 1-.215-.127.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l3.32-3.301L9.907 8.13a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.058.45.176z" />
							</svg>
						</i> -->
					</a>

				</li>
				<?/*if ($arItem["PERMISSION"] > "D"):?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"></a></li>
					<?else:?>
						<li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
					<?endif?>

				<?endif */?>

			<?endif?>

			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>



			<?endforeach?>

			<?if ($previousLevel > 1)://close last item tags?>
				<?=str_repeat("</li></ul>", ($previousLevel-1) );?>
			<?endif?>

			<li class="menu__item ">

				<a href="http://bit.ly/2UXO8zH" class="d-flex align-items-center px-lg-7"><span>Buy Now!</span></a>
			</li>

			</ul>

		</nav>
	</div>

<?endif?>