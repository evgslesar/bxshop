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

$dateCreate = CIBlockFormatProperties::DateFormat(
	'j M Y', 
	MakeTimeStamp(
		$arResult["TIMESTAMP_X"], 
		CSite::GetDateFormat()
	)
);
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
									array(
										"ACTIVE_DATE_FORMAT" => "j F Y",
										"CACHE_GROUPS" => "Y",
										"CACHE_TIME" => "300",
										"CACHE_TYPE" => "A",
										"DETAIL_URL" => "#SITE_DIR#//notes/?ELEMENT_ID=#ELEMENT_ID#",
										"FIELD_CODE" => array(
											0 => "CREATED_USER_NAME",
											1 => "",
										),
										"IBLOCKS" => array(
											0 => "3",
										),
										"IBLOCK_TYPE" => "articles",
										"NEWS_COUNT" => "3",
										"SORT_BY1" => "ACTIVE_FROM",
										"SORT_BY2" => "SORT",
										"SORT_ORDER1" => "DESC",
										"SORT_ORDER2" => "ASC",
										"COMPONENT_TEMPLATE" => "sidebar_recent"
									),
									false
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

	<div class="article__body article__body--max-width">
		<div id="theme-section-article-body" class="theme-section">
			<div data-section-id="article-body" data-section-type="article-body">
				<article class="article-body mt-30">
					<header class="mb-25 text-center">
						<h2 class="mb-0"><?=$arResult["NAME"]?></h2>

						<p class="mt-15 mb-0 font-italic">
							<time datetime="<?echo $arResult["TIMESTAMP_X"]?>"><?echo $dateCreate;?></time>
							Автор: <?php echo $arResult["CREATED_USER_NAME"]?>
						</p>
					</header>
					<div class="text-center mb-40">
						<div class="rimage" style="padding-top:72.98701298701299%;"><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
								class="rimage__img rimage__img--fade-in lazyload"
								data-master="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
								data-aspect-ratio="1.3701067615658362"


								data-srcset="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"

								alt="<?=$arItem["DETAIL_PICTURE"]["ALT"]?>">
						</div>
					</div>
					<div class="rte">

						<?echo $arResult["DETAIL_TEXT"];?>

					</div>
					<div class="clearfix"></div>
					<div class="mt-35">
						<div class="row">
							<div class="col-12 col-md-1 pr-md-5 mb-20 mb-md-0">
								<p class="mt-5 mb-0">TAGS:</p>
							</div>
							<div class="col-12 col-md-11 d-flex flex-wrap pl-md-5">
								<a
									href="/blogs/blog/tagged/vintage"
									class="link-revert py-4 px-10 mr-10 mb-10 border border-hover">
									Vintage
								</a>
								<?
								foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

									<?=$arProperty["NAME"]?>:&nbsp;
									<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
										<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
									<?else:?>
										<?=$arProperty["DISPLAY_VALUE"];?>
									<?endif?>
									<br />
								<?endforeach;?>

							</div>
						</div>
					</div>
					<div class="article__nav py-55 mt-40 border-top">
						<div class="d-flex">
							<div class="d-flex flex-column w-50">
								<?if($arResult["NAV_RESULT"]):?>
									<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
									<?echo $arResult["NAV_TEXT"];?>
									<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>		
								<?endif?>

							</div>
						</div>
					</div>
					<?
					if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
					{
						?>
						<div class="news-detail-share">
							<noindex>
							<?
							$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
									"HANDLERS" => $arParams["SHARE_HANDLERS"],
									"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
									"PAGE_TITLE" => $arResult["~NAME"],
									"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
									"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
									"HIDE" => $arParams["SHARE_HIDE"],
								),
								$component,
								array("HIDE_ICONS" => "Y")
							);
							?>
							</noindex>
						</div>
						<?
					} 
					?>
				</article>
			</div>

			<script>
				Loader.require({
					type: "script",
					name: "plugin_slick"
				});

				Loader.require({
					type: "script",
					name: "article_body"
				});
			</script>


		</div>
	</div>
</div>

