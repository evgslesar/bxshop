<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<div class="header__nav d-none d-lg-flex" data-js-position-desktop="menu">
		<nav class="menu js-menu js-position" data-js-position-name="menu">

		<div class="menu__panel menu__list menu__level-01 d-flex flex-column flex-lg-row flex-lg-wrap menu__panel--bordered">
			<div class="menu__curtain d-none position-lg-absolute"></div>
			<?
			$previousLevel = 0;
			foreach($arResult as $arItem):?>

			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</div></div></div>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]):?>

				<?if ($arItem["DEPTH_LEVEL"] == 1):?>

					<div class="menu__item menu__item--has-children position-lg-relative">
						<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected <?endif?>d-flex align-items-center px-lg-7">
							<span><?=$arItem["TEXT"]?></span> 
							<i class="d-none d-lg-inline position-lg-relative">
								<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-229" viewBox="0 0 24 24">
									<path d="M11.783 14.088l-3.75-3.75a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176l3.301 3.32 3.301-3.32a.65.65 0 0 1 .449-.176c.169 0 .318.059.449.176.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .841.841 0 0 1-.215-.127z" />
								</svg>
							</i>
							<i class="d-lg-none ml-auto">
								<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-theme-231" viewBox="0 0 24 24">
									<path d="M10.806 7.232l3.75 3.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .877.877 0 0 1-.215-.127.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l3.32-3.301L9.907 8.13a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.058.45.176z" />
								</svg>
							</i>
						</a>
						<div class="menu__dropdown d-lg-none position-lg-absolute">
							<div class="menu__list menu__list--styled menu__level-02 menu__level-02 p-lg-20">
								<div class="menu__item menu__back d-lg-none"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div>
				<?else:?>
					<div class="menu__item menu__item--has-children position-lg-relative">
						<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected <?endif?>d-flex align-items-center px-lg-5">
							<span><?=$arItem["TEXT"]?></span>
							<i class="ml-auto">
								<svg aria-hidden="true" focusable="false"
										role="presentation" class="icon icon-theme-231"
										viewBox="0 0 24 24">
									<path d="M10.806 7.232l3.75 3.75c.117.13.176.28.176.449a.652.652 0 0 1-.176.449l-3.75 3.75a.877.877 0 0 1-.215.127.596.596 0 0 1-.468 0 .877.877 0 0 1-.215-.127.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449l3.32-3.301L9.907 8.13a.652.652 0 0 1-.176-.449c0-.169.059-.319.176-.449a.652.652 0 0 1 .449-.176c.169 0 .319.058.45.176z"/>
								</svg>
							</i>
						</a>
						<div class="menu__list p-lg-15 menu__level-03 position-lg-absolute">
							<div>
							<div class="menu__item menu__back d-lg-none"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"] ?></a></div>
				<?endif?>

			<?else:?>

				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
					<div class="menu__item">
						<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected <?endif?>d-flex align-items-center px-lg-7">
							<span><?=$arItem["TEXT"]?></span> 
						</a>
					</div>
				<?else:?>
					<div class="menu__item">
						<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected <?endif?>d-flex align-items-center px-lg-5">
							<span><?=$arItem["TEXT"]?></span> 
						</a>
					</div>
				<?endif?>
			<?endif?>

			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>



			<?endforeach?>
			<?if ($previousLevel > 1)://close last item tags?>
				<?=str_repeat("</div></div></div>", ($previousLevel-1) );?>
			<?endif?>


			<div class="menu__item ">

				<a href="http://bit.ly/2UXO8zH" class="d-flex align-items-center px-lg-7"><span>Buy Now!</span></a>
			</div>

			</div>

		</nav>
	</div>

<?endif?>