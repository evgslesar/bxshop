<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arResult
 * @var array $arParams
 * @var array $templateData
 */


// TODO Сделать нормально через res_mod
// Получаем список торговых предложений товара

$offerList = CIBlockPriceTools::GetOffersArray(
    array(
        'IBLOCK_ID' => $arResult['ITEM']['IBLOCK_ID']
    ),
    array(
        $arResult['ITEM']['ID']
    ),
    false,
    array(
        'ID'
    ),
    false,
    false,
    false,
    false,
    false,
    false,
    false
);

$offerIds = array_column($offerList, "ID"); // Получаем ID торговых предложений

if(empty($offerIds)){
    $offerIds[] = $arResult['ITEM']['ID'];
}

$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "PRODUCT_ID" => $offerIds, // Проверяем наличие торговых предложений в корзине
        "ORDER_ID" => "NULL",
        "DELAY" => "N"
    ),
    false,
    false,
    array("PRODUCT_ID")
);
$hasOffersInCart = false;
while ($arItemsBasket = $dbBasketItems->Fetch()) {
    if (in_array($arItemsBasket['PRODUCT_ID'], $offerIds)) {
        $hasOffersInCart = true;
        break;
    }
}
if ($hasOffersInCart == true) {
    ?>
    <script>
        $('.add_to_cart<?=$arResult['ITEM']['ID']?>').addClass('add_to_cart_dn');
        $('.add_to_cart_link<?=$arResult['ITEM']['ID']?>').addClass('link_to_card_db');
    </script>
    <?php
}
// TODO end Сделать нормально через res_mod


// check compared state
if ($arParams['DISPLAY_COMPARE'])
{
	$compared = false;
	$comparedIds = array();
	$item = $templateData['ITEM'];

	if (!empty($_SESSION[$arParams['COMPARE_NAME']][$item['IBLOCK_ID']]))
	{
		if (!empty($item['JS_OFFERS']) && is_array($item['JS_OFFERS']))
		{
			foreach ($item['JS_OFFERS'] as $key => $offer)
			{
				if (array_key_exists($offer['ID'], $_SESSION[$arParams['COMPARE_NAME']][$item['IBLOCK_ID']]['ITEMS']))
				{
					if ($key == $item['OFFERS_SELECTED'])
					{
						$compared = true;
					}

					$comparedIds[] = $offer['ID'];
				}
			}
		}
		elseif (array_key_exists($item['ID'], $_SESSION[$arParams['COMPARE_NAME']][$item['IBLOCK_ID']]['ITEMS']))
		{
			$compared = true;
		}
	}

	if ($templateData['JS_OBJ'])
	{
		?>
		<script>
			BX.ready(BX.defer(function(){
				if (!!window.<?=$templateData['JS_OBJ']?>)
				{
					window.<?=$templateData['JS_OBJ']?>.setCompared('<?=$compared?>');

					<? if (!empty($comparedIds)): ?>
						window.<?=$templateData['JS_OBJ']?>.setCompareInfo(<?=CUtil::PhpToJSObject($comparedIds, false, true)?>);
					<? endif ?>
				}
			}));
		</script>
		<?
	}
}