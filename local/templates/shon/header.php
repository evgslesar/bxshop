<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$CurDir = $APPLICATION->GetCurDir();
$CurUri = $APPLICATION->GetCurUri();
?>
<!doctype html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>">
<head>
    <?

    use Bitrix\Main\Page\Asset;
    use Bitrix\Main\UI\Extension;

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/plugins.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery.main.js');
    // CSS;
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/bootstrap.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/animate.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/icon-fonts.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/main.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/responsive.css');
    // HEADERS
    $APPLICATION->ShowHead();
    ?>

    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- <link rel="apple-touch-icon" sizes="57x57" href="/local/ico/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/local/ico/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/local/ico/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/local/ico/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/local/ico/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/local/ico/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/local/ico/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/local/ico/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/local/ico/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/local/ico/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/local/ico/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/local/ico/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/local/ico/favicon-16x16.png">
    <link rel="manifest" href="/local/ico/manifest.json"> -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900,900italic%7cMontserrat:400,700%7cOxygen:400,300,700' rel='stylesheet' type='text/css'>
    <!-- <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/local/ico/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff"> -->
    <title><? $APPLICATION->ShowTitle() ?></title>
	<?php \Bitrix\Main\UI\Extension::load('neti_favorite.neti_lib'); ?>

</head>
<body>
<?$APPLICATION->ShowPanel();?>

	<!-- main container of all the page elements -->
	<div id="wrapper">
		<!-- Page Loader -->
    <div id="pre-loader" class="loader-container">
      <div class="loader">
        <img src="<?php echo SITE_TEMPLATE_PATH ?>/images/svg/rings.svg" alt="loader">
      </div>
    </div>
		<!-- W1 start here -->
		<div class="w1">
			<!-- mt header style3 start here -->
			<header id="mt-header" class="style3">
				<!-- mt top bar start here -->
				<div class="mt-top-bar">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-md-4 col-lg-6 hidden-xs">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/includes/header-phone.php"
									)
								);?>

								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/includes/header-email.php"
									)
								);?>
							</div>
							<div id="compare_list_count"  class="col-xs-6 col-md-3 col-lg-2 text-right">
            				<?php $APPLICATION->IncludeComponent(
								"bitrix:catalog.compare.list", 
								"compare_top", 
								array(
							        "IBLOCK_TYPE" => "catalog", //Сюда ваш тип инфоблока каталога
							        "IBLOCK_ID" => "18", //Сюда ваш ID инфоблока каталога
							        "AJAX_MODE" => "N",
							        "AJAX_OPTION_JUMP" => "N",
							        "AJAX_OPTION_STYLE" => "Y",
							        "AJAX_OPTION_HISTORY" => "N",
							        "DETAIL_URL" => "#SECTION_CODE#",
							        "COMPARE_URL" => "/catalog/compare.php",
							        "NAME" => "CATALOG_COMPARE_LIST",
							        "AJAX_OPTION_ADDITIONAL" => ""
							 	),
								false
							); ?>	
							</div>
							<div class="col-xs-6 col-md-5 col-lg-4 text-right">
							<?$APPLICATION->IncludeComponent(
								"bitrix:menu", 
								"top_auth_menu", 
								array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "left",
									"DELAY" => "N",
									"MAX_LEVEL" => "1",
									"MENU_CACHE_GET_VARS" => array(
									),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "N",
									"MENU_CACHE_USE_GROUPS" => "Y",
									"MENU_THEME" => "black",
									"ROOT_MENU_TYPE" => "top_auth",
									"USE_EXT" => "N",
									"COMPONENT_TEMPLATE" => "top_auth_menu"
								),
								false
							);?> 
							</div>
						</div>
					</div>
				</div>
				<!-- mt top bar end here -->
				<!-- mt bottom bar start here -->
				<div class="mt-bottom-bar">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<!-- mt logo start here -->
								<div class="mt-logo">
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include",
									"",
									Array(
										"AREA_FILE_SHOW" => "file",
										"AREA_FILE_SUFFIX" => "inc",
										"EDIT_TEMPLATE" => "",
										"PATH" => "/includes/header-logo.php"
									)
								);?>
								</div>
								<!-- mt sh cart start here -->
								<div class="mt-sh-cart">
								<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"top_cart", 
	array(
		"COMPONENT_TEMPLATE" => "top_cart",
		"HIDE_ON_BASKET_PAGES" => "N",
		"MAX_IMAGE_SIZE" => "70",
		"PATH_TO_AUTHORIZE" => SITE_DIR."personal/auth/",
		"PATH_TO_BASKET" => SITE_DIR."personal/cart/",
		"PATH_TO_ORDER" => SITE_DIR."personal/order_make/",
		"PATH_TO_PERSONAL" => SITE_DIR."personal/",
		"PATH_TO_PROFILE" => SITE_DIR."personal/",
		"PATH_TO_REGISTER" => SITE_DIR."personal/auth/",
		"POSITION_FIXED" => "N",
		"SHOW_AUTHOR" => "Y",
		"SHOW_DELAY" => "N",
		"SHOW_EMPTY_VALUES" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_NOTAVAIL" => "N",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"SHOW_PRICE" => "Y",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_REGISTRATION" => "N",
		"SHOW_SUMMARY" => "Y",
		"SHOW_TOTAL_PRICE" => "Y"
	),
	false
);?>
								</div>
								<!-- mt sh cart end here -->
								<!-- mt icon list start here -->
								<ul class="mt-icon-list">
									<li class="hidden-lg hidden-md">
										<a href="#" class="bar-opener mobile-toggle">
											<span class="bar"></span>
											<span class="bar small"></span>
											<span class="bar"></span>
										</a>
									</li>
									<li><a href="#" class="icon-magnifier"></a></li>
								</ul><!-- mt icon list end here -->
								<!-- navigation start here -->
								<?$APPLICATION->IncludeComponent("bitrix:menu", "main_top_menu", Array(
									"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
										"CHILD_MENU_TYPE" => "catalog_cat",	// Тип меню для остальных уровней
										"DELAY" => "N",	// Откладывать выполнение шаблона меню
										"MAX_LEVEL" => "2",	// Уровень вложенности меню
										"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
											0 => "",
										),
										"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
										"MENU_CACHE_TYPE" => "N",	// Тип кеширования
										"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
										"ROOT_MENU_TYPE" => "top_main",	// Тип меню для первого уровня
										"USE_EXT" => "Y",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
									),
									false
								);?>

								<!-- mt icon list end here -->
							</div>
						</div>
					</div>
				</div>
				<!-- mt bottom bar end here -->
				<span class="mt-side-over"></span>
			</header><!-- mt header end here -->
			<!-- mt search popup start here -->
			<div class="mt-search-popup">
				<div class="mt-holder">
					<a href="#" class="search-close"><span></span><span></span></a>
					<div class="mt-frame">
					<?$APPLICATION->IncludeComponent(
						"bitrix:search.title",
						"header_search",
						Array(
							"CATEGORY_0" => array(),
							"CATEGORY_0_TITLE" => "",
							"CHECK_DATES" => "N",
							"CONTAINER_ID" => "title-search",
							"INPUT_ID" => "title-search-input",
							"NUM_CATEGORIES" => "1",
							"ORDER" => "date",
							"PAGE" => "#SITE_DIR#search/index.php",
							"SHOW_INPUT" => "Y",
							"SHOW_OTHERS" => "N",
							"TOP_COUNT" => "5",
							"USE_LANGUAGE_GUESS" => "Y"
						)
					);?>
					</div>
				</div>
			</div><!-- mt search popup end here -->