<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая");
?><?$APPLICATION->IncludeComponent("bitrix:system.auth.form", "auth", Array(
	"FORGOT_PASSWORD_URL" => "/User/",	// Страница забытого пароля
		"PROFILE_URL" => "/User/profil.php",	// Страница профиля
		"REGISTER_URL" => "/User/Registration.php",	// Страница регистрации
		"SHOW_ERRORS" => "N",	// Показывать ошибки
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>