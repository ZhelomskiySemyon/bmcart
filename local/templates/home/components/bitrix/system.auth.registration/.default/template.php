<?php
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2024 Bitrix
 */

use Bitrix\Main\Web\Json;

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
    CJSCore::Init('phone_auth');
}

?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.register",
    "main.register",
    Array(
        "AUTH" => "Y",
        "REQUIRED_FIELDS" => array(),
        "SET_TITLE" => "Y",
        "SHOW_FIELDS" => array("EMAIL","NAME","LAST_NAME"),
        "SUCCESS_PAGE" => "",
        "USER_PROPERTY" => array("UF_USER_GROUP"),
        "USER_PROPERTY_NAME" => "",
        "USE_BACKURL" => "Y"
    )
);?>
<p><a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>
</form>
</div>
</div>
</div>
</div>
</div>