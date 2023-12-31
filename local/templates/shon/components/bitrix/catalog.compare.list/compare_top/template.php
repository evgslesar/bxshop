<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<? if (count($arResult) > 0) { ?>
    <a class="compare-link" href="<?= $arParams["COMPARE_URL"] ?>"><span class="fa">&#xf006;</span> <span>В сравнении</span> <i><?= (count($arResult)) ?></i></a>
<? }else{?>
    <a class="compare-link" href="<?= $arParams["COMPARE_URL"] ?>"><span class="fa">&#xf006;</span> <span>В сравнении</span> <i>0</i></a>
<?}?>

