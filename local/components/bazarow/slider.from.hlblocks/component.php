<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader; // класс загрузки всего что нужно
use Bitrix\Highloadblock as HL;// класс работы с HL
use Bitrix\Main\Entity; // класс для работы с сущностями

	
if (!Loader::includeModule('highloadblock')) {
	return;
}


//$arResult = []; // не нужен, объявлен компонентом

if (!empty($arParams['HL_BLOCK'])) {
	$hlbl = (int)$arParams['HL_BLOCK'];
	$hlblock = HL\HighloadBlockTable::getById($hlbl)->fetch();
	$entity = HL\HighloadBlockTable::compileEntity($hlblock);
	$entity_data_class = $entity->getDataClass();

	$rsData = $entity_data_class::getList(array(
		'order' => array(
			'ID' => 'ASC'
		),
		'cache' => array(
			'ttl' => (int)$arParams['CACHE_TIME'] // мб в параметр
		),
	))->fetchAll();

//     echo '<pre>';
//     print_r($rsData);
//     echo '</pre>';

	foreach ($rsData as $item) {
		if ($item[$arParams['HL_BLOCK_FIELDS_PICTURE']]) {
			$item[$arParams['HL_BLOCK_FIELDS_PICTURE']] = CFile::GetFileArray(
				$item[$arParams['HL_BLOCK_FIELDS_PICTURE']]
			);
		}
		$arr['NAME'] = $item[$arParams['HL_BLOCK_FIELDS_NAME']];
		$arr['LINK'] = $item[$arParams['HL_BLOCK_FIELDS_LINK']];
		$arr['PICTURE'] = $item[$arParams['HL_BLOCK_FIELDS_PICTURE']];
		$arResult[] = $arr;
	}


//    while ($arData = $rsData->Fetch()) {
//        if ($arData[$arParams['HL_BLOCK_FIELDS_PICTURE']]) { //CFile::GetFileArray
//            $arData[$arParams['HL_BLOCK_FIELDS_PICTURE']] = CFile::GetPath($arData[$arParams['HL_BLOCK_FIELDS_PICTURE']]);
//        }
//        $arr['NAME'] = $arData[$arParams['HL_BLOCK_FIELDS_NAME']];
//        $arr['LINK'] = $arData[$arParams['HL_BLOCK_FIELDS_LINK']];
//        $arr['PICTURE'] = $arData[$arParams['HL_BLOCK_FIELDS_PICTURE']];
//        $arResult[] = $arr;
//    }
	$this->includeComponentTemplate();
}