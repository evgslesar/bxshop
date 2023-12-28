<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);

if (!empty($arResult['NAV_RESULT']))
{
	$navParams =  array(
		'NavPageCount' => $arResult['NAV_RESULT']->NavPageCount,
		'NavPageNomer' => $arResult['NAV_RESULT']->NavPageNomer,
		'NavNum' => $arResult['NAV_RESULT']->NavNum
	);
}
else
{
	$navParams = array(
		'NavPageCount' => 1,
		'NavPageNomer' => 1,
		'NavNum' => $this->randString()
	);
}

$showTopPager = false;
$showBottomPager = false;
$showLazyLoad = false;

if ($arParams['PAGE_ELEMENT_COUNT'] > 0 && $navParams['NavPageCount'] > 1)
{
	$showTopPager = $arParams['DISPLAY_TOP_PAGER'];
	$showBottomPager = $arParams['DISPLAY_BOTTOM_PAGER'];
	$showLazyLoad = $arParams['LAZY_LOAD'] === 'Y' && $navParams['NavPageNomer'] != $navParams['NavPageCount'];
}

$templateLibrary = array('popup', 'ajax', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'USE_PAGINATION_CONTAINER' => $showTopPager || $showBottomPager,
);
unset($currencyList, $templateLibrary);

$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCS_TPL_ELEMENT_DELETE_CONFIRM'));

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = '';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = '';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$arParams['~MESS_BTN_BUY'] = ($arParams['~MESS_BTN_BUY'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_BUY');
$arParams['~MESS_BTN_DETAIL'] = ($arParams['~MESS_BTN_DETAIL'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_DETAIL');
$arParams['~MESS_BTN_COMPARE'] = ($arParams['~MESS_BTN_COMPARE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_COMPARE');
$arParams['~MESS_BTN_SUBSCRIBE'] = ($arParams['~MESS_BTN_SUBSCRIBE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_SUBSCRIBE');
$arParams['~MESS_BTN_ADD_TO_BASKET'] = ($arParams['~MESS_BTN_ADD_TO_BASKET'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_BTN_ADD_TO_BASKET');
$arParams['~MESS_NOT_AVAILABLE'] = ($arParams['~MESS_NOT_AVAILABLE'] ?? '') ?: Loc::getMessage('CT_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE');
$arParams['~MESS_NOT_AVAILABLE_SERVICE'] = ($arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '') ?: Loc::getMessage('CP_BCS_TPL_MESS_PRODUCT_NOT_AVAILABLE_SERVICE');
$arParams['~MESS_SHOW_MAX_QUANTITY'] = ($arParams['~MESS_SHOW_MAX_QUANTITY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_SHOW_MAX_QUANTITY');
$arParams['~MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['~MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = ($arParams['MESS_RELATIVE_QUANTITY_MANY'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['~MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['~MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = ($arParams['MESS_RELATIVE_QUANTITY_FEW'] ?? '') ?: Loc::getMessage('CT_BCS_CATALOG_RELATIVE_QUANTITY_FEW');

$arParams['MESS_BTN_LAZY_LOAD'] = $arParams['MESS_BTN_LAZY_LOAD'] ?: Loc::getMessage('CT_BCS_CATALOG_MESS_BTN_LAZY_LOAD');

$obName = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $this->GetEditAreaId($navParams['NavNum']));
$containerName = 'container-'.$navParams['NavNum'];
?>

<div class="collection-products bx-<?=$arParams['TEMPLATE_THEME']?>" data-entity="<?=$containerName?>" data-js-products>
	<?
	if (!empty($arResult['ITEMS']) && !empty($arResult['ITEM_ROWS']))
	{
		$generalParams = [
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
			'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'MESS_SHOW_MAX_QUANTITY' => $arParams['~MESS_SHOW_MAX_QUANTITY'],
			'MESS_RELATIVE_QUANTITY_MANY' => $arParams['~MESS_RELATIVE_QUANTITY_MANY'],
			'MESS_RELATIVE_QUANTITY_FEW' => $arParams['~MESS_RELATIVE_QUANTITY_FEW'],
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
			'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
			'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'COMPARE_PATH' => $arParams['COMPARE_PATH'],
			'COMPARE_NAME' => $arParams['COMPARE_NAME'],
			'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
			'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
			'LABEL_POSITION_CLASS' => $labelPositionClass,
			'DISCOUNT_POSITION_CLASS' => $discountPositionClass,
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'SLIDER_PROGRESS' => $arParams['SLIDER_PROGRESS'],
			'~BASKET_URL' => $arParams['~BASKET_URL'],
			'~ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'~BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE'],
			'~COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
			'~COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY'],
			'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
			'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
			'MESS_BTN_COMPARE' => $arParams['~MESS_BTN_COMPARE'],
			'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
			'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
		];

		$areaIds = [];
		$itemParameters = [];

		foreach ($arResult['ITEMS'] as $item)
		{
			$uniqueId = $item['ID'].'_'.md5($this->randString().$component->getAction());
			$areaIds[$item['ID']] = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $item['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $item['DELETE_LINK'], $elementDelete, $elementDeleteParams);

			$itemParameters[$item['ID']] = [
				'SKU_PROPS' => $arResult['SKU_PROPS'][$item['IBLOCK_ID']],
				'MESS_NOT_AVAILABLE' => ($arResult['MODULES']['catalog'] && $item['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE
					? $arParams['~MESS_NOT_AVAILABLE_SERVICE']
					: $arParams['~MESS_NOT_AVAILABLE']
				),
			];
		}
		?>
		<!-- items-container -->
		<div class="row" data-js-collection-replace="products"
			data-js-collection-replace-method="add" data-entity="items-row">
		<?
		foreach ($arResult['ITEM_ROWS'] as $rowData)
		{
			$rowItems = array_splice($arResult['ITEMS'], 0, $rowData['COUNT']);
			?>
				<?
				switch ($rowData['VARIANT'])
				{
					case 0:
						?>
						<div class="col-xs-12 product-item-small-card">
							<div class="row">
								<div class="col-xs-12 product-item-big-card">
									<div class="row">
										<div class="col-md-12">
											<?
											$item = reset($rowItems);
											$APPLICATION->IncludeComponent(
												'bitrix:catalog.item',
												'',
												array(
													'RESULT' => array(
														'ITEM' => $item,
														'AREA_ID' => $areaIds[$item['ID']],
														'TYPE' => $rowData['TYPE'],
														'BIG_LABEL' => 'N',
														'BIG_DISCOUNT_PERCENT' => 'N',
														'BIG_BUTTONS' => 'N',
														'SCALABLE' => 'N'
													),
													'PARAMS' => $generalParams + $itemParameters[$item['ID']],
												),
												$component,
												array('HIDE_ICONS' => 'Y')
											);
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?
						break;

					case 1:
						?>
						<div class="col-xs-12 product-item-small-card">
							<div class="row">
								<?
								foreach ($rowItems as $item)
								{
									?>
									<div class="col-xs-6 product-item-big-card">
										<div class="row">
											<div class="col-md-12">
												<?
												$APPLICATION->IncludeComponent(
													'bitrix:catalog.item',
													'',
													array(
														'RESULT' => array(
															'ITEM' => $item,
															'AREA_ID' => $areaIds[$item['ID']],
															'TYPE' => $rowData['TYPE'],
															'BIG_LABEL' => 'N',
															'BIG_DISCOUNT_PERCENT' => 'N',
															'BIG_BUTTONS' => 'N',
															'SCALABLE' => 'N'
														),
														'PARAMS' => $generalParams + $itemParameters[$item['ID']],
													),
													$component,
													array('HIDE_ICONS' => 'Y')
												);
												?>
											</div>
										</div>
									</div>
									<?
								}
								?>
							</div>
						</div>
						<?
						break;

					case 2:
						?>
						<div class="col-xs-12 product-item-small-card">
							<div class="row">
								<?
								foreach ($rowItems as $item)
								{
									?>
									<div class="col-sm-4 product-item-big-card">
										<div class="row">
											<div class="col-md-12">
												<?
												$APPLICATION->IncludeComponent(
													'bitrix:catalog.item',
													'',
													array(
														'RESULT' => array(
															'ITEM' => $item,
															'AREA_ID' => $areaIds[$item['ID']],
															'TYPE' => $rowData['TYPE'],
															'BIG_LABEL' => 'N',
															'BIG_DISCOUNT_PERCENT' => 'N',
															'BIG_BUTTONS' => 'Y',
															'SCALABLE' => 'N'
														),
														'PARAMS' => $generalParams + $itemParameters[$item['ID']],
													),
													$component,
													array('HIDE_ICONS' => 'Y')
												);
												?>
											</div>
										</div>
									</div>
									<?
								}
								?>
							</div>
						</div>
						<?
						break;

					case 3:
						?>
							<?
							foreach ($rowItems as $item)
							{
								?>
								<?
								$APPLICATION->IncludeComponent(
									'bitrix:catalog.item',
									'grid_goods_card',
									array(
										'RESULT' => array(
											'ITEM' => $item,
											'AREA_ID' => $areaIds[$item['ID']],
											'TYPE' => $rowData['TYPE'],
											'BIG_LABEL' => 'N',
											'BIG_DISCOUNT_PERCENT' => 'N',
											'BIG_BUTTONS' => 'N',
											'SCALABLE' => 'N'
										),
										'PARAMS' => $generalParams + $itemParameters[$item['ID']],
									),
									$component,
									array('HIDE_ICONS' => 'Y')
								);
								?>
								<?
							}
							?>
						<?
						break;

					case 4:
						$rowItemsCount = count($rowItems);
						?>
						<div class="col-sm-6 product-item-big-card">
							<div class="row">
								<div class="col-md-12">
									<?
									$item = array_shift($rowItems);
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.item',
										'',
										array(
											'RESULT' => array(
												'ITEM' => $item,
												'AREA_ID' => $areaIds[$item['ID']],
												'TYPE' => $rowData['TYPE'],
												'BIG_LABEL' => 'N',
												'BIG_DISCOUNT_PERCENT' => 'N',
												'BIG_BUTTONS' => 'Y',
												'SCALABLE' => 'Y'
											),
											'PARAMS' => $generalParams + $itemParameters[$item['ID']],
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
									unset($item);
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-6 product-item-small-card">
							<div class="row">
								<?
								for ($i = 0; $i < $rowItemsCount - 1; $i++)
								{
									?>
									<div class="col-xs-6">
										<?
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.item',
											'',
											array(
												'RESULT' => array(
													'ITEM' => $rowItems[$i],
													'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
													'TYPE' => $rowData['TYPE'],
													'BIG_LABEL' => 'N',
													'BIG_DISCOUNT_PERCENT' => 'N',
													'BIG_BUTTONS' => 'N',
													'SCALABLE' => 'N'
												),
												'PARAMS' => $generalParams + $itemParameters[$rowItems[$i]['ID']],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
									<?
								}
								?>
							</div>
						</div>
						<?
						break;

					case 5:
						$rowItemsCount = count($rowItems);
						?>
						<div class="col-sm-6 product-item-small-card">
							<div class="row">
								<?
								for ($i = 0; $i < $rowItemsCount - 1; $i++)
								{
									?>
									<div class="col-xs-6">
										<?
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.item',
											'',
											array(
												'RESULT' => array(
													'ITEM' => $rowItems[$i],
													'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
													'TYPE' => $rowData['TYPE'],
													'BIG_LABEL' => 'N',
													'BIG_DISCOUNT_PERCENT' => 'N',
													'BIG_BUTTONS' => 'N',
													'SCALABLE' => 'N'
												),
												'PARAMS' => $generalParams + $itemParameters[$rowItems[$i]['ID']],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
									<?
								}
								?>
							</div>
						</div>
						<div class="col-sm-6 product-item-big-card">
							<div class="row">
								<div class="col-md-12">
									<?
									$item = end($rowItems);
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.item',
										'',
										array(
											'RESULT' => array(
												'ITEM' => $item,
												'AREA_ID' => $areaIds[$item['ID']],
												'TYPE' => $rowData['TYPE'],
												'BIG_LABEL' => 'N',
												'BIG_DISCOUNT_PERCENT' => 'N',
												'BIG_BUTTONS' => 'Y',
												'SCALABLE' => 'Y'
											),
											'PARAMS' => $generalParams + $itemParameters[$item['ID']],
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
									unset($item);
									?>
								</div>
							</div>
						</div>
						<?
						break;

					case 6:
						?>
						<div class="col-xs-12 product-item-small-card">
							<div class="row">
								<?
								foreach ($rowItems as $item)
								{
									?>
									<div class="col-xs-6 col-sm-4 col-md-2">
										<?
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.item',
											'',
											array(
												'RESULT' => array(
													'ITEM' => $item,
													'AREA_ID' => $areaIds[$item['ID']],
													'TYPE' => $rowData['TYPE'],
													'BIG_LABEL' => 'N',
													'BIG_DISCOUNT_PERCENT' => 'N',
													'BIG_BUTTONS' => 'N',
													'SCALABLE' => 'N'
												),
												'PARAMS' => $generalParams + $itemParameters[$item['ID']],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
									<?
								}
								?>
							</div>
						</div>
						<?
						break;

					case 7:
						$rowItemsCount = count($rowItems);
						?>
						<div class="col-sm-6 product-item-big-card">
							<div class="row">
								<div class="col-md-12">
									<?
									$item = array_shift($rowItems);
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.item',
										'',
										array(
											'RESULT' => array(
												'ITEM' => $item,
												'AREA_ID' => $areaIds[$item['ID']],
												'TYPE' => $rowData['TYPE'],
												'BIG_LABEL' => 'N',
												'BIG_DISCOUNT_PERCENT' => 'N',
												'BIG_BUTTONS' => 'Y',
												'SCALABLE' => 'Y'
											),
											'PARAMS' => $generalParams + $itemParameters[$item['ID']],
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
									unset($item);
									?>
								</div>
							</div>
						</div>
						<div class="col-sm-6 product-item-small-card">
							<div class="row">
								<?
								for ($i = 0; $i < $rowItemsCount - 1; $i++)
								{
									?>
									<div class="col-xs-6 col-md-4">
										<?
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.item',
											'',
											array(
												'RESULT' => array(
													'ITEM' => $rowItems[$i],
													'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
													'TYPE' => $rowData['TYPE'],
													'BIG_LABEL' => 'N',
													'BIG_DISCOUNT_PERCENT' => 'N',
													'BIG_BUTTONS' => 'N',
													'SCALABLE' => 'N'
												),
												'PARAMS' => $generalParams + $itemParameters[$rowItems[$i]['ID']],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
									<?
								}
								?>
							</div>
						</div>
						<?
						break;

					case 8:
						$rowItemsCount = count($rowItems);
						?>
						<div class="col-sm-6 product-item-small-card">
							<div class="row">
								<?
								for ($i = 0; $i < $rowItemsCount - 1; $i++)
								{
									?>
									<div class="col-xs-6 col-md-4">
										<?
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.item',
											'',
											array(
												'RESULT' => array(
													'ITEM' => $rowItems[$i],
													'AREA_ID' => $areaIds[$rowItems[$i]['ID']],
													'TYPE' => $rowData['TYPE'],
													'BIG_LABEL' => 'N',
													'BIG_DISCOUNT_PERCENT' => 'N',
													'BIG_BUTTONS' => 'N',
													'SCALABLE' => 'N'
												),
												'PARAMS' => $generalParams + $itemParameters[$rowItems[$i]['ID']],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
									<?
								}
								?>
							</div>
						</div>
						<div class="col-sm-6 product-item-big-card">
							<div class="row">
								<div class="col-md-12">
									<?
									$item = end($rowItems);
									$APPLICATION->IncludeComponent(
										'bitrix:catalog.item',
										'',
										array(
											'RESULT' => array(
												'ITEM' => $item,
												'AREA_ID' => $areaIds[$item['ID']],
												'TYPE' => $rowData['TYPE'],
												'BIG_LABEL' => 'N',
												'BIG_DISCOUNT_PERCENT' => 'N',
												'BIG_BUTTONS' => 'Y',
												'SCALABLE' => 'Y'
											),
											'PARAMS' => $generalParams + $itemParameters[$item['ID']],
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
									unset($item);
									?>
								</div>
							</div>
						</div>
						<?
						break;

					case 9:
						?>
						<div class="col-xs-12">
							<div class="row">
								<?
								foreach ($rowItems as $item)
								{
									?>
									<div class="col-xs-12 product-item-line-card">
										<?
										$APPLICATION->IncludeComponent(
											'bitrix:catalog.item',
											'',
											array(
												'RESULT' => array(
													'ITEM' => $item,
													'AREA_ID' => $areaIds[$item['ID']],
													'TYPE' => $rowData['TYPE'],
													'BIG_LABEL' => 'N',
													'BIG_DISCOUNT_PERCENT' => 'N',
													'BIG_BUTTONS' => 'N'
												),
												'PARAMS' => $generalParams + $itemParameters[$item['ID']],
											),
											$component,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
									<?
								}
								?>

							</div>
						</div>
						<?
						break;
				}
				?>
			<?
		}
		unset($rowItems);

		unset($itemParameters);
		unset($areaIds);

		unset($generalParams);
		?>
		</div>
		<!-- items-container -->
		<?
	}
	else
	{
		// load css for bigData/deferred load
		$APPLICATION->IncludeComponent(
			'bitrix:catalog.item',
			'',
			array(),
			$component,
			array('HIDE_ICONS' => 'Y')
		);
	}
	?>




		


		
		<!-- <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">

			<div class="product-collection d-flex flex-column mb-30" data-js-product
					data-js-product-json-preload
					data-product-handle="meizu-hd50-on-ear-headphones"
					data-product-variant-id="8077175259188"
			>
				<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
						data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_2_1_1_{width}x.progressive.jpg?v=1542545796"
						data-js-product-image-hover-id="4166043762740">
					<a href="product.html?variant=8077175259188"
						class="d-block cursor-default" data-js-product-image>
						<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
								class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
								data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_1_1_1_{width}x.progressive.jpg?v=1542545794"
								data-aspect-ratio="0.78125"


								data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_1_1_1_600x.progressive.jpg?v=1542545794 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_1_1_1_600x@2x.progressive.jpg?v=1542545794 2x"


								data-image-id="4166043697204"
								alt="Cotton Jersey Graphic Tee">
						</div>
					</a>
					<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
						<a href="product.html?variant=8077175259188"
							class="absolute-stretch cursor-default"></a>
						<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
							<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-hot>Hot
							</div>
							<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-new>New
							</div>
							<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-sale></div>
							<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-out-stock>Out Stock
							</div>
						</div>
						<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
							<a href="product.html?variant=8077175259188"
								class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
								data-js-popup-button="quick-view"
								data-js-tooltip
								data-tippy-content="Quick View"
								data-tippy-placement="left"
								data-tippy-distance="5">
								<i>
									<svg aria-hidden="true" focusable="false"
											role="presentation" class="icon icon-theme-154"
											viewBox="0 0 24 24">
										<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
									</svg>
								</i>
							</a>
						</div>
					</div>
					<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
						<a href="product.html?variant=8077175259188"
							class="absolute-stretch cursor-default"></a>
						<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
							<div class="d-none-important" data-js-product-countdown>
								<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
							</div>
						</div>
						<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
							<div class="product-images-navigation d-flex">
								<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
										data-js-product-images-navigation="prev"><i
										class="mr-2"><svg aria-hidden="true"
															focusable="false"
															role="presentation"
															class="icon icon-theme-006"
															viewBox="0 0 24 24"><path
										d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
								<span class="d-flex flex-center rounded-circle cursor-pointer"
										data-js-product-images-navigation="next"><i
										class="ml-3"><svg aria-hidden="true"
															focusable="false"
															role="presentation"
															class="icon icon-theme-007"
															viewBox="0 0 24 24"><path
										d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="product-collection__content d-flex flex-column align-items-start mt-15">
					<div class="product-collection__title mb-3">
						<h4 class="h6 m-0">
							<a href="product.html?variant=8077175259188">Cotton
								Jersey Graphic Tee</a>
						</h4>
					</div>
					<div class="product-collection__details d-none mb-8">
						<div class="product-collection__sku mb-5">
							<p class="m-0" data-js-product-sku>SKU: <span>00110q</span>
							</p>
						</div>
						<div class="product-collection__barcode mb-5">
							<p class="m-0" data-js-product-barcode>BARCODE: <span>1234567890</span>
							</p>
						</div>
						<div class="product-collection__availability mb-5"><p
								class="m-0" data-js-product-availability
								data-availability="false">AVAILABILITY: <span>In stock (99999 items)</span>
						</p>
						</div>
						<div class="product-collection__type mb-5">
							<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Shirt</span>
							</p>
						</div>
						<div class="product-collection__vendor mb-5">
							<p class="m-0" data-js-product-vendor>VENDOR: <span>Dolce & Gabbana</span>
							</p>
						</div>
					</div>
					<div class="product-collection__description d-none mb-15">
						<p class="m-0">Sed ut perspiciatis unde omnis iste natus error
							sit voluptatem accusantium doloremque laudantium, totam rem
							aperiam, eaque ipsa quae ab illo inventore veritatis et
							quasi architecto beatae vitae dicta sunt explicabo. Nemo
							enim ipsam voluptatem quia voluptas sit aspernatur
							aut...</p>
					</div>
					<div class="product-collection__price mb-10">
						<span class="price" data-js-product-price
								data-js-show-sale-separator><span><span class=money>$330.00</span></span></span>
					</div>
					<form method="post" action="/cart/add" accept-charset="UTF-8"
							class="d-flex flex-column w-100 m-0"
							enctype="multipart/form-data" data-js-product-form=""><input
							type="hidden" name="form_type" value="product"/><input
							type="hidden" name="utf8" value="✓"/>
						<div class="product-collection__options">

							<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
								<div><label class="d-none">Color:</label>
									<div class="product-options__section d-flex flex-wrap"
											data-style="image" data-property="color">
										<div class="product-options__value product-options__value--square text-hide cursor-pointer active lazyload"
												data-js-option-value
												data-value="red"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_1_1_1_[width]x.progressive.jpg?v=1542545794)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_1_1_1_92x.progressive.jpg?v=1542545794)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="Red"
												data-tippy-placement="top"
												data-tippy-distance="6">Red
										</div>


										<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
												data-js-option-value
												data-value="black"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900712_1_1_1_[width]x.progressive.jpg?v=1542545801)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900712_1_1_1_92x.progressive.jpg?v=1542545801)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="Black"
												data-tippy-placement="top"
												data-tippy-distance="6">Black
										</div>
									</div>
								</div>
								<div><label class="d-none">Size:</label>
									<div class="product-options__section d-flex flex-wrap"
											data-style="large-text" data-property="size">
										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer active lazyload"
												data-js-option-value
												data-value="xs"

												data-bg="none"
												data-scale="2"
										>XS
										</div>

										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="s"

												data-bg="none"
												data-scale="2"
										>S
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="m"

												data-bg="none"
												data-scale="2"
										>M
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="l"

												data-bg="none"
												data-scale="2"
										>L
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="xl"

												data-bg="none"
												data-scale="2"
										>XL
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="product-collection__variants mb-10 d-none">
							<select name="id" class="m-0" data-js-product-variants>
								<option selected="selected" value="8077175259188">Red /
									XS
								</option>
								<option value="9008912105524">Red / S</option>
								<option value="9008912138292">Red / M</option>
								<option value="9008912171060">Red / L</option>
								<option value="9008912203828">Red / XL</option>
								<option value="9008912236596">Black / XS</option>
								<option value="9008912269364">Black / S</option>
								<option value="9008912302132">Black / M</option>
								<option value="9008912334900">Black / L</option>
								<option value="9008912367668">Black / XL</option>
							</select>
						</div>
						<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
							<div class="product-collection__button-add-to-cart mb-10">
								<button type="submit"
										class="btn btn--status btn--animated js-product-button-add-to-cart"
										name="add" data-js-product-button-add-to-cart>
									<span class="d-flex flex-center"><i
											class="btn__icon mr-5 mb-4"><svg
											aria-hidden="true" focusable="false"
											role="presentation"
											class="icon icon-theme-109"
											viewBox="0 0 24 24"><path
											d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
											class="btn__text">ADD TO CART</span></span>
									<span class="d-flex flex-center"
											data-button-content="added"><i
											class="mr-5 mb-4"><svg aria-hidden="true"
																	focusable="false"
																	role="presentation"
																	class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
											d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
									<span class="d-flex flex-center"
											data-button-content="sold-out">SOLD OUT</span>
								</button>
							</div>
							<div class="product-collection__buttons-section d-flex px-lg-10">
								<div class="product-collection__button-add-to-wishlist mb-10">
									<a href="/account"
										class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

										data-js-tooltip
										data-tippy-content="Wishlist"
										data-tippy-placement="top"
										data-tippy-distance="-3">
										<i class="mb-1 ml-1">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-180"
													viewBox="0 0 24 24">
												<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
											</svg>
										</i>
										<i class="mb-1 ml-1"
											data-button-content="added">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-181"
													viewBox="0 0 24 24">
												<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
											</svg>
										</i>
									</a>
								</div>
								<div class="product-collection__button-add-to-compare mb-10">
									<a href="/account"
										class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

										data-js-tooltip
										data-tippy-content="Compare"
										data-tippy-placement="top"
										data-tippy-distance="-3">
										<i class="mb-1 ml-1">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-039"
													viewBox="0 0 24 24">
												<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
											</svg>
										</i>
										<i class="mb-1 ml-1"
											data-button-content="added">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-235"
													viewBox="0 0 24 24">
												<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
											</svg>
										</i>
									</a>
								</div>
								<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
									<a href="product.html?variant=8077175259188"
										class="btn btn--text pt-2 px-lg-6 js-popup-button"
										data-js-popup-button="quick-view"
										data-js-tooltip
										data-tippy-content="Quick View"
										data-tippy-placement="top"
										data-tippy-distance="-2">
										<i>
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-154"
													viewBox="0 0 24 24">
												<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
											</svg>
										</i>
									</a>
								</div>
							</div>
						</div>
					</form>
					<div class="product-collection__reviews">
						<div class="spr spr--empty-hide d-flex flex-column">
							<span class="shopify-product-reviews-badge"
									data-id="856866127924"></span>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">

			<div class="product-collection d-flex flex-column mb-30" data-js-product
					data-js-product-json-preload data-product-handle="copy-of-floppy-hat"
					data-product-variant-id="8079047229492"
			>
				<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
						data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547927_2_2_1_{width}x.progressive.jpg?v=1542618166"
						data-js-product-image-hover-id="4166072959028">
					<a href="product.html?variant=8079047229492"
						class="d-block cursor-default" data-js-product-image>
						<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
								class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
								data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547927_2_4_1_{width}x.progressive.jpg?v=1542618166"
								data-aspect-ratio="0.78125"


								data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547927_2_4_1_600x.progressive.jpg?v=1542618166 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547927_2_4_1_600x@2x.progressive.jpg?v=1542618166 2x"


								data-image-id="4166073057332"
								alt="Oversized sweater with slogan">
						</div>
					</a>
					<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
						<a href="product.html?variant=8079047229492"
							class="absolute-stretch cursor-default"></a>
						<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
							<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-hot>Hot
							</div>
							<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-new>New
							</div>
							<div class="label label--sale mb-3 mr-3 text-nowrap"
									data-js-product-label-sale>-25%
							</div>
							<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-out-stock>Out Stock
							</div>
						</div>
						<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
							<a href="product.html?variant=8079047229492"
								class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
								data-js-popup-button="quick-view"
								data-js-tooltip
								data-tippy-content="Quick View"
								data-tippy-placement="left"
								data-tippy-distance="5">
								<i>
									<svg aria-hidden="true" focusable="false"
											role="presentation" class="icon icon-theme-154"
											viewBox="0 0 24 24">
										<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
									</svg>
								</i>
							</a>
						</div>
					</div>
					<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
						<a href="product.html?variant=8079047229492"
							class="absolute-stretch cursor-default"></a>
						<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
							<div class="d-none-important" data-js-product-countdown>
								<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
							</div>
						</div>
						<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
							<div class="product-images-navigation d-flex">
								<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
										data-js-product-images-navigation="prev"><i
										class="mr-2"><svg aria-hidden="true"
															focusable="false"
															role="presentation"
															class="icon icon-theme-006"
															viewBox="0 0 24 24"><path
										d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
								<span class="d-flex flex-center rounded-circle cursor-pointer"
										data-js-product-images-navigation="next"><i
										class="ml-3"><svg aria-hidden="true"
															focusable="false"
															role="presentation"
															class="icon icon-theme-007"
															viewBox="0 0 24 24"><path
										d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="product-collection__content d-flex flex-column align-items-start mt-15">
					<div class="product-collection__title mb-3">
						<h4 class="h6 m-0">
							<a href="product.html?variant=8079047229492">Oversized
								sweater with slogan</a>
						</h4>
					</div>
					<div class="product-collection__details d-none mb-8">
						<div class="product-collection__sku mb-5">
							<p class="m-0" data-js-product-sku>SKU:
								<span>00152cd-1</span></p>
						</div>
						<div class="product-collection__barcode mb-5">
							<p class="m-0" data-js-product-barcode>BARCODE: <span>1234567890</span>
							</p>
						</div>
						<div class="product-collection__availability mb-5"><p
								class="m-0" data-js-product-availability
								data-availability="true">AVAILABILITY: <span>In stock (1 item)</span>
						</p>
						</div>
						<div class="product-collection__type mb-5">
							<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Sweatshirts</span>
							</p>
						</div>
						<div class="product-collection__vendor mb-5">
							<p class="m-0" data-js-product-vendor>VENDOR:
								<span>Levi's</span></p>
						</div>
					</div>
					<div class="product-collection__description d-none mb-15">
						<p class="m-0">Sed ut perspiciatis unde omnis iste natus error
							sit voluptatem accusantium doloremque laudantium, totam rem
							aperiam, eaque ipsa quae ab illo inventore veritatis et
							quasi architecto beatae vitae dicta sunt explicabo. Nemo
							enim ipsam voluptatem quia voluptas sit aspernatur
							aut...</p>
					</div>
					<div class="product-collection__price mb-10">
						<span class="price price--sale" data-js-product-price
								data-js-show-sale-separator><span><span class=money>$280.00</span></span> from<span><span
								class=money>$210.00</span></span></span>
					</div>
					<form method="post" action="/cart/add" accept-charset="UTF-8"
							class="d-flex flex-column w-100 m-0"
							enctype="multipart/form-data" data-js-product-form=""><input
							type="hidden" name="form_type" value="product"/><input
							type="hidden" name="utf8" value="✓"/>
						<div class="product-collection__options">

							<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
								<div><label class="d-none">Color:</label>
									<div class="product-options__section d-flex flex-wrap"
											data-style="image" data-property="color">
										<div class="product-options__value product-options__value--square text-hide cursor-pointer active lazyload"
												data-js-option-value
												data-value="pink"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547927_2_4_1_[width]x.progressive.jpg?v=1542618166)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547927_2_4_1_92x.progressive.jpg?v=1542618166)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="Pink"
												data-tippy-placement="top"
												data-tippy-distance="6">Pink
										</div>


										<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
												data-js-option-value
												data-value="white"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547318_2_4_1_[width]x.progressive.jpg?v=1542618166)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1937547318_2_4_1_92x.progressive.jpg?v=1542618166)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="White"
												data-tippy-placement="top"
												data-tippy-distance="6">White
										</div>
									</div>
								</div>
								<div><label class="d-none">Size:</label>
									<div class="product-options__section d-flex flex-wrap"
											data-style="large-text" data-property="size">
										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer active lazyload"
												data-js-option-value
												data-value="34"

												data-bg="none"
												data-scale="2"
										>34
										</div>

										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="36"

												data-bg="none"
												data-scale="2"
										>36
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="product-collection__variants mb-10 d-none">
							<select name="id" class="m-0" data-js-product-variants>
								<option selected="selected" value="8079047229492">Pink /
									34
								</option>
								<option value="9009091051572">Pink / 36</option>
								<option value="9009091018804">White / 34</option>
								<option value="9009091084340">White / 36</option>
							</select>
						</div>
						<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
							<div class="product-collection__button-add-to-cart mb-10">
								<button type="submit"
										class="btn btn--status btn--animated js-product-button-add-to-cart"
										name="add" data-js-product-button-add-to-cart>
									<span class="d-flex flex-center"><i
											class="btn__icon mr-5 mb-4"><svg
											aria-hidden="true" focusable="false"
											role="presentation"
											class="icon icon-theme-109"
											viewBox="0 0 24 24"><path
											d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
											class="btn__text">ADD TO CART</span></span>
									<span class="d-flex flex-center"
											data-button-content="added"><i
											class="mr-5 mb-4"><svg aria-hidden="true"
																	focusable="false"
																	role="presentation"
																	class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
											d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
									<span class="d-flex flex-center"
											data-button-content="sold-out">SOLD OUT</span>
								</button>
							</div>
							<div class="product-collection__buttons-section d-flex px-lg-10">
								<div class="product-collection__button-add-to-wishlist mb-10">
									<a href="/account"
										class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

										data-js-tooltip
										data-tippy-content="Wishlist"
										data-tippy-placement="top"
										data-tippy-distance="-3">
										<i class="mb-1 ml-1">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-180"
													viewBox="0 0 24 24">
												<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
											</svg>
										</i>
										<i class="mb-1 ml-1"
											data-button-content="added">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-181"
													viewBox="0 0 24 24">
												<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
											</svg>
										</i>
									</a>
								</div>
								<div class="product-collection__button-add-to-compare mb-10">
									<a href="/account"
										class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

										data-js-tooltip
										data-tippy-content="Compare"
										data-tippy-placement="top"
										data-tippy-distance="-3">
										<i class="mb-1 ml-1">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-039"
													viewBox="0 0 24 24">
												<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
											</svg>
										</i>
										<i class="mb-1 ml-1"
											data-button-content="added">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-235"
													viewBox="0 0 24 24">
												<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
											</svg>
										</i>
									</a>
								</div>
								<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
									<a href="product.html?variant=8079047229492"
										class="btn btn--text pt-2 px-lg-6 js-popup-button"
										data-js-popup-button="quick-view"
										data-js-tooltip
										data-tippy-content="Quick View"
										data-tippy-placement="top"
										data-tippy-distance="-2">
										<i>
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-154"
													viewBox="0 0 24 24">
												<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
											</svg>
										</i>
									</a>
								</div>
							</div>
						</div>
					</form>
					<div class="product-collection__reviews">
						<div class="spr spr--empty-hide d-flex flex-column">
							<span class="shopify-product-reviews-badge"
									data-id="857341362228"></span>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xl-4">

			<div class="product-collection d-flex flex-column mb-30" data-js-product
					data-js-product-json-preload
					data-product-handle="copy-of-loose-fit-round-neck-sweater"
					data-product-variant-id="8078998732852"
			>
				<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
						data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456401_2_1_1_1_{width}x.progressive.jpg?v=1542724565"
						data-js-product-image-hover-id="4170082025524">
					<a href="product.html?variant=8078998732852"
						class="d-block cursor-default" data-js-product-image>
						<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
								class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
								data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456401_2_3_1_1_{width}x.progressive.jpg?v=1542724565"
								data-aspect-ratio="0.78125"


								data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456401_2_3_1_1_600x.progressive.jpg?v=1542724565 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456401_2_3_1_1_600x@2x.progressive.jpg?v=1542724565 2x"


								data-image-id="4170082484276"
								alt="Loose-fit round neck sweater">
						</div>
					</a>
					<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
						<a href="product.html?variant=8078998732852"
							class="absolute-stretch cursor-default"></a>
						<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
							<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-hot>Hot
							</div>
							<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-new>New
							</div>
							<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-sale></div>
							<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
									data-js-product-label-out-stock>Out Stock
							</div>
						</div>
						<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
							<a href="product.html?variant=8078998732852"
								class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
								data-js-popup-button="quick-view"
								data-js-tooltip
								data-tippy-content="Quick View"
								data-tippy-placement="left"
								data-tippy-distance="5">
								<i>
									<svg aria-hidden="true" focusable="false"
											role="presentation" class="icon icon-theme-154"
											viewBox="0 0 24 24">
										<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
									</svg>
								</i>
							</a>
						</div>
					</div>
					<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
						<a href="product.html?variant=8078998732852"
							class="absolute-stretch cursor-default"></a>
						<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
							<div class="d-none-important" data-js-product-countdown>
								<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
							</div>
						</div>
						<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
							<div class="product-images-navigation d-flex">
								<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
										data-js-product-images-navigation="prev"><i
										class="mr-2"><svg aria-hidden="true"
															focusable="false"
															role="presentation"
															class="icon icon-theme-006"
															viewBox="0 0 24 24"><path
										d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
								<span class="d-flex flex-center rounded-circle cursor-pointer"
										data-js-product-images-navigation="next"><i
										class="ml-3"><svg aria-hidden="true"
															focusable="false"
															role="presentation"
															class="icon icon-theme-007"
															viewBox="0 0 24 24"><path
										d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
							</div>
						</div>
					</div>
				</div>
				<div class="product-collection__content d-flex flex-column align-items-start mt-15">
					<div class="product-collection__title mb-3">
						<h4 class="h6 m-0">
							<a href="product.html?variant=8078998732852">Loose-fit
								round neck sweater</a>
						</h4>
					</div>
					<div class="product-collection__details d-none mb-8">
						<div class="product-collection__sku mb-5">
							<p class="m-0" data-js-product-sku>SKU:
								<span>00101сd-1</span></p>
						</div>
						<div class="product-collection__barcode mb-5">
							<p class="m-0" data-js-product-barcode>BARCODE: <span>1234567890</span>
							</p>
						</div>
						<div class="product-collection__availability mb-5"><p
								class="m-0" data-js-product-availability
								data-availability="false">AVAILABILITY: <span>In stock (9 items)</span>
						</p>
						</div>
						<div class="product-collection__type mb-5">
							<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Pants</span>
							</p>
						</div>
						<div class="product-collection__vendor mb-5">
							<p class="m-0" data-js-product-vendor>VENDOR:
								<span>Zara</span></p>
						</div>
					</div>
					<div class="product-collection__description d-none mb-15">
						<p class="m-0">Sed ut perspiciatis unde omnis iste natus error
							sit voluptatem accusantium doloremque laudantium, totam rem
							aperiam, eaque ipsa quae ab illo inventore veritatis et
							quasi architecto beatae vitae dicta sunt explicabo. Nemo
							enim ipsam voluptatem quia voluptas sit aspernatur
							aut...</p>
					</div>
					<div class="product-collection__price mb-10">
						<span class="price" data-js-product-price
								data-js-show-sale-separator><span><span class=money>$150.00</span></span></span>
					</div>
					<form method="post" action="/cart/add" accept-charset="UTF-8"
							class="d-flex flex-column w-100 m-0"
							enctype="multipart/form-data" data-js-product-form=""><input
							type="hidden" name="form_type" value="product"/><input
							type="hidden" name="utf8" value="✓"/>
						<div class="product-collection__options">

							<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
								<div><label class="d-none">Color:</label>
									<div class="product-options__section d-flex flex-wrap"
											data-style="image" data-property="color">
										<div class="product-options__value product-options__value--square text-hide cursor-pointer active lazyload"
												data-js-option-value
												data-value="black"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456401_2_3_1_1_[width]x.progressive.jpg?v=1542724565)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456401_2_3_1_1_92x.progressive.jpg?v=1542724565)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="Black"
												data-tippy-placement="top"
												data-tippy-distance="6">Black
										</div>


										<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
												data-js-option-value
												data-value="yellow"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456310_1_1_1_1_[width]x.progressive.jpg?v=1542724565)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456310_1_1_1_1_92x.progressive.jpg?v=1542724565)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="Yellow"
												data-tippy-placement="top"
												data-tippy-distance="6">Yellow
										</div>


										<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
												data-js-option-value
												data-value="pink"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456645_1_1_1_1_[width]x.progressive.jpg?v=1542724565)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456645_1_1_1_1_92x.progressive.jpg?v=1542724565)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="Pink"
												data-tippy-placement="top"
												data-tippy-distance="6">Pink
										</div>


										<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
												data-js-option-value
												data-value="white"

												data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456712_1_1_1_1_[width]x.progressive.jpg?v=1542724565)"
												data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1931456712_1_1_1_1_92x.progressive.jpg?v=1542724565)"
												data-scale="2"
												data-js-tooltip
												data-tippy-content="White"
												data-tippy-placement="top"
												data-tippy-distance="6">White
										</div>
									</div>
								</div>
								<div><label class="d-none">Size:</label>
									<div class="product-options__section d-flex flex-wrap"
											data-style="large-text" data-property="size">
										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer active lazyload"
												data-js-option-value
												data-value="30"

												data-bg="none"
												data-scale="2"
										>30
										</div>

										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="32"

												data-bg="none"
												data-scale="2"
										>32
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="34"

												data-bg="none"
												data-scale="2"
										>34
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="36"

												data-bg="none"
												data-scale="2"
										>36
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="38"

												data-bg="none"
												data-scale="2"
										>38
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="44"

												data-bg="none"
												data-scale="2"
										>44
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="42"

												data-bg="none"
												data-scale="2"
										>42
										</div>


										<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
												data-js-option-value
												data-value="40"

												data-bg="none"
												data-scale="2"
										>40
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="product-collection__variants mb-10 d-none">
							<select name="id" class="m-0" data-js-product-variants>
								<option selected="selected" value="8078998732852">Black
									/ 30
								</option>
								<option value="9009144037428">Black / 32</option>
								<option value="9009144070196">Black / 34</option>
								<option value="9009144102964">Black / 36</option>
								<option value="9009144135732">Black / 38</option>
								<option value="9009144168500">Yellow / 30</option>
								<option value="9009144201268">Yellow / 32</option>
								<option value="9009144234036">Yellow / 34</option>
								<option value="9009144266804">Yellow / 36</option>
								<option value="9009144299572">Yellow / 38</option>
								<option value="9009144332340">Pink / 30</option>
								<option value="9009144365108">Pink / 32</option>
								<option value="9009144397876">Pink / 34</option>
								<option value="9009144430644">Pink / 36</option>
								<option value="9009144463412">Pink / 38</option>
								<option value="9009144496180">White / 30</option>
								<option value="9009144528948">White / 32</option>
								<option value="9009144561716">White / 34</option>
								<option value="9009144594484">White / 36</option>
								<option value="9009144627252">White / 38</option>
								<option value="13519068102708">White / 44</option>
								<option value="13519069151284">White / 42</option>
								<option value="13519070855220">White / 40</option>
							</select>
						</div>
						<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
							<div class="product-collection__button-add-to-cart mb-10">
								<button type="submit"
										class="btn btn--status btn--animated js-product-button-add-to-cart"
										name="add" data-js-product-button-add-to-cart>
									<span class="d-flex flex-center"><i
											class="btn__icon mr-5 mb-4"><svg
											aria-hidden="true" focusable="false"
											role="presentation"
											class="icon icon-theme-109"
											viewBox="0 0 24 24"><path
											d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
											class="btn__text">ADD TO CART</span></span>
									<span class="d-flex flex-center"
											data-button-content="added"><i
											class="mr-5 mb-4"><svg aria-hidden="true"
																	focusable="false"
																	role="presentation"
																	class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
											d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
									<span class="d-flex flex-center"
											data-button-content="sold-out">SOLD OUT</span>
								</button>
							</div>
							<div class="product-collection__buttons-section d-flex px-lg-10">
								<div class="product-collection__button-add-to-wishlist mb-10">
									<a href="/account"
										class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

										data-js-tooltip
										data-tippy-content="Wishlist"
										data-tippy-placement="top"
										data-tippy-distance="-3">
										<i class="mb-1 ml-1">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-180"
													viewBox="0 0 24 24">
												<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
											</svg>
										</i>
										<i class="mb-1 ml-1"
											data-button-content="added">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-181"
													viewBox="0 0 24 24">
												<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
											</svg>
										</i>
									</a>
								</div>
								<div class="product-collection__button-add-to-compare mb-10">
									<a href="/account"
										class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

										data-js-tooltip
										data-tippy-content="Compare"
										data-tippy-placement="top"
										data-tippy-distance="-3">
										<i class="mb-1 ml-1">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-039"
													viewBox="0 0 24 24">
												<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
											</svg>
										</i>
										<i class="mb-1 ml-1"
											data-button-content="added">
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-235"
													viewBox="0 0 24 24">
												<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
											</svg>
										</i>
									</a>
								</div>
								<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
									<a href="product.html?variant=8078998732852"
										class="btn btn--text pt-2 px-lg-6 js-popup-button"
										data-js-popup-button="quick-view"
										data-js-tooltip
										data-tippy-content="Quick View"
										data-tippy-placement="top"
										data-tippy-distance="-2">
										<i>
											<svg aria-hidden="true" focusable="false"
													role="presentation"
													class="icon icon-theme-154"
													viewBox="0 0 24 24">
												<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
											</svg>
										</i>
									</a>
								</div>
							</div>
						</div>
					</form>
					<div class="product-collection__reviews">
						<div class="spr spr--empty-hide d-flex flex-column">
							<span class="shopify-product-reviews-badge"
									data-id="857357320244"></span>
						</div>
					</div>
				</div>
			</div>

		</div> -->
	</div>
</div>
<div data-js-collection-pagination data-pagination-type="button_load_more"
		data-js-collection-replace="pagination">
	<div class="pagination">
		<div class="d-flex justify-content-center mt-35"><a
				href="collection.html?page=2" class="btn btn--secondary">
			<span>LOAD MORE</span>
		</a></div>
	</div>
	<input type="hidden" name="page" value="1">
</div>

<?
if ($showLazyLoad)
{
	?>
	<div class="row bx-<?=$arParams['TEMPLATE_THEME']?>">
		<div class="btn btn-default btn-lg center-block" style="margin: 15px;"
			data-use="show-more-<?=$navParams['NavNum']?>">
			<?=$arParams['MESS_BTN_LAZY_LOAD']?>
		</div>
	</div>
	<?
}

if ($showBottomPager)
{
	?>
	<div data-pagination-num="<?=$navParams['NavNum']?>">
		<!-- pagination-container -->
		<?=$arResult['NAV_STRING']?>
		<!-- pagination-container -->
	</div>
	<?
}

$signer = new \Bitrix\Main\Security\Sign\Signer;
$signedTemplate = $signer->sign($templateName, 'catalog.section');
$signedParams = $signer->sign(base64_encode(serialize($arResult['ORIGINAL_PARAMETERS'])), 'catalog.section');
?>
<script>
	BX.message({
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BASKET_URL: '<?=$arParams['BASKET_URL']?>',
		ADD_TO_BASKET_OK: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_TITLE_BASKET_PROPS')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_MESSAGE_SEND_PROPS: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCS_CATALOG_MESS_COMPARE_TITLE')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCS_CATALOG_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		BTN_MESSAGE_LAZY_LOAD: '<?=CUtil::JSEscape($arParams['MESS_BTN_LAZY_LOAD'])?>',
		BTN_MESSAGE_LAZY_LOAD_WAITER: '<?=GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_LAZY_LOAD_WAITER')?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});
	var <?=$obName?> = new JCCatalogSectionComponent({
		siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
		componentPath: '<?=CUtil::JSEscape($componentPath)?>',
		navParams: <?=CUtil::PhpToJSObject($navParams)?>,
		deferredLoad: false, // enable it for deferred load
		initiallyShowHeader: '<?=!empty($arResult['ITEM_ROWS'])?>',
		bigData: <?=CUtil::PhpToJSObject($arResult['BIG_DATA'])?>,
		lazyLoad: !!'<?=$showLazyLoad?>',
		loadOnScroll: !!'<?=($arParams['LOAD_ON_SCROLL'] === 'Y')?>',
		template: '<?=CUtil::JSEscape($signedTemplate)?>',
		ajaxId: '<?=CUtil::JSEscape($arParams['AJAX_ID'] ?? '')?>',
		parameters: '<?=CUtil::JSEscape($signedParams)?>',
		container: '<?=$containerName?>'
	});
</script>
<!-- component-end -->
