<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);


if ($arResult['AUTHORIZED'])
{
	echo Loc::getMessage('MAIN_AUTH_FORM_SUCCESS');
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
		<?endif;?>

		<div id="CustomerLoginForm">
			<h1 class="h3 mt-30 mb-40 text-center"><?= Loc::getMessage('MAIN_AUTH_FORM_HEADER');?></h1>

			<?if ($arResult['AUTH_SERVICES']):?>
				<?$APPLICATION->IncludeComponent('bitrix:socserv.auth.form',
					'flat',
					array(
						'AUTH_SERVICES' => $arResult['AUTH_SERVICES'],
						'AUTH_URL' => $arResult['CURR_URI']
					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>
				<hr class="bxe-light">
			<?endif?>

			<form name="<?= $arResult['FORM_ID'];?>" method="post" target="_top" action="<?= POST_FORM_ACTION_URI;?>" id="customer_login" accept-charset="UTF-8">
				<input type="hidden" name="form_type" value="customer_login"/>
				<input type="hidden" name="utf8" value="✓"/>
								
				<label for="CustomerEmail" class="label-required"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_LOGIN');?></label>
				<input type="email"
						name="<?= $arResult['FIELDS']['login'];?>"
						id="CustomerEmail"
						class=""
						placeholder="Введите адрес эл. почты"
						spellcheck="false"
						autocomplete="off"
						autocapitalize="off"
						required="required"
						value="<?= \htmlspecialcharsbx($arResult['LAST_LOGIN']);?>"
						autofocus>

				<label for="CustomerPassword" class="label-required"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_PASS');?></label>
				<?if ($arResult['SECURE_AUTH']):?>
					<div class="bx-authform-psw-protected" id="bx_auth_secure" style="display:none">
						<div class="bx-authform-psw-protected-desc"><span></span>
							<?= Loc::getMessage('MAIN_AUTH_FORM_SECURE_NOTE');?>
						</div>
					</div>
					<script type="text/javascript">
						document.getElementById('bx_auth_secure').style.display = '';
					</script>
				<?endif?>
				<br>
				<input type="password"
						name="<?= $arResult['FIELDS']['password'];?>"
						id="CustomerPassword"
						class=""
						placeholder="Введите пароль"
						required="required">
				<div class="text-center">

					<?if ($arResult['CAPTCHA_CODE']):?>
						<input type="hidden" name="captcha_sid" value="<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" />
						<div class="bx-authform-formgroup-container dbg_captha">
							<div class="bx-authform-label-container">
								<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_CAPTCHA');?>
							</div>
							<div class="bx-captcha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?= \htmlspecialcharsbx($arResult['CAPTCHA_CODE']);?>" width="180" height="40" alt="CAPTCHA" /></div>
							<div class="bx-authform-input-container">
								<input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" />
							</div>
						</div>
					<?endif;?>

					<?if ($arResult['STORE_PASSWORD'] == 'Y'):?>
						<div class="bx-authform-formgroup-container">
							<div class="checkbox">
								<label class="bx-filter-param-label">
									<input type="checkbox" id="USER_REMEMBER" name="<?= $arResult['FIELDS']['remember'];?>" value="Y" />
									<span class="bx-filter-param-text"><?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_REMEMBER');?></span>
								</label>
							</div>
						</div>
						<br>
					<?endif?>

					<input type="submit" class="btn btn--full btn--secondary" name="<?= $arResult['FIELDS']['action'];?>" value="<?= Loc::getMessage('MAIN_AUTH_FORM_FIELD_SUBMIT');?>">
					<div>
						<a href="/hasta/goods/" class="h6 btn-link mt-20 mb-0">Вернуться в магазин</a>
					</div>
					<div>
						<a href="<?= $arResult['AUTH_FORGOT_PASSWORD_URL'];?>" class="btn-link mt-15 js-button-block-visibility">
							<?= Loc::getMessage('MAIN_AUTH_FORM_URL_FORGOT_PASSWORD');?>
						</a>
					</div>
				</div>
			</form>
		</div>









		<!-- <form method="post" action="/account/recover" accept-charset="UTF-8"><input type="hidden" name="form_type"
																					value="recover_customer_password"/><input
				type="hidden" name="utf8" value="✓"/>
			<div id="RecoverPasswordForm" class="pt-35 mt-35 border-top d-none-important"
					data-block-visibility="#recover">
				<h2 class="h3 text-center">Reset your password</h2>
				<p>We will send you an email to reset your password.</p><label for="RecoverEmail"
																				class="label-required">EMAIL</label>
				<input type="email"
						name="email"
						id="RecoverEmail"
						placeholder="Enter your email"
						spellcheck="false"
						autocomplete="off"
						autocapitalize="off"
						required="required"
						data-block-visibility-focus>

				<input type="submit" class="btn btn--full" value="Submit">
				<div class="mt-15 text-center">
					<span class="btn-link js-button-block-visibility" data-action="close"
							data-block-link="#recover">Close</span>
				</div>
			</div>
		</form> -->

		<div class="pt-35 mt-35 border-top">
			<h2 class="h3 text-center">Регистрация</h2>
			<div class="mb-35">
				<p class="h6 mb-15">Enjoy The Benefits Of Registering:</p>
				<ul class="mb-0">
					<li>Order: view Order History, track and manage purchases and returns.</li>
					<li>Address Book and Card Wallet: safely store delivery and payment details for faster
						checkout
					</li>
					<li>Saved for later: wish list your preferred items and track their availability</li>
				</ul>
			</div>
			<a href="<?= $arResult['AUTH_REGISTER_URL'];?>" class="btn btn--full"><?= Loc::getMessage('MAIN_AUTH_FORM_URL_REGISTER_URL');?></a>
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
	<?if ($arResult['LAST_LOGIN'] != ''):?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_PASSWORD.focus();}catch(e){}
	<?else:?>
	try{document.<?= $arResult['FORM_ID'];?>.USER_LOGIN.focus();}catch(e){}
	<?endif?>
</script>