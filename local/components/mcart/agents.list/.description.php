<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/*
 *  Задать имя компонента и Описание
 *  Разместить его в своем разделе в Визуальном редакторе
 */

$arComponentDescription = array( 
        "NAME" => GetMessage("MY_BLOCK"),
        "DESCRIPTION" => GetMessage("MY_BLOCK_DESC"),
        "SORT" => 20,
        "CACHE_PATH" => "Y",
        "PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "MY_BLOCK",
			"NAME" => GetMessage("MY_BLOCK_DESC_NEWS"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "news_cmpx",
			),
		),
	),
);
