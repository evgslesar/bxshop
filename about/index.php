<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?>
<!-- mt main start here -->
<main id="mt-main">
<div class="container">
<?$APPLICATION->IncludeComponent("bitrix:search.title", "", Array(
	"CATEGORY_0" => "",	// Ограничение области поиска
		"CATEGORY_0_TITLE" => "",	// Название категории
		"CHECK_DATES" => "N",	// Искать только в активных по дате документах
		"CONTAINER_ID" => "title-search2",	// ID контейнера, по ширине которого будут выводиться результаты
		"INPUT_ID" => "title-search-input2",	// ID строки ввода поискового запроса
		"NUM_CATEGORIES" => "1",	// Количество категорий поиска
		"ORDER" => "date",	// Сортировка результатов
		"PAGE" => "#SITE_DIR#search/index.php",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
		"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
		"SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
		"TOP_COUNT" => "5",	// Количество результатов в каждой категории
		"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
	),
	false
);?>

</div>
</main>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>