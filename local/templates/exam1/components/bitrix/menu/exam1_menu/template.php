<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
    <div class="menu-block popup-wrap">
    <a href="" class="btn-menu btn-toggle"></a>
    <div class="menu popup-block">
<ul class="">
    <li class="main-page"><a href="/s2/"><?=GetMessage("HOME")?>></a>
    </li>
<?
$previousLevel = 0;
foreach($arResult as $arItem):?>
    <?
        $color = '';

        if (isset($arItem['PARAMS']['COLOR'])) {
            $color = $arItem['PARAMS']['COLOR'];
        }
    ?>
    <?if ($arItem["PERMISSION"] > "D"):?>
        <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
            <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        <?endif?>
        <?if ($arItem["IS_PARENT"]):?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li><a href="<?=$arItem["LINK"]?>" class="<?=$color?> <?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a>
                    <ul>
            <?else:?>
                <li<?if ($arItem["SELECTED"]):?> class="<?=$color?> item-selected div_yellow"<?endif?>><a href="<?=$arItem["LINK"]?>" class="parent"><?=$arItem["TEXT"]?></a>
                    <ul>
            <?endif?>
            <?if ($arItem["PARAMS"]['UNIQ_TEXT']):?>
                <?if ($arItem['DEPTH_LEVEL'] >= 1):?>
                    <div class="menu-text">
                        <?=$arItem["PARAMS"]['UNIQ_TEXT']?>
                    </div>
                <?endif;?>
            <?endif;?>
        <?else:?>
            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li><a href="<?=$arItem["LINK"]?>" style="color: <?=$arItem['PARAMS']['COLOR']?>>" class="<?=$color?> <?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li<?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>><a href="<?=$arItem["LINK"]?>" class="<?=$color?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>
        <?endif?>

        <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
    <?endif;?>
<?endforeach?>
<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
    </div>
        <div class="menu-overlay"></div>
    </div>

<div class="menu-clear-left"></div>
<?endif?>
