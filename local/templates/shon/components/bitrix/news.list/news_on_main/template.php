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
<div class="col-xs-12 col-sm-8 wow fadeInLeft" data-wow-delay="0.4s">

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
	$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
	if($ar_res = $res->GetNext())
	?>
	<!-- Blog Post of the Page -->
	<article class="blog-post style2" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div class="img-holder">
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"></a>
				<ul class="list-unstyled comment-nav">
				<li>
					<a href="">
					<i class="fa fa-comments"></i>
						<?if (strlen($arItem['DISPLAY_PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])>0):?>
							<?echo $arItem['DISPLAY_PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];?>
						<?else:?>
							0
						<?endif;?>	
					</a>				
				</li>
				<li><a href="#"><i class="fa fa-share-alt"></i>14</a></li>
				</ul>
			</div>
		<?endif?>
		<div class="blog-txt">
			<h2><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></h2>
			<ul class="list-unstyled blog-nav">
				<li> <a href="#"><i class="fa fa-clock-o"></i><?echo $dateCreate;?></a></li>
				<li> 
					<a href="/blog/<? echo $ar_res['CODE']; ?>/"><i class="fa fa-list"></i><? echo $ar_res['NAME']; ?></a>
				</li>
				<li> 
					<i class="fa fa-comment"></i>
					<?if (strlen($arItem['DISPLAY_PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])>0):?>
						Число комментариев: <?echo $arItem['DISPLAY_PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];?>
					<?else:?>
						Число комментариев: 0
					<?endif;?>
				</li>
			</ul>
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>
			<a href="<?echo $arItem["DETAIL_PAGE_URL"];?>" class="btn-more"><?=GetMessage("BLOG_READ_MORE")?></a>
		</div>
	</article>
	<!-- Blog Post of the Page end -->

<?endforeach;?>
</div>
