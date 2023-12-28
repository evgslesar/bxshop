<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>
<div class="register mb-60">
	<div class="container">

	<h1 class="h3 mt-30 mb-40 text-center"><?=GetMessage("AUTH_REGISTER")?></h1>

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (!empty($arResult["ERRORS"])):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0) 
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
	<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />

	<?echo GetMessage("main_register_sms")?><span class="starrequired">*</span>
	<input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" />
	<input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" />

</form>

<script>
new BX.PhoneAuth({
	containerId: 'bx_register_resend',
	errorContainerId: 'bx_register_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_register_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_register_resend"></div>

<?else:?>


<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" id="create_customer" accept-charset="UTF-8" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>	
	<input type="hidden" name="form_type" value="create_customer"/>
	<input type="hidden" name="utf8" value="✓"/>



<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	<div>
	<? if ($FIELD !== 'LOGIN') { ?>
		<label class="<? if ($arResult["REQUIRED_FIELDS_FLAGS"][$FIELD] == "Y"){ echo 'label-required';} ?>">
			<?= GetMessage("REGISTER_FIELD_" . $FIELD) ?>:
		</label>
	<? } ?>
	<?
	switch ($FIELD)
	{
		case "PASSWORD":
			?>
			<input type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>"			
						placeholder="Введите пароль" 
						autocomplete="off"
						required="required"/>

			<?
			break;
		case "CONFIRM_PASSWORD":
			?>
			<input type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" 
						placeholder="Повторите пароль" 
						autocomplete="off"
						required="required"/>			
			<?
			break;

		default:
			?>
			<? if ($FIELD == 'EMAIL') { ?>
			<input type="email" name="REGISTER[<?= $FIELD ?>]"
				onkeyup="document.getElementById('login-field').value = this.value" 
				value="<?= $arResult["VALUES"][$FIELD] ?>"
				spellcheck="false"
				autocomplete="off"
				autocapitalize="off" 
				placeholder="Введите адрес эл. почты" 
				required="required"/>
			<? } elseif ($FIELD == 'LOGIN') { // Скрываем поле LOGIN ?>
			<input id="login-field" size="30" type="text" style="display: none;" name="REGISTER[<?= $FIELD ?>]"
				value="<?= $arResult["VALUES"][$FIELD] ?>"/>
			<? } else { ?>
			<input type="text" name="REGISTER[<?= $FIELD ?>]"
				value="<?= $arResult["VALUES"][$FIELD] ?>"/>
			<? } ?>
		
			<?
	}?>
	
	</div>
<?endforeach?>

<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<?=GetMessage("REGISTER_CAPTCHA_TITLE")?>

		<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="150" height="40" alt="CAPTCHA" />
		<?=GetMessage("REGISTER_CAPTCHA_PROMT")?>:
		<input style="margin-top: 10px;" type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
	<?
}
/* !CAPTCHA */
?>

	<div class="text-center">
		<input type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" class="btn btn--full btn--secondary">
		<a href="/hasta/goods/" class="h6 btn-link mt-20 mb-0">Вернуться в магазин</a>
	</div>
</form>


<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>

<?endif //$arResult["SHOW_SMS_FIELD"] == true ?>

<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

<?endif?>

	</div>
</div>