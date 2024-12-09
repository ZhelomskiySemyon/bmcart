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

        if (empty($arParams['CACHE_TIME'])) {
            $arParams['CACHE_TIME'] = '36000000';
        }
        if (empty($arParams['ROWS_PER_PAGE'])) {
            $arParams['ROWS_PER_PAGE'] = "1";
        }
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
            $this->addError(
                new Error(Loc::getMessage('MCART_AGENTS_LIST_NOT_HLBLOCK_TNAME'), 404)
            );
        }

        if ($this->showErrors()) {
            return;
        }

        // https://dev.1c-bitrix.ru/api_help/main/reference/cphpcache/initcache.php в данном компоненте используется Bitrix\Main\Data\Cache::initCache из нового ядра
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

            $this->taggedCache->registerTag('hlblock_table_name_' . $arHlblock['TABLE_NAME']); // Регистрируем кеш, чтобы по нему на событиях добавление/изменение/удаление элементов хлблока сбрасывать кеш компонента

            $entity = self::getEntityDataClassById($arHlblock); // получить класс для работы с хлблоком
            $arTypeAgents = self::getFieldListValue($arHlblock, 'UF_TYPE'); // получить массив со значениями списочного свойства Виды деятельности агентов
            $this->arResult['AGENTS'] = $this->getAgents($entity, $arTypeAgents); // получить массив со списком агентов и объектом для пагинации

            if ($this->cacheInvalid) {
                $this->taggedCache->abortTagCache();
                $this->cache->abortDataCache();
            }

            $this->taggedCache->endTagCache(); // конец области, для тегированого кеша
            $this->cache->endDataCache($this->arResult); // запись arResult в кеш
        }

        /*
         * Получить Избранных агентов для текущего пользователя записать их в массив $this->arResult['STAR_AGENTS']
         * Это можно зделать с помощью CUserOptions::GetOption
         */
        $category = 'mcart_agent';
        $name = 'options_agents_star';
         $this->arResult['STAR_AGENTS'] = CUserOptions::GetOption($category, $name);
        /*
         * Данного метода нет в документации, код метода и его параметры можно найти в ядре (/bitrix/modules/main/) или в гугле
         * $category - это категория настройки, можете придумать любую, например mcart_agent
         * $name - это название настройки, например options_agents_star
         * Эти настройки храняться в таблице b_user_option
         */


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

        /*
         * Делаем запрос для получения данных хлблока по TABLE_NAME, используя HighloadBlockTable::getList
         * https://dev.1c-bitrix.ru/learning/course/index.php?COURSE_ID=43&LESSON_ID=5753
         */
        $result = HighloadBlockTable::getList([
            'filter' => [
                ['TABLE_NAME' => $hl_block_name]
                // Указать фильтр по полю "TABLE_NAME"
            ], 
        ]);
        if ($row = $result->fetch()) { // Получим результат запросв
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
        $entity = HighloadBlockTable::compileEntity($arHlblock)->getDataClass();
        return $entity;
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

        //Получаем ID пользовательского поля, по его коду
        $fieldID = Bitrix\Main\UserFieldTable::getList([
            'filter' => [
                "ENTITY_ID" => "HLBLOCK_" . $arHlblock['ID'],
                "FIELD_NAME" => $fieldName,
            ],
        ])->Fetch()["ID"];
        if ($fieldID) {
            $arEnums = CUserFieldEnum::GetList(array(), [
                "USER_FIELD_ID" => $fieldID,
            ]);
            while($arEnum = $arEnums->fetch())
            {
                $result[$arEnum["ID"]] = $arEnum["VALUE"];
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

        // Объек для для пагинации, подробнее можно почитать 
        $nav = new \Bitrix\Main\UI\PageNavigation("nav-agents");
        $nav->allowAllRecords(true)
            ->setPageSize($this->arParams['ROWS_PER_PAGE']) //Нужно передать параметр Количество элементов из мввсива $this->arParams
            ->initFromUri();
        
        $rsAgents = $entity::getList([
            "filter" => ['UF_ACTIVITY' => true],
            "count_total" => true,
            'offset' => $nav->getOffset(),
            'limit' => $nav->getLimit(),
        ]);

        while ($arAgent = $rsAgents->fetch()) {

            $arAgent['UF_TYPE'] = $arTypeAgents[$arAgent['UF_TYPE']];
            $arAgent['UF_PHOTO'] =  CFile::GetPath($arAgent['UF_PHOTO']);
            /**
             * Обработает полученный массив
             *
             * 1. В свойстве Вид деятельности записан ID значения списка,
             * с помощью массива $arTypeAgents определить значение
             *
             * 2. В свойстве Фото записан ID файла из таблицы b_file,
             * если значение есть, то получить путь через класс \CFile
             */
            $arAgents['ITEMS'][$arAgent['ID']] = $arAgent; // Записываем получившийся массив в $arAgents['ITEMS']
        }
        $nav->setRecordCount($rsAgents->getCount()); // В объект для пагинации передаем общее количество агентов
        $arAgents['NAV_OBJECT'] = $nav; // Записываем получившийся объект в $arAgents['NAV_OBJECT']

        return $arAgents; // Возвращаем результат
    }



    // Далее код для ajax, к нему можно вернуться после внедрения верски и js
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
        $hlblock = HighloadBlockTable::getList([
            "filter" => ['=NAME' => 'RealEstateAgentsHL']
        ])->fetch();
        $userOptions = CUserOptions::GetOption('form', "form_element_".$hlblock['ID']);
        if ($userOptions) {
            if (!is_array($userOptions)) {
                $userOptions = [];
            }
            if (in_array($agentID, $userOptions)) {
                unset($userOptions[$agentID]);
            } else {
                $userOptions[$agentID] = $agentID;
            }
            $value = $userOptions;
        } else {
            $value = $agentID;
        }
        if (CUserOptions::SetOption('form', "form_element_".$hlblock['ID'], [$agentID => $value])) {
            $result['action'] = 'success';
        }

        return $result;
    }
}
