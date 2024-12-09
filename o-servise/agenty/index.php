<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Агенты");
?><?$APPLICATION->IncludeComponent(
	"mcart:agents.list",
	"",
	Array(
		"CACHE_TIME" => "",
		"CACHE_TYPE" => "A",
		"HLBLOCK_TNAME" => "real_estate_agents",
		"NEWS_COUNT" => "1",
		"ROWS_PER_PAGE" => "3"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>