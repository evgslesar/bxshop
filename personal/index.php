<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");
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
<?$APPLICATION->IncludeComponent("bitrix:main.profile", "flat", Array(
	"CHECK_RIGHTS" => "N",	// Проверять права доступа
		"SEND_INFO" => "N",	// Генерировать почтовое событие
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"USER_PROPERTY" => "",	// Показывать доп. свойства
		"USER_PROPERTY_NAME" => "",	// Название закладки с доп. свойствами
	),
	false
);?>
</div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>