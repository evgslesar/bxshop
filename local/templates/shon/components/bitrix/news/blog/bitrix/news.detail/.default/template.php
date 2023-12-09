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

$dateCreate = CIBlockFormatProperties::DateFormat(
	'j M Y', 
	MakeTimeStamp(
		$arResult["TIMESTAMP_X"], 
		CSite::GetDateFormat()
	)
);
$res = CIBlockSection::GetByID($arResult["IBLOCK_SECTION_ID"]);
if($ar_res = $res->GetNext())
?>

	<!-- Blog Post of the Page -->
	<article class="blog-post detail">
		<div class="img-holder">
			<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
				alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>" />
		</div>
		<time class="time" datetime="<?echo $arResult["TIMESTAMP_X"]?>"><?echo $dateCreate;?></time>
		<div class="blog-txt">
			<h2><?=$arResult["NAME"]?></h2>
			<ul class="list-unstyled blog-nav">
				<li> <i class="fa fa-clock-o"></i><?echo $dateCreate;?></li>
				<li> <a href="/blog/<? echo $ar_res['CODE']; ?>/"><i class="fa fa-list"></i><? echo $ar_res['NAME']; ?></a></li>
				<li> 
					<i class="fa fa-comment"></i>
					<?if (strlen($arResult['DISPLAY_PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'])>0):?>
						Число комментариев: <?echo $arResult['DISPLAY_PROPERTIES']['FORUM_MESSAGE_CNT']['VALUE'];?>
					<?else:?>
						Число комментариев: 0
					<?endif;?>
				</li>
			</ul>

			<?echo $arResult["DETAIL_TEXT"];?>

		</div>
	</article>
	<!-- Blog Post of the Page end -->
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>		
	<?endif?>
	<br />
	<!-- Mt Author Box of the Page -->
	<article class="mt-author-box">
		<div class="author-img">
		<a href="#"><img src="http://placehold.it/150x150" alt="image description"></a>
		</div>
		<div class="author-txt">
		<h3><a href="#">Clara Wooden</a></h3>
		<p>Commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
		<ul class="list-unstyled social-network">
			<li><a href="#"><i class="fa fa-facebook"></i></a></li>
			<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<li><a href="#"><i class="fa fa-instagram"></i></a></li>
		</ul>
		</div>
	</article>
	<!-- Mt Author Box of the Page end -->
	<?
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>