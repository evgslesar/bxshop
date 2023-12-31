<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx', 'ui.fonts.opensans');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => [
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
    ],
];
if ($haveOffers) {
    $templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
    $templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $haveOffers && !empty($arResult['OFFERS_PROP']) ? $mainId . '_skudiv' : null,
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DESCRIPTION_ID' => $mainId . '_description',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

if ($haveOffers) {
    $actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');

if ($arResult['MODULES']['catalog'] && $arResult['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE) {
    $arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE_SERVICE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
    $arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE_SERVICE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
} else {
    $arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
    $arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
}

$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-' . $arParams['TEMPLATE_THEME'] : '';
?>
    <div class="detail_item" id="<?= $itemIds['ID'] ?>" itemscope itemtype="http://schema.org/Product">

        <div class="row">

            <div class="col-xl-5">
                <div class="product-item-detail-slider-container" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">
                    <span data-entity="close-popup"></span>
                    <div class="product-item-detail-slider-block
				        <?= ($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '') ?>"
                         data-entity="images-slider-block">
                        <span class="product-item-detail-slider-left" data-entity="slider-control-left"
                              style="display: none;"></span>
                        <span class="product-item-detail-slider-right" data-entity="slider-control-right"
                              style="display: none;"></span>
                        <div class="product-item-label-text" id="<?= $itemIds['STICKER_ID'] ?>"
                            <?= (!$arResult['LABEL'] ? 'style="display: none;"' : '') ?>>
                            <?php
                            if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE'])) {
                                foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value) {
                                    ?>
                                    <div>
                                        <?= $value ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <?php
                        if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') {
                            if ($haveOffers) {
                                ?>
                                <div class="img_discount_perc" id="<?= $itemIds['DISCOUNT_PERCENT_ID'] ?>" style="display: none;"></div>
                                <?php
                            } else {
                                if ($price['DISCOUNT'] > 0) {
                                    ?>
                                    <div class="img_discount_perc" id="<?= $itemIds['DISCOUNT_PERCENT_ID'] ?>">
                                        <?= -$price['PERCENT'] ?>%
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <div class="product-item-detail-slider-images-container" data-entity="images-container">
                            <?php
                            if (!empty($actualItem['MORE_PHOTO'])) {
                                foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                    ?>
                                    <div class="product-item-detail-slider-image<?= ($key == 0 ? ' active' : '') ?>"
                                         data-entity="image" data-id="<?= $photo['ID'] ?>">
                                        <img src="<?= $photo['SRC'] ?>" alt="<?= $alt ?>"
                                             title="<?= $title ?>"<?= ($key == 0 ? ' itemprop="image"' : '') ?>>
                                    </div>
                                    <?php
                                }
                            }

                            if ($arParams['SLIDER_PROGRESS'] === 'Y') {
                                ?>
                                <div class="product-item-detail-slider-progress-bar" data-entity="slider-progress-bar"
                                     style="width: 0;"></div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($showSliderControls) {
                        if ($haveOffers) {
                            foreach ($arResult['OFFERS'] as $keyOffer => $offer) {
                                if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
                                    continue;

                                $strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
                                ?>
                                <div class="product-item-detail-slider-controls-block"
                                     id="<?= $itemIds['SLIDER_CONT_OF_ID'] . $offer['ID'] ?>"
                                     style="display: <?= $strVisible ?>;">
                                    <?php
                                    foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo) {
                                        ?>
                                        <div class="product-item-detail-slider-controls-image<?= ($keyPhoto == 0 ? ' active' : '') ?>"
                                             data-entity="slider-control"
                                             data-value="<?= $offer['ID'] . '_' . $photo['ID'] ?>">
                                            <img src="<?= $photo['SRC'] ?>">
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        } else {
                            ?>
                            <div class="product-item-detail-slider-controls-block"
                                 id="<?= $itemIds['SLIDER_CONT_ID'] ?>">
                                <?php
                                if (!empty($actualItem['MORE_PHOTO'])) {
                                    foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                        ?>
                                        <div class="product-item-detail-slider-controls-image<?= ($key == 0 ? ' active' : '') ?>"
                                             data-entity="slider-control" data-value="<?= $photo['ID'] ?>">
                                            <img src="<?= $photo['SRC'] ?>">
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
            $showOffersBlock = $haveOffers && !empty($arResult['OFFERS_PROP']);
            $mainBlockProperties = array_intersect_key($arResult['DISPLAY_PROPERTIES'], $arParams['MAIN_BLOCK_PROPERTY_CODE']);
            $showPropsBlock = !empty($mainBlockProperties) || $arResult['SHOW_OFFERS_PROPS'];
            $showBlockWithOffersAndProps = $showOffersBlock || $showPropsBlock;
            ?>
            <div class="col-xl-7">

                <div class="detail_item_right">
                    <div class="detail_item_right_col_1">
                        <div class="detail_item_right_artum">
                            Артикул: 123-45-67-0988

                            <button type="button" data-id="<?= $arResult['ID'] ?>" class="bazarow_add_favor">
                                <svg class="icon">
                                    <use xlink:href="#heart"></use>
                                </svg>
                            </button>
                        </div>



                        <ul class="detail_item_right_props">
                            <?
                            foreach ($arResult['DISPLAY_PROPERTIES'] as $PROPERTY) {
                                ?>
                                <li>
                                    <strong><?= $PROPERTY['NAME'] ?></strong>
                                    <span>
                                    <?
                                    if (is_array($PROPERTY['VALUE'])) {
                                        echo implode(',', $PROPERTY['VALUE']);
                                    } else {
                                        echo $PROPERTY['VALUE'];
                                    }
                                    ?>
                                </span>
                                </li>
                                <?
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="detail_item_right_col_2">
                        <div class="detail_item_right_over">
                            <div class="detail_item_right_vote">
                                <?php
                                $APPLICATION->IncludeComponent(
                                    'bitrix:iblock.vote',
                                    'bootstrap_v4',
                                    array(
                                        'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
                                        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                        'ELEMENT_ID' => $arResult['ID'],
                                        'ELEMENT_CODE' => '',
                                        'MAX_VOTE' => '5',
                                        'VOTE_NAMES' => array('1', '2', '3', '4', '5'),
                                        'SET_STATUS_404' => 'N',
                                        'DISPLAY_AS_RATING' => $arParams['VOTE_DISPLAY_AS_RATING'],
                                        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                        'CACHE_TIME' => $arParams['CACHE_TIME']
                                    ),
                                    $component,
                                    array('HIDE_ICONS' => 'Y')
                                );
                                ?>
                            </div>
                            <div class="detail_item_right_price">
                                <?php
                                foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName) {
                                    switch ($blockName) {
                                        case 'price':
                                            if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
                                                ?>
                                                <del id="<?= $itemIds['OLD_PRICE_ID'] ?>"
                                                    <?= ($showDiscount ? '' : 'style="display: none;"') ?>>
                                                    <?= ($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '') ?>
                                                </del>
                                                <?php
                                            }
                                            ?>
                                            <div class="detail_item_right_price_current"
                                                 id="<?= $itemIds['PRICE_ID'] ?>">
                                                <?= $price['PRINT_RATIO_PRICE'] ?>
                                            </div>
                                            <?php
                                            if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
                                                ?>
                                                <div class="detail_item_right_price_eco"
                                                     id="<?= $itemIds['DISCOUNT_PRICE_ID'] ?>"
                                                    <?= ($showDiscount ? '' : 'style="display: none;"') ?>><?php
                                                    if ($showDiscount) {
                                                        echo Loc::getMessage('CT_BCE_CATALOG_ECONOMY_INFO2', array('#ECONOMY#' => $price['PRINT_RATIO_DISCOUNT']));
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                            break;
                                    }
                                }
                                ?>
                            </div>
                            <div class="detail_item_right_btns">
                                <?php
                                foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName) {
                                    switch ($blockName) {
                                        case 'quantity':
                                            if ($arParams['USE_PRODUCT_QUANTITY']) {
                                                ?>
                                                <div class="detail_item_right_btns_quantity"
                                                     data-entity="quantity-block">
                                                    <button id="<?= $itemIds['QUANTITY_DOWN_ID'] ?>">-</button>
                                                    <input id="<?= $itemIds['QUANTITY_ID'] ?>" type="text"
                                                           value="<?= $price['MIN_QUANTITY'] ?>">
                                                    <button id="<?= $itemIds['QUANTITY_UP_ID'] ?>">+</button>
                                                    <?/*span id="<?= $itemIds['QUANTITY_MEASURE'] ?>"><?= $actualItem['ITEM_MEASURE']['TITLE'] ?></span>
                                        <span id="<?= $itemIds['PRICE_TOTAL'] ?>"></span*/ ?>
                                                </div>
                                                <?php
                                            }

                                            break;
                                        case 'buttons':
                                            ?>
                                            <div class="detail_item_right_btns_btn" data-entity="main-button-container">
                                                <div id="<?= $itemIds['BASKET_ACTIONS_ID'] ?>">
                                                    <?php
                                                    if ($showAddBtn) {
                                                        ?>

                                                        <button class="add_to_cart btn" id="<?= $itemIds['ADD_BASKET_LINK'] ?>" href="javascript:void(0);">
                                                            <?= $arParams['MESS_BTN_ADD_TO_BASKET'] ?>
                                                        </button>

                                                        <a class="item_in_cart hidden btn" href="<?=$arParams['BASKET_URL']?>" id="to_cart_<?=$itemIds['ADD_BASKET_LINK']?>">
                                                            В корзине
                                                        </a>

                                                        <script>
                                                            $('#<?= $itemIds['ADD_BASKET_LINK'] ?>').click(function () {
                                                                $(this).addClass('hidden');
                                                                $('#to_cart_<?=$itemIds['ADD_BASKET_LINK']?>').removeClass('hidden');
                                                            });
                                                        </script>

                                                        <?php
                                                    }
                                                    /*
                                                       if ($showBuyBtn) {
                                                           ?>
                                                           <button id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0);">
                                                               <?= $arParams['MESS_BTN_BUY'] ?>
                                                           </button>
                                                           <?php
                                                       }
                                                    */
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            if ($showSubscribe) {
                                                ?>

                                                <?php
                                                $APPLICATION->IncludeComponent(
                                                    'bitrix:catalog.product.subscribe',
                                                    '',
                                                    array(
                                                        'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
                                                        'PRODUCT_ID' => $arResult['ID'],
                                                        'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                                        'BUTTON_CLASS' => 'btn u-btn-outline-primary product-item-detail-buy-button',
                                                        'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
                                                        'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                                    ),
                                                    $component,
                                                    array('HIDE_ICONS' => 'Y')
                                                );
                                                ?>

                                                <?php
                                            }
                                            ?>
                                            <div style="display: <?= (!$actualItem['CAN_BUY'] ? '' : 'none') ?>;">
                                                <a href="javascript:void(0)"
                                                   rel="nofollow"><?= $arParams['MESS_NOT_AVAILABLE'] ?></a>
                                            </div>
                                            <?php
                                            break;
                                    }
                                }
                                ?>
                            </div>
                            <div class="detail_item_right_scu">
                                <?php
                                if ($showBlockWithOffersAndProps) {
                                    foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName) {
                                        switch ($blockName) {
                                            case 'sku':
                                                if ($showOffersBlock) {
                                                    ?>
                                                    <div id="<?= $itemIds['TREE_ID'] ?>">
                                                        <?php
                                                        foreach ($arResult['SKU_PROPS'] as $skuProperty) {
                                                            if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
                                                                continue;

                                                            $propertyId = $skuProperty['ID'];
                                                            $skuProps[] = array(
                                                                'ID' => $propertyId,
                                                                'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                                                'VALUES' => $skuProperty['VALUES'],
                                                                'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                                                            );
                                                            ?>
                                                            <div data-entity="sku-line-block">
                                                                <div class="detail_item_right_scu_title">
                                                                    Выберите: <?= htmlspecialcharsEx($skuProperty['NAME']) ?>
                                                                </div>
                                                                <ul>
                                                                    <?php
                                                                    foreach ($skuProperty['VALUES'] as &$value) {
                                                                        $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                                                                        if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                                                            $dbProps = CIBlockElement::GetList(
                                                                                false,
                                                                                array(
                                                                                    'IBLOCK_ID' => $arResult['OFFERS']['0']['IBLOCK_ID'],
                                                                                    'PROPERTY_CML2_LINK' => $arResult['ID'],
                                                                                    'PROPERTY_ATT_COLOR' => $value['XML_ID']
                                                                                ),
                                                                                false,
                                                                                array('nTopCount' => '1'),
                                                                                array('DETAIL_PICTURE')
                                                                            );
                                                                            while ($arFields = $dbProps->Fetch()) {
                                                                                if (!empty($arFields["DETAIL_PICTURE"])) {
                                                                                    $imgPath = CFile::GetPath($arFields["DETAIL_PICTURE"]);
                                                                                } else {
                                                                                    $imgPath = $value['PICT']['SRC'];
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <li class="detail_item_right_scu_pict"
                                                                                data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                                                data-onevalue="<?= $value['ID'] ?>">
                                                                                <span style="background-image: url('<?= $imgPath ?>');"></span>
                                                                                <span><?= $value['NAME'] ?></span>
                                                                            </li>
                                                                            <?php
                                                                            unset($imgPath);
                                                                        } else {
                                                                            ?>
                                                                            <li class="detail_item_right_scu_txt"
                                                                                data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                                                data-onevalue="<?= $value['ID'] ?>">
                                                                                <span><?= $value['NAME'] ?></span>
                                                                            </li>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }

                                                break;
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">
            <div class="col-xl-9">
                <div class="detail_item_text">
                <?= $arResult['DETAIL_TEXT'] ?>
                </div>
            </div>
            <div class="col-xl-3">

            </div>
        </div>

        <meta itemprop="name" content="<?= $name ?>"/>
        <meta itemprop="category" content="<?= $arResult['CATEGORY_PATH'] ?>"/>
        <meta itemprop="id" content="<?= $arResult['ID'] ?>"/>
        <?php
        if ($haveOffers) {
            foreach ($arResult['JS_OFFERS'] as $offer) {
                $currentOffersList = array();
                if (!empty($offer['TREE']) && is_array($offer['TREE'])) {
                    foreach ($offer['TREE'] as $propName => $skuId) {
                        $propId = (int)substr($propName, 5);
                        foreach ($skuProps as $prop) {
                            if ($prop['ID'] == $propId) {
                                foreach ($prop['VALUES'] as $propId => $propValue) {
                                    if ($propId == $skuId) {
                                        $currentOffersList[] = $propValue['NAME'];
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
                $offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
                ?>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <meta itemprop="sku" content="<?= htmlspecialcharsbx(implode('/', $currentOffersList)) ?>"/>
                    <meta itemprop="price" content="<?= $offerPrice['RATIO_PRICE'] ?>"/>
                    <meta itemprop="priceCurrency" content="<?= $offerPrice['CURRENCY'] ?>"/>
                    <link itemprop="availability"
                          href="http://schema.org/<?= ($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>"/>
                </div>
                <?php
            }
            unset($offerPrice, $currentOffersList);
        } else {
            ?>
            <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <meta itemprop="price" content="<?= $price['RATIO_PRICE'] ?>"/>
                <meta itemprop="priceCurrency" content="<?= $price['CURRENCY'] ?>"/>
                <link itemprop="availability"
                      href="http://schema.org/<?= ($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock') ?>"/>
            </div>
            <?php
        }
        ?>
        <?php
        if ($haveOffers) {
            $offerIds = array();
            $offerCodes = array();

            $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

            foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer) {
                $offerIds[] = (int)$jsOffer['ID'];
                $offerCodes[] = $jsOffer['CODE'];

                $fullOffer = $arResult['OFFERS'][$ind];
                $measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

                $strAllProps = '';
                $strMainProps = '';
                $strPriceRangesRatio = '';
                $strPriceRanges = '';

                if ($arResult['SHOW_OFFERS_PROPS']) {
                    if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                        foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property) {
                            $current = '<li class="product-item-detail-properties-item">
					<span class="product-item-detail-properties-name">' . $property['NAME'] . '</span>
					<span class="product-item-detail-properties-dots"></span>
					<span class="product-item-detail-properties-value">' . (
                                is_array($property['VALUE'])
                                    ? implode(' / ', $property['VALUE'])
                                    : $property['VALUE']
                                ) . '</span></li>';
                            $strAllProps .= $current;

                            if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']])) {
                                $strMainProps .= $current;
                            }
                        }

                        unset($current);
                    }
                }

                if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1) {
                    $strPriceRangesRatio = '(' . Loc::getMessage(
                            'CT_BCE_CATALOG_RATIO_PRICE',
                            array('#RATIO#' => ($useRatio
                                    ? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
                                    : '1'
                                ) . ' ' . $measureName)
                        ) . ')';

                    foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range) {
                        if ($range['HASH'] !== 'ZERO-INF') {
                            $itemPrice = false;

                            foreach ($jsOffer['ITEM_PRICES'] as $itemPrice) {
                                if ($itemPrice['QUANTITY_HASH'] === $range['HASH']) {
                                    break;
                                }
                            }

                            if ($itemPrice) {
                                $strPriceRanges .= '<dt>' . Loc::getMessage(
                                        'CT_BCE_CATALOG_RANGE_FROM',
                                        array('#FROM#' => $range['SORT_FROM'] . ' ' . $measureName)
                                    ) . ' ';

                                if (is_infinite($range['SORT_TO'])) {
                                    $strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                                } else {
                                    $strPriceRanges .= Loc::getMessage(
                                        'CT_BCE_CATALOG_RANGE_TO',
                                        array('#TO#' => $range['SORT_TO'] . ' ' . $measureName)
                                    );
                                }

                                $strPriceRanges .= '</dt><dd>' . ($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']) . '</dd>';
                            }
                        }
                    }

                    unset($range, $itemPrice);
                }

                $jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
                $jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
                $jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
                $jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
            }

            $templateData['OFFER_IDS'] = $offerIds;
            $templateData['OFFER_CODES'] = $offerCodes;
            unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

            $jsParams = array(
                'CONFIG' => array(
                    'USE_CATALOG' => $arResult['CATALOG'],
                    'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                    'SHOW_PRICE' => true,
                    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
                    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
                    'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                    'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                    'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
                    'OFFER_GROUP' => $arResult['OFFER_GROUP'],
                    'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
                    'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                    'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
                    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                    'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
                    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
                    'USE_STICKERS' => true,
                    'USE_SUBSCRIBE' => $showSubscribe,
                    'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
                    'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
                    'ALT' => $alt,
                    'TITLE' => $title,
                    'MAGNIFIER_ZOOM_PERCENT' => 200,
                    'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
                    'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
                    'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                        ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                        : null,
                    'SHOW_SKU_DESCRIPTION' => $arParams['SHOW_SKU_DESCRIPTION'],
                    'DISPLAY_PREVIEW_TEXT_MODE' => $arParams['DISPLAY_PREVIEW_TEXT_MODE']
                ),
                'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
                'VISUAL' => $itemIds,
                'DEFAULT_PICTURE' => array(
                    'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
                    'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
                ),
                'PRODUCT' => array(
                    'ID' => $arResult['ID'],
                    'ACTIVE' => $arResult['ACTIVE'],
                    'NAME' => $arResult['~NAME'],
                    'CATEGORY' => $arResult['CATEGORY_PATH'],
                    'DETAIL_TEXT' => $arResult['DETAIL_TEXT'],
                    'DETAIL_TEXT_TYPE' => $arResult['DETAIL_TEXT_TYPE'],
                    'PREVIEW_TEXT' => $arResult['PREVIEW_TEXT'],
                    'PREVIEW_TEXT_TYPE' => $arResult['PREVIEW_TEXT_TYPE']
                ),
                'BASKET' => array(
                    'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                    'BASKET_URL' => $arParams['BASKET_URL'],
                    'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
                    'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                    'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
                ),
                'OFFERS' => $arResult['JS_OFFERS'],
                'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
                'TREE_PROPS' => $skuProps
            );
        } else {
            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties) {
                ?>
                <div id="<?= $itemIds['BASKET_PROP_DIV'] ?>" style="display: none;">
                    <?php
                    if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                        foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo) {
                            ?>
                            <input type="hidden" name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                                   value="<?= htmlspecialcharsbx($propInfo['ID']) ?>">
                            <?php
                            unset($arResult['PRODUCT_PROPERTIES'][$propId]);
                        }
                    }

                    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
                    if (!$emptyProductProperties) {
                        ?>
                        <table>
                            <?php
                            foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo) {
                                ?>
                                <tr>
                                    <td><?= $arResult['PROPERTIES'][$propId]['NAME'] ?></td>
                                    <td>
                                        <?php
                                        if (
                                            $arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
                                            && $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
                                        ) {
                                            foreach ($propInfo['VALUES'] as $valueId => $value) {
                                                ?>
                                                <label>
                                                    <input type="radio"
                                                           name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]"
                                                           value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"checked"' : '') ?>>
                                                    <?= $value ?>
                                                </label>
                                                <br>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <select name="<?= $arParams['PRODUCT_PROPS_VARIABLE'] ?>[<?= $propId ?>]">
                                                <?php
                                                foreach ($propInfo['VALUES'] as $valueId => $value) {
                                                    ?>
                                                    <option value="<?= $valueId ?>" <?= ($valueId == $propInfo['SELECTED'] ? '"selected"' : '') ?>>
                                                        <?= $value ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }

            $jsParams = array(
                'CONFIG' => array(
                    'USE_CATALOG' => $arResult['CATALOG'],
                    'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
                    'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
                    'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
                    'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
                    'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                    'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
                    'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
                    'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
                    'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
                    'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                    'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
                    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
                    'USE_STICKERS' => true,
                    'USE_SUBSCRIBE' => $showSubscribe,
                    'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
                    'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
                    'ALT' => $alt,
                    'TITLE' => $title,
                    'MAGNIFIER_ZOOM_PERCENT' => 200,
                    'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
                    'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
                    'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
                        ? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
                        : null
                ),
                'VISUAL' => $itemIds,
                'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
                'PRODUCT' => array(
                    'ID' => $arResult['ID'],
                    'ACTIVE' => $arResult['ACTIVE'],
                    'PICT' => reset($arResult['MORE_PHOTO']),
                    'NAME' => $arResult['~NAME'],
                    'SUBSCRIPTION' => true,
                    'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
                    'ITEM_PRICES' => $arResult['ITEM_PRICES'],
                    'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
                    'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
                    'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
                    'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
                    'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
                    'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
                    'SLIDER' => $arResult['MORE_PHOTO'],
                    'CAN_BUY' => $arResult['CAN_BUY'],
                    'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
                    'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
                    'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
                    'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
                    'CATEGORY' => $arResult['CATEGORY_PATH']
                ),
                'BASKET' => array(
                    'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
                    'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                    'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
                    'EMPTY_PROPS' => $emptyProductProperties,
                    'BASKET_URL' => $arParams['BASKET_URL'],
                    'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
                    'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
                )
            );
            unset($emptyProductProperties);
        }
        $jsParams["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"] =
            $arResult["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"];
        ?>
    </div>
    <script>
        BX.message({
            ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
            TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
            TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
            BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
            BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
            BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
            BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
            BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
            TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
            COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
            COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
            COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
            PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
            PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
            RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
            RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
            SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
        });

        var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
    </script>
<?php
unset($actualItem, $itemIds, $jsParams);
