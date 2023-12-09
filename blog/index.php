<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Блог");
?><!-- mt main start here -->
<main id="mt-main">
	<!-- Mt Contact Banner of the Page -->
	<section class="mt-contact-banner wow fadeInUp" data-wow-delay="0.4s" style="background-image: url(http://placehold.it/1920x205);">
		<div class="container">
			<div class="row">
			<div class="col-xs-12 text-center">
				<h1>BLOG LIST SIDEBAR</h1>
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
	<!-- Mt Contact Banner of the Page end -->
	<!-- Mt Blog Detail of the Page -->
	<div class="mt-blog-detail style1">
		<div class="container">
			<div class="row">

				<?$APPLICATION->IncludeComponent(
					"bitrix:news", 
					"blog", 
					array(
						"COMPONENT_TEMPLATE" => "blog",
						"IBLOCK_TYPE" => "articles",
						"IBLOCK_ID" => "3",
						"NEWS_COUNT" => "2",
						"USE_SEARCH" => "N",
						"USE_RSS" => "N",
						"USE_RATING" => "Y",
						"MAX_VOTE" => "5",
						"VOTE_NAMES" => array(
							0 => "1",
							1 => "2",
							2 => "3",
							3 => "4",
							4 => "5",
							5 => "",
						),
						"USE_CATEGORIES" => "N",
						"USE_REVIEW" => "Y",
						"MESSAGES_PER_PAGE" => "10",
						"USE_CAPTCHA" => "Y",
						"REVIEW_AJAX_POST" => "Y",
						"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
						"FORUM_ID" => "1",
						"URL_TEMPLATES_READ" => "",
						"SHOW_LINK_TO_FORUM" => "Y",
						"USE_FILTER" => "N",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_ORDER1" => "DESC",
						"SORT_BY2" => "SORT",
						"SORT_ORDER2" => "ASC",
						"CHECK_DATES" => "Y",
						"SEF_MODE" => "Y",
						"SEF_FOLDER" => "/blog/",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"SET_LAST_MODIFIED" => "Y",
						"SET_TITLE" => "Y",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"ADD_SECTIONS_CHAIN" => "Y",
						"ADD_ELEMENT_CHAIN" => "Y",
						"USE_PERMISSIONS" => "N",
						"STRICT_SECTION_CHECK" => "Y",
						"DISPLAY_AS_RATING" => "rating",
						"DISPLAY_DATE" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"USE_SHARE" => "Y",
						"SHARE_HIDE" => "N",
						"SHARE_TEMPLATE" => "",
						"SHARE_HANDLERS" => array(
							0 => "delicious",
							1 => "facebook",
							2 => "twitter",
							3 => "vk",
						),
						"SHARE_SHORTEN_URL_LOGIN" => "",
						"SHARE_SHORTEN_URL_KEY" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
						"LIST_FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"LIST_PROPERTY_CODE" => array(
							0 => "FORUM_MESSAGE_CNT",
							1 => "",
						),
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"DISPLAY_NAME" => "Y",
						"META_KEYWORDS" => "-",
						"META_DESCRIPTION" => "-",
						"BROWSER_TITLE" => "-",
						"DETAIL_SET_CANONICAL_URL" => "N",
						"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
						"DETAIL_FIELD_CODE" => array(
							0 => "",
							1 => "",
						),
						"DETAIL_PROPERTY_CODE" => array(
							0 => "ATT_SOURCE",
							1 => "FORUM_MESSAGE_CNT",
							2 => "",
						),
						"DETAIL_DISPLAY_TOP_PAGER" => "N",
						"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
						"DETAIL_PAGER_TITLE" => "Страница",
						"DETAIL_PAGER_TEMPLATE" => "",
						"DETAIL_PAGER_SHOW_ALL" => "Y",
						"PAGER_TEMPLATE" => "custom",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"PAGER_TITLE" => "Новости",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"SET_STATUS_404" => "Y",
						"SHOW_404" => "Y",
						"FILE_404" => "",
						"SEF_URL_TEMPLATES" => array(
							"news" => "",
							"section" => "#SECTION_CODE_PATH#/",
							"detail" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
						)
					),
					false
				);?>
        
				<div class="col-xs-12 col-sm-4 text-right sidebar wow fadeInRight" data-wow-delay="0.4s">
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/side-categories.php"
					)
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/side-popular.php"
					)
				);?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/includes/side-tags.php"
					)
				);?>
				</div>
			</div>
		</div>
	</div>
	<!-- Mt Blog Detail of the Page end -->
</main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>