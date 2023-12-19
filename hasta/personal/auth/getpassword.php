<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Восстановление пароля");
$APPLICATION->SetPageProperty("title", "Восстановление пароля");
$APPLICATION->SetPageProperty("keywords", "Восстановление пароля");
$APPLICATION->SetPageProperty("description", "Восстановление пароля");
$APPLICATION->SetTitle("Восстановление пароля");
?><?$APPLICATION->IncludeComponent("bitrix:main.auth.forgotpasswd", "template1", Array(
	"AUTH_AUTH_URL" => "index.php",	// Страница для авторизации
		"AUTH_REGISTER_URL" => "registration.php",	// Страница для регистрации
	),
	false
);?><br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>