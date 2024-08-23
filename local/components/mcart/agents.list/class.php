<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Errorable;
use \Bitrix\Main\Engine\Contract\Controllerable;

use \Bitrix\Main\Error;
use \Bitrix\Main\ErrorCollection;

use \Bitrix\Main\Application;

use \Bitrix\Main\Data\Cache;
use \Bitrix\Main\Data\TaggedCache;

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Highloadblock\HighloadBlockTable;
use \Bitrix\Main\Engine\ActionFilter;

class AgentsList extends CBitrixComponent implements Controllerable, Errorable
{
    protected ErrorCollection $errorCollection;

    protected Cache $cache;
    protected TaggedCache $taggedCache;

    protected int $cacheTime;
    protected bool $cacheInvalid;
    protected string $cacheKey;
    protected string $cachePatch;

    /**
     * Получение ошибок
     */
    final public function getErrors(): array
    {
        return $this->errorCollection->toArray();
    }

    final public function getErrorByCode($code): Error
    {
        return $this->errorCollection->getErrorByCode($code);
    }

    /**
     * Добавление ошибки
     */
    private function addError(Error $error): void
    {
        $this->errorCollection[] = $error;
    }

    /**
     * Добавление ошибок
     */
    private function addErrors(array $errors): void
    {
        $this->errorCollection->add($errors);
    }

