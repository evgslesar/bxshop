<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
if (!empty($arResult['SECTIONS'])) {
?>
<div class="top_section_list">
    <?php
    foreach ($arResult['SECTIONS'] as $arSection) {
        ?>

            <a class="top_section_list_item" href="<?= $arSection['SECTION_PAGE_URL'] ?>">
                <span style="background-image:url(<?=$arSection['ALT_PICTURE']?>) "></span>
                <strong><?= $arSection['NAME'] ?></strong>
            </a>

        <?php
    }
    ?>
</div>
<?}?>