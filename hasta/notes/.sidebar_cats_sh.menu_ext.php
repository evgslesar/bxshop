<? 
 if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 
    global $APPLICATION; 

	$aMenuLinksExt=$APPLICATION->IncludeComponent(
		"bitrix:menu.sections", 
		"", 
		array( 
		"IS_SEF" => "Y", 
		"SEF_BASE_URL" => "/hasta/notes/", 
		"SECTION_PAGE_URL" => "", 
		"DETAIL_PAGE_URL" => "", 
		"IBLOCK_TYPE" => "articles", 
		"IBLOCK_ID" => "3", 
		"DEPTH_LEVEL" => "1", 
		"CACHE_TYPE" => "A", 
		"CACHE_TIME" => "3600" 
		), 
	false 
   );
 $aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt); 