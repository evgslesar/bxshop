<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<h3 class="h5 pt-25 mb-15"><?= GetMessage("SIDEBAR_MENU_TITEL") ?></h3>
<ul class="list-unstyled pb-25">

<?
foreach($arResult as $arItem):?>

	<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected<?endif?> h5 link-revert mb-0"><?=$arItem["TEXT"]?></a>
				
<?endforeach?>

</ul>
<?endif?>