<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
?><main id="mt-main">
	<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s">
		<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
			<h1><?php echo $APPLICATION->GetTitle(); ?></h1>
			<!-- Breadcrumbs of the Page -->
			<nav class="breadcrumbs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb", 
					"breadcrumbs", 
					array(
						"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0",
						"COMPONENT_TEMPLATE" => "breadcrumbs"
					),
					false
				);?>
			</nav>
			<!-- Breadcrumbs of the Page end -->
			</div>
		</div>
		</div>
	</section>
	        <!-- Mt Process Section of the Page -->
			<div class="mt-process-sec wow fadeInUp" data-wow-delay="0.4s">
          <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <ul class="list-unstyled process-list">
                  <li class="active">
                    <span class="counter">01</span>
                    <strong class="title">Корзина</strong>
                  </li>
                  <li>
                    <span class="counter">02</span>
                    <strong class="title">Оформление заказа</strong>
                  </li>
                  <li>
                    <span class="counter">03</span>
                    <strong class="title">Завершение</strong>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div><!-- Mt Process Section of the Page end -->
        <!-- Mt Product Table of the Page -->
        <div class="mt-product-table wow fadeInUp" data-wow-delay="0.4s">
			<div class="container">
			<?$APPLICATION->IncludeComponent(
				"bitrix:sale.basket.basket", 
				"cart", 
				array(
					"ACTION_VARIABLE" => "basketAction",
					"ADDITIONAL_PICT_PROP_1" => "-",
					"ADDITIONAL_PICT_PROP_2" => "-",
					"AUTO_CALCULATION" => "Y",
					"BASKET_IMAGES_SCALING" => "adaptive",
					"COLUMNS_LIST_EXT" => array(
						0 => "PREVIEW_PICTURE",
						1 => "DISCOUNT",
						2 => "DELETE",
						3 => "DELAY",
						4 => "TYPE",
						5 => "SUM",
					),
					"COLUMNS_LIST_MOBILE" => array(
						0 => "PREVIEW_PICTURE",
						1 => "DISCOUNT",
						2 => "DELETE",
						3 => "DELAY",
						4 => "TYPE",
						5 => "SUM",
					),
					"COMPATIBLE_MODE" => "Y",
					"CORRECT_RATIO" => "Y",
					"DEFERRED_REFRESH" => "N",
					"DISCOUNT_PERCENT_POSITION" => "bottom-right",
					"DISPLAY_MODE" => "extended",
					"EMPTY_BASKET_HINT_PATH" => "/catalog/",
					"GIFTS_BLOCK_TITLE" => "Выберите один из подарков",
					"GIFTS_CONVERT_CURRENCY" => "N",
					"GIFTS_HIDE_BLOCK_TITLE" => "N",
					"GIFTS_HIDE_NOT_AVAILABLE" => "N",
					"GIFTS_MESS_BTN_BUY" => "Выбрать",
					"GIFTS_MESS_BTN_DETAIL" => "Подробнее",
					"GIFTS_PAGE_ELEMENT_COUNT" => "4",
					"GIFTS_PLACE" => "BOTTOM",
					"GIFTS_PRODUCT_PROPS_VARIABLE" => "prop",
					"GIFTS_PRODUCT_QUANTITY_VARIABLE" => "quantity",
					"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
					"GIFTS_SHOW_OLD_PRICE" => "N",
					"GIFTS_TEXT_LABEL_GIFT" => "Подарок",
					"HIDE_COUPON" => "N",
					"LABEL_PROP" => array(
					),
					"PATH_TO_ORDER" => "/personal/order_make/",
					"PRICE_DISPLAY_MODE" => "Y",
					"PRICE_VAT_SHOW_VALUE" => "N",
					"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
					"QUANTITY_FLOAT" => "Y",
					"SET_TITLE" => "Y",
					"SHOW_DISCOUNT_PERCENT" => "Y",
					"SHOW_FILTER" => "Y",
					"SHOW_RESTORE" => "Y",
					"TEMPLATE_THEME" => "blue",
					"TOTAL_BLOCK_DISPLAY" => array(
						0 => "bottom",
					),
					"USE_DYNAMIC_SCROLL" => "Y",
					"USE_ENHANCED_ECOMMERCE" => "N",
					"USE_GIFTS" => "N",
					"USE_PREPAYMENT" => "N",
					"USE_PRICE_ANIMATION" => "Y",
					"COMPONENT_TEMPLATE" => "cart",
					"ADDITIONAL_PICT_PROP_5" => "MORE_PHOTO",
					"ADDITIONAL_PICT_PROP_6" => "MORE_PHOTO",
					"ADDITIONAL_PICT_PROP_9" => "-",
					"ADDITIONAL_PICT_PROP_10" => "-",
					"ADDITIONAL_PICT_PROP_11" => "-",
					"ADDITIONAL_PICT_PROP_12" => "-"
				),
				false
			);?>
			</div>
		</div>
</main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>