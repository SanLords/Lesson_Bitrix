<?if (!empty($arResult['ITEMS'])) {
    foreach ($arResult['ITEMS'] as &$arItem) {
        $arItem['DISPLAY_PROPERTIES'] = array();
        $res = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID']);
        while ($arProp = $res->GetNext()) {
            $arItem['DISPLAY_PROPERTIES'][$arProp['CODE']] = array(
                'NAME' => $arProp['NAME'],
                'VALUE' => $arProp['VALUE'],
                'DISPLAY_VALUE' => $arProp['VALUE'],
            );
        }
    }
    unset($arItem);
}?>