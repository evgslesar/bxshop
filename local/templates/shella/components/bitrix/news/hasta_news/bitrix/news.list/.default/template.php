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
$this->setFrameMode(true);
?>

<div class="row mb-60">
	<div class="blogs__sidebar blogs__sidebar--width-md blogs__sidebar--offset-bottom d-none col-auto d-lg-block order-2"
			data-sticky-sidebar-parent>
		<div class="js-sticky-sidebar">
			<div data-js-position-desktop="sidebar-blog" data-sticky-sidebar-inner>
				<div id="theme-section-blog-sidebar" class="theme-section">
					<div data-section-id="blog-sidebar" data-section-type="blog-sidebar">
						<aside class="blog-sidebar pb-50 js-position" data-js-position-name="sidebar-blog">
							<div class="blog-sidebar__layer-navigation pt-lg-40"><h3 class="h5 mb-15">
								ABOUT</h3>
								<div class="rte pb-25">


									<div class="d-flex flex-column align-items-center text-center">
										<div class="row no-gutters justify-content-center">
											<div class="col-6">
												<div class="rounded-circle overflow-hidden">
													<img src="https://cdn.shopify.com/s/files/1/0026/2956/6516/files/11_4a15381b-ed2a-4afb-b547-c3d1badf18c3.png?12775322482103733020"
															alt="About">
												</div>
											</div>
										</div>
										<h4 class="mt-20 mb-0">Annie Greenberg</h4>
										<p class="mt-15 mb-0">Lorem ipsum dolor sit amet conse ctetur
											adipisicing elit, sed do eiusmod tempor incididunt ut labore et
											dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
											exercitation. Lorem ipsum dolor sit amet conse ctetur
											adipisicing eli.</p>
										<div class="row no-gutters justify-content-center mt-20">
											<div class="col-6">
												<div class="rounded-circle overflow-hidden">
													<img src="https://cdn.shopify.com/s/files/1/0026/2956/6516/files/blogs-about.png?9425565926943578041"
															alt="About">
												</div>
											</div>
										</div>
									</div>

								</div>
								<div class="border-top"></div>
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu",
									"sidebar_categories",
									Array(
										"ALLOW_MULTI_SELECT" => "N",
										"CHILD_MENU_TYPE" => "left",
										"DELAY" => "N",
										"MAX_LEVEL" => "1",
										"MENU_CACHE_GET_VARS" => array(""),
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_USE_GROUPS" => "Y",
										"ROOT_MENU_TYPE" => "sidebar_cats_sh",
										"USE_EXT" => "Y"
									)
								);?>
								<div class="border-top"></div>
								<?$APPLICATION->IncludeComponent(
									"bitrix:news.line",
									"sidebar_recent",
									Array(
										"ACTIVE_DATE_FORMAT" => "j F Y",
										"CACHE_GROUPS" => "Y",
										"CACHE_TIME" => "300",
										"CACHE_TYPE" => "A",
										"DETAIL_URL" => "",
										"FIELD_CODE" => array(0=>"CREATED_USER_NAME",1=>"",),
										"IBLOCKS" => array(0=>"3",),
										"IBLOCK_TYPE" => "articles",
										"NEWS_COUNT" => "3",
										"SORT_BY1" => "ACTIVE_FROM",
										"SORT_BY2" => "SORT",
										"SORT_ORDER1" => "DESC",
										"SORT_ORDER2" => "ASC"
									)
								);?>
								<div class="border-top"></div>
								<h3 class="h5 pt-25 mb-15">TAGS</h3>
								<div class="blog-sidebar__tags d-flex flex-wrap pb-20"><a
										href="blog.html/tagged/awesome"
										class="link-revert py-4 px-10 mr-10 mb-10 border border-hover">Awesome</a><a
										href="blog.html/tagged/cool"
										class="link-revert py-4 px-10 mr-10 mb-10 border border-hover">Cool</a><a
										href="blog.html/tagged/nice"
										class="link-revert py-4 px-10 mr-10 mb-10 border border-hover">Nice</a><a
										href="blog.html"
										class="link-revert py-4 px-10 mr-10 mb-10 border border-hover">Summer</a>
								</div>
								<div class="border-top"></div>
								<h3 class="h5 pt-25 mb-15">NEWSLETTER SUBSCRIPTION</h3>
								<p>Sign up for Shella updates to receive information about new arrivals,
									future events and specials.</p>
								<form action="/subscribe/post?u=8a50b61e56896303a04d0243e&amp;id=3c3d06b907"
										method="post" class="d-flex flex-column flex-lg-row mb-15"
										target="_blank">
									<input type="email" name="EMAIL" class="mb-0 mr-lg-10"
											placeholder="Enter your email address" required="required">
									<input type="submit" class="btn mt-10 mt-lg-0" value="SUBSCRIBE!">
								</form>
							</div>
						</aside>
					</div>

					<script>
						Loader.require({
							type: "script",
							name: "blog_sidebar"
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

	<div class="blogs__body">

		<div id="theme-section-blog-body" class="theme-section">

			<div data-section-id="blog-body" data-section-type="blog-body">
				<div class="blog-body mt-30">

					<?foreach($arResult["ITEMS"] as $arItem):?>
						<?
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						$dateCreate = CIBlockFormatProperties::DateFormat(
							'j M Y', 
							MakeTimeStamp(
								$arItem["TIMESTAMP_X"], 
								CSite::GetDateFormat()
							)
						);
						$count = 1;
						
						?>
						<div class="post post--limit-width mb-40 text-center" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?php if($count>1){ ?><div class="border-top mb-35"></div><?php }; $count++; ?>
							<h3 class="mb-15">
								<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
							</h3>

							<p class="mb-0 font-italic">
								<time datetime="<?echo $arItem["TIMESTAMP_X"]?>"><?echo $dateCreate;?></time>
								Автор: <?php echo $arItem["CREATED_USER_NAME"]?>
							</p>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="d-block mt-25 overflow-hidden">
								<div class="rimage" style="padding-top:72.98701298701299%;">
									<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
										class="rimage__img rimage__img--fade-in lazyload"
										data-master="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
										data-aspect-ratio="1.3701067615658362"


										data-srcset="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"

										alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>">
								</div>
							</a>
							<div class="rte mt-30">
								<span><?echo $arItem["PREVIEW_TEXT"];?></span>
							</div>
							<div class="d-flex flex-column flex-lg-row flex-center position-relative mt-25">
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn"><?=GetMessage("BLOG_READ_MORE")?></a>
							</div>
						</div>
					<?endforeach;?>

				</div>
			</div>
			<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
				<br /><?=$arResult["NAV_STRING"]?>
			<?endif;?>
			<script>


			Loader.require({
				type: "script",
				name: "blog_body"
			});
			</script>

		</div>
	</div>
</div>
