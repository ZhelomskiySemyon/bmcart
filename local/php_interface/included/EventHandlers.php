<?

namespace included;

use Bitrix\Main\Entity\Event;
use Bitrix\Main\EventManager;
use CUser;

class EventHandlers
{
    public static function init()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->addEventHandler("main", "OnAfterUserRegister", [self::class, "AfterRegistration"]);
        $eventManager->addEventHandler('', 'RealEstateAgentsHLOnAfterAdd', [self::class, "clearCache"]);
        $eventManager->addEventHandler('', 'RealEstateAgentsHLOnAfterUpdate', [self::class, "clearCache"]);
        $eventManager->addEventHandler('', 'RealEstateAgentsHLOnAfterDelete', [self::class, "clearCache"]);
    }


    /**
     * @param $arFields
     * @return void
     * Определяем в какую группу попадёт зарегистрировавшийся пользователь
     */
    public static function AfterRegistration(&$arFields)
    {
        if($arFields["UF_USER_GROUP"] == 12)
        {
            $arGroup[] = 7;
            CUser::SetUserGroup($arFields['USER_ID'], $arGroup);
        }

        if($arFields["UF_USER_GROUP"] == 13)
        {
            $arGroup[] = 8;
            CUser::SetUserGroup($arFields['USER_ID'], $arGroup);
        }
    }
    public static function clearCache(Event $event)
    {
        $taggedCache = \Bitrix\Main\Application::getInstance()->getTaggedCache();
        $taggedCache->clearByTag('hlblock_table_name_' . "real_estate_agents");
    }
}
?>