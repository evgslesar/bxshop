<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Интернет-магазин \"Shella\"");
$APPLICATION->SetPageProperty("keywords", "Интернет-магазин \"Shella\"");
$APPLICATION->SetPageProperty("title", "Интернет-магазин \"Shella\"");
$APPLICATION->SetTitle("Интернет-магазин \"Shella\"");
?>


		<div id="theme-section-1537376034307" class="theme-section">
			<div data-section-id="1537376034307" data-section-type="home-builder" class="container">

				<div class="overflow-x-hidden">
					<div class="row mt-0 mb-45 justify-content-start align-items-start">
						<div class="col-12 col-md-4 mt-0 mb-15">


							<div class="promobox promobox--type-06 d-flex flex-column align-items-center text-center">
								<a href="product.html" class="w-100">

									<div class="image-animation image-animation--from-center image-animation--to-right">
										<div class="rimage" style="padding-top:127.027027%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/52_d08a5ae9-a835-41c0-8baa-46f880671f58_{width}x.progressive.png.jpg?v=1552397724" data-aspect-ratio="0.7872340425531915" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/52_d08a5ae9-a835-41c0-8baa-46f880671f58_900x.progressive.png.jpg?v=1552397724 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/52_d08a5ae9-a835-41c0-8baa-46f880671f58_900x@2x.progressive.png.jpg?v=1552397724 2x" data-scale-perspective="1.1" alt="">
										</div>
									</div>
								</a><a href="product.html" class="promobox__text-line-01 h3 mt-15 mb-0">'90S
									LOVE</a><a href="product.html" class="promobox__btn btn mt-10">Discover
									More</a>
							</div>
						</div>
						<div class="col-12 col-md-4 mt-0 mb-15">


							<div class="promobox promobox--type-06 d-flex flex-column align-items-center text-center">
								<a href="product.html" class="w-100">

									<div class="image-animation image-animation--from-center image-animation--to-right">
										<div class="rimage" style="padding-top:127.027027%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/55_886978e7-5806-4bca-968e-2dc187ea3008_{width}x.progressive.png.jpg?v=1552397753" data-aspect-ratio="0.7872340425531915" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/55_886978e7-5806-4bca-968e-2dc187ea3008_900x.progressive.png.jpg?v=1552397753 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/55_886978e7-5806-4bca-968e-2dc187ea3008_900x@2x.progressive.png.jpg?v=1552397753 2x" data-scale-perspective="1.1" alt="">
										</div>
									</div>
								</a><a href="product.html" class="promobox__text-line-01 h3 mt-15 mb-0">40% OFF
									ALL CLOTHING</a><a href="product.html" class="promobox__btn btn mt-10">Discover
									More</a>
							</div>
						</div>
						<div class="col-12 col-md-4 mt-0 mb-15">


							<div class="promobox promobox--type-06 d-flex flex-column align-items-center text-center">
								<a href="product.html" class="w-100">

									<div class="image-animation image-animation--from-center image-animation--to-right">
										<div class="rimage" style="padding-top:127.027027%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/32_c3eac819-bca4-49fe-b46f-5b2ef94ee38f_{width}x.progressive.png.jpg?v=1552394352" data-aspect-ratio="0.7872340425531915" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/32_c3eac819-bca4-49fe-b46f-5b2ef94ee38f_900x.progressive.png.jpg?v=1552394352 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/32_c3eac819-bca4-49fe-b46f-5b2ef94ee38f_900x@2x.progressive.png.jpg?v=1552394352 2x" data-scale-perspective="1.1" alt="">
										</div>
									</div>
								</a><a href="product.html" class="promobox__text-line-01 h3 mt-15 mb-0">NEW ICONIC MODEL</a><a href="product.html" class="promobox__btn btn mt-10">Discover
									More</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<script>
				Loader.require({
					type: "script",
					name: "home_builder"
				});
			</script>

		</div>

		<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"mp_goods_list", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
		"BASKET_URL" => "/hasta/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPATIBLE_MODE" => "N",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "STRICT",
		"FILTER_NAME" => "arrFilter",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => array(
		),
		"LAZY_LOAD" => "N",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_BTN_LAZY_LOAD" => "Показать ещё",
		"MESS_BTN_SUBSCRIBE" => "Подписаться",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFER_ADD_PICT_PROP" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "4",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => "",
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SEF_RULE" => "",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "Y",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "Y",
		"TEMPLATE_THEME" => "blue",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "mp_goods_list",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right"
	),
	false
);?>
		<!-- <div id="theme-section-1537376166880" class="theme-section">
			<div data-section-id="1537376166880" data-section-type="sorting-collections">

				<div class="container mt-0 mb-20">
					<div class="sorting-collections">
						<div class="sorting-collections__head row justify-content-center mb-25" data-sorting-collections-control>
							<h4 class="col-auto mb-10 text-center">
								<a href="" class="active" data-collection="new-products">New
									Products</a>
							</h4>
							<h4 class="col-auto mb-10 text-center">
								<a href="" data-collection="special-products">Special Products</a>
							</h4>
							<h4 class="col-auto mb-10 text-center">
								<a href="" data-collection="featured-products">Featured
									Products</a>
							</h4>
						</div>
						<div class="sorting-collections__products row" data-sorting-collections-items data-limit="8" data-grid="col-6 col-sm-6 col-md-4 col-lg-3">
							<div class="col-6 col-sm-6 col-md-4 col-lg-3">
								<div class="product-collection d-flex flex-column mb-30" data-js-product data-js-product-json-preload data-product-handle="cotton-crewneck-sweater" data-product-variant-id="13520511402036">
									<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover" data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2605987251_2_1_1_66473277-9f84-4538-b8ec-57b7f0b365c7_{width}x.progressive.jpg?v=1542544381" data-js-product-image-hover-id="4166028918836">
										<a href="product.html?variant=13520511402036" class="d-block cursor-default" data-js-product-image>
											<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--contain rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2605987251_1_1_1_7af4f909-456b-4e53-8601-b726fc1bd01d_{width}x.progressive.jpg?v=1542544380" data-aspect-ratio="0.78125" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2605987251_1_1_1_7af4f909-456b-4e53-8601-b726fc1bd01d_600x.progressive.jpg?v=1542544380 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2605987251_1_1_1_7af4f909-456b-4e53-8601-b726fc1bd01d_600x@2x.progressive.jpg?v=1542544380 2x" data-image-id="4166028853300" alt="Cotton Crewneck Sweater">
											</div>
										</a>
										<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
											<a href="product.html?variant=13520511402036" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
												<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-hot>Hot
												</div>
												<div class="label label--new mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-new>New
												</div>
												<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-sale></div>
												<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-out-stock>Out Stock
												</div>
											</div>
											<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
												<a href="product.html?variant=13520511402036" class="button-quick-view d-flex flex-center rounded-circle js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="left" data-tippy-distance="5">
													<i>
														<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
															<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
														</svg>
													</i>
												</a>
											</div>
										</div>
										<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
											<a href="product.html?variant=13520511402036" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
												<div class="d-none-important" data-js-product-countdown>
													<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
												</div>
											</div>
											<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
												<div class="product-images-navigation d-flex">
													<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer" data-js-product-images-navigation="prev"><i class="mr-2"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-006" viewBox="0 0 24 24">
																<path d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z" />
															</svg></i></span>
													<span class="d-flex flex-center rounded-circle cursor-pointer" data-js-product-images-navigation="next"><i class="ml-3"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-007" viewBox="0 0 24 24">
																<path d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z" />
															</svg></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="product-collection__content d-flex flex-column align-items-start mt-15">
										<div class="product-collection__title mb-3">
											<h4 class="h6 m-0">
												<a href="product.html?variant=13520511402036">Cotton
													Crewneck Sweater</a>
											</h4>
										</div>
										<div class="product-collection__details d-none mb-8">
											<div class="product-collection__sku mb-5">
												<p class="m-0" data-js-product-sku>SKU: <span>00111</span></p>
											</div>
											<div class="product-collection__barcode mb-5">
												<p class="m-0" data-js-product-barcode>BARCODE: <span>1234567890</span></p>
											</div>
											<div class="product-collection__availability mb-5">
												<p class="m-0" data-js-product-availability data-availability="false">
													AVAILABILITY: <span>In stock (99998 items)</span></p>
											</div>
											<div class="product-collection__type mb-5">
												<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Hoodie</span></p>
											</div>
											<div class="product-collection__vendor mb-5">
												<p class="m-0" data-js-product-vendor>VENDOR: <span>Prada</span></p>
											</div>
										</div>
										<div class="product-collection__description d-none mb-15">
											<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet conse ctetur
												adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
												aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
												nisi ut aliquip ex ea commodo consequat....</p>
										</div>
										<div class="product-collection__price mb-10">
											<span class="price" data-js-product-price data-js-show-sale-separator><span><span class=money>$350.00</span></span></span>
										</div>
										<form method="post" action="/cart/add" accept-charset="UTF-8" class="d-flex flex-column w-100 m-0" enctype="multipart/form-data" data-js-product-form=""><input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
											<div class="product-collection__options">

											</div>
											<div class="product-collection__variants mb-10 d-none">
												<select name="id" class="m-0" data-js-product-variants>
													<option selected="selected" value="13520511402036">Default variant
													</option>
												</select>
											</div>
											<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
												<div class="product-collection__button-add-to-cart mb-10">
													<button type="submit" class="btn btn--status btn--animated js-product-button-add-to-cart" name="add" data-js-product-button-add-to-cart>
														<span class="d-flex flex-center"><i class="btn__icon mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-109" viewBox="0 0 24 24">
																	<path d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z" />
																</svg></i><span class="btn__text">ADD TO CART</span></span>
														<span class="d-flex flex-center" data-button-content="added"><i class="mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-110" viewBox="0 0 24 24">
																	<path d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z" />
																</svg></i>ADDED</span>
														<span class="d-flex flex-center" data-button-content="sold-out">SOLD OUT</span>
													</button>
												</div>
												<div class="product-collection__buttons-section d-flex px-lg-10">
													<div class="product-collection__button-add-to-wishlist mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist" data-js-tooltip data-tippy-content="Wishlist" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
																	<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-181" viewBox="0 0 24 24">
																	<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-add-to-compare mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare" data-js-tooltip data-tippy-content="Compare" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-039" viewBox="0 0 24 24">
																	<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-235" viewBox="0 0 24 24">
																	<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
														<a href="product.html?variant=13520511402036" class="btn btn--text pt-2 px-lg-6 js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="top" data-tippy-distance="-2">
															<i>
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
																	<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
																</svg>
															</i>
														</a>
													</div>
												</div>
											</div>
										</form>
										<div class="product-collection__reviews">
											<div class="spr spr--empty-hide d-flex flex-column">
												<span class="shopify-product-reviews-badge" data-id="1463881793588"></span>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-6 col-sm-6 col-md-4 col-lg-3">
								<div class="product-collection d-flex flex-column mb-30" data-js-product data-js-product-json-preload data-product-handle="apple-iwatch" data-product-variant-id="8077164281908">
									<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover" data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4609862406_2_1_1_{width}x.progressive.jpg?v=1542544058" data-js-product-image-hover-id="4166023774260">
										<a href="product.html?variant=8077164281908" class="d-block cursor-default" data-js-product-image>
											<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--contain rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4609862406_1_1_1_{width}x.progressive.jpg?v=1542544056" data-aspect-ratio="0.78125" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4609862406_1_1_1_600x.progressive.jpg?v=1542544056 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4609862406_1_1_1_600x@2x.progressive.jpg?v=1542544056 2x" data-image-id="4166023741492" alt="Cashmere Jogger Pant">
											</div>
										</a>
										<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
											<a href="product.html?variant=8077164281908" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
												<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-hot>Hot
												</div>
												<div class="label label--new mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-new>New
												</div>
												<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-sale></div>
												<div class="label label--out-stock mb-3 mr-3 text-nowrap" data-js-product-label-out-stock>Out Stock
												</div>
											</div>
											<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
												<a href="product.html?variant=8077164281908" class="button-quick-view d-flex flex-center rounded-circle js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="left" data-tippy-distance="5">
													<i>
														<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
															<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
														</svg>
													</i>
												</a>
											</div>
										</div>
										<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
											<a href="product.html?variant=8077164281908" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
												<div class="d-none-important" data-js-product-countdown>
													<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
												</div>
											</div>
											<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
												<div class="product-images-navigation d-flex">
													<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer" data-js-product-images-navigation="prev"><i class="mr-2"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-006" viewBox="0 0 24 24">
																<path d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z" />
															</svg></i></span>
													<span class="d-flex flex-center rounded-circle cursor-pointer" data-js-product-images-navigation="next"><i class="ml-3"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-007" viewBox="0 0 24 24">
																<path d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z" />
															</svg></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="product-collection__content d-flex flex-column align-items-start mt-15">
										<div class="product-collection__title mb-3">
											<h4 class="h6 m-0">
												<a href="product.html?variant=8077164281908">Cashmere Jogger
													Pant</a>
											</h4>
										</div>
										<div class="product-collection__details d-none mb-8">
											<div class="product-collection__sku mb-5">
												<p class="m-0" data-js-product-sku>SKU: <span>00101</span></p>
											</div>
											<div class="product-collection__barcode mb-5">
												<p class="m-0" data-js-product-barcode>BARCODE: <span>1234567890</span></p>
											</div>
											<div class="product-collection__availability mb-5">
												<p class="m-0" data-js-product-availability data-availability="false">
													AVAILABILITY: <span>Out of Stock</span></p>
											</div>
											<div class="product-collection__type mb-5">
												<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Pants</span></p>
											</div>
											<div class="product-collection__vendor mb-5">
												<p class="m-0" data-js-product-vendor>VENDOR: <span>Calvin Klein</span></p>
											</div>
										</div>
										<div class="product-collection__description d-none mb-15">
											<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet conse ctetur
												adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
												aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
												nisi ut aliquip ex ea commodo consequat....</p>
										</div>
										<div class="product-collection__price mb-10">
											<span class="price" data-js-product-price data-js-show-sale-separator><span><span class=money>$150.00</span></span></span>
										</div>
										<form method="post" action="/cart/add" accept-charset="UTF-8" class="d-flex flex-column w-100 m-0" enctype="multipart/form-data" data-js-product-form=""><input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
											<div class="product-collection__options">

											</div>
											<div class="product-collection__variants mb-10 d-none">
												<select name="id" class="m-0" data-js-product-variants>
													<option disabled="disabled" value="8077164281908">Default variant
													</option>
												</select>
											</div>
											<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
												<div class="product-collection__button-add-to-cart mb-10">
													<button type="submit" class="btn btn--status btn--animated js-product-button-add-to-cart" name="add" data-js-product-button-add-to-cart disabled="disabled" data-button-status="sold-out">
														<span class="d-flex flex-center"><i class="btn__icon mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-109" viewBox="0 0 24 24">
																	<path d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z" />
																</svg></i><span class="btn__text">ADD TO CART</span></span>
														<span class="d-flex flex-center" data-button-content="added"><i class="mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-110" viewBox="0 0 24 24">
																	<path d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z" />
																</svg></i>ADDED</span>
														<span class="d-flex flex-center" data-button-content="sold-out">SOLD OUT</span>
													</button>
												</div>
												<div class="product-collection__buttons-section d-flex px-lg-10">
													<div class="product-collection__button-add-to-wishlist mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist" data-js-tooltip data-tippy-content="Wishlist" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
																	<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-181" viewBox="0 0 24 24">
																	<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-add-to-compare mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare" data-js-tooltip data-tippy-content="Compare" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-039" viewBox="0 0 24 24">
																	<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-235" viewBox="0 0 24 24">
																	<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
														<a href="product.html?variant=8077164281908" class="btn btn--text pt-2 px-lg-6 js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="top" data-tippy-distance="-2">
															<i>
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
																	<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
																</svg>
															</i>
														</a>
													</div>
												</div>
											</div>
										</form>
										<div class="product-collection__reviews">
											<div class="spr spr--empty-hide d-flex flex-column">
												<span class="shopify-product-reviews-badge" data-id="856863014964"></span>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-6 col-sm-6 col-md-4 col-lg-3">
								<div class="product-collection d-flex flex-column mb-30" data-js-product data-js-product-json-preload data-product-handle="cotton-t-shirt-with-slogan" data-product-variant-id="13520149807156">
									<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover" data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2127987251_2_1_1_b11fa8e8-ed1e-41aa-a53e-d351925c6b14_{width}x.progressive.jpg?v=1540473274" data-js-product-image-hover-id="4072715419700">
										<a href="product.html?variant=13520149807156" class="d-block cursor-default" data-js-product-image>
											<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--contain rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2127987251_1_1_1_ff11cb71-b4fa-4e5c-aa3e-65ce4bcf2215_{width}x.progressive.jpg?v=1540473274" data-aspect-ratio="0.78125" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2127987251_1_1_1_ff11cb71-b4fa-4e5c-aa3e-65ce4bcf2215_600x.progressive.jpg?v=1540473274 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2127987251_1_1_1_ff11cb71-b4fa-4e5c-aa3e-65ce4bcf2215_600x@2x.progressive.jpg?v=1540473274 2x" data-image-id="4072715386932" alt="Cotton T-shirt with slogan">
											</div>
										</a>
										<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
											<a href="product.html?variant=13520149807156" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
												<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-hot>Hot
												</div>
												<div class="label label--new mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-new>New
												</div>
												<div class="label label--sale mb-3 mr-3 text-nowrap" data-js-product-label-sale>-20%
												</div>
												<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-out-stock>Out Stock
												</div>
											</div>
											<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
												<a href="product.html?variant=13520149807156" class="button-quick-view d-flex flex-center rounded-circle js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="left" data-tippy-distance="5">
													<i>
														<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
															<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
														</svg>
													</i>
												</a>
											</div>
										</div>
										<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
											<a href="product.html?variant=13520149807156" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
												<div class="d-none-important" data-js-product-countdown>
													<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
												</div>
											</div>
											<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
												<div class="product-images-navigation d-flex">
													<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer" data-js-product-images-navigation="prev"><i class="mr-2"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-006" viewBox="0 0 24 24">
																<path d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z" />
															</svg></i></span>
													<span class="d-flex flex-center rounded-circle cursor-pointer" data-js-product-images-navigation="next"><i class="ml-3"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-007" viewBox="0 0 24 24">
																<path d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z" />
															</svg></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="product-collection__content d-flex flex-column align-items-start mt-15">
										<div class="product-collection__title mb-3">
											<h4 class="h6 m-0">
												<a href="product.html?variant=13520149807156">Cotton
													T-shirt with slogan</a>
											</h4>
										</div>
										<div class="product-collection__details d-none mb-8">
											<div class="product-collection__sku mb-5">
												<p class="m-0" data-js-product-sku>SKU: <span>00106с</span></p>
											</div>
											<div class="product-collection__barcode mb-5">
												<p class="m-0" data-js-product-barcode>BARCODE: <span>1234567890</span></p>
											</div>
											<div class="product-collection__availability mb-5">
												<p class="m-0" data-js-product-availability data-availability="false">
													AVAILABILITY: <span>In stock (99999 items)</span></p>
											</div>
											<div class="product-collection__type mb-5">
												<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Dresses</span></p>
											</div>
											<div class="product-collection__vendor mb-5">
												<p class="m-0" data-js-product-vendor>VENDOR: <span>Chanel</span></p>
											</div>
										</div>
										<div class="product-collection__description d-none mb-15">
											<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet conse ctetur
												adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
												aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
												nisi ut aliquip ex ea commodo consequat....</p>
										</div>
										<div class="product-collection__price mb-10">
											<span class="price price--sale" data-js-product-price data-js-show-sale-separator><span><span class=money>$310.00</span></span> from<span><span class=money>$250.00</span></span></span>
										</div>
										<form method="post" action="/cart/add" accept-charset="UTF-8" class="d-flex flex-column w-100 m-0" enctype="multipart/form-data" data-js-product-form=""><input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
											<div class="product-collection__options">

											</div>
											<div class="product-collection__variants mb-10 d-none">
												<select name="id" class="m-0" data-js-product-variants>
													<option selected="selected" value="13520149807156">Default variant
													</option>
												</select>
											</div>
											<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
												<div class="product-collection__button-add-to-cart mb-10">
													<button type="submit" class="btn btn--status btn--animated js-product-button-add-to-cart" name="add" data-js-product-button-add-to-cart>
														<span class="d-flex flex-center"><i class="btn__icon mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-109" viewBox="0 0 24 24">
																	<path d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z" />
																</svg></i><span class="btn__text">ADD TO CART</span></span>
														<span class="d-flex flex-center" data-button-content="added"><i class="mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-110" viewBox="0 0 24 24">
																	<path d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z" />
																</svg></i>ADDED</span>
														<span class="d-flex flex-center" data-button-content="sold-out">SOLD OUT</span>
													</button>
												</div>
												<div class="product-collection__buttons-section d-flex px-lg-10">
													<div class="product-collection__button-add-to-wishlist mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist" data-js-tooltip data-tippy-content="Wishlist" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
																	<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-181" viewBox="0 0 24 24">
																	<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-add-to-compare mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare" data-js-tooltip data-tippy-content="Compare" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-039" viewBox="0 0 24 24">
																	<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-235" viewBox="0 0 24 24">
																	<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
														<a href="product.html?variant=13520149807156" class="btn btn--text pt-2 px-lg-6 js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="top" data-tippy-distance="-2">
															<i>
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
																	<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
																</svg>
															</i>
														</a>
													</div>
												</div>
											</div>
										</form>
										<div class="product-collection__reviews">
											<div class="spr spr--empty-hide d-flex flex-column">
												<span class="shopify-product-reviews-badge" data-id="1463849189428"></span>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="col-6 col-sm-6 col-md-4 col-lg-3">
								<div class="product-collection d-flex flex-column mb-30" data-js-product data-js-product-json-preload data-product-handle="huawei-honor-watch-s1" data-product-variant-id="8077170933812">
									<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover" data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4205984613_2_3_1_{width}x.progressive.jpg?v=1543244458" data-js-product-image-hover-id="4166026723380">
										<a href="product.html?variant=8077170933812" class="d-block cursor-default" data-js-product-image>
											<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--contain rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4205984613_1_1_1_{width}x.progressive.jpg?v=1543244458" data-aspect-ratio="0.78125" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4205984613_1_1_1_600x.progressive.jpg?v=1543244458 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4205984613_1_1_1_600x@2x.progressive.jpg?v=1543244458 2x" data-image-id="4166026592308" alt="New York Yankees Baseball Hats">
											</div>
										</a>
										<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
											<a href="product.html?variant=8077170933812" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
												<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-hot>Hot
												</div>
												<div class="label label--new mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-new>New
												</div>
												<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-sale></div>
												<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important" data-js-product-label-out-stock>Out Stock
												</div>
											</div>
											<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
												<a href="product.html?variant=8077170933812" class="button-quick-view d-flex flex-center rounded-circle js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="left" data-tippy-distance="5">
													<i>
														<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
															<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
														</svg>
													</i>
												</a>
											</div>
										</div>
										<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
											<a href="product.html?variant=8077170933812" class="absolute-stretch cursor-default"></a>
											<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
												<div class="d-none-important" data-js-product-countdown>
													<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
												</div>
											</div>
											<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
												<div class="product-images-navigation d-flex">
													<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer" data-js-product-images-navigation="prev"><i class="mr-2"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-006" viewBox="0 0 24 24">
																<path d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z" />
															</svg></i></span>
													<span class="d-flex flex-center rounded-circle cursor-pointer" data-js-product-images-navigation="next"><i class="ml-3"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-007" viewBox="0 0 24 24">
																<path d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z" />
															</svg></i></span>
												</div>
											</div>
										</div>
									</div>
									<div class="product-collection__content d-flex flex-column align-items-start mt-15">
										<div class="product-collection__title mb-3">
											<h4 class="h6 m-0">
												<a href="product.html?variant=8077170933812">New York
													Yankees Baseball Hats</a>
											</h4>
										</div>
										<div class="product-collection__details d-none mb-8">
											<div class="product-collection__sku mb-5">
												<p class="m-0" data-js-product-sku>SKU: <span>00106</span></p>
											</div>
											<div class="product-collection__barcode mb-5">
												<p class="m-0" data-js-product-barcode>BARCODE: <span>1234567890</span></p>
											</div>
											<div class="product-collection__availability mb-5">
												<p class="m-0" data-js-product-availability data-availability="false">
													AVAILABILITY: <span>In stock (99999 items)</span></p>
											</div>
											<div class="product-collection__type mb-5">
												<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Dresses</span></p>
											</div>
											<div class="product-collection__vendor mb-5">
												<p class="m-0" data-js-product-vendor>VENDOR: <span>Gap</span></p>
											</div>
										</div>
										<div class="product-collection__description d-none mb-15">
											<p class="m-0">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
												accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab
												illo inventore veritatis et quasi architecto beatae vitae dicta sunt
												explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur
												aut...</p>
										</div>
										<div class="product-collection__price mb-10">
											<span class="price" data-js-product-price data-js-show-sale-separator><span><span class=money>$250.00</span></span></span>
										</div>
										<form method="post" action="/cart/add" accept-charset="UTF-8" class="d-flex flex-column w-100 m-0" enctype="multipart/form-data" data-js-product-form=""><input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
											<div class="product-collection__options">

											</div>
											<div class="product-collection__variants mb-10 d-none">
												<select name="id" class="m-0" data-js-product-variants>
													<option selected="selected" value="8077170933812">Default variant
													</option>
												</select>
											</div>
											<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
												<div class="product-collection__button-add-to-cart mb-10">
													<button type="submit" class="btn btn--status btn--animated js-product-button-add-to-cart" name="add" data-js-product-button-add-to-cart>
														<span class="d-flex flex-center"><i class="btn__icon mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-109" viewBox="0 0 24 24">
																	<path d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z" />
																</svg></i><span class="btn__text">ADD TO CART</span></span>
														<span class="d-flex flex-center" data-button-content="added"><i class="mr-5 mb-4"><svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-110" viewBox="0 0 24 24">
																	<path d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z" />
																</svg></i>ADDED</span>
														<span class="d-flex flex-center" data-button-content="sold-out">SOLD OUT</span>
													</button>
												</div>
												<div class="product-collection__buttons-section d-flex px-lg-10">
													<div class="product-collection__button-add-to-wishlist mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist" data-js-tooltip data-tippy-content="Wishlist" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
																	<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-181" viewBox="0 0 24 24">
																	<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-add-to-compare mb-10">
														<a href="/account" class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare" data-js-tooltip data-tippy-content="Compare" data-tippy-placement="top" data-tippy-distance="-3">
															<i class="mb-1 ml-1">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-039" viewBox="0 0 24 24">
																	<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z" />
																</svg>
															</i>
															<i class="mb-1 ml-1" data-button-content="added">
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-235" viewBox="0 0 24 24">
																	<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z" />
																</svg>
															</i>
														</a>
													</div>
													<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
														<a href="product.html?variant=8077170933812" class="btn btn--text pt-2 px-lg-6 js-popup-button" data-js-popup-button="quick-view" data-js-tooltip data-tippy-content="Quick View" data-tippy-placement="top" data-tippy-distance="-2">
															<i>
																<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-154" viewBox="0 0 24 24">
																	<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z" />
																</svg>
															</i>
														</a>
													</div>
												</div>
											</div>
										</form>
										<div class="product-collection__reviews">
											<div class="spr spr--empty-hide d-flex flex-column">
												<span class="shopify-product-reviews-badge" data-id="856865112116"></span>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<script>
				Loader.require({
					type: "script",
					name: "sorting_collections"
				});
			</script>

		</div> -->
		
		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"mp_news_list", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "CREATED_USER_NAME",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "articles",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "mp_news_list"
	),
	false
);?>

		<div id="theme-section-1537376221647" class="theme-section">
			<div data-section-id="1537376221647" data-section-type="carousel-brands" data-postload="carousel_brands">

				<div class="container mt-0 mb-55">
					<div class="carousel carousel--arrows carousel-brands position-relative">
						<div class="border-top mb-50"></div>
						<div class="carousel__slider position-relative invisible" data-js-carousel data-autoplay="true" data-speed="5000" data-count="6" data-infinite="true" data-arrows="true" data-bullets="false">
							<div class="carousel__prev position-absolute cursor-pointer" data-js-carousel-prev><i>
									<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-006" viewBox="0 0 24 24">
										<path d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z" />
									</svg>
								</i></div>
							<div class="carousel__items overflow-hidden">
								<div class="carousel__slick" data-js-carousel-slick>
									<div class="carousel__item promobox promobox--type-03">
										<a href="#" class="position-relative w-100">
											<div class="rimage" style="padding-top:40.816326530612244%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2_500x_1a6ee244-6c57-42d5-870f-223d457a59cc_{width}x.png?v=1541009263" data-aspect-ratio="2.45" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2_500x_1a6ee244-6c57-42d5-870f-223d457a59cc_400x.png?v=1541009263 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2_500x_1a6ee244-6c57-42d5-870f-223d457a59cc_400x@2x.png?v=1541009263 2x" alt="">
											</div>
											<div class="promobox__border absolute-stretch"></div>
										</a>
									</div>
									<div class="carousel__item promobox promobox--type-03">
										<a href="#" class="position-relative w-100">
											<div class="rimage" style="padding-top:40.71246819338422%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.3_500x_87538212-9bfc-4063-86d8-ed13fe97fba8_{width}x.png?v=1541009359" data-aspect-ratio="2.45625" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.3_500x_87538212-9bfc-4063-86d8-ed13fe97fba8_400x.png?v=1541009359 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.3_500x_87538212-9bfc-4063-86d8-ed13fe97fba8_400x@2x.png?v=1541009359 2x" alt="">
											</div>
											<div class="promobox__border absolute-stretch"></div>
										</a>
									</div>
									<div class="carousel__item promobox promobox--type-03">
										<a href="#" class="position-relative w-100">
											<div class="rimage" style="padding-top:40.71246819338422%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.4_500x_d5d5f1ec-fa91-4a0d-aaf6-4d20900b043c_{width}x.png?v=1541009374" data-aspect-ratio="2.45625" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.4_500x_d5d5f1ec-fa91-4a0d-aaf6-4d20900b043c_400x.png?v=1541009374 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.4_500x_d5d5f1ec-fa91-4a0d-aaf6-4d20900b043c_400x@2x.png?v=1541009374 2x" alt="">
											</div>
											<div class="promobox__border absolute-stretch"></div>
										</a>
									</div>
									<div class="carousel__item promobox promobox--type-03">
										<a href="#" class="position-relative w-100">
											<div class="rimage" style="padding-top:40.71246819338422%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand2_500x_3b961f8b-3630-4341-be89-e8f91a660965_{width}x.png?v=1541009393" data-aspect-ratio="2.45625" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand2_500x_3b961f8b-3630-4341-be89-e8f91a660965_400x.png?v=1541009393 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand2_500x_3b961f8b-3630-4341-be89-e8f91a660965_400x@2x.png?v=1541009393 2x" alt="">
											</div>
											<div class="promobox__border absolute-stretch"></div>
										</a>
									</div>
									<div class="carousel__item promobox promobox--type-03">
										<a href="#" class="position-relative w-100">
											<div class="rimage" style="padding-top:40.816326530612244%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand1_500x_1888498d-df52-4162-a349-613cd6ee85c1_{width}x.png?v=1541009401" data-aspect-ratio="2.45" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand1_500x_1888498d-df52-4162-a349-613cd6ee85c1_400x.png?v=1541009401 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/brand1_500x_1888498d-df52-4162-a349-613cd6ee85c1_400x@2x.png?v=1541009401 2x" alt="">
											</div>
											<div class="promobox__border absolute-stretch"></div>
										</a>
									</div>
									<div class="carousel__item promobox promobox--type-03">
										<a href="#" class="position-relative w-100">
											<div class="rimage" style="padding-top:40.816326530612244%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2_500x_0065522e-5b2d-4c36-a074-a24d4d8c7e2b_{width}x.png?v=1541009423" data-aspect-ratio="2.45" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2_500x_0065522e-5b2d-4c36-a074-a24d4d8c7e2b_400x.png?v=1541009423 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2_500x_0065522e-5b2d-4c36-a074-a24d4d8c7e2b_400x@2x.png?v=1541009423 2x" alt="">
											</div>
											<div class="promobox__border absolute-stretch"></div>
										</a>
									</div>
									<div class="carousel__item promobox promobox--type-03">
										<a href="#" class="position-relative w-100">
											<div class="rimage" style="padding-top:40.816326530612244%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.1_500x_9c698431-51cf-4b15-91f6-b547041a782f_{width}x.png?v=1541009438" data-aspect-ratio="2.45" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.1_500x_9c698431-51cf-4b15-91f6-b547041a782f_400x.png?v=1541009438 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/Group_2.1_500x_9c698431-51cf-4b15-91f6-b547041a782f_400x@2x.png?v=1541009438 2x" alt="">
											</div>
											<div class="promobox__border absolute-stretch"></div>
										</a>
									</div>
								</div>
							</div>
							<div class="carousel__next position-absolute cursor-pointer" data-js-carousel-next><i>
									<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-007" viewBox="0 0 24 24">
										<path d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z" />
									</svg>
								</i></div>
						</div>

					</div>
				</div>
			</div>

			<script>
				Loader.require({
					type: "style",
					name: "plugin_slick"
				});

				Loader.require({
					type: "script",
					name: "carousel_brands"
				});
			</script>

		</div>
		<div id="theme-section-1537376363588" class="theme-section">
			<div data-section-id="1537376363588" data-section-type="home-builder" class="container">
				<h4 class="mb-30 text-center">

					<a href="https://instagram.com/shellatemplate/" target="_blank"><span class="text-underline">@Shella</span>
						Follow Us On Instagram</a>

				</h4>

				<div class="overflow-x-hidden">
					<div class="row mt-0 mb-30 justify-content-start align-items-start">
						<div class="col-12 col-md-12 mt-0 mb-35">
							<div class="instafeed row no-gutters position-relative">


								<div class="instafeed__item col col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
									<a href="#" class="d-block position-relative" target="_blank">
										<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--cover rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/1_5f550d4c-4f71-4209-baa1-6c88b5d6ef52_{width}x.progressive.jpg?v=1551852066" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/1_5f550d4c-4f71-4209-baa1-6c88b5d6ef52_small.progressive.jpg?v=1551852066 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/1_5f550d4c-4f71-4209-baa1-6c88b5d6ef52_small@2x.progressive.jpg?v=1551852066 2x" alt="">
										</div>
										<div class="instafeed__curtain absolute-stretch d-none d-lg-flex flex-lg-center">

											<div class="d-flex position-relative align-items-center mr-15">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
														<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
													</svg>
												</i><span class="mt-2">21</span>
											</div>
											<div class="d-flex position-relative align-items-center">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-176" viewBox="0 0 24 24">
														<path d="M12.027 2.429c1.406 0 2.718.208 3.936.625s2.275.993 3.174 1.729 1.604 1.599 2.119 2.588.771 2.051.771 3.184c0 .938-.188 1.849-.566 2.734s-.918 1.699-1.621 2.441l.313 4.16c.013.104-.007.205-.059.303s-.117.179-.195.244c-.052.039-.11.068-.176.088a.663.663 0 0 1-.312.019.999.999 0 0 1-.117-.029l-4.688-1.953c-.43.091-.859.163-1.289.215s-.859.078-1.289.078c-1.38 0-2.676-.218-3.887-.654s-2.269-1.032-3.174-1.787-1.621-1.634-2.148-2.637-.791-2.077-.791-3.223c0-1.133.257-2.194.771-3.184S4.02 5.518 4.918 4.782 6.874 3.47 8.092 3.053s2.529-.624 3.935-.624zm6.739 12.617c.651-.638 1.149-1.341 1.494-2.109s.518-1.563.518-2.383c0-.964-.225-1.865-.674-2.705s-1.067-1.569-1.855-2.188-1.716-1.104-2.783-1.455-2.214-.527-3.438-.527-2.371.175-3.438.527-1.995.837-2.783 1.455S4.4 7.009 3.951 7.849s-.674 1.741-.674 2.705c0 .977.231 1.892.693 2.744s1.087 1.599 1.875 2.236 1.712 1.143 2.773 1.514 2.197.557 3.408.557c.417 0 .833-.026 1.25-.078s.827-.124 1.23-.215c.026-.013.052-.02.078-.02h.078c.039 0 .078.003.117.01s.078.017.117.029l3.926 1.641-.234-3.438c-.013-.091-.003-.183.029-.273s.083-.163.149-.215z" />
													</svg>
												</i><span class="mt-2">12</span>
											</div>


										</div>
									</a>
								</div>

								<div class="instafeed__item col col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
									<a href="#" class="d-block position-relative" target="_blank">
										<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--cover rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/2_3b35e463-efc3-41ea-9be3-e1847c68f842_{width}x.progressive.JPG?v=1551852070" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/2_3b35e463-efc3-41ea-9be3-e1847c68f842_small.progressive.JPG?v=1551852070 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/2_3b35e463-efc3-41ea-9be3-e1847c68f842_small@2x.progressive.JPG?v=1551852070 2x" alt="">
										</div>
										<div class="instafeed__curtain absolute-stretch d-none d-lg-flex flex-lg-center">

											<div class="d-flex position-relative align-items-center mr-15">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
														<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
													</svg>
												</i><span class="mt-2">21</span>
											</div>
											<div class="d-flex position-relative align-items-center">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-176" viewBox="0 0 24 24">
														<path d="M12.027 2.429c1.406 0 2.718.208 3.936.625s2.275.993 3.174 1.729 1.604 1.599 2.119 2.588.771 2.051.771 3.184c0 .938-.188 1.849-.566 2.734s-.918 1.699-1.621 2.441l.313 4.16c.013.104-.007.205-.059.303s-.117.179-.195.244c-.052.039-.11.068-.176.088a.663.663 0 0 1-.312.019.999.999 0 0 1-.117-.029l-4.688-1.953c-.43.091-.859.163-1.289.215s-.859.078-1.289.078c-1.38 0-2.676-.218-3.887-.654s-2.269-1.032-3.174-1.787-1.621-1.634-2.148-2.637-.791-2.077-.791-3.223c0-1.133.257-2.194.771-3.184S4.02 5.518 4.918 4.782 6.874 3.47 8.092 3.053s2.529-.624 3.935-.624zm6.739 12.617c.651-.638 1.149-1.341 1.494-2.109s.518-1.563.518-2.383c0-.964-.225-1.865-.674-2.705s-1.067-1.569-1.855-2.188-1.716-1.104-2.783-1.455-2.214-.527-3.438-.527-2.371.175-3.438.527-1.995.837-2.783 1.455S4.4 7.009 3.951 7.849s-.674 1.741-.674 2.705c0 .977.231 1.892.693 2.744s1.087 1.599 1.875 2.236 1.712 1.143 2.773 1.514 2.197.557 3.408.557c.417 0 .833-.026 1.25-.078s.827-.124 1.23-.215c.026-.013.052-.02.078-.02h.078c.039 0 .078.003.117.01s.078.017.117.029l3.926 1.641-.234-3.438c-.013-.091-.003-.183.029-.273s.083-.163.149-.215z" />
													</svg>
												</i><span class="mt-2">12</span>
											</div>


										</div>
									</a>
								</div>

								<div class="instafeed__item col col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
									<a href="#" class="d-block position-relative" target="_blank">
										<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--cover rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/3_9a0a49a5-c1a8-4129-94c1-0a05a2c3f7b0_{width}x.progressive.jpg?v=1551852074" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/3_9a0a49a5-c1a8-4129-94c1-0a05a2c3f7b0_small.progressive.jpg?v=1551852074 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/3_9a0a49a5-c1a8-4129-94c1-0a05a2c3f7b0_small@2x.progressive.jpg?v=1551852074 2x" alt="">
										</div>
										<div class="instafeed__curtain absolute-stretch d-none d-lg-flex flex-lg-center">

											<div class="d-flex position-relative align-items-center mr-15">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
														<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
													</svg>
												</i><span class="mt-2">21</span>
											</div>
											<div class="d-flex position-relative align-items-center">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-176" viewBox="0 0 24 24">
														<path d="M12.027 2.429c1.406 0 2.718.208 3.936.625s2.275.993 3.174 1.729 1.604 1.599 2.119 2.588.771 2.051.771 3.184c0 .938-.188 1.849-.566 2.734s-.918 1.699-1.621 2.441l.313 4.16c.013.104-.007.205-.059.303s-.117.179-.195.244c-.052.039-.11.068-.176.088a.663.663 0 0 1-.312.019.999.999 0 0 1-.117-.029l-4.688-1.953c-.43.091-.859.163-1.289.215s-.859.078-1.289.078c-1.38 0-2.676-.218-3.887-.654s-2.269-1.032-3.174-1.787-1.621-1.634-2.148-2.637-.791-2.077-.791-3.223c0-1.133.257-2.194.771-3.184S4.02 5.518 4.918 4.782 6.874 3.47 8.092 3.053s2.529-.624 3.935-.624zm6.739 12.617c.651-.638 1.149-1.341 1.494-2.109s.518-1.563.518-2.383c0-.964-.225-1.865-.674-2.705s-1.067-1.569-1.855-2.188-1.716-1.104-2.783-1.455-2.214-.527-3.438-.527-2.371.175-3.438.527-1.995.837-2.783 1.455S4.4 7.009 3.951 7.849s-.674 1.741-.674 2.705c0 .977.231 1.892.693 2.744s1.087 1.599 1.875 2.236 1.712 1.143 2.773 1.514 2.197.557 3.408.557c.417 0 .833-.026 1.25-.078s.827-.124 1.23-.215c.026-.013.052-.02.078-.02h.078c.039 0 .078.003.117.01s.078.017.117.029l3.926 1.641-.234-3.438c-.013-.091-.003-.183.029-.273s.083-.163.149-.215z" />
													</svg>
												</i><span class="mt-2">12</span>
											</div>


										</div>
									</a>
								</div>

								<div class="instafeed__item col col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
									<a href="#" class="d-block position-relative" target="_blank">
										<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--cover rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/4_6fbe71fd-591d-4ddf-a1c8-413ec69fce86_{width}x.progressive.jpg?v=1551852080" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/4_6fbe71fd-591d-4ddf-a1c8-413ec69fce86_small.progressive.jpg?v=1551852080 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/4_6fbe71fd-591d-4ddf-a1c8-413ec69fce86_small@2x.progressive.jpg?v=1551852080 2x" alt="">
										</div>
										<div class="instafeed__curtain absolute-stretch d-none d-lg-flex flex-lg-center">

											<div class="d-flex position-relative align-items-center mr-15">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
														<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
													</svg>
												</i><span class="mt-2">21</span>
											</div>
											<div class="d-flex position-relative align-items-center">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-176" viewBox="0 0 24 24">
														<path d="M12.027 2.429c1.406 0 2.718.208 3.936.625s2.275.993 3.174 1.729 1.604 1.599 2.119 2.588.771 2.051.771 3.184c0 .938-.188 1.849-.566 2.734s-.918 1.699-1.621 2.441l.313 4.16c.013.104-.007.205-.059.303s-.117.179-.195.244c-.052.039-.11.068-.176.088a.663.663 0 0 1-.312.019.999.999 0 0 1-.117-.029l-4.688-1.953c-.43.091-.859.163-1.289.215s-.859.078-1.289.078c-1.38 0-2.676-.218-3.887-.654s-2.269-1.032-3.174-1.787-1.621-1.634-2.148-2.637-.791-2.077-.791-3.223c0-1.133.257-2.194.771-3.184S4.02 5.518 4.918 4.782 6.874 3.47 8.092 3.053s2.529-.624 3.935-.624zm6.739 12.617c.651-.638 1.149-1.341 1.494-2.109s.518-1.563.518-2.383c0-.964-.225-1.865-.674-2.705s-1.067-1.569-1.855-2.188-1.716-1.104-2.783-1.455-2.214-.527-3.438-.527-2.371.175-3.438.527-1.995.837-2.783 1.455S4.4 7.009 3.951 7.849s-.674 1.741-.674 2.705c0 .977.231 1.892.693 2.744s1.087 1.599 1.875 2.236 1.712 1.143 2.773 1.514 2.197.557 3.408.557c.417 0 .833-.026 1.25-.078s.827-.124 1.23-.215c.026-.013.052-.02.078-.02h.078c.039 0 .078.003.117.01s.078.017.117.029l3.926 1.641-.234-3.438c-.013-.091-.003-.183.029-.273s.083-.163.149-.215z" />
													</svg>
												</i><span class="mt-2">12</span>
											</div>


										</div>
									</a>
								</div>

								<div class="instafeed__item col col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
									<a href="#" class="d-block position-relative" target="_blank">
										<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--cover rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/5_b9b07c98-fdbe-4588-9a30-c2e302f12102_{width}x.progressive.jpg?v=1551852084" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/5_b9b07c98-fdbe-4588-9a30-c2e302f12102_small.progressive.jpg?v=1551852084 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/5_b9b07c98-fdbe-4588-9a30-c2e302f12102_small@2x.progressive.jpg?v=1551852084 2x" alt="">
										</div>
										<div class="instafeed__curtain absolute-stretch d-none d-lg-flex flex-lg-center">

											<div class="d-flex position-relative align-items-center mr-15">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
														<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
													</svg>
												</i><span class="mt-2">21</span>
											</div>
											<div class="d-flex position-relative align-items-center">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-176" viewBox="0 0 24 24">
														<path d="M12.027 2.429c1.406 0 2.718.208 3.936.625s2.275.993 3.174 1.729 1.604 1.599 2.119 2.588.771 2.051.771 3.184c0 .938-.188 1.849-.566 2.734s-.918 1.699-1.621 2.441l.313 4.16c.013.104-.007.205-.059.303s-.117.179-.195.244c-.052.039-.11.068-.176.088a.663.663 0 0 1-.312.019.999.999 0 0 1-.117-.029l-4.688-1.953c-.43.091-.859.163-1.289.215s-.859.078-1.289.078c-1.38 0-2.676-.218-3.887-.654s-2.269-1.032-3.174-1.787-1.621-1.634-2.148-2.637-.791-2.077-.791-3.223c0-1.133.257-2.194.771-3.184S4.02 5.518 4.918 4.782 6.874 3.47 8.092 3.053s2.529-.624 3.935-.624zm6.739 12.617c.651-.638 1.149-1.341 1.494-2.109s.518-1.563.518-2.383c0-.964-.225-1.865-.674-2.705s-1.067-1.569-1.855-2.188-1.716-1.104-2.783-1.455-2.214-.527-3.438-.527-2.371.175-3.438.527-1.995.837-2.783 1.455S4.4 7.009 3.951 7.849s-.674 1.741-.674 2.705c0 .977.231 1.892.693 2.744s1.087 1.599 1.875 2.236 1.712 1.143 2.773 1.514 2.197.557 3.408.557c.417 0 .833-.026 1.25-.078s.827-.124 1.23-.215c.026-.013.052-.02.078-.02h.078c.039 0 .078.003.117.01s.078.017.117.029l3.926 1.641-.234-3.438c-.013-.091-.003-.183.029-.273s.083-.163.149-.215z" />
													</svg>
												</i><span class="mt-2">12</span>
											</div>


										</div>
									</a>
								</div>

								<div class="instafeed__item col col-4 col-sm-4 col-md-2 col-lg-2 col-xl-2">
									<a href="#" class="d-block position-relative" target="_blank">
										<div class="rimage" style="padding-top:100.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--cover rimage__img--fade-in lazyload" data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/6_360a7c43-352f-4a97-90a3-0c05ff566787_{width}x.progressive.jpg?v=1551852089" data-aspect-ratio="1.0" data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/6_360a7c43-352f-4a97-90a3-0c05ff566787_small.progressive.jpg?v=1551852089 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/6_360a7c43-352f-4a97-90a3-0c05ff566787_small@2x.progressive.jpg?v=1551852089 2x" alt="">
										</div>
										<div class="instafeed__curtain absolute-stretch d-none d-lg-flex flex-lg-center">

											<div class="d-flex position-relative align-items-center mr-15">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-180" viewBox="0 0 24 24">
														<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z" />
													</svg>
												</i><span class="mt-2">21</span>
											</div>
											<div class="d-flex position-relative align-items-center">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-176" viewBox="0 0 24 24">
														<path d="M12.027 2.429c1.406 0 2.718.208 3.936.625s2.275.993 3.174 1.729 1.604 1.599 2.119 2.588.771 2.051.771 3.184c0 .938-.188 1.849-.566 2.734s-.918 1.699-1.621 2.441l.313 4.16c.013.104-.007.205-.059.303s-.117.179-.195.244c-.052.039-.11.068-.176.088a.663.663 0 0 1-.312.019.999.999 0 0 1-.117-.029l-4.688-1.953c-.43.091-.859.163-1.289.215s-.859.078-1.289.078c-1.38 0-2.676-.218-3.887-.654s-2.269-1.032-3.174-1.787-1.621-1.634-2.148-2.637-.791-2.077-.791-3.223c0-1.133.257-2.194.771-3.184S4.02 5.518 4.918 4.782 6.874 3.47 8.092 3.053s2.529-.624 3.935-.624zm6.739 12.617c.651-.638 1.149-1.341 1.494-2.109s.518-1.563.518-2.383c0-.964-.225-1.865-.674-2.705s-1.067-1.569-1.855-2.188-1.716-1.104-2.783-1.455-2.214-.527-3.438-.527-2.371.175-3.438.527-1.995.837-2.783 1.455S4.4 7.009 3.951 7.849s-.674 1.741-.674 2.705c0 .977.231 1.892.693 2.744s1.087 1.599 1.875 2.236 1.712 1.143 2.773 1.514 2.197.557 3.408.557c.417 0 .833-.026 1.25-.078s.827-.124 1.23-.215c.026-.013.052-.02.078-.02h.078c.039 0 .078.003.117.01s.078.017.117.029l3.926 1.641-.234-3.438c-.013-.091-.003-.183.029-.273s.083-.163.149-.215z" />
													</svg>
												</i><span class="mt-2">12</span>
											</div>


										</div>
									</a>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<script>
				Loader.require({
					type: "script",
					name: "home_builder"
				});
			</script>

		</div>
		<div id="theme-section-1537376466573" class="theme-section">


			<div data-section-id="1537376466573" data-section-type="information-line">

				<div class=" mt-0 mb-0">
					<div class="information-line" style="background-color: #141414;">
						<div class="container">
							<div class="row py-10">
								<div class="col-12 col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-start py-10">
									<i class="mr-15">

										<svg style="fill: #ffffff;" aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-116" viewBox="0 0 24 24">
											<path d="M21.93 6.088l.029.029c.007.007.01.017.01.029l.039.127a.47.47 0 0 1 .02.127v15a.6.6 0 0 1-.186.439.601.601 0 0 1-.439.186H2.652a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.47.47 0 0 1 .02-.127l.039-.127c0-.013.003-.022.01-.029a.387.387 0 0 0 .029-.029.478.478 0 0 1 .049-.078.844.844 0 0 1 .049-.059l.02-.02 4.375-3.75a.776.776 0 0 1 .195-.117.575.575 0 0 1 .215-.039h10c.078 0 .149.013.215.039.065.026.13.065.195.117l4.375 3.75v.02a.19.19 0 0 1 .068.059.557.557 0 0 1 .049.078zm-1.153 14.687V7.025h-5.625v5.625a.598.598 0 0 1-.186.439.601.601 0 0 1-.439.186h-5a.6.6 0 0 1-.439-.186.6.6 0 0 1-.186-.439V7.025H3.277v13.75h17.5zM7.262 3.275l-2.93 2.5h4.805l1.25-2.5H7.262zm2.89 8.75h3.75v-5h-3.75v5zm1.641-8.75l-1.25 2.5h2.969l-1.25-2.5h-.469zm7.93 2.5l-2.93-2.5h-3.125l1.25 2.5h4.805z" />
										</svg>

									</i>
									<div>
										<h6 class="d-inline" style="color: #ffffff;">Free Shipping. </h6>
										<p class="d-inline">All orders of $49 or more of eligible items across any product
											category qualify.</p>
									</div>
								</div>
								<div class="col-12 col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-start py-10">
									<i class="mr-15">

										<svg style="fill: #ffffff;" aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-125" viewBox="0 0 24 24">
											<path d="M21.508 5.035c.364.365.547.808.547 1.328v11.25c0 .521-.183.964-.547 1.328a1.808 1.808 0 0 1-1.328.547H3.93c-.521 0-.964-.182-1.328-.547a1.805 1.805 0 0 1-.547-1.328V6.363c0-.521.182-.963.547-1.328a1.81 1.81 0 0 1 1.328-.547h16.25c.521 0 .964.183 1.328.547zm-18.017.889a.6.6 0 0 0-.186.439v1.25h17.5v-1.25a.6.6 0 0 0-.186-.439.598.598 0 0 0-.439-.186H3.93a.598.598 0 0 0-.439.186zm-.186 4.814h17.5V8.863h-17.5v1.875zm17.315 7.315a.6.6 0 0 0 .186-.439v-5.625h-17.5v5.625c0 .169.062.316.186.439a.6.6 0 0 0 .439.186h16.25a.605.605 0 0 0 .439-.186zM9.995 14.674a.601.601 0 0 1 .186.439.598.598 0 0 1-.186.439.601.601 0 0 1-.439.186H5.18a.598.598 0 0 1-.439-.186.6.6 0 0 1-.186-.439.6.6 0 0 1 .186-.439.6.6 0 0 1 .439-.186h4.375c.169 0 .316.062.44.186zm9.375 0a.601.601 0 0 1 .186.439.598.598 0 0 1-.186.439.601.601 0 0 1-.439.186h-1.25a.598.598 0 0 1-.439-.186.6.6 0 0 1-.186-.439.6.6 0 0 1 .186-.439.6.6 0 0 1 .439-.186h1.25c.168 0 .315.062.439.186z" />
										</svg>

									</i>
									<div>
										<h6 class="d-inline" style="color: #ffffff;">Payment Methods. </h6>
										<p class="d-inline">Credit Card: Visa, MasterCard, Maestro, American Express.</p>
									</div>
								</div>
								<div class="col-12 col-lg-4 d-flex align-items-center justify-content-center justify-content-lg-start py-10">
									<i class="mr-15">

										<svg style="fill: #ffffff;" aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-009" viewBox="0 0 24 24">
											<path d="M2.453 8.299c-.026-.039-.048-.075-.068-.107a2.896 2.896 0 0 0-.068-.107.715.715 0 0 1 0-.469 2.48 2.48 0 0 0 .068-.107c.02-.033.042-.068.068-.107l5-5a.9.9 0 0 1 .215-.128c.078-.032.156-.049.234-.049s.156.017.234.049a.93.93 0 0 1 .215.127c.117.13.176.28.176.449a.652.652 0 0 1-.176.449L4.407 7.225h10.059a6.36 6.36 0 0 1 2.549.518 6.63 6.63 0 0 1 2.09 1.406c.593.592 1.062 1.289 1.406 2.09s.518 1.65.518 2.549-.173 1.748-.518 2.549a6.63 6.63 0 0 1-1.406 2.09 6.647 6.647 0 0 1-2.09 1.406 6.373 6.373 0 0 1-2.549.518H8.528a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439c0-.169.062-.316.186-.439a.595.595 0 0 1 .439-.187h5.938a5.12 5.12 0 0 0 2.061-.42 5.397 5.397 0 0 0 1.689-1.143 5.454 5.454 0 0 0 1.143-1.689 5.12 5.12 0 0 0 .42-2.061c0-.729-.14-1.416-.42-2.061a5.397 5.397 0 0 0-2.832-2.832 5.116 5.116 0 0 0-2.061-.42H4.407L8.352 12.4c.117.13.176.28.176.449a.652.652 0 0 1-.176.449.652.652 0 0 1-.449.176.652.652 0 0 1-.449-.176L2.453 8.299z" />
										</svg>

									</i>
									<div>
										<h6 class="d-inline" style="color: #ffffff;">Returns and Refunds. </h6>
										<p class="d-inline">You can return any item purchased on Shella within 20 days of
											the delivery date.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div><!-- END content_for_index -->
<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>