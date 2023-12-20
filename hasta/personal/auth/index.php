<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?><?$APPLICATION->IncludeComponent("bitrix:main.auth.form", "flat", Array(
	"AUTH_FORGOT_PASSWORD_URL" => "getpassword.php?forgot_password=yes",	// Страница для восстановления пароля
		"AUTH_REGISTER_URL" => "registration.php",	// Страница для регистрации
		"AUTH_SUCCESS_URL" => "/hasta/personal/",	// Страница после успешной авторизации
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>