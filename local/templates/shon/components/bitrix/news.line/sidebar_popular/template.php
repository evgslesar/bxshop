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
<ul class="list-unstyled text-right popular-post">

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
		<li id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="img-post">
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><img style="object-fit: cover;height:60px;" src="<?echo $arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
			</div>
			<div class="info-dscrp">
			<p><?echo $arItem["NAME"]?></p>
			<time datetime="<?echo $arItem["TIMESTAMP_X"]?>"><?echo $dateCreate;?></time>
			</div>
		</li>
	<?endforeach;?>
	</ul>
