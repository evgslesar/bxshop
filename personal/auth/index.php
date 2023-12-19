<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");
?>
<main id="mt-main">
	<!-- Mt Content Banner of the Page -->
	<section class="mt-contact-banner style4 wow fadeInUp" data-wow-delay="0.4s">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
			<h1><?php echo $APPLICATION->GetTitle(); ?></h1>
			<!-- Breadcrumbs of the Page -->
			<nav class="breadcrumbs">
				<?$APPLICATION->IncludeComponent(
					"bitrix:breadcrumb", 
					"breadcrumbs", 
					array(
						"PATH" => "",
						"SITE_ID" => "s1",
						"START_FROM" => "0",
						"COMPONENT_TEMPLATE" => "breadcrumbs"
					),
					false
				);?>
			</nav>
			<!-- Breadcrumbs of the Page end -->
			</div>
		</div>
	</div>
</section>
	<!-- Mt Content Banner of the Page end -->
	<!-- Mt About Section of the Page -->
	<section class="mt-about-sec" style="padding-bottom: 0;">
		<div class="container">
		<div class="row">
			<div class="col-xs-12">
			<div class="txt">
				<!-- <h2>LOGIN</h2> -->
				<p>Morbi in erat malesuada, sollicitudin massa at, tristique nisl. Maecenas id eros scelerisque, vulputate tortor quis, efficitur arcu sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Umco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit sse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat <strong>Vestibulum sit amet metus euismod, condimentum lectus id, ultrices sem.</strong></p>
			</div>
			</div>
		</div>
		</div>
	</section>
	<!-- Mt About Section of the Page -->
	<!-- Mt Detail Section of the Page -->
	<section class="mt-detail-sec toppadding-zero">
		<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-10 col-sm-push-1">
			<div class="holder" style="margin: 0;">
				<div class="mt-side-widget">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.auth.form", 
						"flat", 
						array(
							"AUTH_FORGOT_PASSWORD_URL" => "getpassword.php?forgot_password=yes",
							"AUTH_REGISTER_URL" => "registration.php",
							"AUTH_SUCCESS_URL" => "/personal/",
							"COMPONENT_TEMPLATE" => "flat"
						),
						false
					);?>

					<!-- <form action="#">
                        <fieldset>
                          <input type="text" placeholder="Username or email address" class="input">
                          <input type="password" placeholder="Password" class="input">
                          <div class="box">
                            <span class="left"><input class="checkbox" type="checkbox" id="check1"><label for="check1">Remember Me</label></span>
                            <a href="#" class="help">Help?</a>
                          </div>
                          <button type="submit" class="btn-type1">Login</button>
                        </fieldset>
                    </form> -->
				</div>
			</div>
			</div>
		</div>
		</div>
	</section>
	<!-- Mt Detail Section of the Page end -->
	<div class="container">
		<div class="row">
		<div class="col-xs-12">
			<!-- banner frame start here -->
			<div class="banner-frame toppadding-zero">
			<!-- banner 5 white start here -->
			<div class="banner-5 white wow fadeInLeft" data-wow-delay="0.4s">
				<img src="http://placehold.it/590x565" alt="image description">
				<div class="holder">
				<div class="texts">
					<strong class="title">FURNITURE DESIGNS IDEAS</strong>
					<h3><strong>New</strong> Collection</h3>
					<p>Consectetur adipisicing elit. Beatae accusamus, optio, repellendus inventore</p>
					<span class="price-add">$ 79.00</span>
				</div>
				</div>
			</div><!-- banner 5 white end here -->
			<!-- banner 6 white start here -->
			<div class="banner-6 white wow fadeInRight" data-wow-delay="0.4s">
				<img src="http://placehold.it/275x565" alt="image description">
				<div class="holder">
				<strong class="sub-title">SOFAS &amp; ARMCHAIRS</strong>
				<h3>3 Seater Leather Sofa</h3>
				<span class="offer">
					<span class="price-less">$ 659.00</span>
					<span class="prices">$ 499.00</span>
				</span>
				<a href="product-detail.html" class="btn-shop">
					<span>shop now</span>
					<i class="fa fa-angle-right"></i>
				</a>
				</div>
			</div><!-- banner 5 white end here -->
			<!-- banner box two start here -->
			<div class="banner-box two">
				<!-- banner 7 right start here -->
				<div class="banner-7 right wow fadeInUp" data-wow-delay="0.4s">
				<img src="http://placehold.it/295x275" alt="image description">
				<div class="holder">
					<h2><strong>ACRYLIC FABRIC <br>BEAN BAG</strong></h2>
					<ul class="mt-stars">
					<li><i class="fa fa-star"></i></li>
					<li><i class="fa fa-star"></i></li>
					<li><i class="fa fa-star"></i></li>
					<li><i class="fa fa-star-o"></i></li>
					</ul>
					<div class="price-tag">
					<span class="price">$ 99.00</span>
					<a class="shop-now" href="product-detail.html">SHOP NOW</a>
					</div>
				</div>
				</div><!-- banner 7 right end here -->
				<!-- banner 8 start here -->
				<div class="banner-8 wow fadeInDown" data-wow-delay="0.4s">
				<img src="http://placehold.it/295x275" alt="image description">
				<div class="holder">
					<h2><strong>CHAIR WITH <br>ARMRESTS</strong></h2>
					<ul class="mt-stars">
					<li><i class="fa fa-star"></i></li>
					<li><i class="fa fa-star"></i></li>
					<li><i class="fa fa-star"></i></li>
					<li><i class="fa fa-star-o"></i></li>
					</ul>
					<div class="price-tag">
					<span class="price-off">$ 129.00</span>
					<span class="price">$ 99.00</span>
					<a class="btn-shop" href="product-detail.html">
						<span>HURRY UP!</span> 
						<i class="fa fa-angle-right"></i>
					</a>
					</div>
				</div>
				</div><!-- banner 8 start here -->
			</div>
			</div><!-- banner frame end here -->
		</div>
		</div>
	</div>
</main>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>