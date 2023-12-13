<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?><!-- mt main start here --> <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?><main id="mt-main">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bazarow:slider.from.hlblocks",
	"top_ads",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => "top_ads",
		"HL_BLOCK" => "4",
		"HL_BLOCK_FIELDS_LINK" => "UF_TOPADS_LINK",
		"HL_BLOCK_FIELDS_NAME" => "UF_TOPADS_TITLE",
		"HL_BLOCK_FIELDS_PICTURE" => "UF_TOPADS_PICTURE"
	)
);?><?$APPLICATION->IncludeComponent(
	"neti:favorite.icon",
	"",
	Array(
		"LINK" => ""
	)
);?>
</div>
 </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>