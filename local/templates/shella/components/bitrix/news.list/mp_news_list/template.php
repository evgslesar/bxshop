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
<div id="theme-section-1537199704472" class="theme-section">
	<div data-section-id="1537199704472" data-section-type="carousel-articles" data-postload="carousel_articles">

		<div class="container mt-0 mb-60">
			<div class="carousel carousel--arrows carousel-articles position-relative"><h4
					class="carousel__title mb-35 text-center"><a
					href="notes/">Последние новости</a></h4>
				<div class="carousel__slider position-relative invisible"
					data-js-carousel
					data-autoplay="true"
					data-speed="5000"
					data-count="2"
					data-infinite="false"
					data-arrows="true"
					data-bullets="true">
					<div class="carousel__prev position-absolute cursor-pointer" data-js-carousel-prev><i>
						<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-006"
							viewBox="0 0 24 24">
							<path d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/>
						</svg>
					</i></div>
					<div class="carousel__items overflow-hidden">
						<div class="carousel__slick row" data-js-carousel-slick>
						<?foreach($arResult["ITEMS"] as $arItem):?>
							<?
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							
							$dateCreate = CIBlockFormatProperties::DateFormat(
								'j M Y', 
								MakeTimeStamp(
									$arItem["TIMESTAMP_X"], 
									CSite::GetDateFormat()
								)
							);
							?>
							<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="carousel__item carousel-articles__item col-auto d-flex flex-column flex-xl-row align-items-center align-items-xl-start text-center text-xl-left">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
								class="carousel-articles__image d-block mr-xl-20 w-100">
									<div class="rimage" style="padding-top:72.98701298701299%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
											class="rimage__img rimage__img--fade-in lazyload"
											data-master="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
											data-aspect-ratio="1.3701067615658362"

											data-srcset="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"

											alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
									</div>
								</a>	
								<div class="mt-20 mt-xl-0">
									<h3 class="mb-10">
										<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
									</h3>

									<div class="font-italic">
										<p class='mb-5'>
											<time datetime="<?echo $arItem["TIMESTAMP_X"]?>"><?echo $dateCreate;?></time>
										</p>
										<p class='mb-0'>Автор: <?php echo $arItem["CREATED_USER_NAME"]?></p>
									</div>
								</div>
						
							</div>
						<?endforeach;?>
						</div>
					</div>
					<div class="carousel__next position-absolute cursor-pointer" data-js-carousel-next><i>
						<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-007"
							viewBox="0 0 24 24">
							<path d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/>
						</svg>
					</i></div>
				</div>

			</div>
		</div>
	</div>

	<script>
		Loader.require({
			type: "style",
			name: "plugin_slick"
		});

		Loader.require({
			type: "script",
			name: "carousel_articles"
		});
	</script>

</div>
