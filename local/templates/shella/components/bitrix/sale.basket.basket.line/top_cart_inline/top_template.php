<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $cartId
 */

$compositeStub = ($arResult['COMPOSITE_STUB'] ?? 'N') === 'Y';
?>
<a href="/cart" class="header__btn-cart position-relative d-flex align-items-center text-nowrap js-popup-button" data-page-url="#system_mainpage" data-js-popup-button="cart">
	<i class="mr-lg-7">
		<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-109" viewBox="0 0 24 24">
			<path d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z" />
		</svg>
	</i>
	<?php
	if (!$compositeStub)
	{
		if (
			$arParams['SHOW_NUM_PRODUCTS'] === 'Y'
			&& ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] === 'Y')
		)
		{
			?>
			<span class="d-none d-lg-inline mt-lg-3" data-js-cart-count-desktop="0">Корзина (<?= $arResult['NUM_PRODUCTS'] ?>)</span>
			<span class="header__counter d-lg-none" data-js-cart-count-mobile="0"><?= $arResult['NUM_PRODUCTS'] ?></span>
			<?php
		}
	}
	?>
</a>

