<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<!-- slider start here -->
<div class="slider banner-slider">
	<?foreach($arResult as $arItem):?>
	<!-- holder start here -->
	<div class="s-holder" style="overflow: hidden;">
		<a href="<?=$arItem['LINK']?>"></a>
		<img style="width:765px; height:580px; object-fit: cover;" src="<?=$arItem['PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>">
		<div class="s-box">
			<strong class="s-title">FURNITURE DESIGNS IDEAS</strong>
			<!-- <span class="heading">Upholstered fabric</span>
			<span class="heading add">Counter stool</span>
			<div class="s-txt">
				<p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
			</div> -->
		</div>
	</div><!-- holder end here -->
	<?endforeach;?>
</div>
