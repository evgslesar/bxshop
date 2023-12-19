<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<?if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'):?>
	<!-- <i class="fa fa-user"></i> -->
	<?if ($USER->IsAuthorized()):
		$name = trim($USER->GetFullName());
		if (! $name)
			$name = trim($USER->GetLogin());
		if (mb_strlen($name) > 9)
			$name = mb_substr($name, 0, 8).' ';
		?>
		<a href="<?=$arParams['PATH_TO_PROFILE']?>"><?=htmlspecialcharsbx($name)?></a>
		&nbsp;
		<a href="?logout=yes&<?=bitrix_sessid_get()?>"><?=GetMessage('TSB1_LOGOUT')?></a>
	<?else:
		$arParamsToDelete = array(
			"login",
			"login_form",
			"logout",
			"register",
			"forgot_password",
			"change_password",
			"confirm_registration",
			"confirm_code",
			"confirm_user_id",
			"logout_butt",
			"auth_service_id",
			"clear_cache",
			"backurl",
		);

		$currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
		if ($arParams['AJAX'] == 'N')
		{
			?><script type="text/javascript"><?=$cartId?>.currentUrl = '<?=$currentUrl?>';</script><?
		}
		else
		{
			$currentUrl = '#CURRENT_URL#';
		}
		
		$pathToAuthorize = $arParams['PATH_TO_AUTHORIZE'];
		$pathToAuthorize .= (mb_stripos($pathToAuthorize, '?') === false ? '?' : '&');
		$pathToAuthorize .= 'login=yes&backurl='.$currentUrl;
		?>
		<a href="<?=$pathToAuthorize?>">
			<?=GetMessage('TSB1_LOGIN')?>
		</a>
		<?
		if ($arParams['SHOW_REGISTRATION'] === 'Y')
		{
			$pathToRegister = $arParams['PATH_TO_REGISTER'];
			$pathToRegister .= (mb_stripos($pathToRegister, '?') === false ? '?' : '&');
			$pathToRegister .= 'register=yes&backurl='.$currentUrl;
			?>
			<a href="<?=$pathToRegister?>">
				<?=GetMessage('TSB1_REGISTER')?>
			</a>
			<?
		}
		?>
	<?endif?>
<?endif?>
<?
if (!$arResult["DISABLE_USE_BASKET"])
{
	?><span class="icon-handbag"></span>
	<strong><a href="<?= $arParams['PATH_TO_BASKET'] ?>"><?= GetMessage('TSB1_CART') ?></a></strong>
	<?
}

if (!$compositeStub)
{
	if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'))
	{
		?>
		<span>
			<?=$arResult['NUM_PRODUCTS'] ?> поз. <?=GetMessage('TSB1_TOTAL_PRICE')?> <?=$arResult['TOTAL_PRICE']?>
		</span>
		<?
	}
}

if ($arParams['SHOW_PERSONAL_LINK'] == 'Y'):?>
	<div style="padding-top: 4px;">
	<span class="icon_info"></span>
	<a href="<?=$arParams['PATH_TO_PERSONAL']?>"><?=GetMessage('TSB1_PERSONAL')?></a>
	</div>
<?endif?>
 