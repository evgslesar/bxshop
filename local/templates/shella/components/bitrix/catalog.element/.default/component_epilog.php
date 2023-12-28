<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;



// TODO Сделать нормально через res_mod
// Получаем список торговых предложений товара
$offerList = CIBlockPriceTools::GetOffersArray(
    array(
        'IBLOCK_ID' => $arParams['IBLOCK_ID']
    ),
    array(
        $arResult['ID']
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
        $('.add_to_cart').addClass('hidden');
        $('.item_in_cart').removeClass('hidden');
    </script>
    <?php
}
// TODO end Сделать нормально через res_mod


/**
 * @var array $templateData
 * @var array $arParams
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if (!empty($templateData['TEMPLATE_LIBRARY'])) {
    $loadCurrency = false;

    if (!empty($templateData['CURRENCIES'])) {
        $loadCurrency = Loader::includeModule('currency');
    }

    CJSCore::Init($templateData['TEMPLATE_LIBRARY']);
    if ($loadCurrency) {
        ?>
        <script>
            BX.Currency.setCurrencies(<?=$templateData['CURRENCIES']?>);
        </script>
        <?php
    }
}

if (isset($templateData['JS_OBJ'])) {
    ?>
    <script>
        BX.ready(BX.defer(function () {
            if (!!window.<?=$templateData['JS_OBJ']?>) {
                window.<?=$templateData['JS_OBJ']?>.allowViewedCount(true);
            }
        }));
    </script>
    <?php
    // select target offer
    $request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
    $offerNum = false;
    $offerId = (int)$this->request->get('OFFER_ID');
    $offerCode = $this->request->get('OFFER_CODE');
    if (!empty($_REQUEST['offer'])) {
        $offerNum = array_search($_REQUEST['offer'], $templateData['OFFER_IDS']);
        $dbOfferData = CIBlockElement::GetList(
            false,
            array(
                '=ID' => $_REQUEST['offer']
            ),
            false,
            array(
                'nTopCount' => 1
            ),
            array(
                'NAME',
                'IBLOCK_ID',
                'CANONICAL_PAGE_URL'
            )
        )->GetNext();
        $dbOfferSeoProps = new \Bitrix\Iblock\InheritedProperty\ElementValues(
            $dbOfferData['IBLOCK_ID'], // ID инфоблока с ТП
            $_REQUEST['offer'] // ID элемента
        );
        $arOfferSeoProps = $dbOfferSeoProps->getValues();
        $APPLICATION->SetTitle($dbOfferData['NAME']);
        $APPLICATION->SetPageProperty("title", $arOfferSeoProps['ELEMENT_META_TITLE']);
        $APPLICATION->SetPageProperty("keywords", $arOfferSeoProps['ELEMENT_META_KEYWORDS']);
        $APPLICATION->SetPageProperty("description", $arOfferSeoProps['ELEMENT_META_DESCRIPTION']);
        $APPLICATION->SetPageProperty("canonical", $dbOfferData['CANONICAL_PAGE_URL']);
    } else {
        $offerNum = 0;
    }
    ?>
    <script>
        BX.ready(function () {
            if (!!window.<?=$templateData['JS_OBJ']?>) {
                window.<?=$templateData['JS_OBJ']?>.setOffer(<?=$offerNum?>);
            }
        });
    </script>
    <?php
}
