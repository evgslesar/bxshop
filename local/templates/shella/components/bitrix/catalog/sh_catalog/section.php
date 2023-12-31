<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/** @var array $arCurSection */
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;



$this->setFrameMode(true);

if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
		$arCurSection = array();
}
?>
<?

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = $arParams['COMMON_ADD_TO_BASKET_ACTION'] ?? '';
}
else
{
	$basketAction = $arParams['SECTION_ADD_TO_BASKET_ACTION'] ?? '';
}

?>
<div class="collections js-collections pb-10">
	<div class="container mt-10 mt-lg-25">
		<div class="row mb-40">
			<div class="collections__sidebar collections__sidebar--width-md d-none col-auto d-lg-block"
					data-sticky-sidebar-parent>
				<div class="js-sticky-sidebar">
					<div data-js-position-desktop="sidebar" data-sticky-sidebar-inner>
						<div id="theme-section-collection-sidebar" class="theme-section">
							<div data-section-id="collection-sidebar" data-section-type="collection-sidebar">
								<aside class="collection-sidebar js-position js-collection-sidebar"
										data-js-collection-sidebar data-js-position-name="sidebar">
									<?
									$APPLICATION->IncludeComponent(
										"bitrix:catalog.smart.filter",
										"smart.mobile.filter",
										array(
											"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],    // Тип инфоблока
											"IBLOCK_ID" => $arParams["IBLOCK_ID"],    // Инфоблок
											"SECTION_ID" => $arCurSection["ID"],    // ID раздела инфоблока
											"FILTER_NAME" => $arParams["FILTER_NAME"],    // Имя выходящего массива для фильтрации
											"PRICE_CODE" => $arParams["~PRICE_CODE"],    // Тип цены
											"CACHE_TYPE" => $arParams["CACHE_TYPE"],    // Тип кеширования
											"CACHE_TIME" => $arParams["CACHE_TIME"],    // Время кеширования (сек.)
											"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],    // Учитывать права доступа
											"SAVE_IN_SESSION" => "N",    // Сохранять установки фильтра в сессии пользователя
											"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],    // Вид отображения
											"XML_EXPORT" => "N",    // Включить поддержку Яндекс Островов
											"SECTION_TITLE" => "NAME",    // Заголовок
											"SECTION_DESCRIPTION" => "DESCRIPTION",    // Описание
											"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],    // Не отображать недоступные товары
											"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],    // Цветовая тема
											"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],    // Показывать цены в одной валюте
											"CURRENCY_ID" => $arParams["CURRENCY_ID"],
											"SEF_MODE" => 'N',    // Включить поддержку ЧПУ
											"SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],    // Правило для обработки
											"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
											"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],    // Имя массива с переменными для построения ссылок в постраничной навигации
											"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
											"POPUP_POSITION" => "left",
										),
										$component,
										array('HIDE_ICONS' => 'Y')
									);
									?>
									<div class="hidden-xs">
										<?
										$APPLICATION->IncludeComponent(
											"bitrix:main.include",
											"",
											Array(
												"AREA_FILE_SHOW" => "file",
												"PATH" => $arParams["SIDEBAR_PATH"],
												"AREA_FILE_RECURSIVE" => "N",
												"EDIT_MODE" => "html",
											),
											false,
											array('HIDE_ICONS' => 'Y')
										);
										?>
									</div>
									<nav class="collection-sidebar__navigation">

										<div class="layer-navigation d-none"
												data-js-collection-nav-section="current_filters"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer open"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">CURRENT FILTERS<i
														class="layer-navigation__arrow">
													<svg aria-hidden="true" focusable="false" role="presentation"
															class="icon icon-theme-229" viewBox="0 0 24 24">
														<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
													</svg>
												</i></h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div data-js-collection-replace="current-tags">
														<p class="mb-8">There are no current tags</p>
													</div>
												</div>
											</div>
											<div class="border-bottom"></div>
										</div>
										<div class="layer-navigation" data-js-collection-nav-section="collections"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer open"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">COLLECTION<i
														class="layer-navigation__arrow">
													<svg aria-hidden="true" focusable="false" role="presentation"
															class="icon icon-theme-229" viewBox="0 0 24 24">
														<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
													</svg>
												</i></h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div class="collections-menu" data-js-collections-menu>
														<div class="collections-menu__item" data-js-accordion="all"
																data-section-for-collection="womens">
															<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
																<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																	<input type="radio" class="d-none"
																			name="collection" value="womens"
																			checked="checked">
																	<span class="position-relative d-block mr-8 border"><i
																			class="d-none"><svg aria-hidden="true"
																								focusable="false"
																								role="presentation"
																								class="icon icon-theme-146"
																								viewBox="0 0 24 24"><path
																			d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																	<span>Shop</span>
																</label>
																<span class="ml-auto">42</span>
															</div>
														</div>
														<div class="collections-menu__item" data-js-accordion="all"
																data-section-for-collection="womens">
															<div class="collections-menu__button open d-flex align-items-center mb-15 mb-lg-9 cursor-pointer"
																	data-js-accordion-button>
																<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																	<input type="radio" class="d-none"
																			name="collection" value="womens"
																			checked="checked"
																			data-js-accordion-input>
																	<span class="position-relative d-block mr-8 border"><i
																			class="d-none"><svg aria-hidden="true"
																								focusable="false"
																								role="presentation"
																								class="icon icon-theme-146"
																								viewBox="0 0 24 24"><path
																			d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																	<span>Women's</span>
																</label><i class="collections-menu__arrow">
																<svg aria-hidden="true" focusable="false"
																		role="presentation" class="icon icon-theme-229"
																		viewBox="0 0 24 24">
																	<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
																</svg>
															</i><span class="ml-auto">42</span>
															</div>
															<div class="collections-menu__list ml-25"
																	data-js-accordion-content>
																<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
																	<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																		<input type="radio" class="d-none"
																				name="collection"
																				value="women-clothing">
																		<span class="position-relative d-block mr-8 border"><i
																				class="d-none"><svg
																				aria-hidden="true" focusable="false"
																				role="presentation"
																				class="icon icon-theme-146"
																				viewBox="0 0 24 24"><path
																				d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																		<span>Clothing</span>
																	</label>
																	<span class="ml-auto">21</span>
																</div>
																<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
																	<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																		<input type="radio" class="d-none"
																				name="collection"
																				value="women-shoes">
																		<span class="position-relative d-block mr-8 border"><i
																				class="d-none"><svg
																				aria-hidden="true" focusable="false"
																				role="presentation"
																				class="icon icon-theme-146"
																				viewBox="0 0 24 24"><path
																				d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																		<span>Shoes</span>
																	</label>
																	<span class="ml-auto">15</span>
																</div>
																<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
																	<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																		<input type="radio" class="d-none"
																				name="collection"
																				value="women-accessories">
																		<span class="position-relative d-block mr-8 border"><i
																				class="d-none"><svg
																				aria-hidden="true" focusable="false"
																				role="presentation"
																				class="icon icon-theme-146"
																				viewBox="0 0 24 24"><path
																				d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																		<span>Accessories</span>
																	</label>
																	<span class="ml-auto">12</span>
																</div>
															</div>
														</div>
														<div class="collections-menu__item" data-js-accordion="all"
																data-section-for-collection="mens">
															<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer"
																	data-js-accordion-button>
																<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																	<input type="radio" class="d-none"
																			name="collection" value="mens"
																			data-js-accordion-input>
																	<span class="position-relative d-block mr-8 border"><i
																			class="d-none"><svg aria-hidden="true"
																								focusable="false"
																								role="presentation"
																								class="icon icon-theme-146"
																								viewBox="0 0 24 24"><path
																			d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																	<span>Men's</span>
																</label><i class="collections-menu__arrow">
																<svg aria-hidden="true" focusable="false"
																		role="presentation" class="icon icon-theme-229"
																		viewBox="0 0 24 24">
																	<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
																</svg>
															</i><span class="ml-auto">22</span>
															</div>
															<div class="collections-menu__list d-none ml-25"
																	data-js-accordion-content>
																<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
																	<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																		<input type="radio" class="d-none"
																				name="collection"
																				value="men-clothing">
																		<span class="position-relative d-block mr-8 border"><i
																				class="d-none"><svg
																				aria-hidden="true" focusable="false"
																				role="presentation"
																				class="icon icon-theme-146"
																				viewBox="0 0 24 24"><path
																				d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																		<span>Clothing</span>
																	</label>
																	<span class="ml-auto">15</span>
																</div>
																<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
																	<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																		<input type="radio" class="d-none"
																				name="collection" value="men-shoes">
																		<span class="position-relative d-block mr-8 border"><i
																				class="d-none"><svg
																				aria-hidden="true" focusable="false"
																				role="presentation"
																				class="icon icon-theme-146"
																				viewBox="0 0 24 24"><path
																				d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																		<span>Shoes</span>
																	</label>
																	<span class="ml-auto">12</span>
																</div>
																<div class="collections-menu__button d-flex align-items-center mb-15 mb-lg-9 cursor-pointer">
																	<label class="input-checkbox d-flex align-items-center mb-0 mr-0 cursor-pointer">
																		<input type="radio" class="d-none"
																				name="collection"
																				value="men-accessories">
																		<span class="position-relative d-block mr-8 border"><i
																				class="d-none"><svg
																				aria-hidden="true" focusable="false"
																				role="presentation"
																				class="icon icon-theme-146"
																				viewBox="0 0 24 24"><path
																				d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i></span>
																		<span>Accessories</span>
																	</label>
																	<span class="ml-auto">15</span>
																</div>
															</div>
														</div>
													</div>

												</div>
											</div>
											<div class="border-bottom"></div>
										</div>
										<div class="layer-navigation" data-js-collection-nav-section="filters"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer open"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">COLOR<i
														class="layer-navigation__arrow">
													<svg aria-hidden="true" focusable="false" role="presentation"
															class="icon icon-theme-229" viewBox="0 0 24 24">
														<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
													</svg>
												</i></h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div data-js-collection-replace="filter-1"
															data-js-collection-replace-only-full>

														<div class="collection-filters d-flex flex-wrap"
																data-js-collection-filters data-property="color"><label
																class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="red">
										<span class="position-relative d-block rounded-circle standard-color-red lazyload"
												data-value="red" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="orange">
										<span class="position-relative d-block rounded-circle standard-color-orange lazyload"
												data-value="orange" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="yellow">
										<span class="position-relative d-block rounded-circle standard-color-yellow lazyload"
												data-value="yellow" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="green">
										<span class="position-relative d-block rounded-circle standard-color-green lazyload"
												data-value="green" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="black">
										<span class="position-relative d-block rounded-circle standard-color-black lazyload"
												data-value="black" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="silver">
										<span class="position-relative d-block rounded-circle standard-color-silver lazyload"
												data-value="silver" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="blue">
										<span class="position-relative d-block rounded-circle standard-color-blue lazyload"
												data-value="blue" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="grey">
										<span class="position-relative d-block rounded-circle standard-color-grey lazyload"
												data-value="grey" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="white">
										<span class="position-relative d-block rounded-circle standard-color-white lazyload"
												data-value="white" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="violet">
										<span class="position-relative d-block rounded-circle standard-color-violet lazyload"
												data-value="violet" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label><label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 mr-15 mr-lg-10 input-checkbox--unbordered cursor-pointer">
															<input type="checkbox" class="d-none"
																	name="filter_by_color" value="pink">
										<span class="position-relative d-block rounded-circle standard-color-pink lazyload"
												data-value="pink" data-bg="none">
											<i class="d-none standard-color-arrow"><svg aria-hidden="true"
																						focusable="false"
																						role="presentation"
																						class="icon icon-theme-146"
																						viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span></label>
														</div>
													</div>
												</div>
											</div>
											<div class="border-bottom"></div>
										</div>
										<div class="layer-navigation" data-js-collection-nav-section="filters"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer open"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">SIZE<i
														class="layer-navigation__arrow">
													<svg aria-hidden="true" focusable="false" role="presentation"
															class="icon icon-theme-229" viewBox="0 0 24 24">
														<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
													</svg>
												</i></h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div data-js-collection-replace="filter-2"
															data-js-collection-replace-only-full>

														<div class="collection-filters row"
																data-js-collection-filters>
															<div class="col-4 mb-10">

																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="30">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>30</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="32">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>32</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="34">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>34</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="36">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>36</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="38">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>38</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="40">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>40</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="42">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>42</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="44">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>44</span></label>
															</div>
															<div class="col-4 mb-10"><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_tag" value="xxs">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>XXS</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="xs">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>XS</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="s">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>S</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="m">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>M</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="l">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>L</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="xl">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>XL</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="xxl">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>XXL</span></label>
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_tag" value="xxxl">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>XXXL</span></label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="border-bottom"></div>
										</div>
										<div class="layer-navigation"
												data-js-collection-nav-section="filter_by_price"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer open"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">PRICE<i
														class="layer-navigation__arrow">
													<svg aria-hidden="true" focusable="false" role="presentation"
															class="icon icon-theme-229" viewBox="0 0 24 24">
														<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
													</svg>
												</i></h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div class="collection-filter-by-price">
														<input type="hidden" class="js-range-of-price"
																name="filter_by_price" data-min="0" data-max="900"
																data-step="10">
													</div>
													<script>
														Loader.require({
															type: "style",
															name: "plugin_ion_range_slider"
														});

														Loader.require({
															type: "script",
															name: "plugin_ion_range_slider"
														});

														Loader.require({
															type: "script",
															name: "range_of_price"
														});
													</script>

												</div>
											</div>
											<div class="border-bottom"></div>
										</div>
										<div class="layer-navigation" data-js-collection-nav-section="filters"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer open"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">BRANDS<i
														class="layer-navigation__arrow">
													<svg aria-hidden="true" focusable="false" role="presentation"
															class="icon icon-theme-229" viewBox="0 0 24 24">
														<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
													</svg>
												</i></h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div data-js-collection-replace="filter-3"
															data-js-collection-replace-only-full>

														<div class="collection-filters row"
																data-js-collection-filters>
															<div class="col-12 mb-10">
																<label class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																	<input type="checkbox" class="d-none"
																			name="filter_by_vendor"
																			value="calvin-klein">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Calvin Klein</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="chanel">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Chanel</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="dior">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Dior</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor"
																		value="dolce-gabbana">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Dolce & Gabbana</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="gap">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Gap</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor"
																		value="giorgio-armani">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Giorgio Armani</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="lacoste">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Lacoste</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="levis">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Levi's</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="prada">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Prada</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="versace">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Versace</span></label><label
																	class="input-checkbox d-flex align-items-center mb-15 mb-lg-10 cursor-pointer">
																<input type="checkbox" class="d-none"
																		name="filter_by_vendor" value="zara">
										<span class="position-relative d-block mr-8 border lazyload" data-bg="none">
											<i class="d-none"><svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-146"
																	viewBox="0 0 24 24"><path
													d="M9.703 15.489l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .93.93 0 0 1-.215-.127z"/></svg></i>
										</span><span>Zara</span></label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="border-bottom"></div>
										</div>
										<div class="layer-navigation" data-js-collection-nav-section="products"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">FEATURED PRODUCTS</h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div class="collection-sidebar-offers">
														<div class="product-featured d-flex flex-row align-items-start mb-20">
															<div class="product-featured__image mr-20 js-product-images-hovered-end js-product-images-hover"
																	data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_2_1_1_f1eca011-aa7b-4d6f-b673-7d84ca013e02_{width}x.progressive.jpg?v=1542543798"
																	data-js-product-image-hover-id="4166020202548">
																<a href="product.html?variant=13520590012468"
																	class="d-block">
																	<div class="rimage"
																			style="padding-top:128.2307692%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
																			class="rimage__img rimage__img--fade-in lazyload"
																			data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_67eb2dce-35d8-4dfa-8d93-fee6c4b56c49_{width}x.progressive.jpg?v=1542543797"
																			data-aspect-ratio="0.7798440311937612"


																			data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_67eb2dce-35d8-4dfa-8d93-fee6c4b56c49_300x.progressive.jpg?v=1542543797 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_67eb2dce-35d8-4dfa-8d93-fee6c4b56c49_300x@2x.progressive.jpg?v=1542543797 2x"


																			alt="Blend Field Jacket">
																	</div>
																</a>
															</div>
															<div class="product-featured__content d-flex flex-column align-items-start">
																<div class="product-featured__collections mb-3">
																	<a href="collection.html">Featured
																		Products,</a>
																	<a href="collection.html">Featured
																		Products</a>
																</div>
																<div class="product-featured__title mb-3">
																	<h3 class="h6 m-0">
																		<a href="product.html?variant=13520590012468">Blend
																			Field Jacket</a>
																	</h3>
																</div>
																<div class="product-featured__price mb-10">
																	<span class="price" data-js-product-price
																			data-js-show-sale-separator><span><span
																			class=money>$470.00</span></span></span>
																</div>
																<div class="product-featured__reviews">
																	<div class="spr spr--text-hide spr--empty-hide d-flex flex-column">
																		<span class="shopify-product-reviews-badge"
																				data-id="1463888117812"></span>
																	</div>
																</div>
															</div>
														</div>


														<div class="product-featured d-flex flex-row align-items-start mb-20">
															<div class="product-featured__image mr-20 js-product-images-hovered-end js-product-images-hover"
																	data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_1_1_1_c19ba148-bdf2-4b2a-b45d-fcab566c6a80_{width}x.progressive.jpg?v=1543244602"
																	data-js-product-image-hover-id="4166047399988">
																<a href="product.html?variant=13520580444212"
																	class="d-block">
																	<div class="rimage"
																			style="padding-top:128.2307692%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
																			class="rimage__img rimage__img--fade-in lazyload"
																			data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_2_3_1_86b90065-d75b-4519-a95e-a02ae468f4e9_{width}x.progressive.jpg?v=1543244602"
																			data-aspect-ratio="0.7798440311937612"


																			data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_2_3_1_86b90065-d75b-4519-a95e-a02ae468f4e9_300x.progressive.jpg?v=1543244602 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2121900600_2_3_1_86b90065-d75b-4519-a95e-a02ae468f4e9_300x@2x.progressive.jpg?v=1543244602 2x"


																			alt="Jersey Graphic Tee">
																	</div>
																</a>
															</div>
															<div class="product-featured__content d-flex flex-column align-items-start">
																<div class="product-featured__collections mb-3">
																	<a href="collection.html">Featured
																		Products</a>
																</div>
																<div class="product-featured__title mb-3">
																	<h3 class="h6 m-0">
																		<a href="product.html?variant=13520580444212">Jersey
																			Graphic Tee</a>
																	</h3>
																</div>
																<div class="product-featured__price mb-10">
																	<span class="price" data-js-product-price
																			data-js-show-sale-separator><span><span
																			class=money>$330.00</span></span></span>
																</div>
																<div class="product-featured__reviews">
																	<div class="spr spr--text-hide spr--empty-hide d-flex flex-column">
																		<span class="shopify-product-reviews-badge"
																				data-id="1463887626292"></span>
																	</div>
																</div>
															</div>
														</div>


														<div class="product-featured d-flex flex-row align-items-start mb-20">
															<div class="product-featured__image mr-20 js-product-images-hovered-end js-product-images-hover"
																	data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2608851250_2_2_1_6dced8be-eb3f-4972-9e37-e5638fdd4483_{width}x.progressive.jpg?v=1540480331"
																	data-js-product-image-hover-id="4072878997556">
																<a href="product.html?variant=13520570974260"
																	class="d-block">
																	<div class="rimage"
																			style="padding-top:128.2307692%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
																			class="rimage__img rimage__img--fade-in lazyload"
																			data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2608851250_1_1_1_0401469c-1bd2-4f3d-846b-52b3862ccd7d_{width}x.progressive.jpg?v=1540480331"
																			data-aspect-ratio="0.7798440311937612"


																			data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2608851250_1_1_1_0401469c-1bd2-4f3d-846b-52b3862ccd7d_300x.progressive.jpg?v=1540480331 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/2608851250_1_1_1_0401469c-1bd2-4f3d-846b-52b3862ccd7d_300x@2x.progressive.jpg?v=1540480331 2x"


																			alt="Cotton T-shirt with print">
																	</div>
																</a>
															</div>
															<div class="product-featured__content d-flex flex-column align-items-start">
																<div class="product-featured__collections mb-3">
																	<a href="collection.html">Featured
																		Products</a>
																</div>
																<div class="product-featured__title mb-3">
																	<h3 class="h6 m-0">
																		<a href="product.html?variant=13520570974260">Cotton
																			T-shirt with print</a>
																	</h3>
																</div>
																<div class="product-featured__price mb-10">
																	<span class="price" data-js-product-price
																			data-js-show-sale-separator><span><span
																			class=money>$150.00</span></span></span>
																</div>
																<div class="product-featured__reviews">
																	<div class="spr spr--text-hide spr--empty-hide d-flex flex-column">
																		<span class="shopify-product-reviews-badge"
																				data-id="1463886643252"></span>
																	</div>
																</div>
															</div>
														</div>

													</div>

												</div>
											</div>
											<div class="border-bottom"></div>
										</div>
										<div class="layer-navigation" data-js-collection-nav-section="custom_html"
												data-js-accordion="all">
											<div class="layer-navigation__head py-10 cursor-pointer"
													data-js-accordion-button>
												<h5 class="d-flex align-items-center mb-0">CUSTOM CMS BLOCK</h5>
											</div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">
													<div class="rte">


														<div class="fs">
															<div class="d-flex align-items-start mb-15">
																<i class="mr-10">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-116"
																			viewBox="0 0 24 24">
																		<path d="M21.93 6.088l.029.029c.007.007.01.017.01.029l.039.127a.47.47 0 0 1 .02.127v15a.6.6 0 0 1-.186.439.601.601 0 0 1-.439.186H2.652a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.47.47 0 0 1 .02-.127l.039-.127c0-.013.003-.022.01-.029a.387.387 0 0 0 .029-.029.478.478 0 0 1 .049-.078.844.844 0 0 1 .049-.059l.02-.02 4.375-3.75a.776.776 0 0 1 .195-.117.575.575 0 0 1 .215-.039h10c.078 0 .149.013.215.039.065.026.13.065.195.117l4.375 3.75v.02a.19.19 0 0 1 .068.059.557.557 0 0 1 .049.078zm-1.153 14.687V7.025h-5.625v5.625a.598.598 0 0 1-.186.439.601.601 0 0 1-.439.186h-5a.6.6 0 0 1-.439-.186.6.6 0 0 1-.186-.439V7.025H3.277v13.75h17.5zM7.262 3.275l-2.93 2.5h4.805l1.25-2.5H7.262zm2.89 8.75h3.75v-5h-3.75v5zm1.641-8.75l-1.25 2.5h2.969l-1.25-2.5h-.469zm7.93 2.5l-2.93-2.5h-3.125l1.25 2.5h4.805z"/>
																	</svg>
																</i>
																<p class="mb-0">Free shipping all orders of $49 or
																	more of eligible items across any product
																	category qualify.</p>
															</div>
															<div class="d-flex align-items-start mb-15">
																<i class="mr-10">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-125"
																			viewBox="0 0 24 24">
																		<path d="M21.508 5.035c.364.365.547.808.547 1.328v11.25c0 .521-.183.964-.547 1.328a1.808 1.808 0 0 1-1.328.547H3.93c-.521 0-.964-.182-1.328-.547a1.805 1.805 0 0 1-.547-1.328V6.363c0-.521.182-.963.547-1.328a1.81 1.81 0 0 1 1.328-.547h16.25c.521 0 .964.183 1.328.547zm-18.017.889a.6.6 0 0 0-.186.439v1.25h17.5v-1.25a.6.6 0 0 0-.186-.439.598.598 0 0 0-.439-.186H3.93a.598.598 0 0 0-.439.186zm-.186 4.814h17.5V8.863h-17.5v1.875zm17.315 7.315a.6.6 0 0 0 .186-.439v-5.625h-17.5v5.625c0 .169.062.316.186.439a.6.6 0 0 0 .439.186h16.25a.605.605 0 0 0 .439-.186zM9.995 14.674a.601.601 0 0 1 .186.439.598.598 0 0 1-.186.439.601.601 0 0 1-.439.186H5.18a.598.598 0 0 1-.439-.186.6.6 0 0 1-.186-.439.6.6 0 0 1 .186-.439.6.6 0 0 1 .439-.186h4.375c.169 0 .316.062.44.186zm9.375 0a.601.601 0 0 1 .186.439.598.598 0 0 1-.186.439.601.601 0 0 1-.439.186h-1.25a.598.598 0 0 1-.439-.186.6.6 0 0 1-.186-.439.6.6 0 0 1 .186-.439.6.6 0 0 1 .439-.186h1.25c.168 0 .315.062.439.186z"/>
																	</svg>
																</i>
																<p class="mb-0">Credit Card: Visa, MasterCard,
																	Maestro, American Express. The total will be
																	charged to your card when the order is
																	shipped.</p>
															</div>
															<div class="d-flex align-items-start mb-15">
																<i class="mr-10">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-009"
																			viewBox="0 0 24 24">
																		<path d="M2.453 8.299c-.026-.039-.048-.075-.068-.107a2.896 2.896 0 0 0-.068-.107.715.715 0 0 1 0-.469 2.48 2.48 0 0 0 .068-.107c.02-.033.042-.068.068-.107l5-5a.9.9 0 0 1 .215-.128c.078-.032.156-.049.234-.049s.156.017.234.049a.93.93 0 0 1 .215.127c.117.13.176.28.176.449a.652.652 0 0 1-.176.449L4.407 7.225h10.059a6.36 6.36 0 0 1 2.549.518 6.63 6.63 0 0 1 2.09 1.406c.593.592 1.062 1.289 1.406 2.09s.518 1.65.518 2.549-.173 1.748-.518 2.549a6.63 6.63 0 0 1-1.406 2.09 6.647 6.647 0 0 1-2.09 1.406 6.373 6.373 0 0 1-2.549.518H8.528a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439c0-.169.062-.316.186-.439a.595.595 0 0 1 .439-.187h5.938a5.12 5.12 0 0 0 2.061-.42 5.397 5.397 0 0 0 1.689-1.143 5.454 5.454 0 0 0 1.143-1.689 5.12 5.12 0 0 0 .42-2.061c0-.729-.14-1.416-.42-2.061a5.397 5.397 0 0 0-2.832-2.832 5.116 5.116 0 0 0-2.061-.42H4.407L8.352 12.4c.117.13.176.28.176.449a.652.652 0 0 1-.176.449.652.652 0 0 1-.449.176.652.652 0 0 1-.449-.176L2.453 8.299z"/>
																	</svg>
																</i>
																<p class="mb-0">Returns and Refunds: You can return
																	any item purchased on Shella within 20 days of
																	the delivery date.</p>
															</div>
														</div>

													</div>

												</div>
											</div>
										</div>
										<div class="layer-navigation" data-js-collection-nav-section="promobox"
												data-js-accordion="all">
											<div class="pt-20"></div>
											<div class="layer-navigation__accordion" data-js-accordion-content>
												<div class="pt-2 pb-10">


													<div class="promobox promobox--type-02 position-relative d-flex flex-column align-items-center text-center">
														<div class="w-100">
															<a href="product.html"
																class="w-100">

																<div class="image-animation image-animation--from-default image-animation--to-center image-animation--to-opacity">
																	<div class="rimage"
																			style="padding-top:128.1481481%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
																			class="rimage__img rimage__img--fade-in lazyload"
																			data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/08_dbfb557e-a691-4822-9ece-255c7fa4a984_{width}x.progressive.png.jpg?v=1530696155"
																			data-aspect-ratio="0.7803468208092486"


																			data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/files/08_dbfb557e-a691-4822-9ece-255c7fa4a984_400x.progressive.png.jpg?v=1530696155 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/files/08_dbfb557e-a691-4822-9ece-255c7fa4a984_400x@2x.progressive.png.jpg?v=1530696155 2x"


																			data-scale-perspective="1.1"

																			alt="">
																	</div>
																</div>
															</a>
															<div class="promobox__plate position-absolute d-flex flex-column flex-center px-10 py-7 pointer-events-none">
																<p class="promobox__text-line-01 h5 position-relative m-0">
																	NEW IN</p>
																<p class="promobox__text-line-02 position-relative m-0">
																	Spring/Summer 2018 Collection</p></div>
														</div>
													</div>


												</div>
											</div>
										</div>
									</nav>

								</aside>
							</div>

							<script>
								Loader.require({
									type: "script",
									name: "collection_sidebar"
								});
							</script>

						</div>
					</div>
				</div>
			</div>

			<script>
				Loader.require({
					type: "script",
					name: "plugin_sticky_sidebar"
				});

				Loader.require({
					type: "script",
					name: "sticky_sidebar"
				});
			</script>

			<div class="collections__body col pb-25">
				<div data-js-collection-replace="head" data-js-collection-replace-only-full>
					<div id="theme-section-collection-head" class="theme-section">
						<div data-section-id="collection-head" data-section-type="collection-head">
							<div class="collection-head">
								<div class="mb-15">

									<h1 class="h3 mb-10 d-lg-block text-center text-lg-left">Women's</h1>
								</div>
								<?
								$sectionListParams = array(
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
									"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
									"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
									"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
									"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
									"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
									"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
									"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
									"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
								);
								if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
								{
									$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
									if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
									{
										$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
									}
								}
								$APPLICATION->IncludeComponent(
									"bitrix:catalog.section.list",
									"",
									$sectionListParams,
									$component,
									array("HIDE_ICONS" => "Y")
								);
								unset($sectionListParams);

								if ($arParams["USE_COMPARE"]=="Y")
								{
									$APPLICATION->IncludeComponent(
										"bitrix:catalog.compare.list",
										"",
										array(
											"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
											"IBLOCK_ID" => $arParams["IBLOCK_ID"],
											"NAME" => $arParams["COMPARE_NAME"],
											"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
											"COMPARE_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
											"ACTION_VARIABLE" => (!empty($arParams["ACTION_VARIABLE"]) ? $arParams["ACTION_VARIABLE"] : "action"),
											"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
											'POSITION_FIXED' => isset($arParams['COMPARE_POSITION_FIXED']) ? $arParams['COMPARE_POSITION_FIXED'] : '',
											'POSITION' => isset($arParams['COMPARE_POSITION']) ? $arParams['COMPARE_POSITION'] : ''
										),
										$component,
										array("HIDE_ICONS" => "Y")
									);
								}
								?>
							</div>
						</div>

						<script>
							Loader.require({
								type: "script",
								name: "collection_head"
							});
						</script>

					</div>
				</div>

				<div id="theme-section-collection-body" class="theme-section">
					<script data-js-collection-replace="js-settings" data-js-collection-replace-only-full>
						window.page.default.view_length = "12";
						window.page.default.sort_by = "manual";
						window.page.default.only_available = false;
					</script>
					<div data-section-id="collection-body" data-section-type="collection-body">
						<div class="collection-body js-products-view">
							<div class="collection-control mb-25 mb-lg-30">
								<div class="row">
									<div class="col-8 col-lg d-flex d-lg-flex align-items-center">
										<div class="d-flex d-lg-none mr-30">
											<div class="collection-control__button-sidebar d-flex align-items-center cursor-pointer js-popup-button"
													data-js-popup-button="sidebar">
												<i class="mr-5">
													<svg aria-hidden="true" focusable="false" role="presentation"
															class="icon icon-theme-084" viewBox="0 0 24 24">
														<path d="M19.292 1.871c.169 0 .315.063.439.186a.601.601 0 0 1 .186.439v2.5a.657.657 0 0 1-.039.225.499.499 0 0 1-.117.186l-5.469 6.074v6.641a.582.582 0 0 1-.078.293.823.823 0 0 1-.195.234l-3.75 2.5c-.052.026-.107.049-.166.068a.603.603 0 0 1-.479-.05c-.104-.052-.186-.127-.244-.225s-.088-.205-.088-.322v-9.14L3.823 5.406a.491.491 0 0 1-.117-.186.648.648 0 0 1-.039-.224v-2.5a.6.6 0 0 1 .186-.439.604.604 0 0 1 .439-.186h15zm-.625 2.89v-1.64H4.917v1.641l5.469 6.074a.507.507 0 0 1 .117.186.653.653 0 0 1 .039.225v8.203l2.5-1.66v-6.543c0-.078.013-.152.039-.225a.515.515 0 0 1 .117-.186l5.469-6.075z"/>
													</svg>
												</i>
												SHOW FILTER
											</div>
										</div>
										
										<div class="collection-control__sort-by d-none d-lg-block mr-20"
												data-js-collection-sort-by>
											<div class="select position-relative js-dropdown js-select">
												<form class="sortline d-flex align-items-center" method="post" action="/local/ajax/sort.php" >
												
													<label for="SortBy" class="mb-0 mr-5">Сортировать</label>
													<select name="sortten"
															class="p-0 pr-25 mb-0 border-0 cursor-pointer"
															id="SortBy">

														<option value="show_counter" <? echo $_COOKIE['sortten'] === 'show_counter' ? ' selected' : ' '; ?>>
														По просмотрам
														</option>
														<option value="name" <? echo $_COOKIE['sortten'] === 'name' ? ' selected' : ' '; ?>>
														По алфавиту
														</option>
														<option value="BASE_PRICE" <? echo $_COOKIE['sortten'] === 'BASE_PRICE' ? ' selected' : ' '; ?>>
														По цене
														</option>

														<!-- <option value="manual" selected>Featured</option>
														<option value="best-selling">Best Selling</option>
														<option value="price-ascending">Price Ascending</option>
														<option value="price-descending">Price Descending</option>
														<option value="created-ascending">Date Ascending</option>
														<option value="created-descending">Date Descending</option>
														<option value="title-ascending">Name Ascending</option>
														<option value="title-descending">Name Descending</option> -->
													</select>
													<i class="position-absolute right-0">
														<svg aria-hidden="true" focusable="false"
																role="presentation" class="icon icon-theme-229"
																viewBox="0 0 24 24">
															<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
														</svg>
													</i>
												</form>
											</div>
										</div>
									</div>
									<div class="col-lg d-none d-lg-flex justify-content-lg-center align-items-lg-center"
											data-js-collection-replace="info">
										<div class="collection-control__information">Showing 1–12 of 42 results
										</div>
									</div>
									<div class="col-4 col-lg d-flex justify-content-lg-end align-items-center">
										<div class="collection-control__view-length d-none d-lg-block"
												data-js-collection-view-length>
											<div class="select position-relative js-dropdown js-select">
												<div class="d-flex align-items-center" data-js-dropdown-button>
													<label for="ViewLength" class="mb-0 mr-5">Show:</label>
													<select name="view_length"
															class="p-0 pr-25 mb-0 border-0 cursor-pointer"
															id="ViewLength">
														<option value="6">6</option>
														<option value="12" selected>12</option>
														<option value="18">18</option>
														<option value="24">24</option>
													</select>
													<i class="position-absolute right-0">
														<svg aria-hidden="true" focusable="false"
																role="presentation" class="icon icon-theme-229"
																viewBox="0 0 24 24">
															<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z"/>
														</svg>
													</i>
												</div>
												<div class="select__dropdown dropdown d-none position-lg-absolute top-lg-100 left-lg-0"
														data-js-dropdown data-js-select-dropdown>
													<div class="px-15 pb-30 py-lg-15">
														<span data-value="6">6</span><span data-value="12"
																							class="selected">12</span><span
															data-value="18">18</span><span data-value="24">24</span>
													</div>
												</div>
											</div>
										</div>
										<div class="collection-control__view-grid ml-auto ml-lg-15"
												data-js-tooltip
												data-tippy-content="View of item"
												data-tippy-placement="top"
												data-tippy-distance="8">
											<div class="products-grid-buttons d-flex" data-js-products-grid-buttons
													data-value-xs="2" data-value-sm="2" data-value-md="3"
													data-value-lg="3" data-value-xl="3">
												<div class="mx-8 mx-lg-1 cursor-pointer d-md-none" data-value="1">
													<i>
														<svg aria-hidden="true" focusable="false"
																role="presentation" class="icon icon-theme-304"
																viewBox="0 0 24 24">
															<path d="M21.2 2.6c-.1-.1-.3-.2-.4-.2H3.3c-.2 0-.3.1-.4.2-.2.1-.2.2-.2.4v17.6c0 .1.1.2.2.3.1.1.3.2.4.2h17.5c.2 0 .3-.1.4-.2.1-.1.1-.2.2-.3V3c0-.2 0-.3-.2-.4zm-1 4.2v13.1H3.9V3.6h16.3v3.2z"/>
														</svg>
													</i>
												</div>
												<div class="mx-8 mx-lg-1 cursor-pointer" data-value="2"
														data-active-xs data-active-sm>
													<i>
														<svg aria-hidden="true" focusable="false"
																role="presentation" class="icon icon-theme-185"
																viewBox="0 0 24 24">
															<path d="M3.306 21.142a.598.598 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-17.5a.6.6 0 0 1 .186-.439.604.604 0 0 1 .439-.186h17.5c.169 0 .315.063.439.186a.601.601 0 0 1 .186.439v17.5a.6.6 0 0 1-.186.439.601.601 0 0 1-.439.186h-17.5zm.625-17.5v7.5h7.5v-7.5h-7.5zm0 16.25h7.5v-7.5h-7.5v7.5zm16.25-16.25h-7.5v7.5h7.5v-7.5zm0 16.25v-7.5h-7.5v7.5h7.5z"/>
														</svg>
													</i>
												</div>
												<div class="mx-8 mx-lg-1 cursor-pointer d-none d-sm-block"
														data-value="3" data-active-md data-active-lg data-active-xl>
													<i>
														<svg aria-hidden="true" focusable="false"
																role="presentation" class="icon icon-theme-186"
																viewBox="0 0 24 24">
															<path d="M2.828 2.567a.608.608 0 0 1 .449-.175h16.875c.183 0 .332.059.449.176s.176.268.176.449v16.875c0 .183-.059.332-.176.449s-.267.176-.449.176H3.277c-.183 0-.332-.059-.449-.176s-.176-.267-.176-.449V3.017c0-.182.059-.332.176-.45zm1.074 1.075v4.375h4.375V3.642H3.902zm4.375 5.625H3.902v4.375h4.375V9.267zm-4.375 10h4.375v-4.375H3.902v4.375zm10-11.25V3.642H9.527v4.375h4.375zm-4.375 1.25v4.375h4.375V9.267H9.527zm0 5.625v4.375h4.375v-4.375H9.527zm10-11.25h-4.375v4.375h4.375V3.642zm0 5.625h-4.375v4.375h4.375V9.267zm0 10v-4.375h-4.375v4.375h4.375z"/>
														</svg>
													</i>
												</div>
												<div class="mx-8 mx-lg-1 cursor-pointer d-none d-md-block"
														data-value="4">
													<i>
														<svg aria-hidden="true" focusable="false"
																role="presentation" class="icon icon-theme-305"
																viewBox="0 0 24 24">
															<path d="M21.245 2.577a.605.605 0 0 0-.439-.186h-17.5a.602.602 0 0 0-.439.186.598.598 0 0 0-.186.44v17.629h.025c.024.114.07.22.16.31a.6.6 0 0 0 .439.186h17.5a.6.6 0 0 0 .439-.186.595.595 0 0 0 .16-.31h.025V3.017a.592.592 0 0 0-.184-.44zm-1.064 12.94h-3.125v-3.125h3.125v3.125zm0 1.25v3.125h-3.125v-3.125h3.125zm-11.875-1.25v-3.125h3.125v3.125H8.306zm3.125 1.25v3.125H8.306v-3.125h3.125zm-7.5-8.75h3.125v3.125H3.931V8.017zm0-1.25V3.642h3.125v3.125H3.931zm11.875 1.25v3.125h-3.125V8.017h3.125zm-3.125-1.25V3.642h3.125v3.125h-3.125zm-1.25 4.375H8.306V8.017h3.125v3.125zm-7.5 1.25h3.125v3.125H3.931v-3.125zm8.75 0h3.125v3.125h-3.125v-3.125zm7.5-1.25h-3.125V8.017h3.125v3.125zm0-4.375h-3.125V3.642h3.125v3.125zm-8.75 0H8.306V3.642h3.125v3.125zm-7.5 10h3.125v3.125H3.931v-3.125zm8.75 0h3.125v3.125h-3.125v-3.125z"/>
														</svg>
													</i>
												</div>
												<div class="mx-8 mx-lg-1 cursor-pointer d-none d-lg-block"
														data-value="list">
													<i>
														<svg aria-hidden="true" focusable="false"
																role="presentation" class="icon icon-theme-187"
																viewBox="0 0 24 24">
															<path d="M20.574 2.567a.61.61 0 0 0-.449-.176H3.25c-.183 0-.332.059-.449.176s-.176.268-.176.45v16.875c0 .183.059.332.176.449s.267.176.449.176h16.875c.182 0 .332-.059.449-.176s.176-.267.176-.449V3.017a.613.613 0 0 0-.176-.45zM8.25 19.267H3.875v-4.375H8.25v4.375zm0-5.625H3.875V9.267H8.25v4.375zm0-5.625H3.875V3.642H8.25v4.375zm11.25 11.25h-10v-4.375h10v4.375zm0-5.625h-10V9.267h10v4.375zm0-5.625h-10V3.642h10v4.375z"/>
														</svg>
													</i>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="smart_filter_checked_items"></div>

							</div>
							<script>
								Loader.require({
									type: "script",
									name: "products_view"
								});
							</script>
							<?
							if (
								(!empty($_COOKIE['sortten']))
							) {
								$sort = $_COOKIE['sortten'];
							} else {
								$sort = $arParams["ELEMENT_SORT_FIELD"];
							}
							$intSectionID = $APPLICATION->IncludeComponent(
								"bitrix:catalog.section",
								"",
								array(
									"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
									"IBLOCK_ID" => $arParams["IBLOCK_ID"],
														
									"ELEMENT_SORT_FIELD" => $sort,
									"ELEMENT_SORT_ORDER" => ($_COOKIE['sortten'] === 'show_counter') ? 'desc' : 'asc',

									// "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
									// "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
									"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
									"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
									"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"]) ? $arParams["LIST_PROPERTY_CODE"] : []),
									"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
									"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
									"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
									"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
									"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
									"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
									"BASKET_URL" => $arParams["BASKET_URL"],
									"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
									"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
									"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
									"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
									"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
									"FILTER_NAME" => $arParams["FILTER_NAME"],
									"CACHE_TYPE" => $arParams["CACHE_TYPE"],
									"CACHE_TIME" => $arParams["CACHE_TIME"],
									"CACHE_FILTER" => $arParams["CACHE_FILTER"],
									"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
									"SET_TITLE" => $arParams["SET_TITLE"],
									"MESSAGE_404" => $arParams["~MESSAGE_404"],
									"SET_STATUS_404" => $arParams["SET_STATUS_404"],
									"SHOW_404" => $arParams["SHOW_404"],
									"FILE_404" => $arParams["FILE_404"],
									"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
									"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
									"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
									"PRICE_CODE" => $arParams["~PRICE_CODE"],
									"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
									"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

									"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
									"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
									"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
									"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
									"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),

									"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
									"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
									"PAGER_TITLE" => $arParams["PAGER_TITLE"],
									"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
									"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
									"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
									"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
									"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
									"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
									"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
									"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
									"LAZY_LOAD" => $arParams["LAZY_LOAD"],
									"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
									"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

									"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
									"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
									"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"]) ? $arParams["LIST_OFFERS_PROPERTY_CODE"] : []),
									"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
									"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
									"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
									"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
									"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"]) ? $arParams["LIST_OFFERS_LIMIT"] : 0),

									"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
									"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
									"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
									"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
									"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
									'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
									'CURRENCY_ID' => $arParams['CURRENCY_ID'],
									'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
									'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

									'LABEL_PROP' => $arParams['LABEL_PROP'],
									'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
									'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'] ?? '',
									'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
									'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
									'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
									'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
									'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
									'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
									'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
									'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
									'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

									'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
									'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
									'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
									'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
									'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
									'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
									'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
									'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
									'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
									'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
									'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
									'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
									'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
									'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
									'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
									'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'] ?? '',
									'MESS_NOT_AVAILABLE_SERVICE' => $arParams['~MESS_NOT_AVAILABLE_SERVICE'] ?? '',
									'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

									'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
									'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
									'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

									'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
									"ADD_SECTIONS_CHAIN" => "N",
									'ADD_TO_BASKET_ACTION' => $basketAction,
									'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
									'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
									'COMPARE_NAME' => $arParams['COMPARE_NAME'],
									'USE_COMPARE_LIST' => 'Y',
									'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
									'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
									'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
								),
								$component
							);
							?>
							<?
							$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;

							?>
						</div>
					</div>

					<script>
						Loader.require({
							type: "script",
							name: "collection_body"
						});
					</script>

				</div>
			</div>
		</div>
		<script>
			Loader.require({
				type: "script",
				name: "collections"
			});
		</script>
		<div id="theme-section-carousel-products" class="theme-section">
			<div data-section-id="carousel-products" data-section-type="carousel-products"
					data-postload="carousel_products">
				<div class="carousel carousel--arrows carousel-products position-relative mt-60 mt-sm-60 mt-md-60 mt-lg-30 mt-xl-30 mb-60">
					<div class="border-top mb-50"></div>
					<div class="carousel__head row justify-content-center mb-25" data-carousel-control><h4
							class="carousel__title col-auto mb-10 text-center">
						<a href="collection.html" class="active" data-collection="trending-now-hp">Trending
							Now</a>
					</h4></div>
					<div class="carousel__slider position-relative invisible"
							data-js-carousel
							data-autoplay="true"
							data-speed="5000"
							data-count="4"
							data-infinite="true"
							data-arrows="true"
							data-bullets="true">
						<div class="carousel__prev position-absolute cursor-pointer" data-js-carousel-prev><i>
							<svg aria-hidden="true" focusable="false" role="presentation"
									class="icon icon-theme-006" viewBox="0 0 24 24">
								<path d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/>
							</svg>
						</i></div>
						<div class="carousel__products overflow-hidden">
							<div class="carousel__slick row" data-js-carousel-slick data-carousel-items
									data-max-count="6" data-products-pre-row="4" data-async-ajax-loading="true">
								<div class="carousel__item col-auto">
									<div class="product-collection d-flex flex-column mb-30" data-js-product
											data-js-product-json-preload data-product-handle="blend-field-jacket-1"
											data-product-variant-id="13520717250612"
									>
										<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
												data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_2_1_1_c8438a3b-abe8-43d0-91f0-5479d926e066_{width}x.progressive.jpg?v=1540482206"
												data-js-product-image-hover-id="4072957313076">
											<a href="product.html-1?variant=13520717250612"
												class="d-block cursor-default" data-js-product-image>
												<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
														class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
														data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_52bb581a-2a82-4803-a0b5-5803536beb6d_{width}x.progressive.jpg?v=1540482206"
														data-aspect-ratio="0.78125"


														data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_52bb581a-2a82-4803-a0b5-5803536beb6d_600x.progressive.jpg?v=1540482206 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_52bb581a-2a82-4803-a0b5-5803536beb6d_600x@2x.progressive.jpg?v=1540482206 2x"


														data-image-id="4072957280308"
														alt="New Blend Field Jacket">
												</div>
											</a>
											<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
												<a href="product.html-1?variant=13520717250612"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
													<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-hot>Hot
													</div>
													<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-new>New
													</div>
													<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-sale></div>
													<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-out-stock>Out Stock
													</div>
												</div>
												<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
													<a href="product.html-1?variant=13520717250612"
														class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
														data-js-popup-button="quick-view"
														data-js-tooltip
														data-tippy-content="Quick View"
														data-tippy-placement="left"
														data-tippy-distance="5">
														<i>
															<svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-154"
																	viewBox="0 0 24 24">
																<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
															</svg>
														</i>
													</a>
												</div>
											</div>
											<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
												<a href="product.html-1?variant=13520717250612"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
													<div class="d-none-important" data-js-product-countdown>
														<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
													</div>
												</div>
												<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
													<div class="product-images-navigation d-flex">
														<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
																data-js-product-images-navigation="prev"><i
																class="mr-2"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-006"
																					viewBox="0 0 24 24"><path
																d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
														<span class="d-flex flex-center rounded-circle cursor-pointer"
																data-js-product-images-navigation="next"><i
																class="ml-3"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-007"
																					viewBox="0 0 24 24"><path
																d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="product-collection__content d-flex flex-column align-items-start mt-15">
											<div class="product-collection__title mb-3">
												<h4 class="h6 m-0">
													<a href="product.html-1?variant=13520717250612">New
														Blend Field Jacket</a>
												</h4>
											</div>
											<div class="product-collection__details d-none mb-8">
												<div class="product-collection__sku mb-5">
													<p class="m-0" data-js-product-sku>SKU: <span>00117cc</span></p>
												</div>
												<div class="product-collection__barcode mb-5">
													<p class="m-0" data-js-product-barcode>BARCODE:
														<span>1234567890</span></p>
												</div>
												<div class="product-collection__availability mb-5"><p class="m-0"
																										data-js-product-availability
																										data-availability="false">
													AVAILABILITY: <span>In stock (99999 items)</span></p>
												</div>
												<div class="product-collection__type mb-5">
													<p class="m-0" data-js-product-type>PRODUCT TYPE:
														<span>Scarf</span></p>
												</div>
												<div class="product-collection__vendor mb-5">
													<p class="m-0" data-js-product-vendor>VENDOR: <span>Gap</span>
													</p>
												</div>
											</div>
											<div class="product-collection__description d-none mb-15">
												<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet
													conse ctetur adipisicing elit, sed do eiusmod tempor incididunt
													ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
													nostrud exercitation ullamco laboris nisi ut aliquip ex ea
													commodo consequat....</p>
											</div>
											<div class="product-collection__price mb-10">
												<span class="price" data-js-product-price
														data-js-show-sale-separator><span><span
														class=money>$470.00</span></span></span>
											</div>
											<form method="post" action="/cart/add" accept-charset="UTF-8"
													class="d-flex flex-column w-100 m-0" enctype="multipart/form-data"
													data-js-product-form=""><input type="hidden" name="form_type"
																					value="product"/><input
													type="hidden" name="utf8" value="✓"/>
												<div class="product-collection__options">

													<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
														<div><label class="d-none">Color:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="image" data-property="color">
																<div class="product-options__value product-options__value--square text-hide cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="white"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_52bb581a-2a82-4803-a0b5-5803536beb6d_[width]x.progressive.jpg?v=1540482206)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534250_1_1_1_52bb581a-2a82-4803-a0b5-5803536beb6d_92x.progressive.jpg?v=1540482206)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="White"
																		data-tippy-placement="top"
																		data-tippy-distance="6">White
																</div>


																<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
																		data-js-option-value
																		data-value="beige"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534711_2_3_1_946348a0-7d10-4c14-a1df-07c8e861e525_[width]x.progressive.jpg?v=1540482206)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534711_2_3_1_946348a0-7d10-4c14-a1df-07c8e861e525_92x.progressive.jpg?v=1540482206)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="Beige"
																		data-tippy-placement="top"
																		data-tippy-distance="6">Beige
																</div>


																<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
																		data-js-option-value
																		data-value="pink"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534980_2_3_1_1e102427-beba-4856-ae06-f34f846f98f2_[width]x.progressive.jpg?v=1540482206)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/3410534980_2_3_1_1e102427-beba-4856-ae06-f34f846f98f2_92x.progressive.jpg?v=1540482206)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="Pink"
																		data-tippy-placement="top"
																		data-tippy-distance="6">Pink
																</div>
															</div>
														</div>
														<div><label class="d-none">Size:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="large-text" data-property="size">
																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="30"

																		data-bg="none"
																		data-scale="2"
																>30
																</div>

																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="32"

																		data-bg="none"
																		data-scale="2"
																>32
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="34"

																		data-bg="none"
																		data-scale="2"
																>34
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="36"

																		data-bg="none"
																		data-scale="2"
																>36
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="38"

																		data-bg="none"
																		data-scale="2"
																>38
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="40"

																		data-bg="none"
																		data-scale="2"
																>40
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="42"

																		data-bg="none"
																		data-scale="2"
																>42
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="product-collection__variants mb-10 d-none">
													<select name="id" class="m-0" data-js-product-variants>
														<option selected="selected" value="13520717250612">White /
															30
														</option>
														<option value="13520717316148">White / 32</option>
														<option value="13520717348916">White / 34</option>
														<option value="13520717414452">White / 36</option>
														<option value="13520717447220">White / 38</option>
														<option value="13520717512756">White / 40</option>
														<option value="13520717545524">White / 42</option>
														<option value="13520717611060">Beige / 30</option>
														<option value="13520717643828">Beige / 32</option>
														<option value="13520717709364">Beige / 34</option>
														<option value="13520717742132">Beige / 36</option>
														<option value="13520717807668">Beige / 38</option>
														<option value="13520717840436">Beige / 40</option>
														<option value="13520717905972">Beige / 42</option>
														<option value="13520717938740">Pink / 30</option>
														<option value="13520718004276">Pink / 32</option>
														<option value="13520718037044">Pink / 34</option>
														<option value="13520718102580">Pink / 36</option>
														<option value="13520718135348">Pink / 38</option>
														<option value="13520718168116">Pink / 40</option>
														<option value="13520718233652">Pink / 42</option>
													</select>
												</div>
												<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
													<div class="product-collection__button-add-to-cart mb-10">
														<button type="submit"
																class="btn btn--status btn--animated js-product-button-add-to-cart"
																name="add" data-js-product-button-add-to-cart>
															<span class="d-flex flex-center"><i
																	class="btn__icon mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-109"
																	viewBox="0 0 24 24"><path
																	d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
																	class="btn__text">ADD TO CART</span></span>
															<span class="d-flex flex-center"
																	data-button-content="added"><i class="mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
																	d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
															<span class="d-flex flex-center"
																	data-button-content="sold-out">SOLD OUT</span>
														</button>
													</div>
													<div class="product-collection__buttons-section d-flex px-lg-10">
														<div class="product-collection__button-add-to-wishlist mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

																data-js-tooltip
																data-tippy-content="Wishlist"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-180"
																			viewBox="0 0 24 24">
																		<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-181"
																			viewBox="0 0 24 24">
																		<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-add-to-compare mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

																data-js-tooltip
																data-tippy-content="Compare"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-039"
																			viewBox="0 0 24 24">
																		<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-235"
																			viewBox="0 0 24 24">
																		<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
															<a href="product.html-1?variant=13520717250612"
																class="btn btn--text pt-2 px-lg-6 js-popup-button"
																data-js-popup-button="quick-view"
																data-js-tooltip
																data-tippy-content="Quick View"
																data-tippy-placement="top"
																data-tippy-distance="-2">
																<i>
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-154"
																			viewBox="0 0 24 24">
																		<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
																	</svg>
																</i>
															</a>
														</div>
													</div>
												</div>
											</form>
											<div class="product-collection__reviews">
												<div class="spr spr--empty-hide d-flex flex-column">
													<span class="shopify-product-reviews-badge"
															data-id="1463899193396"></span>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="carousel__item col-auto">
									<div class="product-collection d-flex flex-column mb-30" data-js-product
											data-js-product-json-preload data-product-handle="fit-linen-shirt"
											data-product-variant-id="13520714825780"
									>
										<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
												data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168400_2_1_1_00554540-01de-4081-a9c1-59808f8aef3c_{width}x.progressive.jpg?v=1540482192"
												data-js-product-image-hover-id="4072956624948">
											<a href="product.html?variant=13520714825780"
												class="d-block cursor-default" data-js-product-image>
												<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
														class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
														data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168400_1_1_1_078fffc1-0fe7-4959-bc2a-5aed687b9c09_{width}x.progressive.jpg?v=1540482192"
														data-aspect-ratio="0.78125"


														data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168400_1_1_1_078fffc1-0fe7-4959-bc2a-5aed687b9c09_600x.progressive.jpg?v=1540482192 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168400_1_1_1_078fffc1-0fe7-4959-bc2a-5aed687b9c09_600x@2x.progressive.jpg?v=1540482192 2x"


														data-image-id="4072956592180"
														alt="Fit Linen Shirt">
												</div>
											</a>
											<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
												<a href="product.html?variant=13520714825780"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
													<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-hot>Hot
													</div>
													<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-new>New
													</div>
													<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-sale></div>
													<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-out-stock>Out Stock
													</div>
												</div>
												<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
													<a href="product.html?variant=13520714825780"
														class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
														data-js-popup-button="quick-view"
														data-js-tooltip
														data-tippy-content="Quick View"
														data-tippy-placement="left"
														data-tippy-distance="5">
														<i>
															<svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-154"
																	viewBox="0 0 24 24">
																<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
															</svg>
														</i>
													</a>
												</div>
											</div>
											<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
												<a href="product.html?variant=13520714825780"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
													<div class="d-none-important" data-js-product-countdown>
														<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
													</div>
												</div>
												<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
													<div class="product-images-navigation d-flex">
														<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
																data-js-product-images-navigation="prev"><i
																class="mr-2"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-006"
																					viewBox="0 0 24 24"><path
																d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
														<span class="d-flex flex-center rounded-circle cursor-pointer"
																data-js-product-images-navigation="next"><i
																class="ml-3"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-007"
																					viewBox="0 0 24 24"><path
																d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="product-collection__content d-flex flex-column align-items-start mt-15">
											<div class="product-collection__title mb-3">
												<h4 class="h6 m-0">
													<a href="product.html?variant=13520714825780">Fit
														Linen Shirt</a>
												</h4>
											</div>
											<div class="product-collection__details d-none mb-8">
												<div class="product-collection__sku mb-5">
													<p class="m-0" data-js-product-sku>SKU: <span>00109aa</span></p>
												</div>
												<div class="product-collection__barcode mb-5">
													<p class="m-0" data-js-product-barcode>BARCODE:
														<span>123456789</span></p>
												</div>
												<div class="product-collection__availability mb-5"><p class="m-0"
																										data-js-product-availability
																										data-availability="false">
													AVAILABILITY: <span>In stock (99999 items)</span></p>
												</div>
												<div class="product-collection__type mb-5">
													<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Beachwear</span>
													</p>
												</div>
												<div class="product-collection__vendor mb-5">
													<p class="m-0" data-js-product-vendor>VENDOR: <span>Giorgio Armani</span>
													</p>
												</div>
											</div>
											<div class="product-collection__description d-none mb-15">
												<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet
													conse ctetur adipisicing elit, sed do eiusmod tempor incididunt
													ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
													nostrud exercitation ullamco laboris nisi ut aliquip ex ea
													commodo consequat....</p>
											</div>
											<div class="product-collection__price mb-10">
												<span class="price" data-js-product-price
														data-js-show-sale-separator><span><span
														class=money>$270.00</span></span></span>
											</div>
											<form method="post" action="/cart/add" accept-charset="UTF-8"
													class="d-flex flex-column w-100 m-0" enctype="multipart/form-data"
													data-js-product-form=""><input type="hidden" name="form_type"
																					value="product"/><input
													type="hidden" name="utf8" value="✓"/>
												<div class="product-collection__options">

													<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
														<div><label class="d-none">Color:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="image" data-property="color">
																<div class="product-options__value product-options__value--square text-hide cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="gainsboro"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168400_1_1_1_078fffc1-0fe7-4959-bc2a-5aed687b9c09_[width]x.progressive.jpg?v=1540482192)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168400_1_1_1_078fffc1-0fe7-4959-bc2a-5aed687b9c09_92x.progressive.jpg?v=1540482192)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="Gainsboro"
																		data-tippy-placement="top"
																		data-tippy-distance="6">Gainsboro
																</div>


																<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
																		data-js-option-value
																		data-value="pink"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168605_2_3_1_8f1670ab-69cb-4c39-8243-9a42d086672b_[width]x.progressive.jpg?v=1540482192)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/0832168605_2_3_1_8f1670ab-69cb-4c39-8243-9a42d086672b_92x.progressive.jpg?v=1540482192)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="Pink"
																		data-tippy-placement="top"
																		data-tippy-distance="6">Pink
																</div>
															</div>
														</div>
														<div><label class="d-none">Size:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="large-text" data-property="size">
																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="s"

																		data-bg="none"
																		data-scale="2"
																>S
																</div>

																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="m"

																		data-bg="none"
																		data-scale="2"
																>M
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="l"

																		data-bg="none"
																		data-scale="2"
																>L
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="xl"

																		data-bg="none"
																		data-scale="2"
																>XL
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="product-collection__variants mb-10 d-none">
													<select name="id" class="m-0" data-js-product-variants>
														<option selected="selected" value="13520714825780">Gainsboro
															/ S
														</option>
														<option value="13520714858548">Gainsboro / M</option>
														<option value="13520714891316">Gainsboro / L</option>
														<option value="13520714924084">Gainsboro / XL</option>
														<option value="13520714956852">Pink / S</option>
														<option value="13520714989620">Pink / M</option>
														<option value="13520715022388">Pink / L</option>
														<option value="13520715055156">Pink / XL</option>
													</select>
												</div>
												<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
													<div class="product-collection__button-add-to-cart mb-10">
														<button type="submit"
																class="btn btn--status btn--animated js-product-button-add-to-cart"
																name="add" data-js-product-button-add-to-cart>
															<span class="d-flex flex-center"><i
																	class="btn__icon mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-109"
																	viewBox="0 0 24 24"><path
																	d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
																	class="btn__text">ADD TO CART</span></span>
															<span class="d-flex flex-center"
																	data-button-content="added"><i class="mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
																	d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
															<span class="d-flex flex-center"
																	data-button-content="sold-out">SOLD OUT</span>
														</button>
													</div>
													<div class="product-collection__buttons-section d-flex px-lg-10">
														<div class="product-collection__button-add-to-wishlist mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

																data-js-tooltip
																data-tippy-content="Wishlist"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-180"
																			viewBox="0 0 24 24">
																		<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-181"
																			viewBox="0 0 24 24">
																		<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-add-to-compare mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

																data-js-tooltip
																data-tippy-content="Compare"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-039"
																			viewBox="0 0 24 24">
																		<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-235"
																			viewBox="0 0 24 24">
																		<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
															<a href="product.html?variant=13520714825780"
																class="btn btn--text pt-2 px-lg-6 js-popup-button"
																data-js-popup-button="quick-view"
																data-js-tooltip
																data-tippy-content="Quick View"
																data-tippy-placement="top"
																data-tippy-distance="-2">
																<i>
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-154"
																			viewBox="0 0 24 24">
																		<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
																	</svg>
																</i>
															</a>
														</div>
													</div>
												</div>
											</form>
											<div class="product-collection__reviews">
												<div class="spr spr--empty-hide d-flex flex-column">
													<span class="shopify-product-reviews-badge"
															data-id="1463898964020"></span>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="carousel__item col-auto">
									<div class="product-collection d-flex flex-column mb-30" data-js-product
											data-js-product-json-preload data-product-handle="hoodie-with-slogan"
											data-product-variant-id="13520714661940"
									>
										<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
												data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1935457407_2_1_1_685e9cce-31c1-4cf3-800e-267f92c3cede_{width}x.progressive.jpg?v=1547913669"
												data-js-product-image-hover-id="4072955805748">
											<a href="product.html?variant=13520714661940"
												class="d-block cursor-default" data-js-product-image>
												<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
														class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
														data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1935457407_1_1_1_fa66f662-41f8-455c-9b7c-94d54a558537_{width}x.progressive.jpg?v=1547913669"
														data-aspect-ratio="0.78125"


														data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1935457407_1_1_1_fa66f662-41f8-455c-9b7c-94d54a558537_600x.progressive.jpg?v=1547913669 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1935457407_1_1_1_fa66f662-41f8-455c-9b7c-94d54a558537_600x@2x.progressive.jpg?v=1547913669 2x"


														data-image-id="4072955772980"
														alt="Hoodie with slogan">
												</div>
											</a>
											<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
												<a href="product.html?variant=13520714661940"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
													<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-hot>Hot
													</div>
													<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-new>New
													</div>
													<div class="label label--sale mb-3 mr-3 text-nowrap"
															data-js-product-label-sale>-25%
													</div>
													<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-out-stock>Out Stock
													</div>
												</div>
												<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
													<a href="product.html?variant=13520714661940"
														class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
														data-js-popup-button="quick-view"
														data-js-tooltip
														data-tippy-content="Quick View"
														data-tippy-placement="left"
														data-tippy-distance="5">
														<i>
															<svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-154"
																	viewBox="0 0 24 24">
																<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
															</svg>
														</i>
													</a>
												</div>
											</div>
											<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
												<a href="product.html?variant=13520714661940"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
													<div class="d-none-important" data-js-product-countdown>
														<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
													</div>
												</div>
												<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
													<div class="product-images-navigation d-flex">
														<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
																data-js-product-images-navigation="prev"><i
																class="mr-2"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-006"
																					viewBox="0 0 24 24"><path
																d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
														<span class="d-flex flex-center rounded-circle cursor-pointer"
																data-js-product-images-navigation="next"><i
																class="ml-3"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-007"
																					viewBox="0 0 24 24"><path
																d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="product-collection__content d-flex flex-column align-items-start mt-15">
											<div class="product-collection__title mb-3">
												<h4 class="h6 m-0">
													<a href="product.html?variant=13520714661940">Hoodie
														with slogan</a>
												</h4>
											</div>
											<div class="product-collection__details d-none mb-8">
												<div class="product-collection__sku mb-5">
													<p class="m-0" data-js-product-sku>SKU: <span>00152cda-1</span>
													</p>
												</div>
												<div class="product-collection__barcode mb-5">
													<p class="m-0" data-js-product-barcode>BARCODE:
														<span>1234567890</span></p>
												</div>
												<div class="product-collection__availability mb-5"><p class="m-0"
																										data-js-product-availability
																										data-availability="true">
													AVAILABILITY: <span>In stock (1 item)</span></p>
												</div>
												<div class="product-collection__type mb-5">
													<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Sweatshirts</span>
													</p>
												</div>
												<div class="product-collection__vendor mb-5">
													<p class="m-0" data-js-product-vendor>VENDOR:
														<span>Levi's</span></p>
												</div>
											</div>
											<div class="product-collection__description d-none mb-15">
												<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet
													conse ctetur adipisicing elit, sed do eiusmod tempor incididunt
													ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
													nostrud exercitation ullamco laboris nisi ut aliquip ex ea
													commodo consequat....</p>
											</div>
											<div class="product-collection__price mb-10">
												<span class="price price--sale" data-js-product-price
														data-js-show-sale-separator><span><span
														class=money>$280.00</span></span> from<span><span
														class=money>$210.00</span></span></span>
											</div>
											<form method="post" action="/cart/add" accept-charset="UTF-8"
													class="d-flex flex-column w-100 m-0" enctype="multipart/form-data"
													data-js-product-form=""><input type="hidden" name="form_type"
																					value="product"/><input
													type="hidden" name="utf8" value="✓"/>
												<div class="product-collection__options">

													<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
														<div><label class="d-none">Colour:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="text" data-property="colour">
																<div class="product-options__value product-options__value--text d-flex flex-center border cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="black"

																		data-bg="none"
																		data-scale="2"
																>Black
																</div>

																<div class="product-options__value product-options__value--text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="gainsboro"

																		data-bg="none"
																		data-scale="2"
																>Gainsboro
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="product-collection__variants mb-10 d-none">
													<select name="id" class="m-0" data-js-product-variants>
														<option selected="selected" value="13520714661940">Black
														</option>
														<option value="13520714727476">Gainsboro</option>
													</select>
												</div>
												<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
													<div class="product-collection__button-add-to-cart mb-10">
														<button type="submit"
																class="btn btn--status btn--animated js-product-button-add-to-cart"
																name="add" data-js-product-button-add-to-cart>
															<span class="d-flex flex-center"><i
																	class="btn__icon mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-109"
																	viewBox="0 0 24 24"><path
																	d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
																	class="btn__text">ADD TO CART</span></span>
															<span class="d-flex flex-center"
																	data-button-content="added"><i class="mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
																	d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
															<span class="d-flex flex-center"
																	data-button-content="sold-out">SOLD OUT</span>
														</button>
													</div>
													<div class="product-collection__buttons-section d-flex px-lg-10">
														<div class="product-collection__button-add-to-wishlist mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

																data-js-tooltip
																data-tippy-content="Wishlist"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-180"
																			viewBox="0 0 24 24">
																		<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-181"
																			viewBox="0 0 24 24">
																		<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-add-to-compare mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

																data-js-tooltip
																data-tippy-content="Compare"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-039"
																			viewBox="0 0 24 24">
																		<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-235"
																			viewBox="0 0 24 24">
																		<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
															<a href="product.html?variant=13520714661940"
																class="btn btn--text pt-2 px-lg-6 js-popup-button"
																data-js-popup-button="quick-view"
																data-js-tooltip
																data-tippy-content="Quick View"
																data-tippy-placement="top"
																data-tippy-distance="-2">
																<i>
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-154"
																			viewBox="0 0 24 24">
																		<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
																	</svg>
																</i>
															</a>
														</div>
													</div>
												</div>
											</form>
											<div class="product-collection__reviews">
												<div class="spr spr--empty-hide d-flex flex-column">
													<span class="shopify-product-reviews-badge"
															data-id="1463898931252"></span>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="carousel__item col-auto">
									<div class="product-collection d-flex flex-column mb-30" data-js-product
											data-js-product-json-preload data-product-handle="cotton-voile-shirt"
											data-product-variant-id="13520713318452"
									>
										<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
												data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4856423605_1_1_1_81a133d0-1a7f-4539-a347-b5cd7ad7e85b_{width}x.progressive.jpg?v=1540482157"
												data-js-product-image-hover-id="4072954953780">
											<a href="product.html?variant=13520713318452"
												class="d-block cursor-default" data-js-product-image>
												<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
														class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
														data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4857423800_1_1_1_14e40924-84fd-4eb6-8206-6ecb0f1e3ddb_{width}x.progressive.jpg?v=1540482157"
														data-aspect-ratio="0.78125"


														data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4857423800_1_1_1_14e40924-84fd-4eb6-8206-6ecb0f1e3ddb_600x.progressive.jpg?v=1540482157 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4857423800_1_1_1_14e40924-84fd-4eb6-8206-6ecb0f1e3ddb_600x@2x.progressive.jpg?v=1540482157 2x"


														data-image-id="4072954921012"
														alt="Cotton Voile Shirt">
												</div>
											</a>
											<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
												<a href="product.html?variant=13520713318452"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
													<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-hot>Hot
													</div>
													<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-new>New
													</div>
													<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-sale></div>
													<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-out-stock>Out Stock
													</div>
												</div>
												<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
													<a href="product.html?variant=13520713318452"
														class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
														data-js-popup-button="quick-view"
														data-js-tooltip
														data-tippy-content="Quick View"
														data-tippy-placement="left"
														data-tippy-distance="5">
														<i>
															<svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-154"
																	viewBox="0 0 24 24">
																<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
															</svg>
														</i>
													</a>
												</div>
											</div>
											<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
												<a href="product.html?variant=13520713318452"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
													<div class="d-none-important" data-js-product-countdown>
														<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
													</div>
												</div>
												<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
													<div class="product-images-navigation d-flex">
														<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
																data-js-product-images-navigation="prev"><i
																class="mr-2"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-006"
																					viewBox="0 0 24 24"><path
																d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
														<span class="d-flex flex-center rounded-circle cursor-pointer"
																data-js-product-images-navigation="next"><i
																class="ml-3"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-007"
																					viewBox="0 0 24 24"><path
																d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="product-collection__content d-flex flex-column align-items-start mt-15">
											<div class="product-collection__title mb-3">
												<h4 class="h6 m-0">
													<a href="product.html?variant=13520713318452">Cotton
														Voile Shirt</a>
												</h4>
											</div>
											<div class="product-collection__details d-none mb-8">
												<div class="product-collection__sku mb-5">
													<p class="m-0" data-js-product-sku>SKU: <span>00119ii</span></p>
												</div>
												<div class="product-collection__barcode mb-5">
													<p class="m-0" data-js-product-barcode>BARCODE:
														<span>1234567890</span></p>
												</div>
												<div class="product-collection__availability mb-5"><p class="m-0"
																										data-js-product-availability
																										data-availability="false">
													AVAILABILITY: <span>In stock (99999 items)</span></p>
												</div>
												<div class="product-collection__type mb-5">
													<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Sunglasses</span>
													</p>
												</div>
												<div class="product-collection__vendor mb-5">
													<p class="m-0" data-js-product-vendor>VENDOR:
														<span>Chanel</span></p>
												</div>
											</div>
											<div class="product-collection__description d-none mb-15">
												<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet
													conse ctetur adipisicing elit, sed do eiusmod tempor incididunt
													ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
													nostrud exercitation ullamco laboris nisi ut aliquip ex ea
													commodo consequat....</p>
											</div>
											<div class="product-collection__price mb-10">
												<span class="price" data-js-product-price
														data-js-show-sale-separator><span><span
														class=money>$165.00</span></span></span>
											</div>
											<form method="post" action="/cart/add" accept-charset="UTF-8"
													class="d-flex flex-column w-100 m-0" enctype="multipart/form-data"
													data-js-product-form=""><input type="hidden" name="form_type"
																					value="product"/><input
													type="hidden" name="utf8" value="✓"/>
												<div class="product-collection__options">

													<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
														<div><label class="d-none">Color:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="image" data-property="color">
																<div class="product-options__value product-options__value--square text-hide cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="black"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4857423800_1_1_1_14e40924-84fd-4eb6-8206-6ecb0f1e3ddb_[width]x.progressive.jpg?v=1540482157)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4857423800_1_1_1_14e40924-84fd-4eb6-8206-6ecb0f1e3ddb_92x.progressive.jpg?v=1540482157)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="Black"
																		data-tippy-placement="top"
																		data-tippy-distance="6">Black
																</div>


																<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
																		data-js-option-value
																		data-value="white"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4857423250_1_1_1_3591635e-f5f9-4a40-915c-97253cf68174_[width]x.progressive.jpg?v=1540482157)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4857423250_1_1_1_3591635e-f5f9-4a40-915c-97253cf68174_92x.progressive.jpg?v=1540482157)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="White"
																		data-tippy-placement="top"
																		data-tippy-distance="6">White
																</div>


																<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
																		data-js-option-value
																		data-value="firebrick"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4856423605_2_1_1_7e017eb1-1ff4-498a-b782-5a46d08d8da0_[width]x.progressive.jpg?v=1540482157)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/4856423605_2_1_1_7e017eb1-1ff4-498a-b782-5a46d08d8da0_92x.progressive.jpg?v=1540482157)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="FireBrick"
																		data-tippy-placement="top"
																		data-tippy-distance="6">FireBrick
																</div>
															</div>
														</div>
														<div><label class="d-none">Size:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="large-text" data-property="size">
																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="s"

																		data-bg="none"
																		data-scale="2"
																>S
																</div>

																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="m"

																		data-bg="none"
																		data-scale="2"
																>M
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="product-collection__variants mb-10 d-none">
													<select name="id" class="m-0" data-js-product-variants>
														<option selected="selected" value="13520713318452">Black /
															S
														</option>
														<option value="13520713351220">Black / M</option>
														<option value="13520713383988">White / S</option>
														<option value="13520713416756">White / M</option>
														<option value="13520713449524">FireBrick / S</option>
														<option value="13520713482292">FireBrick / M</option>
													</select>
												</div>
												<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
													<div class="product-collection__button-add-to-cart mb-10">
														<button type="submit"
																class="btn btn--status btn--animated js-product-button-add-to-cart"
																name="add" data-js-product-button-add-to-cart>
															<span class="d-flex flex-center"><i
																	class="btn__icon mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-109"
																	viewBox="0 0 24 24"><path
																	d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
																	class="btn__text">ADD TO CART</span></span>
															<span class="d-flex flex-center"
																	data-button-content="added"><i class="mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
																	d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
															<span class="d-flex flex-center"
																	data-button-content="sold-out">SOLD OUT</span>
														</button>
													</div>
													<div class="product-collection__buttons-section d-flex px-lg-10">
														<div class="product-collection__button-add-to-wishlist mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

																data-js-tooltip
																data-tippy-content="Wishlist"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-180"
																			viewBox="0 0 24 24">
																		<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-181"
																			viewBox="0 0 24 24">
																		<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-add-to-compare mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

																data-js-tooltip
																data-tippy-content="Compare"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-039"
																			viewBox="0 0 24 24">
																		<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-235"
																			viewBox="0 0 24 24">
																		<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
															<a href="product.html?variant=13520713318452"
																class="btn btn--text pt-2 px-lg-6 js-popup-button"
																data-js-popup-button="quick-view"
																data-js-tooltip
																data-tippy-content="Quick View"
																data-tippy-placement="top"
																data-tippy-distance="-2">
																<i>
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-154"
																			viewBox="0 0 24 24">
																		<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
																	</svg>
																</i>
															</a>
														</div>
													</div>
												</div>
											</form>
											<div class="product-collection__reviews">
												<div class="spr spr--empty-hide d-flex flex-column">
													<span class="shopify-product-reviews-badge"
															data-id="1463898832948"></span>
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="carousel__item col-auto">
									<div class="product-collection d-flex flex-column mb-30" data-js-product
											data-js-product-json-preload data-product-handle="print-sweater"
											data-product-variant-id="13520712859700"
									>
										<div class="product-collection__image product-image product-image--hover-fade position-relative w-100 js-product-images-navigation js-product-images-hovered-end js-product-images-hover"
												data-js-product-image-hover="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1938617800_2_1_1_922b902f-3d50-4cbd-a927-fe5f6de8b3f7_{width}x.progressive.jpg?v=1540482146"
												data-js-product-image-hover-id="4072954363956">
											<a href="product.html?variant=13520712859700"
												class="d-block cursor-default" data-js-product-image>
												<div class="rimage" style="padding-top:128.0%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
														class="rimage__img rimage__img--contain rimage__img--fade-in lazyload"
														data-master="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1938617800_1_1_1_6fdbc1b5-c9a4-49a1-9d66-4af6c6c3cc91_{width}x.progressive.jpg?v=1540482146"
														data-aspect-ratio="0.78125"


														data-srcset="https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1938617800_1_1_1_6fdbc1b5-c9a4-49a1-9d66-4af6c6c3cc91_600x.progressive.jpg?v=1540482146 1x, https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1938617800_1_1_1_6fdbc1b5-c9a4-49a1-9d66-4af6c6c3cc91_600x@2x.progressive.jpg?v=1540482146 2x"


														data-image-id="4072954331188"
														alt="Print sweater">
												</div>
											</a>
											<div class="product-image__overlay-top position-absolute d-flex flex-wrap top-0 left-0 w-100 px-10 pt-10">
												<a href="product.html?variant=13520712859700"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-top-left product-collection__labels position-relative d-flex flex-column align-items-start mb-10">
													<div class="label label--hot mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-hot>Hot
													</div>
													<div class="label label--new mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-new>New
													</div>
													<div class="label label--sale mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-sale></div>
													<div class="label label--out-stock mb-3 mr-3 text-nowrap d-none-important"
															data-js-product-label-out-stock>Out Stock
													</div>
												</div>
												<div class="product-image__overlay-top-right product-collection__button-quick-view position-lg-relative d-none d-lg-flex mb-lg-10 ml-lg-auto">
													<a href="product.html?variant=13520712859700"
														class="button-quick-view d-flex flex-center rounded-circle js-popup-button"
														data-js-popup-button="quick-view"
														data-js-tooltip
														data-tippy-content="Quick View"
														data-tippy-placement="left"
														data-tippy-distance="5">
														<i>
															<svg aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-154"
																	viewBox="0 0 24 24">
																<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
															</svg>
														</i>
													</a>
												</div>
											</div>
											<div class="product-image__overlay-bottom position-absolute d-flex justify-content-center justify-content-lg-start align-items-end bottom-0 left-0 w-100 px-10 pb-10">
												<a href="product.html?variant=13520712859700"
													class="absolute-stretch cursor-default"></a>
												<div class="product-image__overlay-bottom-left product-collection__countdown position-relative mt-10">
													<div class="d-none-important" data-js-product-countdown>
														<div class="countdown countdown--type-01 d-flex flex-wrap justify-content-center js-countdown"></div>
													</div>
												</div>
												<div class="product-image__overlay-bottom-right product-collection__images-navigation position-relative d-none d-lg-block mt-10 ml-auto">
													<div class="product-images-navigation d-flex">
														<span class="d-flex flex-center mr-3 rounded-circle cursor-pointer"
																data-js-product-images-navigation="prev"><i
																class="mr-2"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-006"
																					viewBox="0 0 24 24"><path
																d="M16.736 3.417a.652.652 0 0 1-.176.449l-8.32 8.301 8.32 8.301c.117.13.176.28.176.449s-.059.319-.176.449a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.93.93 0 0 1-.215-.127l-8.75-8.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l8.75-8.75a.652.652 0 0 1 .449-.176c.169 0 .319.059.449.176.117.13.176.28.176.449z"/></svg></i></span>
														<span class="d-flex flex-center rounded-circle cursor-pointer"
																data-js-product-images-navigation="next"><i
																class="ml-3"><svg aria-hidden="true"
																					focusable="false"
																					role="presentation"
																					class="icon icon-theme-007"
																					viewBox="0 0 24 24"><path
																d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/></svg></i></span>
													</div>
												</div>
											</div>
										</div>
										<div class="product-collection__content d-flex flex-column align-items-start mt-15">
											<div class="product-collection__title mb-3">
												<h4 class="h6 m-0">
													<a href="product.html?variant=13520712859700">Print
														sweater</a>
												</h4>
											</div>
											<div class="product-collection__details d-none mb-8">
												<div class="product-collection__sku mb-5">
													<p class="m-0" data-js-product-sku>SKU: <span>00109cda4-1</span>
													</p>
												</div>
												<div class="product-collection__barcode mb-5">
													<p class="m-0" data-js-product-barcode>BARCODE:
														<span>1234567890</span></p>
												</div>
												<div class="product-collection__availability mb-5"><p class="m-0"
																										data-js-product-availability
																										data-availability="false">
													AVAILABILITY: <span>In stock (99999 items)</span></p>
												</div>
												<div class="product-collection__type mb-5">
													<p class="m-0" data-js-product-type>PRODUCT TYPE: <span>Beachwear</span>
													</p>
												</div>
												<div class="product-collection__vendor mb-5">
													<p class="m-0" data-js-product-vendor>VENDOR:
														<span>Lacoste</span></p>
												</div>
											</div>
											<div class="product-collection__description d-none mb-15">
												<p class="m-0">Sample Paragraph Text Lorem ipsum dolor sit amet
													conse ctetur adipisicing elit, sed do eiusmod tempor incididunt
													ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
													nostrud exercitation ullamco laboris nisi ut aliquip ex ea
													commodo consequat....</p>
											</div>
											<div class="product-collection__price mb-10">
												<span class="price" data-js-product-price
														data-js-show-sale-separator><span><span
														class=money>$270.00</span></span></span>
											</div>
											<form method="post" action="/cart/add" accept-charset="UTF-8"
													class="d-flex flex-column w-100 m-0" enctype="multipart/form-data"
													data-js-product-form=""><input type="hidden" name="form_type"
																					value="product"/><input
													type="hidden" name="utf8" value="✓"/>
												<div class="product-collection__options">

													<div class="product-options product-options--type-collection js-product-options" data-js-product-options>
														<div><label class="d-none">Color:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="image" data-property="color">
																<div class="product-options__value product-options__value--square text-hide cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="white"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1938617800_1_1_1_6fdbc1b5-c9a4-49a1-9d66-4af6c6c3cc91_[width]x.progressive.jpg?v=1540482146)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1938617800_1_1_1_6fdbc1b5-c9a4-49a1-9d66-4af6c6c3cc91_92x.progressive.jpg?v=1540482146)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="White"
																		data-tippy-placement="top"
																		data-tippy-distance="6">White
																</div>


																<div class="product-options__value product-options__value--square text-hide cursor-pointer lazyload"
																		data-js-option-value
																		data-value="black"

																		data-master="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1939330800_2_2_1_e54016fa-5680-4b78-a1bd-0113c0652f10_[width]x.progressive.jpg?v=1540482146)"
																		data-bg="url(https://cdn.shopify.com/s/files/1/0026/2910/7764/products/1939330800_2_2_1_e54016fa-5680-4b78-a1bd-0113c0652f10_92x.progressive.jpg?v=1540482146)"
																		data-scale="2"
																		data-js-tooltip
																		data-tippy-content="Black"
																		data-tippy-placement="top"
																		data-tippy-distance="6">Black
																</div>
															</div>
														</div>
														<div><label class="d-none">Size:</label>
															<div class="product-options__section d-flex flex-wrap"
																	data-style="large-text" data-property="size">
																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer active lazyload"
																		data-js-option-value
																		data-value="s"

																		data-bg="none"
																		data-scale="2"
																>S
																</div>

																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="m"

																		data-bg="none"
																		data-scale="2"
																>M
																</div>


																<div class="product-options__value product-options__value--large-text d-flex flex-center border cursor-pointer lazyload"
																		data-js-option-value
																		data-value="l"

																		data-bg="none"
																		data-scale="2"
																>L
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="product-collection__variants mb-10 d-none">
													<select name="id" class="m-0" data-js-product-variants>
														<option selected="selected" value="13520712859700">White /
															S
														</option>
														<option value="13520712892468">White / M</option>
														<option value="13520712925236">White / L</option>
														<option value="13520712958004">Black / S</option>
														<option value="13520712990772">Black / M</option>
														<option value="13520713023540">Black / L</option>
													</select>
												</div>
												<div class="product-collection__buttons d-flex flex-column flex-lg-row align-items-lg-center flex-wrap mt-5 mt-lg-10">
													<div class="product-collection__button-add-to-cart mb-10">
														<button type="submit"
																class="btn btn--status btn--animated js-product-button-add-to-cart"
																name="add" data-js-product-button-add-to-cart>
															<span class="d-flex flex-center"><i
																	class="btn__icon mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-109"
																	viewBox="0 0 24 24"><path
																	d="M19.884 21.897a.601.601 0 0 1-.439.186h-15a.6.6 0 0 1-.439-.186.601.601 0 0 1-.186-.439v-15a.6.6 0 0 1 .186-.439.601.601 0 0 1 .439-.186h3.75c0-1.028.368-1.911 1.104-2.646.735-.735 1.618-1.104 2.646-1.104s1.911.368 2.646 1.104c.735.736 1.104 1.618 1.104 2.646h3.75a.6.6 0 0 1 .439.186.601.601 0 0 1 .186.439v15a.604.604 0 0 1-.186.439zM18.819 7.083h-3.125v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5h-5v2.5a.598.598 0 0 1-.186.439c-.124.124-.271.186-.439.186s-.315-.062-.439-.186a.6.6 0 0 1-.186-.439v-2.5H5.069v13.75h13.75V7.083zm-8.642-3.018a2.409 2.409 0 0 0-.733 1.768h5c0-.69-.244-1.279-.732-1.768s-1.077-.732-1.768-.732-1.279.244-1.767.732z"/></svg></i><span
																	class="btn__text">ADD TO CART</span></span>
															<span class="d-flex flex-center"
																	data-button-content="added"><i class="mr-5 mb-4"><svg
																	aria-hidden="true" focusable="false"
																	role="presentation" class="icon icon-theme-110"
																	viewBox="0 0 24 24"><path
																	d="M19.855 5.998a.601.601 0 0 0-.439-.186h-3.75c0-1.028-.368-1.911-1.104-2.646-.735-.735-1.618-1.104-2.646-1.104s-1.911.369-2.646 1.104c-.736.736-1.104 1.618-1.104 2.647h-3.75a.6.6 0 0 0-.439.186.598.598 0 0 0-.186.439v15a.6.6 0 0 0 .186.439c.124.123.27.186.439.186h15a.6.6 0 0 0 .439-.186.601.601 0 0 0 .186-.439v-15a.602.602 0 0 0-.186-.44zm-9.707-1.953c.488-.488 1.077-.732 1.768-.732s1.279.244 1.768.732.732 1.078.732 1.768h-5c0-.69.244-1.28.732-1.768zm6.926 7.194l-6.25 6.25a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .896.896 0 0 1-.215-.127l-2.5-2.5a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449.13-.117.28-.176.449-.176s.319.059.449.176l2.051 2.07 5.801-5.82c.13-.117.28-.176.449-.176s.319.059.449.176c.117.13.176.28.176.449a.652.652 0 0 1-.176.449z"/></svg></i>ADDED</span>
															<span class="d-flex flex-center"
																	data-button-content="sold-out">SOLD OUT</span>
														</button>
													</div>
													<div class="product-collection__buttons-section d-flex px-lg-10">
														<div class="product-collection__button-add-to-wishlist mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-wishlist"

																data-js-tooltip
																data-tippy-content="Wishlist"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-180"
																			viewBox="0 0 24 24">
																		<path d="M21.486 6.599a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.546-.964 1.168-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.5-.431-2.196zm-1.162 3.916a4.436 4.436 0 0 1-.967 1.445l-7.441 7.441-7.441-7.441c-.417-.417-.739-.898-.967-1.445s-.342-1.12-.342-1.719.114-1.172.342-1.719.55-1.035.967-1.465c.442-.43.94-.755 1.494-.977s1.116-.332 1.689-.332a4.496 4.496 0 0 1 3.467 1.641c.098.117.186.241.264.371.117.169.293.254.527.254s.41-.085.527-.254c.078-.13.166-.254.264-.371s.198-.228.303-.332a4.5 4.5 0 0 1 3.164-1.309c.573 0 1.136.11 1.689.332s1.052.547 1.494.977c.417.43.739.918.967 1.465s.342 1.12.342 1.719-.114 1.172-.342 1.719z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-181"
																			viewBox="0 0 24 24">
																		<path d="M21.861 6.568a5.661 5.661 0 0 0-1.25-1.865c-.56-.56-1.191-.979-1.895-1.26a5.77 5.77 0 0 0-4.326 0c-.71.28-1.345.7-1.904 1.26-.026.039-.056.075-.088.107l-.107.107-.107-.107a.706.706 0 0 1-.088-.107c-.56-.56-1.194-.979-1.904-1.26s-1.433-.42-2.168-.42-1.455.14-2.158.42-1.335.7-1.895 1.26c-.547.547-.964 1.169-1.25 1.865s-.43 1.429-.43 2.197.144 1.501.43 2.197.703 1.318 1.25 1.865l7.871 7.871c.003.003.007.004.011.006l.439.436.439-.437c.003-.002.007-.003.01-.006l7.871-7.871c.547-.547.964-1.169 1.25-1.865s.43-1.429.43-2.197-.145-1.499-.431-2.196z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-add-to-compare mb-10">
															<a href="/account"
																class="btn btn--text btn--status px-lg-6 js-store-lists-add-compare"

																data-js-tooltip
																data-tippy-content="Compare"
																data-tippy-placement="top"
																data-tippy-distance="-3">
																<i class="mb-1 ml-1">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-039"
																			viewBox="0 0 24 24">
																		<path d="M23.408 19.784c-.01.007-.024.012-.035.02l-4.275-12.11.005-.014-.011-.004-.114-.323v-.061h-6.394v-4.75a.6.6 0 0 0-.186-.439c-.124-.124-.271-.186-.439-.186s-.315.062-.439.186a.601.601 0 0 0-.186.439v4.75H4.939v.062l-.114.322-.011.004.005.014L.544 19.803c-.01-.007-.025-.012-.035-.02l-.388 1.081c1.345.846 3.203 1.363 5.286 1.363 2.08 0 3.935-.515 5.279-1.359l-.019-.054.02-.007L6.326 8.458H17.59l-4.36 12.349.02.007-.019.054c1.344.844 3.199 1.359 5.279 1.359 2.083 0 3.941-.517 5.286-1.363l-.388-1.08zm-14.122.563c-1.085.486-2.434.781-3.88.781-1.423 0-2.749-.288-3.825-.761l.326-.924h7.06l.319.904zm-.71-2.013H2.299l3.138-8.888 3.139 8.888zm9.903-8.888l3.138 8.888h-6.276l3.138-8.888zm.031 11.682c-1.446 0-2.796-.295-3.88-.781l.319-.904h7.06l.326.924c-1.076.473-2.402.761-3.825.761z"/>
																	</svg>
																</i>
																<i class="mb-1 ml-1" data-button-content="added">
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-235"
																			viewBox="0 0 24 24">
																		<path d="M23.4 19.8l-2.3-6.6c1.7-1.3 2.8-3.4 2.8-5.8 0-4.1-3.3-7.4-7.4-7.4-4 0-7.3 3.2-7.4 7.2H4.9v.1l-.1.4L.5 19.8l-.4 1.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4v-.1L6.3 8.5h2.9c.4 3.2 3 5.8 6.2 6.3l-2.1 6.1v.1c1.3.8 3.2 1.4 5.3 1.4 2.1 0 3.9-.5 5.3-1.4l-.5-1.2zm-14.1.5c-1.1.5-2.4.8-3.9.8-1.4 0-2.7-.3-3.8-.8l.3-.9H9l.3.9zm-.7-2H2.3l3.1-8.9 3.2 8.9zm6.6-6.9c-.1.1-.1.1-.2.1h-.2-.2c-.1 0-.1-.1-.2-.1l-2.5-2.5c-.1-.1-.2-.3-.2-.4s.1-.3.2-.4c.1-.1.3-.2.4-.2s.3.1.4.2l2.1 2.1 5.8-5.8c.1-.3.3-.4.4-.4s.3.1.4.2c.1.1.2.3.2.4s0 .4-.1.5l-6.3 6.3zm1.4 3.4c1.3 0 2.4-.3 3.5-.9l1.6 4.4h-6.3l1.2-3.5zm1.9 6.3c-1.4 0-2.8-.3-3.9-.8l.3-.9H22l.3.9c-1 .5-2.4.8-3.8.8z"/>
																	</svg>
																</i>
															</a>
														</div>
														<div class="product-collection__button-quick-view-mobile d-lg-none mb-10">
															<a href="product.html?variant=13520712859700"
																class="btn btn--text pt-2 px-lg-6 js-popup-button"
																data-js-popup-button="quick-view"
																data-js-tooltip
																data-tippy-content="Quick View"
																data-tippy-placement="top"
																data-tippy-distance="-2">
																<i>
																	<svg aria-hidden="true" focusable="false"
																			role="presentation"
																			class="icon icon-theme-154"
																			viewBox="0 0 24 24">
																		<path d="M8.528 17.238c-1.107-.592-2.074-1.25-2.9-1.973-.827-.723-1.491-1.393-1.992-2.012-.501-.618-.771-.96-.811-1.025a.571.571 0 0 1-.117-.352c0-.13.039-.247.117-.352.039-.064.306-.406.801-1.025.495-.618 1.159-1.289 1.992-2.012.833-.723 1.803-1.38 2.91-1.973a7.424 7.424 0 0 1 3.555-.889c1.263 0 2.448.297 3.555.889 1.106.593 2.073 1.25 2.9 1.973.827.723 1.491 1.394 1.992 2.012.501.619.771.961.811 1.025a.573.573 0 0 1 .117.352.656.656 0 0 1-.117.371c-.039.053-.31.391-.811 1.016-.501.625-1.169 1.296-2.002 2.012-.833.717-1.804 1.371-2.91 1.963a7.375 7.375 0 0 1-3.535.889 7.415 7.415 0 0 1-3.555-.889zm.869-9.746c-.853.41-1.631.889-2.334 1.436s-1.312 1.101-1.826 1.66c-.515.561-.889.99-1.123 1.289.234.3.608.729 1.123 1.289.514.561 1.123 1.113 1.826 1.66s1.484 1.025 2.344 1.436 1.751.615 2.676.615c.924 0 1.813-.205 2.666-.615.853-.41 1.634-.889 2.344-1.436.709-.547 1.318-1.1 1.826-1.66.508-.56.885-.989 1.133-1.289a41.634 41.634 0 0 0-1.133-1.289c-.508-.56-1.113-1.113-1.816-1.66s-1.484-1.025-2.344-1.436-1.751-.615-2.676-.615c-.937 0-1.833.205-2.686.615zm.04 7.031c-.736-.735-1.104-1.617-1.104-2.646 0-1.028.368-1.91 1.104-2.646.735-.735 1.618-1.104 2.646-1.104 1.028 0 1.911.368 2.646 1.104.735.736 1.104 1.618 1.104 2.646 0 1.029-.368 1.911-1.104 2.646-.736.736-1.618 1.104-2.646 1.104-1.029 0-1.911-.367-2.646-1.104zm.878-4.414a2.41 2.41 0 0 0-.732 1.768c0 .69.244 1.279.732 1.768s1.077.732 1.768.732c.69 0 1.279-.244 1.768-.732s.732-1.077.732-1.768c0-.689-.244-1.279-.732-1.768s-1.078-.732-1.768-.732-1.279.244-1.768.732z"/>
																	</svg>
																</i>
															</a>
														</div>
													</div>
												</div>
											</form>
											<div class="product-collection__reviews">
												<div class="spr spr--empty-hide d-flex flex-column">
													<span class="shopify-product-reviews-badge"
															data-id="1463898767412"></span>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
						<div class="carousel__next position-absolute cursor-pointer" data-js-carousel-next><i>
							<svg aria-hidden="true" focusable="false" role="presentation"
									class="icon icon-theme-007" viewBox="0 0 24 24">
								<path d="M6.708 20.917c0-.169.059-.319.176-.449l8.32-8.301-8.32-8.301a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l8.75 8.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-8.75 8.75a.91.91 0 0 1-.215.127c-.078.032-.156.049-.234.049s-.156-.017-.234-.049a.91.91 0 0 1-.215-.127.652.652 0 0 1-.176-.449z"/>
							</svg>
						</i></div>
					</div>

				</div>
			</div>
			<script>
				Loader.require({
					type: "style",
					name: "plugin_slick"
				});

				Loader.require({
					type: "script",
					name: "carousel_products"
				});
			</script>

		</div>
	</div>
</div>
