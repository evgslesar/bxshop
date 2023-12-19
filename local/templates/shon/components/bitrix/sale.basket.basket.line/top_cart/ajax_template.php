<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(__DIR__).'/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && ($arResult['NUM_PRODUCTS'] > 0 || !empty($arResult['CATEGORIES']['DELAY'])))
{
?>
	<div data-role="basket-item-list" class="basket-item__list">

		<div id="<?=$cartId?>products" class="basket-item__container">
			<?foreach ($arResult["CATEGORIES"] as $category => $items):
				if (empty($items))
					continue;
				?>
				<div class="basket-item__status"><?=GetMessage("TSB1_$category")?></div>
				<?foreach ($items as $v):?>
					<div class="basket-item__list-item">
						<button type="button" class="basket-item__remove" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)" title="<?=GetMessage("TSB1_DELETE")?>">X</button>
						<div class="basket-item__list-img">
							<?if ($arParams["SHOW_IMAGE"] == "Y" && $v["PICTURE_SRC"]):?>
								<?if($v["DETAIL_PAGE_URL"]):?>
									<a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>"></a>
								<?else:?>
									<img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>" />
								<?endif?>
							<?endif?>
						</div>
						<div class="basket-item__name">
							<?if ($v["DETAIL_PAGE_URL"]):?>
								<a href="<?=$v["DETAIL_PAGE_URL"]?>"><?=$v["NAME"]?></a>
							<?else:?>
								<?=$v["NAME"]?>
							<?endif?>
						</div>
						<?if (true):/*$category != "SUBSCRIBE") TODO */?>
							<div class="basket-item__price-block">
								<?if ($arParams["SHOW_PRICE"] == "Y"):?>
									<div class="basket-item__price"><strong><?=$v["PRICE_FMT"]?></strong></div>
									<?if ($v["FULL_PRICE"] != $v["PRICE_FMT"]):?>
										<div class="basket-item__price-old"><?=$v["FULL_PRICE"]?></div>
									<?endif?>
								<?endif?>
								<?if ($arParams["SHOW_SUMMARY"] == "Y"):?>
									<div class="basket-item__price-summ">
										<?=$v["QUANTITY"]?> <?=$v["MEASURE_NAME"]?> <?=GetMessage("TSB1_SUM")?>
										<strong><?=$v["SUM"]?></strong>
									</div>
								<?endif?>
							</div>
						<?endif?>
					</div>
				<?endforeach?>
			<?endforeach?>
		</div>

		<?if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]):?>
			<a href="<?=$arParams["PATH_TO_ORDER"]?>" class="basket-item__button"><?=GetMessage("TSB1_2ORDER")?></a>
		<?endif?>

	</div>

	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}