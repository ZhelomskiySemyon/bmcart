<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */

/** @var PageNavigationComponent $component */
$component = $this->getComponent();

$this->setFrameMode(true);

$colorSchemes = array(
	"green" => "bx-green",
	"yellow" => "bx-yellow",
	"red" => "bx-red",
	"blue" => "bx-blue",
);
if(isset($arParams["TEMPLATE_THEME"]) && isset($colorSchemes[$arParams["TEMPLATE_THEME"]]))
{
	$colorScheme = $colorSchemes[$arParams["TEMPLATE_THEME"]];
}
else
{
	$colorScheme = "";
}
?>

<!--<div class="bx-pagination --><?php //=$colorScheme?><!--">-->
<!--	<div class="bx-pagination-container">-->
<div class="row">
    <div class="col-md-12 text-center">
        <div class="site-pagination">
<?if($arResult["REVERSED_PAGES"] === true):?>
	<?if ($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"]):?>
		<?if (($arResult["CURRENT_PAGE"]+1) == $arResult["PAGE_COUNT"]):?>
		<?else:?>
			<label class="bx-pag-prev"><a class="active" href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($arResult["CURRENT_PAGE"]+1))?>"><span><?echo GetMessage("round_nav_back")?></span></a></label>
		<?endif?>
			<label class=""><a href="<?=htmlspecialcharsbx($arResult["URL"])?>"><span>1</span></a></label>
	<?else:?>
			<label class="active"><span>1</span></label>
	<?endif?>

	<?
	$page = $arResult["START_PAGE"] - 1;
	while($page >= $arResult["END_PAGE"] + 1):
	?>
		<?if ($page == $arResult["CURRENT_PAGE"]):?>
			<label class="active"><a><?=($arResult["PAGE_COUNT"] - $page + 1)?></a></label>
		<?else:?>
			<label class=""><ahref="<?=htmlspecialcharsbx($component->replaceUrlTemplate($page))?>"><span><?=($arResult["PAGE_COUNT"] - $page + 1)?></span></a></label>
		<?endif?>

		<?$page--?>
	<?endwhile?>

	<?if ($arResult["CURRENT_PAGE"] > 1):?>
		<?if($arResult["PAGE_COUNT"] > 1):?>
			<label class=""><a href="<?=htmlspecialcharsbx($component->replaceUrlTemplate(1))?>"><span><?=$arResult["PAGE_COUNT"]?></span></a></label>
		<?endif?>
			<label class="bx-pag-next"><a href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($arResult["CURRENT_PAGE"]-1))?>"><span><?echo GetMessage("round_nav_forward")?></span></a></label>
	<?else:?>
		<?if($arResult["PAGE_COUNT"] > 1):?>
			<label class="active"><a><?=$arResult["PAGE_COUNT"]?></a></label>
		<?endif?>
	<?endif?>

<?else:?>
	<?if ($arResult["CURRENT_PAGE"] > 1):?>
			<label class=""><a href="<?=htmlspecialcharsbx($arResult["URL"])?>"><span>1</span></a></label>
	<?else:?>
			<a href="<?=htmlspecialcharsbx($arResult["URL"])?>" class="active">1</a>
	<?endif?>
	<?
	$page = $arResult["START_PAGE"] + 1;
	while($page <= $arResult["END_PAGE"]-1):
	?>
		<?if ($page == $arResult["CURRENT_PAGE"]):?>
			<a class="active" href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($page))?>"><?=$page?></a>
		<?else:?>
			<a class="" href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($page))?>"><?=$page?></a>
		<?endif?>
		<?$page++?>
	<?endwhile?>
	<?if($arResult["CURRENT_PAGE"] < $arResult["PAGE_COUNT"]):?>
		<?if($arResult["PAGE_COUNT"] > 1):?>
            <a href="<?=htmlspecialcharsbx($component->replaceUrlTemplate($arResult["PAGE_COUNT"]))?>"><?=$arResult["PAGE_COUNT"]?></a>
		<?endif?>
	<?else:?>
		<?if($arResult["PAGE_COUNT"] > 1):?>
			<a href="<?=htmlspecialcharsbx($arResult["URL"])?>" class="active"><?=$arResult["PAGE_COUNT"]?></a>
		<?endif?>
	<?endif?>

<?endif?>
        </div>
    </div>
</div>
<!--		<div style="clear:both"></div>-->
<!--	</div>-->
<!--</div>-->
