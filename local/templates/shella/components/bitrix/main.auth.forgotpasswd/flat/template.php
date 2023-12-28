<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);


if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_PWD_SUCCESS');
	return;
}
?>

<div class="login mb-60">
	<div class="container">

		<?if ($arResult['ERRORS']):?>
		<div class="alert alert-danger">
			<? foreach ($arResult['ERRORS'] as $error)
			{
				echo $error;
			}
			?>
		</div>
		<?elseif ($arResult['SUCCESS']):?>
		<div class="alert alert-success">
			<?= $arResult['SUCCESS'];?>
		</div>
		<?endif;?>


		<div id="CustomerLoginForm">
			<h1 class="h3 mt-30 mb-40 text-center"><?= Loc::getMessage('MAIN_AUTH_PWD_HEADER');?></h1>

			<p class="bx-authform-content-container"><?= Loc::getMessage('MAIN_AUTH_PWD_NOTE');?></p>

	
			<form name="bform" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>" accept-charset="UTF-8">
				<input type="hidden" name="form_type" value="recover_customer_password"/>
				<input type="hidden" name="utf8" value="✓"/>
				<div id="RecoverPasswordForm" class="pt-35 mt-35 border-top">
					<label for="RecoverEmail" class="label-required"><?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_EMAIL');?></label>
					<input type="email"
							name="<?= $arResult['FIELDS']['email'];?>"
							id="RecoverEmail"
							placeholder="Enter your email"
							spellcheck="false"
							autocomplete="off"
							autocapitalize="off"
							required="required"
							data-block-visibility-focus>
							
						<?if ($arResult['CAPTCHA_CODE']):?>
							<input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
							<div class="bx-authform-formgroup-container dbg_captha">
								<div class="bx-authform-label-container">
									<?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_CAPTCHA');?>
								</div>
								<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
								<br>
								<div class="bx-authform-input-container">
									<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
								</div>
							</div>
						<?endif;?>

					<input type="submit" class="btn btn--full" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_PWD_FIELD_SUBMIT');?>">


					<div>
						<a href="/hasta/goods/" class="h6 btn-link mt-20 mb-0">Вернуться в магазин</a>
					</div>
					<div>
						<a href="<?= $arResult['AUTH_AUTH_URL'];?>" class="btn-link mt-15 js-button-block-visibility">
							<?= Loc::getMessage('MAIN_AUTH_PWD_URL_AUTH_URL');?>
						</a>
					</div>

					<div>
						<a href="<?= $arResult['AUTH_REGISTER_URL'];?>" class="btn-link mt-15 js-button-block-visibility">
						<?= Loc::getMessage('MAIN_AUTH_PWD_URL_REGISTER_URL');?>
						</a>
					</div>

				</div>
			</form>

		</div>

	</div>
</div>

<script>
	Loader.require({
		type: "script",
		name: "buttons_blocks_visibility"
	});

	Loader.require({
		type: "script",
		name: "customers_login"
	});
</script>


<script type="text/javascript">
	document.bform.<?= $arResult['FIELDS']['login'];?>.focus();
</script>
