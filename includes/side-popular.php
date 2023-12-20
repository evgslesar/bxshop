<!-- Popular Widget of the Page -->
<section class="widget popular-widget">
	<h3>Последние публикации</h3>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.line", 
	"sidebar_popular", 
	array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "300",
		"CACHE_TYPE" => "A",
		"DETAIL_URL" => "#SITE_DIR#/blog/?ELEMENT_ID=#ELEMENT_ID#",
		"FIELD_CODE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "CREATED_USER_NAME",
			2 => "",
		),
		"IBLOCKS" => array(
			0 => "3",
		),
		"IBLOCK_TYPE" => "articles",
		"NEWS_COUNT" => "4",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"COMPONENT_TEMPLATE" => "sidebar_popular"
	),
	false
);?>
</section>
<!-- Popular Widget of the Page end -->
