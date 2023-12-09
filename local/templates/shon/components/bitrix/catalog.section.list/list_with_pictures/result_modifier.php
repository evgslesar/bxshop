<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


foreach ($arResult['SECTIONS'] as $k => $arSection) {
    if (!empty($arSection["PICTURE"]['SRC'])) {
        $sectImg = $arSection["PICTURE"]['SRC'];
    } else {
        $elWithPicture = CIBlockElement::GetList(
            array("ID" => "ASC"),
            array(
                'IBLOCK_ID' => $arSection['IBLOCK_ID'],
                'SECTION_ID' => $arSection['ID'],
                'INCLUDE_SUBSECTIONS' => 'Y',
                '!DETAIL_PICTURE' => false
            ),
            false,
            array('nTopCount' => 1),
            array('DETAIL_PICTURE')
        );
        while ($arPict = $elWithPicture->Fetch()) {
            $renderImage2 = CFile::ResizeImageGet(
                $arPict["DETAIL_PICTURE"],
                array(
                    "width" => 100, "height" => 100
                ),
                BX_RESIZE_IMAGE_PROPORTIONAL_ALT,
                false
            );
            $sectImg = $renderImage2['src'];
        }
        if (empty($sectImg)) {
            $sectImg = '/local/img/nophoto.jpg';
        }
        $arResult['SECTIONS'][$k]['ALT_PICTURE'] = $sectImg;
    }
}