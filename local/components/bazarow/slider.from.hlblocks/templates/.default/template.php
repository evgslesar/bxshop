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

<!-- mt patners start here -->
<div class="mt-patners wow fadeInUp" data-wow-delay="0.4s">
	<h2 class="heading">Наши <span>партнеры</span></h2>
	<!-- patner slider start here -->
	<div class="patner-slider">
		<?foreach($arResult as $arItem):?>
			<!-- slide start here -->
			<div class="slide">
				<div class="box1">
					<div class="box2"><a href="<?=$arItem['LINK']?>"><img src="<?=$arItem['PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>"></a></div>
				</div>
			</div><!-- slide end here -->
		<?endforeach;?>
	</div><!-- patner slider end here -->
</div><!-- mt patners end here -->
