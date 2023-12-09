<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
?>
<div class="card_item_over_hover">
    <button type="button" data-id="<?= $item['ID'] ?>" class="bazarow_add_favor">
        <svg class="icon">
            <use xlink:href="#heart"></use>
        </svg>
    </button>
    <a class="card_item_link" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>" data-entity="image-wrapper">
        <span class="card_item_link_picture"
              id="<?= $itemIds['PICT'] ?>"
              style="background-image: url('<?= $item['PREVIEW_PICTURE']['SRC'] ?>');">
		<?
        if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') {
            if ($price['PERCENT'] > 0) {
                ?>
                <span class="card_item_link_discount">
                    Скидка: <?= $price['PERCENT'] ?>%
                </span>
                <?
            }
        }
        ?>
        <span id="<?= $itemIds['SECOND_PICT'] ?>"></span>
        </span>
        <?
        foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
            if ($blockName === 'price') {
                ?>
                <div class="card_item_price" data-entity="price-block">
                    <?
                    if ($arParams['SHOW_OLD_PRICE'] === 'Y') {
                        if ($price['RATIO_PRICE'] < $price['RATIO_BASE_PRICE']) {
                            ?>
                            <del class="card_item_price_old" id="<?= $itemIds['PRICE_OLD'] ?>">
                                <?= $price['PRINT_RATIO_BASE_PRICE'] ?>
                            </del>
                            <?
                        }
                    }
                    ?>
                    <div class="card_item_price_current" id="<?= $itemIds['PRICE'] ?>">
                        <?
                        if (!empty($price)) {
                            if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
                                echo Loc::getMessage(
                                    'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
                                    array(
                                        '#PRICE#' => $price['PRINT_RATIO_PRICE'],
                                        '#VALUE#' => $measureRatio,
                                        '#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
                                    )
                                );
                            } else {
                                echo $price['PRINT_RATIO_PRICE'];
                            }
                        }
                        ?>
                    </div>
                </div>
                <?
            }
        }
        ?>
        <strong id="<?= $itemIds['PICT_SLIDER'] ?>" class="card_item_link_name">
            <?= $item['NAME'] ?>
        </strong>
    </a>
    <div class="card_item_hidded">
        <?
        foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
            switch ($blockName) {
                case 'sku':
                    if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP'])) {
                        ?>
                        <div id="<?= $itemIds['PROP_DIV'] ?>">
                            <?
                            foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                                $propertyId = $skuProperty['ID'];
                                $skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
                                if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
                                    continue;
                                ?>
                                <div data-entity="sku-block">
                                    <div class="card_item_sku" data-entity="sku-line-block">
                                        <div class="card_item_sku_title">
                                            Выберите: <?= $skuProperty['NAME'] ?>
                                        </div>
                                        <ul>
                                            <?
                                            foreach ($skuProperty['VALUES'] as $value) {
                                                if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
                                                    continue;
                                                $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                                                if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                                    $dbProps = CIBlockElement::GetList(
                                                        false,
                                                        array(
                                                            'IBLOCK_ID' => $item['OFFERS']['0']['IBLOCK_ID'],
                                                            'PROPERTY_CML2_LINK' => $item['ID'],
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
                                                    <li class="card_item_sku_pict"
                                                        data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                        data-onevalue="<?= $value['ID'] ?>">
                                                        <span style="background-image: url('<?= $imgPath ?>');"></span>
                                                    </li>
                                                    <?
                                                    unset($imgPath);
                                                } else {
                                                    ?>
                                                    <li class="card_item_sku_text"
                                                        data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                        data-onevalue="<?= $value['ID'] ?>">
                                                        <span><?= $value['NAME'] ?></span>
                                                    </li>
                                                    <?
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <?
                            }
                            ?>
                        </div>
                        <?
                        foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                            if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
                                continue;

                            $skuProps[] = array(
                                'ID' => $skuProperty['ID'],
                                'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                'VALUES' => $skuProperty['VALUES'],
                                'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                            );
                        }

                        unset($skuProperty, $value);

                    }

                    break;
            }
        }
        ?>
        <div class="card_item_activites">
            <?
            foreach ($arParams['PRODUCT_BLOCKS_ORDER'] as $blockName) {
                switch ($blockName) {
                    case 'quantity':
                        if (!$haveOffers) {
                            if ($actualItem['CAN_BUY'] && $arParams['USE_PRODUCT_QUANTITY']) {
                                ?>
                                <div data-entity="quantity-block" class="card_item_activites_quntity">
                                    <button id="<?= $itemIds['QUANTITY_DOWN'] ?>">-</button>
                                    <input id="<?= $itemIds['QUANTITY'] ?>" type="number"
                                           name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>"
                                           value="<?= $measureRatio ?>">
                                    <button id="<?= $itemIds['QUANTITY_UP'] ?>">+</button>
                                    <div id="<?= $itemIds['PRICE_TOTAL'] ?>"></div>
                                </div>
                                <?
                            }
                        } elseif ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                            if ($arParams['USE_PRODUCT_QUANTITY']) {
                                ?>
                                <div data-entity="quantity-block" class="card_item_activites_quntity">
                                    <button id="<?= $itemIds['QUANTITY_DOWN'] ?>">-</button>
                                    <input id="<?= $itemIds['QUANTITY'] ?>" type="number"
                                           name="<?= $arParams['PRODUCT_QUANTITY_VARIABLE'] ?>"
                                           value="<?= $measureRatio ?>">
                                    <button id="<?= $itemIds['QUANTITY_UP'] ?>">+</button>
                                </div>
                                <?
                            }
                        }
                        break;
                    case 'buttons':
                        ?>
                        <div class="card_item_activites_btns" data-entity="buttons-block">
                            <?
                            if (!$haveOffers) {
                                if ($actualItem['CAN_BUY']) {

                                    ?>
                                    <div id="<?= $itemIds['BASKET_ACTIONS'] ?>">


                                        <button class="add_to_cart<?=$arResult['ITEM']['ID']?> btn" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0);">
                                            <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                        </button>

                                        <a class="add_to_cart_link<?=$arResult['ITEM']['ID']?> link_to_card_dn btn" href="<?=$arParams['~BASKET_URL']?>" id="to_cart_<?=$itemIds['BUY_LINK']?>">
                                            В корзине
                                        </a>

                                        <script>
                                            $('#<?= $itemIds['BUY_LINK'] ?>').click(function () {
                                                $(this).addClass('add_to_cart_dn');
                                                $('#to_cart_<?=$itemIds['BUY_LINK']?>').addClass('link_to_card_db');
                                            });
                                        </script>

                                        <style type="text/css">
                                            .link_to_card_dn, .add_to_cart_dn {
                                                display: none;
                                            }
                                            .link_to_card_db {
                                                display: block;
                                            }
                                        </style>






                                        <!--button class="btn" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0)"
                                                rel="nofollow">
                                            <?//= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                        </button-->
                                    </div>
                                    <?
                                } else {
                                    ?>
                                    <?
                                    if ($showSubscribe) {
                                        $APPLICATION->IncludeComponent(
                                            'bitrix:catalog.product.subscribe',
                                            '',
                                            array(
                                                'PRODUCT_ID' => $actualItem['ID'],
                                                'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                                'BUTTON_CLASS' => 'btn btn-primary ' . $buttonSizeClass,
                                                'DEFAULT_DISPLAY' => true,
                                                'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                            ),
                                            $component,
                                            array('HIDE_ICONS' => 'Y')
                                        );
                                    }
                                    ?>


                                    <button id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>">
                                        <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                    </button>
                                    <?
                                }
                            } else {
                                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                                    ?>

                                    <div id="<?= $itemIds['BASKET_ACTIONS'] ?>">

                                        <button class="add_to_cart<?=$arResult['ITEM']['ID']?> btn" id="<?= $itemIds['BUY_LINK'] ?>" href="javascript:void(0);">
                                            <?= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                        </button>

                                        <a class="add_to_cart_link<?=$arResult['ITEM']['ID']?> link_to_card_dn btn" href="<?=$arParams['~BASKET_URL']?>" id="to_cart_<?=$itemIds['BUY_LINK']?>">
                                            В корзине
                                        </a>

                                        <script>
                                            $('#<?= $itemIds['BUY_LINK'] ?>').click(function () {
                                                $(this).addClass('add_to_cart_dn');
                                                $('#to_cart_<?=$itemIds['BUY_LINK']?>').addClass('link_to_card_db');
                                            });
                                        </script>

                                        <style type="text/css">
                                            <!--
                                            .link_to_card_dn, .add_to_cart_dn {
                                                display: none;
                                            }
                                            .link_to_card_db {
                                                display: block;
                                            }
                                            -->
                                        </style>

                                        <!--button id="<?= $itemIds['BUY_LINK'] ?>" class="btn">
                                            <?//= ($arParams['ADD_TO_BASKET_ACTION'] === 'BUY' ? $arParams['MESS_BTN_BUY'] : $arParams['MESS_BTN_ADD_TO_BASKET']) ?>
                                        </button-->
                                    </div>

                                    <?
                                    if ($showSubscribe) {
                                        $APPLICATION->IncludeComponent(
                                            'bitrix:catalog.product.subscribe',
                                            '',
                                            array(
                                                'PRODUCT_ID' => $item['ID'],
                                                'BUTTON_ID' => $itemIds['SUBSCRIBE_LINK'],
                                                'BUTTON_CLASS' => 'btn btn-primary ' . $buttonSizeClass,
                                                'DEFAULT_DISPLAY' => !$actualItem['CAN_BUY'],
                                                'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
                                            ),
                                            $component,
                                            array('HIDE_ICONS' => 'Y')
                                        );
                                    }
                                    //$actualItem['CAN_BUY']
                                    ?>
                                    <button id="<?= $itemIds['NOT_AVAILABLE_MESS'] ?>">
                                        <?= $arParams['MESS_NOT_AVAILABLE'] ?>
                                    </button>
                                    <?
                                } else {
                                    ?>
                                    <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                                        <?= $arParams['MESS_BTN_DETAIL'] ?>
                                    </a>
                                    <?
                                }
                            }
                            ?>
                        </div>
                        <?
                        break;
                }
            }
            ?>
        </div>
    </div>
</div>
