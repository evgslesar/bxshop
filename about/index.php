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
);?>
</div>
 </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>