<?

namespace included;

use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use CUser;

class EventHandlers
{
    public static function init()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->addEventHandler("main", "OnAfterUserRegister", [self::class, "AfterRegistration"]);
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
}
?>