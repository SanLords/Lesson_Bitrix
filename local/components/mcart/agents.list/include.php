<?php

use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();

$eventManager->addEventHandler('highloadblock', 'OnAfterAddHighloadBlockElement', 'clearHlblockCache');
$eventManager->addEventHandler('highloadblock', 'OnAfterUpdateHighloadBlockElement', 'clearHlblockCache');
$eventManager->addEventHandler('highloadblock', 'OnAfterDeleteHighloadBlockElement', 'clearHlblockCache');

function clearHlblockCache($event) {
    $tableName = $event->getParameter('TABLE_NAME');
    $taggedCache = \Bitrix\Main\Application::getInstance()->getTaggedCache();
    $taggedCache->clearByTag('hlblock_table_name_' . $tableName);
}