<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
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
    </div> <!-- .site-mobile-menu -->

    <div class="border-bottom bg-white top-bar">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-md-6">
            <p class="mb-0">
              <a href="#" class="mr-3"><span class="text-black fl-bigmug-line-phone351"></span> <span
                  class="d-none d-md-inline-block ml-2">+2 102 3923 3922</span></a>
              <a href="#"><span class="text-black fl-bigmug-line-email64"></span> <span
                  class="d-none d-md-inline-block ml-2">info@domain.com</span></a>
            </p>
          </div>
          <div class="col-6 col-md-6 text-right">
            <a href="#" class="mr-3"><span class="text-black icon-facebook"></span></a>
            <a href="#" class="mr-3"><span class="text-black icon-twitter"></span></a>
            <a href="#" class="mr-0"><span class="text-black icon-linkedin"></span></a>
          </div>
        </div>
      </div>

    </div>
    <div class="site-navbar">
      <div class="container py-1">
        <div class="row align-items-center">
          <div class="col-8 col-md-8 col-lg-4">
            <h1 class=""><a href="index.html" class="h5 text-uppercase text-black"><strong>HomeSpace<span
                    class="text-danger">.</span></strong></a></h1>
          </div>
          <div class="col-4 col-md-4 col-lg-8">
            <nav class="site-navigation text-right text-md-right" role="navigation">

              <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#"
                  class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

              <ul class="site-menu js-clone-nav d-none d-lg-block">
                <li class="active">
                  <a href="index.html">Home</a>
                </li>
                <li class="has-children">
                  <a href="properties.html">Properties</a>
                  <ul class="dropdown">
                    <li><a href="#">Buy</a></li>
                    <li><a href="#">Rent</a></li>
                    <li><a href="#">Lease</a></li>
                    <li class="has-children">
                      <a href="#">Menu</a>
                      <ul class="dropdown">
                        <li><a href="#">Menu One</a></li>
                        <li><a href="#">Menu Two</a></li>
                        <li><a href="#">Menu Three</a></li>
                      </ul>
                    </li>
                  </ul>
                </li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
              </ul>
            </nav>
          </div>


        </div>
      </div>
    </div>
  </div>
  