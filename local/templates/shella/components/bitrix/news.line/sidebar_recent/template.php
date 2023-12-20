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

<h3 class="h5 pt-25 mb-15">Последние публикации</h3>
<div class="blog-sidebar__recents pb-5">

	<?
	
	$counter = 1;
	foreach($arResult["ITEMS"] as $arItem):?>
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
		<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="pb-20 <?php if($counter>1){ echo 'pt-20 border-top border--dashed'; };$counter++;?>">

		<h5 class="mb-5"><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h5>

		<p class="mb-0 font-italic">
			<time datetime="<?echo $arItem["TIMESTAMP_X"]?>"><?echo $dateCreate?></time>
			Автор: <?php echo $arItem["CREATED_USER_NAME"]?>
		</p>
		</div>

	<?endforeach;?>
</div>
