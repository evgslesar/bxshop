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
<div class="bx-auth-reg">
<header>
	<h2 style="margin: 0 0 5px;"><?echo GetMessage("AUTH_REGISTER_TITLE")?></h2>
	<p><?echo GetMessage("AUTH_REGISTER_SUBTITLE")?></p>
</header>


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

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data" style="margin: 0 0 80px;">
<fieldset>
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
		
<?foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
	<?
	switch ($FIELD)
	{
		case "PASSWORD":
			?>
			<div class="row">
			<div class="col-md-12">
				<input type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>"  class="input" />
			</div>
			</div>

			<?
			break;

		case "CONFIRM_PASSWORD":
			?>
			<div class="row">
			<div class="col-md-12">
				<input type="password" name="REGISTER[<?=$FIELD?>]" value="<?=$arResult["VALUES"][$FIELD]?>" autocomplete="off" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>"  class="input" />
			</div>
			</div>
			<div class="row">
			<div class="col-md-12">
				<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
			</div>
			</div>

			<?
			break;

		default:
			?>
			<div class="row">
			<div class="col-md-12">
			<? if ($FIELD == 'EMAIL') { ?>
				<input class="input" type="email" name="REGISTER[<?= $FIELD ?>]"
					onkeyup="document.getElementById('login-field').value = this.value"
					value="<?= $arResult["VALUES"][$FIELD] ?>" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>" />
				<? } elseif ($FIELD == 'LOGIN') { // Скрываем поле LOGIN ?>
				<input id="login-field" class="input" type="text" style="display: none;" name="REGISTER[<?= $FIELD ?>]"
					value="<?= $arResult["VALUES"][$FIELD] ?>" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>" />
				<? } else { ?>
				<input class="input" type="text" name="REGISTER[<?= $FIELD ?>]"
					value="<?= $arResult["VALUES"][$FIELD] ?>" placeholder="<?=GetMessage("REGISTER_FIELD_".$FIELD)?>" />
			<? } ?>
			</div>
			</div>
			
			<?
	}?>
	<br>
<?endforeach?>
<?
/* CAPTCHA */
if ($arResult["USE_CAPTCHA"] == "Y")
{
	?>
		<div class="row">
			<div class="col-xs-7 col-md-6">
				<?=GetMessage("REGISTER_CAPTCHA_TITLE")?>
				<br>
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="100" height="40" alt="CAPTCHA" />
			</div>
			<div class="col-xs-7 col-md-5">				
				<?=GetMessage("REGISTER_CAPTCHA_PROMT")?>
				<br>
				<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="input" />
			</div>
		</div>
	<?
}
/* !CAPTCHA */
?>
		<div class="row">
			<div class="col-xs-7 col-md-4">
				<input class="btn-type1" type="submit" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>" />
			</div>
		</div>
</fieldset>
</form>



<?endif //$arResult["SHOW_SMS_FIELD"] == true ?>


<?endif?>
</div>