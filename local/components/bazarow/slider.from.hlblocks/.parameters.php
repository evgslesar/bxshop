<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

use Bitrix\Main\Loader; // класс загрузки всего что нужно
use Bitrix\Highloadblock as HL; // класс работы с HL
use Bitrix\Main\Entity; // класс для работы с сущностями

if (!Loader::includeModule('highloadblock')) {
    return;
}


// Получаем список всех Highload блоков
$arHlBlocksList = [];

$hlblockIterator = HL\HighloadBlockTable::getList();
while ($hlblock = $hlblockIterator->fetch()) {
    $arHlBlocksList[$hlblock['ID']] = '[' . $hlblock['ID'] . '] ' . $hlblock['NAME'];;
}

if (!empty($arCurrentValues['HL_BLOCK'])) {// Получаем поля выбранного HL блока
    $hlblockId = $arCurrentValues['HL_BLOCK'];
// Получаем информацию о Highload блоке
    $hlblock = HL\HighloadBlockTable::getById($hlblockId)->fetch();
// Получаем описание сущности Highload блока
    $hlEntity = HL\HighloadBlockTable::compileEntity($hlblock);
// Получаем список полей сущности
    $hlFields = $hlEntity->getFields();
// Наполняем список доступных полей
    foreach ($hlFields as $fieldName => $field) {
        $arHlBlocksFields[$fieldName] = $fieldName;
    }
}
$arComponentParameters = [
	"GROUPS" => [],
	"PARAMETERS" => [
        'HL_BLOCK' => [
            'PARENT' => 'BASE',
            'NAME' => GetMessage('HL_BLOCK_LIST'),
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksList,
            'REFRESH' => 'Y',
        ],
        'HL_BLOCK_FIELDS_NAME' => [
            'PARENT' => 'BASE',
            'NAME' => 'Поле с названием слайда',
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksFields,
            'REFRESH' => 'N',
        ],
        'HL_BLOCK_FIELDS_LINK' => [
            'PARENT' => 'BASE',
            'NAME' => 'Поле с ссылкой со слайда',
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksFields,
            'REFRESH' => 'N',
        ],
        'HL_BLOCK_FIELDS_PICTURE' => [
            'PARENT' => 'BASE',
            'NAME' => 'Поле с картинкой слайда',
            'TYPE' => 'LIST',
            'VALUES' => $arHlBlocksFields,
            'REFRESH' => 'N',
        ],
        'CACHE_TIME' => [
            'DEFAULT' => '3600'
        ],
	],
];
