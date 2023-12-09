<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle('Главная');
?> 

<!-- mt main start here -->
<main id="mt-main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <?php /* ?>
                <!-- banner frame start here -->
                <div class="banner-frame toppadding-zero">
                    <!-- banner 5 white start here -->
                    <div class="banner-5 white wow fadeInLeft" data-wow-delay="0.4s">
                        <img src="http://placehold.it/590x565" alt="image description">
                        <div class="holder">
                            <div class="texts">
                                <strong class="title">FURNITURE DESIGNS IDEAS</strong>
                                <h3><strong>New</strong> Collection</h3>
                                <p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
                                <span class="price-add">$ 79.00</span>
                            </div>
                        </div>
                    </div><!-- banner 5 white end here -->
                    <!-- banner 6 white start here -->
                    <div class="banner-6 white wow fadeInRight" data-wow-delay="0.4s">
                        <img src="http://placehold.it/275x565" alt="image description">
                        <div class="holder">
                            <strong class="sub-title">SOFAS &amp; ARMCHAIRS</strong>
                            <h3>3 Seater Leather Sofa</h3>
                            <span class="offer">
                                <span class="price-less">$ 659.00</span>
                                <span class="prices">$ 499.00</span>
                            </span>
                            <a href="product-detail.html" class="btn-shop">
                                <span>shop now</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!-- banner 5 white end here -->
                    <!-- banner box two start here -->
                    <div class="banner-box two">
                        <!-- banner 7 right start here -->
                        <div class="banner-7 right wow fadeInUp" data-wow-delay="0.4s">
                            <img src="http://placehold.it/295x275" alt="image description">
                            <div class="holder">
                                <h2><strong>ACRYLIC FABRIC <br>BEAN BAG</strong></h2>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <div class="price-tag">
                                    <span class="price">$ 99.00</span>
                                    <a class="shop-now" href="product-detail.html">SHOP NOW</a>
                                </div>
                            </div>
                        </div><!-- banner 7 right end here -->
                        <!-- banner 8 start here -->
                        <div class="banner-8 wow fadeInDown" data-wow-delay="0.4s">
                            <img src="http://placehold.it/295x275" alt="image description">
                            <div class="holder">
                                <h2><strong>CHAIR WITH <br>ARMRESTS</strong></h2>
                                <ul class="mt-stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                </ul>
                                <div class="price-tag">
                                    <span class="price-off">$ 129.00</span>
                                    <span class="price">$ 99.00</span>
                                    <a class="btn-shop" href="product-detail.html">
                                        <span>HURRY UP!</span> 
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div><!-- banner 8 start here -->
                    </div>
                </div><!-- banner frame end here -->
                <?php */ ?>
                <!-- banner frame start here -->
                <div class="banner-frame toppadding-zero">
                    <!-- banner box third start here -->
                    <div class="banner-box third">
                        <!-- banner 12 right white start here -->
                        <div class="banner-12 right white wow fadeInUp" data-wow-delay="0.4s">
                            <img src="http://placehold.it/415x225" alt="image description">
                            <div class="holder">
                                <h2><span>Chairs</span><strong>ZIO DINING CHAIR</strong></h2>
                                <a class="btn-shop" href="product-detail.html">
                                    <span>SHOP NOW</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div><!-- banner 12 right white end here -->
                        <!-- banner 13 right start here -->
                        <div class="banner-13 right wow fadeInDown" data-wow-delay="0.4s">
                            <img src="http://placehold.it/415x335" alt="image description">
                            <div class="holder">
                                <h2><span>Accessories / Lighting</span><strong>TOTEM FLOOR LAMP</strong></h2>
                                <a class="btn-shop" href="product-detail.html">
                                    <span>SHOP NOW</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div><!-- banner 13 right end here -->
                    </div><!-- banner box third end here -->
                    <!-- slider 7 start here -->
                    <div class="slider-7 wow fadeInRight" data-wow-delay="0.4s">
                    <?$APPLICATION->IncludeComponent(
                        "bazarow:slider.from.hlblocks", 
                        "top_ads", 
                        array(
                            "CACHE_TIME" => "3600",
                            "CACHE_TYPE" => "A",
                            "HL_BLOCK" => "4",
                            "HL_BLOCK_FIELDS_LINK" => "UF_TOPADS_LINK",
                            "HL_BLOCK_FIELDS_NAME" => "UF_TOPADS_TITLE",
                            "HL_BLOCK_FIELDS_PICTURE" => "UF_TOPADS_PICTURE",
                            "COMPONENT_TEMPLATE" => "top_ads"
                        ),
                        false
                    );?>
                    </div><!-- slider 7 end here -->
                </div><!-- banner frame end here --> 
                <!-- mt producttabs style2 start here -->
                <div class="mt-producttabs style2 wow fadeInUp" data-wow-delay="0.4s">
                    <!-- producttabs start here -->
                    <ul class="producttabs">
                        <li><a href="#tab1" class="active">Популярные</a></li>
                        <li><a href="#tab2">Новые</a></li>
                    </ul>
                    <!-- producttabs end here -->
                    <div class="tab-content">
                        <div id="tab1">
                        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"slider_on_main", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_PATH" => "",
		"COMPATIBLE_MODE" => "N",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"DETAIL_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "shows",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
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
		"MESS_BTN_COMPARE" => "Сравнить",
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
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "6",
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
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SEF_RULE" => "#SECTION_CODE_PATH#",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_COMPARE_LIST" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "slider_on_main"
	),
	false
);?>
                        </div>
                        <div id="tab2">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:catalog.section", 
                            "slider_on_main", 
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
                                "BASKET_URL" => "/personal/cart/",
                                "BROWSER_TITLE" => "-",
                                "CACHE_FILTER" => "N",
                                "CACHE_GROUPS" => "Y",
                                "CACHE_TIME" => "36000",
                                "CACHE_TYPE" => "A",
                                "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                                "COMPARE_PATH" => "",
                                "COMPATIBLE_MODE" => "N",
                                "CONVERT_CURRENCY" => "N",
                                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                                "DETAIL_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
                                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "DISPLAY_COMPARE" => "Y",
                                "DISPLAY_TOP_PAGER" => "N",
                                "ELEMENT_SORT_FIELD" => "timestamp_x",
                                "ELEMENT_SORT_FIELD2" => "id",
                                "ELEMENT_SORT_ORDER" => "desc",
                                "ELEMENT_SORT_ORDER2" => "desc",
                                "ENLARGE_PRODUCT" => "STRICT",
                                "FILTER_NAME" => "arrFilter",
                                "HIDE_NOT_AVAILABLE" => "N",
                                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                "IBLOCK_ID" => "1",
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
                                "MESS_BTN_COMPARE" => "Сравнить",
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
                                "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_TEMPLATE" => "",
                                "PAGER_TITLE" => "Товары",
                                "PAGE_ELEMENT_COUNT" => "6",
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
                                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false}]",
                                "PRODUCT_SUBSCRIPTION" => "Y",
                                "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                                "RCM_TYPE" => "personal",
                                "SECTION_CODE" => "",
                                "SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
                                "SECTION_ID" => "",
                                "SECTION_ID_VARIABLE" => "SECTION_ID",
                                "SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/",
                                "SECTION_USER_FIELDS" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "SEF_MODE" => "N",
                                "SEF_RULE" => "#SECTION_CODE_PATH#",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_LAST_MODIFIED" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_STATUS_404" => "N",
                                "SET_TITLE" => "N",
                                "SHOW_404" => "N",
                                "SHOW_ALL_WO_SECTION" => "N",
                                "SHOW_CLOSE_POPUP" => "N",
                                "SHOW_DISCOUNT_PERCENT" => "N",
                                "SHOW_FROM_SECTION" => "N",
                                "SHOW_MAX_QUANTITY" => "N",
                                "SHOW_OLD_PRICE" => "N",
                                "SHOW_PRICE_COUNT" => "1",
                                "SHOW_SLIDER" => "N",
                                "SLIDER_INTERVAL" => "3000",
                                "SLIDER_PROGRESS" => "N",
                                "TEMPLATE_THEME" => "blue",
                                "USE_COMPARE_LIST" => "N",
                                "USE_ENHANCED_ECOMMERCE" => "N",
                                "USE_MAIN_ELEMENT_SECTION" => "N",
                                "USE_PRICE_COUNT" => "N",
                                "USE_PRODUCT_QUANTITY" => "N",
                                "COMPONENT_TEMPLATE" => "slider_on_main"
                            ),
                            false
                        );?>
                        </div>
                    </div>
                </div><!-- mt producttabs end here -->
                <!-- banner frame start here -->
                <div class="banner-frame nospace wow fadeInUp" data-wow-delay="0.4s">
                    <!-- banner 9 start here -->
                    <div class="banner-9">
                        <img src="http://placehold.it/400x210" alt="image description">
                        <div class="holder">
                            <h2><span>Wall Decor</span><strong>CLOCKs</strong></h2>
                            <a class="btn-shop" href="product-detail.html">
                                <span>VIEW</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!-- banner 9 end here -->
                    <!-- banner 10 start here -->
                    <div class="banner-10">
                        <img src="http://placehold.it/400x210" alt="image description">
                        <div class="holder">
                            <h2><span>Coffee Tables</span><strong>S.O.S. BLOCKS</strong></h2>
                            <a class="btn-shop" href="product-detail.html">
                                <span>VIEW</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!-- banner 10 end here -->
                    <!-- banner 11 start here -->
                    <div class="banner-11">
                        <img src="http://placehold.it/400x210" alt="image description">
                        <div class="holder">
                            <h2><span>Floor Lamps</span><strong>ROCKING LAMP</strong></h2>
                            <a class="btn-shop" href="product-detail.html">
                                <span>VIEW</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!-- banner 11 end here -->
                </div><!-- banner frame end here -->
                <!-- mt producttabs style3 start here -->
                <div class="mt-producttabs style3 wow fadeInUp" data-wow-delay="0.4s">
                    <h2 class="heading">Бестселлеры</h2>
                    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"slider_on_main_best", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADD_PICT_PROP" => "-",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_TO_BASKET_ACTION" => "ADD",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BACKGROUND_IMAGE" => "UF_BACKGROUND_IMAGE",
		"BASKET_URL" => "/personal/cart/",
		"BROWSER_TITLE" => "-",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000",
		"CACHE_TYPE" => "A",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_PATH" => "",
		"COMPATIBLE_MODE" => "N",
		"CONVERT_CURRENCY" => "N",
		"CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
		"DETAIL_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_COMPARE" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "SCALED_PRICE_1",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "desc",
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
		"MESS_BTN_COMPARE" => "Сравнить",
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
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_TITLE" => "Товары",
		"PAGE_ELEMENT_COUNT" => "6",
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
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'6','BIG_DATA':false}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"],
		"SECTION_ID" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_URL" => "#SITE_DIR#/catalog/#SECTION_CODE_PATH#/",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SEF_MODE" => "N",
		"SEF_RULE" => "#SECTION_CODE_PATH#",
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SHOW_ALL_WO_SECTION" => "N",
		"SHOW_CLOSE_POPUP" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_MAX_QUANTITY" => "N",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_SLIDER" => "N",
		"SLIDER_INTERVAL" => "3000",
		"SLIDER_PROGRESS" => "N",
		"TEMPLATE_THEME" => "blue",
		"USE_COMPARE_LIST" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "N",
		"COMPONENT_TEMPLATE" => "slider_on_main_best"
	),
	false
);?>
                </div><!-- mt producttabs style3 end here -->
                <!-- Mt Blog Detail of the Page -->
                <div class="mt-blog-detail style1">
                <div class="container">
                    <div class="row">
                    <div class="col-xs-12 col-sm-8 wow fadeInLeft" data-wow-delay="0.4s">
                        <!-- Blog Post of the Page -->
                        <article class="blog-post style2">
                        <div class="img-holder">
                            <a href="blog-post-detail-sidebar.html"><img src="http://placehold.it/280x170" alt="image description"></a>
                            <ul class="list-unstyled comment-nav">
                            <li><a href="#"><i class="fa fa-comments"></i>12</a></li>
                            <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
                            </ul>
                        </div>
                        <div class="blog-txt">
                            <h2><a href="blog-post-detail-sidebar.html">IDEAS FOR LIVING ROOMS</a></h2>
                            <ul class="list-unstyled blog-nav">
                            <li> <a href="#"><i class="fa fa-clock-o"></i>20 April 2015</a></li>
                            <li> <a href="#"><i class="fa fa-list"></i>Design</a></li>
                            <li> <a href="#"><i class="fa fa-comment"></i>2 Comments</a></li>
                            </ul>
                            <p>Fusce mattis nunc lacus, vulputate facilisis dui efficitur ut. Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem. </p>
                            <a href="blog-post-detail-sidebar.html" class="btn-more">Read More</a>
                        </div>
                        </article>
                        <!-- Blog Post of the Page end -->
                        <!-- Blog Post of the Page -->
                        <article class="blog-post style2">
                        <div class="img-holder">
                            <a href="blog-post-detail-sidebar.html"><img src="http://placehold.it/280x170" alt="image description"></a>
                            <ul class="list-unstyled comment-nav">
                            <li><a href="#"><i class="fa fa-comments"></i>12</a></li>
                            <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
                            </ul>
                        </div>
                        <div class="blog-txt">
                            <h2><a href="blog-post-detail-sidebar.html">IDEAS FOR LIVING ROOMS</a></h2>
                            <ul class="list-unstyled blog-nav">
                            <li> <a href="#"><i class="fa fa-clock-o"></i>20 April 2015</a></li>
                            <li> <a href="#"><i class="fa fa-list"></i>Design</a></li>
                            <li> <a href="#"><i class="fa fa-comment"></i>2 Comments</a></li>
                            </ul>
                            <p>Fusce mattis nunc lacus, vulputate facilisis dui efficitur ut. Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem. </p>
                            <a href="blog-post-detail-sidebar.html" class="btn-more">Read More</a>
                        </div>
                        </article>
                        <!-- Blog Post of the Page end -->
                        <!-- Blog Post of the Page -->
                        <article class="blog-post style2">
                        <div class="img-holder">
                            <a href="blog-post-detail-sidebar.html"><img src="http://placehold.it/280x170" alt="image description"></a>
                            <ul class="list-unstyled comment-nav">
                            <li><a href="#"><i class="fa fa-comments"></i>12</a></li>
                            <li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
                            </ul>
                        </div>
                        <div class="blog-txt">
                            <h2><a href="blog-post-detail-sidebar.html">IDEAS FOR LIVING ROOMS</a></h2>
                            <ul class="list-unstyled blog-nav">
                            <li> <a href="#"><i class="fa fa-clock-o"></i>20 April 2015</a></li>
                            <li> <a href="#"><i class="fa fa-list"></i>Design</a></li>
                            <li> <a href="#"><i class="fa fa-comment"></i>2 Comments</a></li>
                            </ul>
                            <p>Fusce mattis nunc lacus, vulputate facilisis dui efficitur ut. Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem. </p>
                            <a href="blog-post-detail-sidebar.html" class="btn-more">Read More</a>
                        </div>
                        </article>
                        <!-- Blog Post of the Page end -->
                    </div>
                    <div class="col-xs-12 col-sm-4 text-right sidebar wow fadeInRight" data-wow-delay="0.4s">
                        <div class="banner-frame toppadding-zero">
                            <div class="banner-box two">
                                <!-- banner 7 right start here -->
                                <div class="banner-7 right wow fadeInUp" data-wow-delay="0.4s">
                                    <img src="http://placehold.it/295x275" alt="image description">
                                    <div class="holder">
                                        <h2><strong>ACRYLIC FABRIC <br>BEAN BAG</strong></h2>
                                        <ul class="mt-stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <div class="price-tag">
                                            <span class="price">$ 99.00</span>
                                            <a class="shop-now" href="product-detail.html">SHOP NOW</a>
                                        </div>
                                    </div>
                                </div><!-- banner 7 right end here -->
                                <!-- banner 8 start here -->
                                <div class="banner-8 wow fadeInDown" data-wow-delay="0.4s">
                                    <img src="http://placehold.it/295x275" alt="image description">
                                    <div class="holder">
                                        <h2><strong>CHAIR WITH <br>ARMRESTS</strong></h2>
                                        <ul class="mt-stars">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                        </ul>
                                        <div class="price-tag">
                                            <span class="price-off">$ 129.00</span>
                                            <span class="price">$ 99.00</span>
                                            <a class="btn-shop" href="product-detail.html">
                                                <span>HURRY UP!</span> 
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div><!-- banner 8 start here -->
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Mt Blog Detail of the Page end -->
                <?$APPLICATION->IncludeComponent(
                    "bazarow:slider.from.hlblocks",
                    "",
                    Array(
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "HL_BLOCK" => "3",
                        "HL_BLOCK_FIELDS_LINK" => "UF_MAIN_SLIDER_LINK",
                        "HL_BLOCK_FIELDS_NAME" => "UF_MAIN_BANNER_NAME",
                        "HL_BLOCK_FIELDS_PICTURE" => "UF_MAIN_SLIDER_PICTURE"
                    )
                );?>
            </div>
        </div>
    </div>
</main>

<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>