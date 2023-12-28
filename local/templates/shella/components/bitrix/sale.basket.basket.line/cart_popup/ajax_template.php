<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

?>
	<div class="popup-cart__head d-flex align-items-center">
		<h5 class="m-0">Корзина <span data-js-popup-cart-count>(<?= $arResult['NUM_PRODUCTS'] ?>)</span></h5>
		<i class="popup-cart__close ml-auto cursor-pointer" data-js-popup-close>
			<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-164" viewBox="0 0 24 24">
				<path d="M19.583 4.965a.65.65 0 0 1-.176.449l-6.445 6.426 6.445 6.426c.117.131.176.28.176.449a.65.65 0 0 1-.176.449.846.846 0 0 1-.215.127.596.596 0 0 1-.468 0 .846.846 0 0 1-.215-.127l-6.426-6.445-6.426 6.445a.846.846 0 0 1-.215.127.596.596 0 0 1-.468 0 .846.846 0 0 1-.215-.127.65.65 0 0 1-.176-.449c0-.169.059-.318.176-.449l6.445-6.426-6.445-6.426a.65.65 0 0 1-.176-.449c0-.169.059-.318.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176l6.426 6.445 6.426-6.445a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z" />
			</svg>
		</i>
	</div>


	<div data-role="basket-item-list" class="popup-cart__content">

		<?if ($arParams["POSITION_FIXED"] == "Y"):?>
			<div id="<?=$cartId?>status" class="bx-basket-item-list-action" onclick="<?=$cartId?>.toggleOpenCloseCart()"><?=GetMessage("TSB1_COLLAPSE")?></div>
		<?endif?>

		<?if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]):?>
			<div class="bx-basket-item-list-button-container">
				<a href="<?=$arParams["PATH_TO_ORDER"]?>" class="btn btn-primary"><?=GetMessage("TSB1_2ORDER")?></a>
			</div>
		<?endif?>

		<div id="<?=$cartId?>products" class="popup-cart__items mt-15 border-bottom">
			<?foreach ($arResult["CATEGORIES"] as $category => $items):
				if (empty($items))
					continue;
				?>
				<div class="bx-basket-item-list-item-status"><?=GetMessage("TSB1_$category")?></div>
				<?foreach ($items as $v):?>
					<div>
						<div class="product-cart d-flex flex-row align-items-start mb-20" data-js-product="" data-product-variant-id="13519954018356">
							<div class="product-cart__image mr-15">
								<a href="<?=$v["DETAIL_PAGE_URL"]?>" class="d-block"> 
									<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" srcset="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>">
								</a>
							</div>
							<div class="product-cart__content d-flex flex-column align-items-start">
								<div class="product-cart__title mb-3">
									<h3 class="h6 m-0"><a href="<?=$v["DETAIL_PAGE_URL"]?>"><?=$v["NAME"]?></a></h3>
								</div>
								<div class="product-cart__price mt-10 mb-10">
									<span class="product-cart__quantity"><?=$v["QUANTITY"]?></span> 
									<span>x</span> 
									<span class="price" data-wg-notranslate="manual">
										<span>
											<span class="money" data-currency-usd="<?=$v["SUM"]?>" data-currency="USD" data-wg-notranslate="manual">
												<?=$v["SUM"]?>
											</span>
										</span>
									</span>
								</div>
								<div class="product-cart__remove btn-link js-product-button-remove-from-cart" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)" title="<?=GetMessage("TSB1_DELETE")?>">X</div>
							</div>
						</div>
					</div>
				<?endforeach?>
			<?endforeach?>
		</div>

		<div class="popup-cart__subtotal h5 d-flex align-items-center mt-15 mb-0">
			<p class="m-0"><?=GetMessage('TSB1_TOTAL_PRICE')?>: <?=$arResult['TOTAL_PRICE']?></p>
			<span class="ml-auto">
				<span class="price" data-js-popup-cart-subtotal></span>
			</span>
		</div>
		<div class="popup-cart__buttons mt-15">
			<a href="<?= $arParams['PATH_TO_BASKET'] ?>" class="btn btn--full mt-20"><?= GetMessage('TSB1_CART') ?></a>
		</div>
	
	</div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>


	<div class="bx-basket-block">
		<i class="fa fa-user"></i>
		<?if ($USER->IsAuthorized()):
			$name = trim($USER->GetFullName());
			if (! $name)
				$name = trim($USER->GetLogin());
			if (mb_strlen($name) > 15)
				$name = mb_substr($name, 0, 12).'...';
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
		<?

		if ($arParams['SHOW_PERSONAL_LINK'] == 'Y'):?>
			<div style="padding-top: 4px;">
			<span class="icon_info"></span>
			<a href="<?=$arParams['PATH_TO_PERSONAL']?>"><?=GetMessage('TSB1_PERSONAL')?></a>
			</div>
		<?endif?>
	</div>

	
	<div class="popup-cart__empty mt-20 d-none-important">Your shopping bag is empty.</div>

