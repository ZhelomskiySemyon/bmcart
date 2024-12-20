</div>
</div>
<!-- /content -->
<!-- side -->
<div class="side">
    <?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "left"
	),
	false
);?>
    <!-- side anonse -->
    <div class="side-block side-anonse">
        <div class="title-block"><span class="i i-title01"></span>Полезная информация!</div>
        <div class="item">
            <p>Клиенты предпочитают все больше эко-материалов.</p>
        </div>
    </div>
    <!-- /side anonse -->
    <!-- side wrap -->
    <div class="side-wrap">
        <div class="item-wrap">
            <!-- side action -->
            <div class="side-block side-action">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/side-action-bg.jpg" alt="" class="bg">
                <div class="photo-block">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/side-action.jpg" alt="">
                </div>
                <div class="text-block">
                    <div class="title">Акция!</div>
                    <p>Мебельная полка всего за 560 <span class="r">a</span>
                    </p>
                </div>
                <a href="" class="btn-more">подробнее</a>
            </div>
            <!-- /side action -->
        </div>

        <!-- footer rew slider box -->
        <?$APPLICATION->IncludeComponent(
            "bitrix:news.line",
            "side.line",
            Array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "300",
                "CACHE_TYPE" => "A",
                "DETAIL_URL" => "",
                "FIELD_CODE" => array("NAME","PREVIEW_TEXT","PREVIEW_PICTURE","PROPERTY_POSITION","PROPERTY_COMPANY"),
                "IBLOCKS" => array("21"),
                "IBLOCK_TYPE" => "reviews",
                "NEWS_COUNT" => "2",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC"
            )
        );?>
        <!-- / footer rew slider box -->
    </div>
    <!-- /side wrap -->
</div>
<!-- /side -->
</div>
<!-- /content box -->
</div>
<!-- /page -->
<div class="empty"></div>
</div>
<footer class="footer">
    <div class="inner-wrap">
        <nav class="main-menu">
            <div class="item">
                <div class="title-block">О магазине</div>
                <ul>
                    <li><a href="">Отзывы</a>
                    </li>
                    <li><a href="">Руководство </a>
                    </li>
                    <li><a href="">История</a>
                    </li>
                </ul>
            </div>
            <div class="item">
                <div class="title-block">Каталог товаров</div>
                <ul>
                    <li><a href="">Кухни</a>
                    </li>
                    <li><a href="">Гарнитуры</a>
                    </li>
                    <li><a href="">Спальни и матрасы</a>
                    </li>
                    <li><a href="">Столы и стулья</a>
                    </li>
                    <li><a href="">Раскладные диваны</a>
                    </li>
                    <li><a href="">Кресла</a>
                    </li>
                    <li><a href="">Кровати и кушетки</a>
                    </li>
                    <li><a href="">Тумобчки и прихожие</a>
                    </li>
                    <li><a href="">Аксессуары</a>
                    </li>
                    <li><a href="">Каталоги мебели</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="contacts-block">
            <div class="title-block">Контактная информация</div>
            <div class="loc-block">
                <div class="address">ул. Летняя, стр.12, офис 512</div>
                <div class="phone"><a href="tel:84952128506">8 (495) 212-85-06</a>
                </div>
            </div>
            <div class="main-soc-block">
                <a href="" class="soc-item">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc01.png" alt="">
                </a>
                <a href="" class="soc-item">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc02.png" alt="">
                </a>
                <a href="" class="soc-item">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc03.png" alt="">
                </a>
                <a href="" class="soc-item">
                    <img src="<?=SITE_TEMPLATE_PATH?>/img/icons/soc04.png" alt="">
                </a>
            </div>
            <div class="copy-block">© 2000 - 2012 "Мебельный магазин"</div>
        </div>
    </div>
</footer>
</body>

</html>