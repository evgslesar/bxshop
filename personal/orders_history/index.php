<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("История заказов");
?>
<main id="mt-main">
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

<div class="container">
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "orders_history", Array(
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"ALLOW_INNER" => "N",	// Разрешить оплату с внутреннего счета
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CUSTOM_SELECT_PROPS" => array(	// Дополнительные свойства инфоблока
			0 => "",
		),
		"DETAIL_HIDE_USER_INFO" => array(	// Не показывать в информации о пользователе
			0 => "0",
		),
		"DISALLOW_CANCEL" => "N",	// Запретить отмену заказа
		"HISTORIC_STATUSES" => array(	// Перенести в историю заказы в статусах
			0 => "F",
		),
		"NAV_TEMPLATE" => "",	// Имя шаблона для постраничной навигации
		"ONLY_INNER_FULL" => "N",	// Разрешить оплату с внутреннего счета только в полном объеме
		"ORDERS_PER_PAGE" => "20",	// Количество заказов на одной странице
		"ORDER_DEFAULT_SORT" => "STATUS",	// Сортировка заказов
		"PATH_TO_BASKET" => "/personal/cart",	// Страница с корзиной
		"PATH_TO_CATALOG" => "/catalog/",	// Путь к каталогу
		"PATH_TO_PAYMENT" => "/personal/order/payment/",	// Страница подключения платежной системы
		"REFRESH_PRICES" => "N",	// Пересчитывать заказ после смены платежной системы
		"RESTRICT_CHANGE_PAYSYSTEM" => array(	// Запретить смену платежной системы у заказов в статусах
			0 => "0",
		),
		"SAVE_IN_SESSION" => "Y",	// Сохранять установки фильтра в сессии пользователя
		"SEF_FOLDER" => "/personal/orders_history/",	// Каталог ЧПУ (относительно корня сайта)
		"SEF_MODE" => "Y",	// Включить поддержку ЧПУ
		"SEF_URL_TEMPLATES" => array(
			"cancel" => "cancel/#ID#",
			"detail" => "detail/#ID#",
			"list" => "index.php",
		),
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"STATUS_COLOR_F" => "gray",	// Цвет статуса "Выполнен"
		"STATUS_COLOR_N" => "green",	// Цвет статуса "Принят, ожидается оплата"
		"STATUS_COLOR_PSEUDO_CANCELLED" => "red",	// Цвет отменённых заказов
	),
	false
);?>
</div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>