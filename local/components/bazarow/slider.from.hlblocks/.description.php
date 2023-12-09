<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("SLIDER_FHL_NAME"),
	"DESCRIPTION" => GetMessage("SLIDER_FHL_DESCRIPTION"),
	"ICON" => "/images/news_line.gif",
	"SORT" => 10,
	"CACHE_PATH" => "Y",
	"PATH" => array(
		"ID" => "content",
		"CHILD" => array(
			"ID" => "owner_components",
			"NAME" => GetMessage("SLIDER_FHL_SECTION"),
			"SORT" => 10,
		)
	),
);

?>