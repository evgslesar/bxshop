<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

<ul class="list-unstyled widget-nav">

<?foreach($arResult as $arItem):?>

	<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>

<?endforeach?>

</ul>
<?endif?>