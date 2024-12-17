<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мебельная компания");
?>
<? $GLOBALS['arrFilter'] = ["PROPERTY_PRIORITYDEAL"=>5];?> <?$APPLICATION->IncludeComponent(
    "bitrix:news.list",
    "slider",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "172800",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPONENT_TEMPLATE" => "slider",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "FIELD_CODE" => array(0=>"PREVIEW_PICTURE",1=>"",),
        "FILTER_NAME" => "arrFilter",
        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
        "IBLOCK_ID" => "5",
        "IBLOCK_TYPE" => "announcements",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "INCLUDE_SUBSECTIONS" => "Y",
        "MESSAGE_404" => "",
        "NEWS_COUNT" => "20",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Новости",
        "PARENT_SECTION" => "",
        "PARENT_SECTION_CODE" => "",
        "PREVIEW_TRUNCATE_LEN" => "",
        "PROPERTY_CODE" => array(0=>"PRICE",1=>"PRIORITYDEAL",2=>"",),
        "SET_BROWSER_TITLE" => "Y",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "Y",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "Y",
        "SHOW_404" => "N",
        "SORT_BY1" => "ACTIVE_FROM",
        "SORT_BY2" => "SORT",
        "SORT_ORDER1" => "DESC",
        "SORT_ORDER2" => "ASC",
        "STRICT_SECTION_CHECK" => "N",
        "USE_FILTER" => "N"
    )
);?>
    <div class="site-section site-section-sm bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="site-section-title">
                    </div>
                </div>
            </div>
            <?$APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                Array(
                    "AREA_FILE_SHOW" => "page",
                    "AREA_FILE_SUFFIX" => "widget",
                    "EDIT_TEMPLATE" => ""
                )
            );?>
            <div class="site-section site-section-sm bg-light">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-12">
                            <div class="site-section-title">
                                <h2><?=GetMessage('ANNOUNCEMENTS')?></h2>
                            </div>
                        </div>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.line",
                        "announcements",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "172800",
                            "CACHE_TYPE" => "A",
                            "DETAIL_URL" => "",
                            "FIELD_CODE" => array("PREVIEW_TEXT","PREVIEW_PICTURE","PROPERTY_PRICE","PROPERTY_TOTALAREA","PROPERTY_NUMBERBATHROOMS","PROPERTY_AVAILABILITYGARAGE",""),
                            "IBLOCKS" => array("5"),
                            "IBLOCK_TYPE" => "announcements",
                            "NEWS_COUNT" => "9",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC",
                        )
                    );?>
                </div>
            </div>
            <div class="site-section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7 text-center mb-5">
                            <div class="site-section-title">
                                <h2><?=GetMessage('OUR_SERVICES')?></h2>
                            </div>
                        </div>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.line",
                        "services",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "7 257 600",
                            "CACHE_TYPE" => "A",
                            "DETAIL_URL" => "",
                            "FIELD_CODE" => array("","PROPERTY_LINKSEXTERNALRESOURCES",""),
                            "IBLOCKS" => array("6"),
                            "IBLOCK_TYPE" => "services",
                            "NEWS_COUNT" => "6",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC"
                        )
                    );?>
                </div>
            </div>
            <div class="site-section bg-light">
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-7 text-center">
                            <div class="site-section-title">
                                <h2><?=GetMessage('NEWS')?></h2>
                            </div>
                        </div>
                    </div>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:news.line",
                        "news",
                        Array(
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "604800",
                            "CACHE_TYPE" => "A",
                            "COMPONENT_TEMPLATE" => "news",
                            "DETAIL_URL" => "",
                            "FIELD_CODE" => array(0=>"PREVIEW_TEXT",1=>"PREVIEW_PICTURE",2=>"DATE_CREATE",3=>"",),
                            "IBLOCKS" => array(),
                            "IBLOCK_TYPE" => "news",
                            "NEWS_COUNT" => "3",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER1" => "DESC",
                            "SORT_ORDER2" => "ASC"
                        )
                    );?>
                </div>
            </div>
            <p>
            </p>
            <p>
            </p>
        </div>
    </div>
    <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>