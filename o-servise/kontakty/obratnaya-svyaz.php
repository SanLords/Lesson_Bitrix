<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?>
<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8 mb-5">
<?$APPLICATION->IncludeComponent("bitrix:main.feedback", "svaz", Array(
	"EMAIL_TO" => "cfcf.01@mail.ru",	// E-mail, на который будет отправлено письмо
		"EVENT_MESSAGE_ID" => "",	// Почтовые шаблоны для отправки письма
		"OK_TEXT" => "Спасибо, ваше сообщение принято.",	// Сообщение, выводимое пользователю после отправки
		"REQUIRED_FIELDS" => "",	// Обязательные поля для заполнения
		"USE_CAPTCHA" => "Y",	// Использовать защиту от автоматических сообщений (CAPTCHA) для неавторизованных пользователей
	),
	false
);?>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/include/svayaz.php"
	),
	false
);?>
		</div>
		</div>
		</div>
	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>