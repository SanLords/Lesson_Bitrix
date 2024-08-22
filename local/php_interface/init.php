<?php
// Подключение файла с классом обработчика
require_once __DIR__ . '/include/UserGroupHandler.php';

// Регистрация обработчика события
AddEventHandler('main', 'OnAfterUserAdd', ['UserGroupHandler', 'addUserToGroup']);