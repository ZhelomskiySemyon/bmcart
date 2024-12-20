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
<div class="item-wrap">
    <div class="rew-footer-carousel">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
    <div class="item">
        <div class="side-block side-opin" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="inner-block">
                <div class="title">
                    <div class="photo-block">
                        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"/>
                        <?else:?>
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.jpg"/>
                        <?endif?>
                    </div>
                    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                        <div class="name-block">
                            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                                <a href=""><?echo $arItem["NAME"]?></a>
                            <?else:?>
                                <?echo $arItem["NAME"]?><br />
                            <?endif;?>
                        </div>
                    <?endif;?>
                    <div class="pos-block">
                        <?echo $arItem['DISPLAY_PROPERTIES']['POSITION']['VALUE']?>
                        <?echo $arItem['DISPLAY_PROPERTIES']['COMPANY']['VALUE']?>

                    </div>
                </div>
                <div class="text-block" style="-webkit-line-clamp: 3; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden" >
            <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                <?echo $arItem["PREVIEW_TEXT"];?>
            <?endif;?>
                </div>
            </div>
        </div>
    </div>
<?endforeach;?>
    </div>
</div>
