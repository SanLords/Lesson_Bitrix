<?php
class UserGroupHandler
{
    public static function addUserToGroup(&$arFields)
    {
        if ($arFields['ID'] > 0 && isset($arFields['UF_USER_TYPE'])) {
            // Логирование для отладки
            \CEventLog::Log('INFO', 'OnAfterUserAddHandler', 'main', 0, print_r($arFields, true));

            $userType = $arFields['UF_USER_TYPE'];
            $groupId = ($userType == 'seller') ? 5 : 6;

            // Дополнительное логирование для проверки значения UF_USER_TYPE и группы
            \CEventLog::Log('INFO', 'OnAfterUserAddHandler', 'main', 0, "UserType: $userType, GroupId: $groupId");

            if ($groupId > 0) {
                $user = new CUser;
                $user->Update($arFields['ID'], ['GROUP_ID' => [$groupId]]);
            }
        } else {
            // Логирование для отладки в случае отсутствия UF_USER_TYPE
            \CEventLog::Log('ERROR', 'OnAfterUserAddHandler', 'main', 0, "UF_USER_TYPE is not set in arFields: " . print_r($arFields, true));
        }
    }
}