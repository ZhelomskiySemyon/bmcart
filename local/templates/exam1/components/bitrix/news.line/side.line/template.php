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
<!--        --><?php //=\Bitrix\Main\Diag\Debug::dump($arItem)?>
        <div class="item">
            <div class="side-block side-opin" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="inner-block">
                    <div class="title">
                        <div class="photo-block">
                            <?if(is_array($arItem["PREVIEW_PICTURE"])):?>
                                <img
                                        src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                        width="40px"
                                        height="40px"

                                ?>"/>
                            <?else:?>
                                <img
                                        src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.jpg"
                                        width="40px"
                                        height="40px"
                                />
                            <?endif?>
                        </div>
                        <?if($arItem["NAME"]):?>
                            <div class="name-block">
                                <a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?echo $arItem["NAME"]?></a>
                            </div>
                        <?endif;?>
                        <div class="pos-block">
                            <?echo $arItem['PROPERTY_POSITION_VALUE']?>
                            <?echo $arItem['PROPERTY_COMPANY_VALUE']?>
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
<!--            <small id="--><?php //=$this->GetEditAreaId($arItem['ID']);?><!--"><span class="news-date-time">--><?//echo $arItem["DISPLAY_ACTIVE_FROM"]?><!--&nbsp;&nbsp;</span><a href="--><?//echo $arItem["DETAIL_PAGE_URL"]?><!--">--><?//echo $arItem["NAME"]?><!--</a><br /></small>-->
        <?endforeach;?>
    </div>
</div>