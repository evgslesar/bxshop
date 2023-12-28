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
<div id="theme-section-1551852751059" class="theme-section">
	<div data-section-id="1551852751059" data-section-type="home-builder">

		<div>
			<div class="row mt-0 mb-10 mb-sm-45 mb-md-45 mb-lg-60 mb-xl-60 justify-content-start align-items-start">
				<div class="col-12 col-md-12 mt-0 mb-0">
					<div class="slider position-relative">
						<div class="slider__slick" data-js-slider-slick data-arrows="false" data-bullets="true" data-speed="7">
						<?foreach($arResult["ITEMS"] as $arItem):?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="slider__slide">


								<div class="promobox promobox--type-07 promobox--is-slider position-relative d-flex flex-column align-items-center text-center overflow-hidden">
									<div class="image-animation-trigger w-100">
										<div class="w-100">

											<div class="image-animation image-animation--from-default image-animation--to-default">
												<div class="rimage" style=" min-height: 550px;">
													<div class="d-sm-none" style="padding-top: 550px;"></div>
													<div class="d-none d-sm-block d-md-none" style="padding-top: 550px;"></div>
													<div class="d-none d-md-block d-lg-none" style="padding-top: 550px;"></div>
													<div class="d-none d-lg-block d-xl-none" style="padding-top: 550px;"></div>
													<div class="d-none d-xl-block" style="padding-top: 550px;"></div>
													<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="rimage__img rimage__img--cover rimage__img--fade-in lazyload" data-master="<?echo $arItem["DETAIL_PICTURE"]["SRC"]?>" data-aspect-ratio="3.4909090909090907" data-srcset="<?echo $arItem["DETAIL_PICTURE"]["SRC"]?>" alt="<?echo $arItem["DETAIL_PICTURE"]["ALT"]?>">
												</div>
											</div>
										</div>
										<div class="promobox__content promobox__content--animation-scale-in absolute-stretch d-flex flex-column flex-center px-15 py-7 overflow-hidden">
											<div class="promobox__content_inner position-absolute d-flex flex-column flex-center w-100" style="max-width: 650px;margin-top: -10px;">

												<div class="promo-text promo-text--width-01 mx-auto">
													<p class="h1 mb-15"><? $arItem["NAME"]?></p>
													<p class="h4 mb-25"><? $arItem["DESCRIPTION"]?></p>
												</div>


											</div>
										</div>
									</div>
								</div>
							</div>
						<?endforeach;?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		Loader.require({
			type: "script",
			name: "home_builder"
		});
	</script>

</div>
