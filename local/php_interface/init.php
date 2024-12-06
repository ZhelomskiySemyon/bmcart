<?
if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/included/EventHandlers.php"))
    require_once($_SERVER["DOCUMENT_ROOT"] . "/local/php_interface/included/EventHandlers.php");
\Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'included\EventHandlers' => '/local/php_interface/included/EventHandlers.php',
]);
////Loader::autoLoad($_SERVER['DOCUMENT_ROOT']);
//if(file_exists($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/included/EventHandlers.php"))
//    require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/included/EventHandlers.php");
//
//require_once($_SERVER['DOCUMENT_ROOT'] . '/local/php_interface/autoload.php');

    \included\EventHandlers::init();
