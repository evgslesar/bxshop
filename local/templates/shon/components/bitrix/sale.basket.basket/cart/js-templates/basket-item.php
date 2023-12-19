<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $mobileColumns
 * @var array $arParams
 * @var string $templateFolder
 */

$usePriceInAdditionalColumn = in_array('PRICE', $arParams['COLUMNS_LIST']) && $arParams['PRICE_DISPLAY_MODE'] === 'Y';
$useSumColumn = in_array('SUM', $arParams['COLUMNS_LIST']);
$useActionColumn = in_array('DELETE', $arParams['COLUMNS_LIST']);

$restoreColSpan = 2 + $usePriceInAdditionalColumn + $useSumColumn + $useActionColumn;

$positionClassMap = array(
	'left' => 'basket-item-label-left',
	'center' => 'basket-item-label-center',
	'right' => 'basket-item-label-right',
	'bottom' => 'basket-item-label-bottom',
	'middle' => 'basket-item-label-middle',
	'top' => 'basket-item-label-top'
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
?>
<script id="basket-item-template" type="text/html">

	<div class="row border {{#SHOW_RESTORE}} basket-items-list-item-container-expend{{/SHOW_RESTORE}}"
		id="basket-item-{{ID}}" data-entity="basket-item" data-id="{{ID}}">
		{{#SHOW_RESTORE}}
			<div class="basket-items-list-item-notification" colspan="<?=$restoreColSpan?>">
				<div class="basket-items-list-item-notification-inner basket-items-list-item-notification-removed" id="basket-item-height-aligner-{{ID}}">
					{{#SHOW_LOADING}}
						<div class="basket-items-list-item-overlay"></div>
					{{/SHOW_LOADING}}
					<div class="basket-items-list-item-removed-container">
						<div>
							<?=Loc::getMessage('SBB_GOOD_CAP')?> <strong>{{NAME}}</strong> <?=Loc::getMessage('SBB_BASKET_ITEM_DELETED')?>.
						</div>
						<div class="basket-items-list-item-removed-block">
							<a href="javascript:void(0)" data-entity="basket-item-restore-button">
								<?=Loc::getMessage('SBB_BASKET_ITEM_RESTORE')?>
							</a>
							<span class="basket-items-list-item-clear-btn" data-entity="basket-item-close-restore-button"></span>
						</div>
					</div>
				</div>
			</div>
		{{/SHOW_RESTORE}}
		{{^SHOW_RESTORE}}
			<div id="basket-item-height-aligner-{{ID}}">
				<?
				if (in_array('PREVIEW_PICTURE', $arParams['COLUMNS_LIST']))
				{
					?>
					<div class="col-xs-12 col-sm-2">
						{{#DETAIL_PAGE_URL}}
							<a href="{{DETAIL_PAGE_URL}}" class="img-holder">
						{{/DETAIL_PAGE_URL}}

						<img alt="{{NAME}}"
							src="{{{IMAGE_URL}}}{{^IMAGE_URL}}<?=$templateFolder?>/images/no_photo.png{{/IMAGE_URL}}">


						{{#DETAIL_PAGE_URL}}
							</a>
						{{/DETAIL_PAGE_URL}}
					</div>
					<?
				}
				?>
				<div class="col-xs-12 col-sm-4">
					<h2 class="product-name">
						{{#DETAIL_PAGE_URL}}
							<a href="{{DETAIL_PAGE_URL}}">
						{{/DETAIL_PAGE_URL}}

						<strong data-entity="basket-item-name">{{NAME}}</strong>

						{{#DETAIL_PAGE_URL}}
							</a>
						{{/DETAIL_PAGE_URL}}
					</h2>
					{{#NOT_AVAILABLE}}
						<div class="basket-items-list-item-warning-container">
							<div class="alert alert-warning text-center">
								<?=Loc::getMessage('SBB_BASKET_ITEM_NOT_AVAILABLE')?>.
							</div>
						</div>
					{{/NOT_AVAILABLE}}
					{{#WARNINGS.length}}
						<div class="basket-items-list-item-warning-container">
							<div class="alert alert-warning alert-dismissable" data-entity="basket-item-warning-node">
								<span class="close" data-entity="basket-item-warning-close">&times;</span>
									{{#WARNINGS}}
										<div data-entity="basket-item-warning-text">{{{.}}}</div>
									{{/WARNINGS}}
							</div>
						</div>
					{{/WARNINGS.length}}
				</div>
				{{#SHOW_LOADING}}
					<div class="basket-items-list-item-overlay"></div>
				{{/SHOW_LOADING}}
				<?
				if ($usePriceInAdditionalColumn)
				{
					?>
					<div class="col-xs-12 col-sm-2">
						<strong class="price">
							{{#SHOW_DISCOUNT_PRICE}}
								<span class="basket-item-price-old-text">
									{{{FULL_PRICE_FORMATED}}}
								</span>
							{{/SHOW_DISCOUNT_PRICE}}

							<span class="basket-item-price-current-text" id="basket-item-price-{{ID}}">
								{{{PRICE_FORMATED}}}
							</span>

							<div class="basket-item-price-title">
								<?=Loc::getMessage('SBB_BASKET_ITEM_PRICE_FOR')?> {{MEASURE_RATIO}} {{MEASURE_TEXT}}
							</div>
							{{#SHOW_LOADING}}
								<div class="basket-items-list-item-overlay"></div>
							{{/SHOW_LOADING}}
						</strong>
					</div>
					<?
				}
				?>
				<div class="col-xs-12 col-sm-2">

					<div class="basket-item-block-amount basket-item-block-amount-custom qyt-form{{#NOT_AVAILABLE}} disabled{{/NOT_AVAILABLE}}"
						data-entity="basket-item-quantity-block">
						<span class="basket-item-amount-btn-minus" data-entity="basket-item-quantity-minus"></span>
							<input class="basket-item-quantity-input" type="text" value="{{QUANTITY}}"
								{{#NOT_AVAILABLE}} disabled="disabled"{{/NOT_AVAILABLE}}
								data-value="{{QUANTITY}}" data-entity="basket-item-quantity-field"
								id="basket-item-quantity-{{ID}}">
						<span class="basket-item-amount-btn-plus" data-entity="basket-item-quantity-plus"></span>
						<!-- <div class="basket-item-amount-field-description">
							<?
							if ($arParams['PRICE_DISPLAY_MODE'] === 'Y')
							{
								?>
								{{MEASURE_TEXT}}
								<?
							}
							else
							{
								?>
								{{#SHOW_PRICE_FOR}}
									{{MEASURE_RATIO}} {{MEASURE_TEXT}} =
									<span id="basket-item-price-{{ID}}">{{{PRICE_FORMATED}}}</span>
								{{/SHOW_PRICE_FOR}}
								{{^SHOW_PRICE_FOR}}
									{{MEASURE_TEXT}}
								{{/SHOW_PRICE_FOR}}
								<?
							}
							?>
						</div> -->
						{{#SHOW_LOADING}}
							<div class="basket-items-list-item-overlay"></div>
						{{/SHOW_LOADING}}
					</div>
				</div>
				<div class="col-xs-12 col-sm-2">
					<div class="price">
						{{#SHOW_DISCOUNT_PRICE}}
							<div class="basket-item-price-old">
								<span class="basket-item-price-old-text" id="basket-item-sum-price-old-{{ID}}">
									{{{SUM_FULL_PRICE_FORMATED}}}
								</span>
							</div>
						{{/SHOW_DISCOUNT_PRICE}}

						<div class="basket-item-price-current">
							<span class="basket-item-price-current-text" id="basket-item-sum-price-{{ID}}">
								{{{SUM_PRICE_FORMATED}}}
							</span>
						</div>

						{{#SHOW_DISCOUNT_PRICE}}
							<div class="basket-item-price-difference">
								<?=Loc::getMessage('SBB_BASKET_ITEM_ECONOMY')?>
								<span id="basket-item-sum-price-difference-{{ID}}" style="white-space: nowrap;">
									{{{SUM_DISCOUNT_PRICE_FORMATED}}}
								</span>
							</div>
						{{/SHOW_DISCOUNT_PRICE}}
						{{#SHOW_LOADING}}
							<div class="basket-items-list-item-overlay"></div>
						{{/SHOW_LOADING}}
					</div>
					<span data-entity="basket-item-delete"><i class="fa fa-close"></i></span>
					{{#SHOW_LOADING}}
						<div class="basket-items-list-item-overlay"></div>
					{{/SHOW_LOADING}}
				</div>
			</div>
		{{/SHOW_RESTORE}}
	</div>
</script>