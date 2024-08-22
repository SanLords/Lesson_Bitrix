<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>

<?php
// Получаем текущий URL
$currentUrl = $_SERVER['REQUEST_URI'];

// Определяем URL главной страницы без query параметров
$homeUrl = '/';

// Удаляем query параметры из текущего URL
$cleanUrl = strtok($currentUrl, '?');

// Проверяем, является ли текущий URL не главным
$isNotHomePage = ($cleanUrl != $homeUrl);
?>

<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">

<head>
  <title><?$APPLICATION->ShowTitle()?></title>
  <?$APPLICATION->ShowHead();?>

<?php 
  use Bitrix\Main\Page\Asset;
  $objAsset = Asset::getInstance();

  $objAsset->addString('<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/fonts/icomoon/style.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/bootstrap.min.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/magnific-popup.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/jquery-ui.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/owl.carousel.min.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/owl.theme.default.min.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/bootstrap-datepicker.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/mediaelementplayer.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/animate.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/fonts/flaticon/font/flaticon.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/fl-bigmug-line.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/aos.css');
  $objAsset->addCss(SITE_TEMPLATE_PATH.'/css/style.css');

  
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/jquery-3.3.1.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/jquery-migrate-3.0.1.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/jquery-ui.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/popper.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/bootstrap.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/owl.carousel.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/mediaelement-and-player.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.stellar.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.countdown.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/jquery.magnific-popup.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/bootstrap-datepicker.min.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/aos.js', true);
  $objAsset->addJs(SITE_TEMPLATE_PATH.'/js/main.js', true);

  
?>
</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

  <div class="site-loader"></div>

  <div class="site-wrap">

    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> 
    <!-- .site-mobile-menu -->

    <div class="border-bottom bg-white top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-md-6">
            <p class="mb-0">
            <?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/include/phone.php"
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/include/mail.php"
	),
	false
);?>
            </p>
          </div>
          <div class="col-6 col-md-6 text-right">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/include/icon.php"
	),
	false
);?>

        </div>
        <div class="col-6 col-md-6">
          <a href="/login/">Вход на сайт</a>
        </div>
      </div>

    </div>
    <div class="site-navbar">
      <div class="container py-1">
        <div class="row align-items-center">
          <div class="col-8 col-md-8 col-lg-4">
            <h1 class="">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	".default", 
	array(
		"AREA_FILE_SHOW" => "file",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"PATH" => "/include/logo.php"
	),
	false
);?>
            </h1>
          </div>
          <?$APPLICATION->IncludeComponent("bitrix:menu", "Top_menu", Array(
	"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
		"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
		"DELAY" => "N",	// Откладывать выполнение шаблона меню
		"MAX_LEVEL" => "3",	// Уровень вложенности меню
		"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
			0 => "",
		),
		"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"MENU_CACHE_TYPE" => "N",	// Тип кеширования
		"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
		"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
		"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
	),
	false
);?>
        </div>
      </div>
    </div>
    <?php if ($isNotHomePage): ?>
            <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"breadcrumb", 
	array(
		"COMPONENT_TEMPLATE" => "breadcrumb",
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1"
	),
	false
);?>
    <?php endif; ?>

  </div>
  