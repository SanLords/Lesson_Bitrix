<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        // Параметр для названия таблицы Highload-блока
        "HLBLOCK_TNAME" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("MCART_AGENTS_LIST_HLBLOCK_TNAME"),
            "TYPE" => "STRING",
            "DEFAULT" => "",
        ),
        // Параметр для количества элементов на странице
        "ELEMENTS_PER_PAGE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("MCART_AGENTS_LIST_ELEMENTS_PER_PAGE"),
            "TYPE" => "STRING",
            "DEFAULT" => "10",
        ),
        // Параметр для времени кеширования
        "CACHE_TIME" => array(
            "PARENT" => "CACHE_SETTINGS",
            "NAME" => GetMessage("MCART_AGENTS_LIST_CACHE_TIME"),
            "TYPE" => "STRING",
            "DEFAULT" => "3600",
        ),
    ),
);