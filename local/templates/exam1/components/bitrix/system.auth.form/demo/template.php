<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if ($arResult ['SHOW_ERRORS'] == 'Y' && $arResult ['ERROR'])
	ShowMessage ( $arResult ['ERROR_MESSAGE'] );

//dump($arParams);
//dump($arResult);
CJSCore::Init();
?>
<?
if($arResult["FORM_TYPE"] == "login")
{
?>
<nav class="menu-block">
	<ul>
		<li class="att popup-wrap"><a id="hd_singin_but_open" href="" class="btn-toggle"><?=GetMessage("AUTH_LOGIN_LINK_TEXT")?></a>
			<form class="frm-login popup-block" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
				<div class="frm-title"><?=GetMessage("AUTH_LOGIN_LINK_TEXT")?></div>
				<a href="" class="btn-close"><?=GetMessage("AUTH_LOGIN_LINK_CLOSE_TEXT")?></a>
				<?if($arResult["BACKURL"] <> ''):?>
					<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
				<?endif?>
				<?foreach ($arResult["POST"] as $key => $value):?>
					<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
				<?endforeach?>
					<input type="hidden" name="AUTH_FORM" value="Y" />
					<input type="hidden" name="TYPE" value="AUTH" />
				<div class="frm-row">
					<input type="text" placeholder="<?=GetMessage("AUTH_LOGIN")?>" name="USER_LOGIN" maxlength="50" value="" size="17" />
					<script>
						BX.ready(function() {
							var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
							if (loginCookie)
							{
								var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
								var loginInput = form.elements["USER_LOGIN"];
								loginInput.value = loginCookie;
							}
						});
					</script>
				</div>
				<div class="frm-row">
					<input type="password" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" name="USER_PASSWORD" maxlength="50" size="17" autocomplete="off" />			
				</div>
				<div class="frm-row">
					<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" class="btn-forgot"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
				</div>
				<div class="frm-row">
					<div class="frm-chk">
						<input type="checkbox" id="login" name="USER_REMEMBER" value="Y"> <label for="login"><?=GetMessage("AUTH_REMEMBER_ME_SHORT")?></label>
					</div>
				</div>
				<div class="frm-row">
					<input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>">
				</div>
			</form></li>
		<li><a href="<?=$arResult["AUTH_REGISTER_URL"]?>"><?=GetMessage("AUTH_REGISTER")?></a></li>
	</ul>
</nav>
<?
}
?>
<?if($arResult["AUTH_SERVICES"]):?>

<?
elseif($arResult["FORM_TYPE"] == "otp"):
?>
<?
else:
?>

<form action="<?=$arResult["AUTH_URL"]?>">
    <nav class="menu-block">
            <ul>
                <li>
                    <a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_NAME"]?>
                    [<?=$arResult["USER_LOGIN"]?>]</a><br />
                </li>
                <li>
                    <?foreach ($arResult["GET"] as $key => $value):?>
                        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
                    <?endforeach?>
                    <?=bitrix_sessid_post()?>
                    <input type="hidden" name="logout" value="yes" />
                    <a href="?logout=yes&<?=bitrix_sessid_get()?>" name="logout_butt"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></a>
                </li>
            </ul>
    </nav>
</form>
<?endif?>