    /**
     * Вывод ошибок в публичке
     */
    private function showErrors(): bool
    {
        if (count($this->getErrors())) {
            foreach ($this->getErrors() as $error) {
                if ((int)$error->getCode() === 404) {
                    ShowError($error->getMessage());
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Обязательный метод, запускается всегда при загрузки класса, используется для проверки Параметров
     */
    final public function onPrepareComponentParams($arParams): array
    {
        $this->initCache($arParams); // создание параметров для работы кеша

        // Проверка подключение модуля highloadblock, отдать ошибку если модуль не подключен
        if (!Loader::includeModule('highloadblock')) {
            $this->addError(
                new Error(Loc::getMessage('MCART_AGENTS_LIST_MODULE_NOT_INSTALLED', ['#MODULE#' => 'highloadblock']), 404)
            );
        }

        // Проверка и установка дефолтных значений для "Время кеширования" и "Количество элементов"
        $arParams['CACHE_TIME'] = isset($arParams['CACHE_TIME']) && intval($arParams['CACHE_TIME']) > 0 ? intval($arParams['CACHE_TIME']) : 3600;
        $arParams['ELEMENTS_COUNT'] = isset($arParams['ELEMENTS_COUNT']) && intval($arParams['ELEMENTS_COUNT']) > 0 ? intval($arParams['ELEMENTS_COUNT']) : 10;

        return parent::onPrepareComponentParams($arParams);
    }

    private function initCache($arParams): void
    {
        $this->cacheInvalid = false;
        $this->errorCollection = new ErrorCollection();
        $this->cacheKey = self::class . '_' . md5(json_encode($arParams)) . '_' . md5(json_encode($_REQUEST)); // тут указывается от каких параметров зависит кэш
        $this->cachePatch = self::class; // директория для хранения файлов кеша

        $this->cache = Cache::createInstance();
        $this->taggedCache = Application::getInstance()->getTaggedCache();
    }

    final public function executeComponent(): void
    {
        if (empty($this->arParams["HLBLOCK_TNAME"])) {
            $this->errorCollection[] = new Error(Loc::getMessage('MCART_AGENTS_LIST_NOT_HLBLOCK_TNAME'));
            $this->showErrors();
            return;
        }

        if ($this->showErrors()) {
            return;
        }

        if ($this->cache->initCache(
            $this->arParams["CACHE_TIME"],
            $this->cacheKey,
            $this->cachePatch
        )) { // если кеш есть
            $this->arResult =  $this->cache->getVars();
        } elseif ($this->cache->startDataCache()) { // если кеша нет
            $this->taggedCache->startTagCache($this->cachePatch); // старт для области, для тегированного кеша

            $this->arResult = []; // объявим результирующий массив

            $arHlblock = self::getHlblockTableName($this->arParams["HLBLOCK_TNAME"]); // получить хлблок по TABLE_NAME

            if (empty($arHlblock)) {
                $this->addError(new Error(Loc::getMessage('MCART_AGENTS_LIST_HLBLOCK_NOT_FOUND')));
                $this->taggedCache->abortTagCache();
                $this->cache->abortDataCache();
                $this->showErrors();
                return;
            }

            $this->taggedCache->registerTag('hlblock_table_name_' . $arHlblock['TABLE_NAME']); // Регистрируем кеш, чтобы по нему на событиях добавление/изменение/удаление элементов хлблока сбрасывать кеш компонента

            $entity = self::getEntityDataClassById($arHlblock); // получить класс для работы с хлблоком
            $arTypeAgents = self::getFieldListValue($arHlblock, 'UF_ACTIVITY_TYPE'); // получить массив со значениями списочного свойства Виды деятельности агентов
            $this->arResult['TYPE_AGENTS'] = $arTypeAgents; // добавляем массив видов деятельности в $arResult
            $this->arResult['AGENTS'] = $this->getAgents($entity, $arTypeAgents); // получить массив со списком агентов и объектом для пагинации

            if ($this->cacheInvalid) {
                $this->taggedCache->abortTagCache();
                $this->cache->abortDataCache();
            }

            $this->taggedCache->endTagCache(); // конец области, для тегированого кеша
            $this->cache->endDataCache($this->arResult); // запись arResult в кеш
        }

        $category = 'mcart_agent'; // категория настройки 
        $name = 'options_agents_star'; // название настройки 
        $this->arResult['STAR_AGENTS'] = CUserOptions::GetOption($category, $name, []);

        $this->IncludeComponentTemplate(); // вызов шаблона компонента
    }

    /**
     * Метод для получения данных хлблока по TABLE_NAME
     * @param string $hl_block_name - название таблицы хлблока
     * @return array
     */
    private static function getHlblockTableName(string $hl_block_name): array
    {
        if (empty($hl_block_name) || strlen($hl_block_name) < 1) {
            return [];
        }

        $result = HighloadBlockTable::getList([
            'filter' => [
                '=TABLE_NAME' => $hl_block_name, // Указать фильтр по полю "TABLE_NAME"
            ], 
        ]);

        if ($row = $result->fetch()) { // Получим результат запроса
            return $row;
        }

        return [];
    }

    /**
     * Метод для получения класса для работы с элементами хлблока
     * @param array $arHlblock - массив с данными хлблока
     * @return string
     */
    private static function getEntityDataClassById(array $arHlblock): string
    {
        if (empty($arHlblock)) {
            return '';
        }

        $hlblockId = $arHlblock['ID'];
        $hlblock = HighloadBlockTable::getById($hlblockId)->fetch();

        if ($hlblock) {
            $entity = HighloadBlockTable::compileEntity($hlblock);
            return $entity->getDataClass();
        }

        return '';
    }

    /**
     * Метод для получения значений списочного свойства
     * @param array $arHlblock - массив с данными хлобка (нужен ID хлобка)
     * @param string $fieldName - Код списочного свойства
     * @return array
     */
    private function getFieldListValue(array $arHlblock, string $fieldName): array
    {
        $result = [];

        $fieldID = Bitrix\Main\UserFieldTable::getList([
            'filter' => [
                "ENTITY_ID" => "HLBLOCK_" . $arHlblock['ID'],
                "FIELD_NAME" => $fieldName,
            ],
        ])->Fetch()["ID"];

        if ($fieldID) {
            $enumList = CUserFieldEnum::GetList([], ["USER_FIELD_ID" => $fieldID]); 
            while ($enum = $enumList->GetNext()) {
                $result[$enum['ID']] = $enum['VALUE'];
            }
        }

        return $result;
    }

    /**
     * Метод для получения списка агентов
     * @param string $entity - класс хлблока
     * @param array $arTypeAgents - массив Видов деятельности агентов
     * @return array|array[]
     */
    private function getAgents(string $entity, array $arTypeAgents): array
    {
        $arAgents = [
            'NAV_OBJECT' => [], // для построения постраничной навигации
            'ITEMS' => [], // список агентов
        ];

        $nav = new \Bitrix\Main\UI\PageNavigation("nav-agents");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['ELEMENTS_COUNT']) // Передаем параметр Количество элементов из массива $this->arParams
            ->initFromUri();

        $rsAgents = $entity::getList([
            'select' => ['*'], 
            'filter' => ['=UF_ACTIVE' => 1], // Запросить список "Активных" агентов 
            'order' => ['ID' => 'ASC'], 
            'offset' => $nav->getOffset(), 
            'limit' => $nav->getLimit(),
        ]);

        while ($arAgent = $rsAgents->fetch()) {
            if (isset($arAgent['UF_ACTIVITY_TYPE']) && is_array($arAgent['UF_ACTIVITY_TYPE'])) { 
                $arAgent['UF_ACTIVITY_TYPE_VALUE'] = array_map(function($typeId) use ($arTypeAgents) {
                     return $arTypeAgents[$typeId] ?? ''; }, 
                     $arAgent['UF_ACTIVITY_TYPE']); 
                    }

            if (isset($arAgent['UF_PHOTO']) && $arAgent['UF_PHOTO'] > 0) {
                $arAgent['UF_PHOTO_PATH'] = \CFile::GetPath($arAgent['UF_PHOTO']);
            }

            $arAgents['ITEMS'][$arAgent['ID']] = $arAgent; // Записываем получившийся массив в $arAgents['ITEMS']
        }

        $nav->setRecordCount($rsAgents->getSelectedRowsCount()); // В объект для пагинации передаем общее количество агентов
        $arAgents['NAV_OBJECT'] = $nav; // Записываем получившийся объект в $arAgents['NAV_OBJECT']

        return $arAgents; // Возвращаем результат
    }

    /**
     * Конфигурация событий для ajax
     */
    final public function configureActions(): array
    {
        return [
            'clickStar' => [
                'prefilters' => [
                    new ActionFilter\Authentication(),
                    new ActionFilter\HttpMethod(
                        [ActionFilter\HttpMethod::METHOD_POST]
                    ),
                    new ActionFilter\Csrf(),
                ]
            ],
        ];
    }

    /**
     * Метод для изменения избранных агентов через ajax
     * @param $agentID - ID элемента агента
     * @return array|string[]
     */
    public function clickStarAction($agentID)
    {
        $result = []; // ответ, который уйдет на фронт

        $value = []; // массив ID элементов, которые пользователь добавил в избраное

        $category = 'mcart_agent'; // категория настройки 
        $name = 'options_agents_star'; // название настройки 

        $currentValue = CUserOptions::GetOption($category, $name, []);

        if (!is_array($currentValue)) {
            $currentValue = [$currentValue];
        }

        if (in_array($agentID, $currentValue)) {
            $value = array_diff($currentValue, [$agentID]);
        } else {
            $value = array_merge($currentValue, [$agentID]);
        }

        CUserOptions::SetOption($category, $name, $value);

        $result['action'] = 'success';

        return $result;
    }
}