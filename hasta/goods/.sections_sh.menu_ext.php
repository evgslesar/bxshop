<? 
 if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
    global $APPLICATION; 

	$aMenuLinksExt=$APPLICATION->IncludeComponent(
		"bitrix:menu.sections", 
		"", 
		array( 
		"IS_SEF" => "Y", 
		"SEF_BASE_URL" => "/hasta/goods/", 
		"SECTION_PAGE_URL" => "", 
		"DETAIL_PAGE_URL" => "", 
		"IBLOCK_TYPE" => "catalog", 
		"IBLOCK_ID" => "5", 
		"DEPTH_LEVEL" => "2", 
		"CACHE_TYPE" => "A", 
		"CACHE_TIME" => "3600" 
		), 
	false 
   );
 $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt); 
