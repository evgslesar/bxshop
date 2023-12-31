<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<!-- footer of the Page -->
            <footer id="mt-footer" class="style2 wow fadeInUp" data-wow-delay="0.4s">

				<!-- F Promo Box of the Page -->
				<aside class="f-promo-box dark">
					<div class="container divider">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<!-- F Widget Item of the Page -->
								<div class="f-widget-item">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/includes/footer-promo1.php"
										)
									);?>
								</div>
								<!-- F Widget Item of the Page end -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomsm">
								<!-- F Widget Item of the Page -->
								<div class="f-widget-item">
								<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/includes/footer-promo2.php"
										)
									);?>
								</div>
								<!-- F Widget Item of the Page -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3 mt-paddingbottomxs">
								<!-- F Widget Item of the Page -->
								<div class="f-widget-item">
								<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/includes/footer-promo3.php"
										)
									);?>
								</div>
								<!-- F Widget Item of the Page -->
							</div>
							<div class="col-xs-12 col-sm-6 col-md-3">
								<!-- F Widget Item of the Page -->
								<div class="f-widget-item">
								<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/includes/footer-promo4.php"
										)
									);?>
								</div>
								<!-- F Widget Item of the Page -->
							</div>
						</div>
					</div>
				</aside>
				<!-- F Promo Box of the Page end -->
				<!-- Footer Holder of the Page -->
				<div class="footer-holder dark">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-5 col-md-4 mt-paddingbottomxs">
								<!-- F Widget About of the Page -->
								<div class="f-widget-about">
									<div class="logo">
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/includes/footer-logo.php"
										)
									);?>
									</div>
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.include",
										"",
										Array(
											"AREA_FILE_SHOW" => "file",
											"AREA_FILE_SUFFIX" => "inc",
											"EDIT_TEMPLATE" => "",
											"PATH" => "/includes/footer-contacts.php"
										)
									);?>
								</div>
								<!-- F Widget About of the Page -->
							</div>
							<nav class="col-xs-12 col-sm-7 col-md-5 mt-paddingbottomxs">
								<!-- Footer Nav of the Page -->
								<div class="nav-widget-1">
									<h3 class="f-widget-heading">Categories</h3>
									<ul class="list-unstyled f-widget-nav">
										<li><a href="#">Chairs</a></li>
										<li><a href="#">Sofas</a></li>
										<li><a href="#">Living</a></li>
										<li><a href="#">Bedroom</a></li>
										<li><a href="#">Tables</a></li>
										<li><a href="#">New</a></li>
									</ul>
								</div>
								<!-- Footer Nav of the Page end -->
								<!-- Footer Nav of the Page -->
								<div class="nav-widget-1">
									<h3 class="f-widget-heading">Information</h3>
									<ul class="list-unstyled f-widget-nav">
										<li><a href="#">About Us</a></li>
										<li><a href="#">Contact Us</a></li>
										<li><a href="#">Terms &amp; Conditions</a></li>
										<li><a href="#">Privacy Policy</a></li>
										<li><a href="#">Customer Service</a></li>
										<li><a href="#">FAQs</a></li>
									</ul>
								</div>
								<!-- Footer Nav of the Page end -->
								<!-- Footer Nav of the Page -->
								<div class="nav-widget-1">
									<h3 class="f-widget-heading">Account</h3>
									<ul class="list-unstyled f-widget-nav">
										<li><a href="#">My Account</a></li>
										<li><a href="#">Order Tracking</a></li>
										<li><a href="#">Wish List</a></li>
										<li><a href="#">Shopping Cart</a></li>
										<li><a href="#">Checkout</a></li>
									</ul>
								</div>
								<!-- Footer Nav of the Page end -->
							</nav>
							<div class="col-xs-12 col-md-3 text-right hidden-sm">
								<!-- F Widget Newsletter of the Page -->
								<div class="f-widget-newsletter">
									<h3 class="f-widget-heading">Sing Up Newsletter</h3>
									<div class="holder">
										<form class="newsletter-form form2" action="#">
											<fieldset>
												<input type="email" class="form-control" placeholder="Your e-mail">
												<button type="submit">Subscribe</button>
											</fieldset>
										</form>
									</div>
									<!-- F Widget Newsletter of the Page end -->
									<h4 class="f-widget-heading follow">Follow Us</h4>
									<?$APPLICATION->IncludeComponent(
	"bitrix:eshop.socnet.links", 
	"footer_soclinks", 
	array(
		"COMPONENT_TEMPLATE" => "footer_soclinks",
		"FACEBOOK" => "#",
		"GOOGLE" => "#",
		"INSTAGRAM" => "#",
		"TWITTER" => "#",
		"VKONTAKTE" => "#",
		"0" => ""
	),
	false
);?>
									<!-- Social Network of the Page -->
									<!-- <ul class="list-unstyled social-network social-icon">
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#"><i class="fa fa-youtube"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
										<li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
									</ul> -->
								<!-- Social Network of the Page end -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Footer Holder of the Page end -->
				<!-- Footer Area of the Page -->
				<div class="footer-area">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<p>© <a href="index.html">schön.</a> - All rights Reserved</p>
							</div>
							<div class="col-xs-12 col-sm-6 text-right">
								<div class="bank-card">
									<img src="<?php echo SITE_TEMPLATE_PATH ?>/images/bank-card.png" alt="bank-card">
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Footer Area of the Page end -->
			</footer>
			<!-- footer of the Page end -->
		</div>
		<!-- W1 end here -->
		<span id="back-top" class="fa fa-arrow-up"></span>
	</div>
</body>
</html>
