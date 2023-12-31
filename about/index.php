<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?><!-- mt main start here --> <main id="mt-main">
<div class="container">
	 <?$APPLICATION->IncludeComponent("interlabs:oneclick", "oneclick_popup", Array(
	"AGREE_PROCESSING" => "Y",	// Согласие на обработку ПД
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"BUY_STRATEGY" => "ProductAndBasket",	// Стратегия покупки
		"PRODUCT_ID" => "#ELEMENT_ID#",	// ID товара
		"USE_CAPTCHA" => "Y",	// Каптча
		"USE_FIELD_COMMENT" => "Y",	// Поле комментарий
		"USE_FIELD_EMAIL" => "Y",	// Поле email
	),
	false
);?>
</div>
 </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>