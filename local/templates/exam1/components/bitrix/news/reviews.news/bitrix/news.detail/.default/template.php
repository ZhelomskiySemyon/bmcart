<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?//$APPLICATION->SetPageProperty('title', 'Отзыв - ' . $arResult['NAME'] . ' - ' . $arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE']);?>
<?//if ($arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE']):?>
<!--    --><?//$APPLICATION->SetPageProperty('title', 'Отзыв - ' . $arResult['NAME'] . ' - ' . $arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE']);?>
<?//else:?>
<!--    --><?//$APPLICATION->SetPageProperty('title','Отзыв - ' . $arResult['NAME']);?>
<?//endif;?>
<div class="review-block">
    <div class="review-text">
        <div class="review-text-cont">
            <?if($arResult["NAV_RESULT"]):?>
                <?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
                <?echo $arResult["NAV_TEXT"];?>
                <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
            <?elseif($arResult["DETAIL_TEXT"] <> ''):?>
                <?echo $arResult["DETAIL_TEXT"];?>
            <?else:?>
                <?echo $arResult["PREVIEW_TEXT"];?>
            <?endif?>
        </div>
        <div class="review-autor">

            <?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
                <?=$arResult['NAME'] . " ".$arResult["DISPLAY_ACTIVE_FROM"] . " " . $arResult['DISPLAY_PROPERTIES']['POSITION']['VALUE'] . " " . $arResult['DISPLAY_PROPERTIES']['COMPANY']['VALUE']?>
            <?endif;?>
        </div>
    </div>
    <div style="clear:both">
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
            <img
                class="review-img-wrap"
                border="0"
                src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
                width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
                height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
                alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
                title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
            />
        <?else:?>
            <img
                class="review-img-wrap"
                border="0"
                src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.jpg"
            />
        <?endif?>
    </div>
</div>
<?if ($arResult['DISPLAY_PROPERTIES']['DOCUMENTS'] != null):?>
<div class="exam-review-doc">
    <p>Документы:</p>
    <?if (count($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE']) != count($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE'], COUNT_RECURSIVE)):?>
    <?foreach ($arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE'] as $file):?>
    <div  class="exam-review-item-doc"><img class="rew-doc-ico" src="<?=SITE_TEMPLATE_PATH?>/img/icons/pdf_ico_40.png"><a href="<?=$file['SRC']?>"><?=$file['ORIGINAL_NAME']?></a></div>
    <?endforeach;?>
    <?else:?>
        <div  class="exam-review-item-doc"><img class="rew-doc-ico" src="<?=SITE_TEMPLATE_PATH?>/img/icons/pdf_ico_40.png"><a href="<?=$arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE']['SRC']?>"><?=$arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['FILE_VALUE']['ORIGINAL_NAME']?></a></div>
    <?endif;?>
</div>
<?endif;?>