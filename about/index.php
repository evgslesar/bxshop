<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании");
?><!-- mt main start here --><main id="mt-main">
<div class="container">
	 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"",
	Array(
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?><?$APPLICATION->IncludeComponent(
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
</div>
 </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>