<!DOCTYPE html>
<html lang="en">


<?php
include_once ('./includesPages/header.php');
?>

<body>
    <!-- SVG Preloader Starts -->
    <?php include_once('./includesPages/preloader.php');?>
    <!-- SVG Preloader Ends -->
	
    <!-- Wrapper Starts -->
    <div class="wrapper">
        <!-- Header Starts -->
        <header class="header">
        <?php include_once('./includesPages/head_login.php');?>
            <!-- Navigation Menu Starts -->
            <nav class="site-navigation navigation" id="site-navigation">
                <div class="container">
                    <div class="site-nav-inner">
                        <!-- Logo For ONLY Mobile display Starts -->
                        <a class="logo-mobile" href="index.php">
                        <img id="logo-mobile" class="img-responsive" src="images/backgrounds/favicon.png" alt="log">
						</a>
                        <!-- Logo For ONLY Mobile display Ends -->
                        <!-- Toggle Icon for Mobile Starts -->
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
                        <!-- Toggle Icon for Mobile Ends -->
                        <div class="collapse navbar-collapse navbar-responsive-collapse">
                            <!-- Main Menu Starts -->
                            <?php include_once('./includesPages/nav_list.php')?>
                            <!-- Main Menu Ends -->
                        </div>
                    </div>
                </div>
                <!-- Search Input Starts -->
                <div class="site-search">
                    <div class="container">
                        <?php include_once('./includesPages/search_form.php'); ?>
                    </div>
                </div>
                <!-- Search Input Ends -->
            </nav>
            <!-- Navigation Menu Ends -->
        </header>
        <!-- Header Ends -->
		<!-- Banner Area Starts -->
		<section class="banner-area">
			<div class="banner-overlay">
				<div class="banner-text text-center">
					<div class="container">
						<!-- Section Title Starts -->
						<div class="row text-center">
							<div class="col-xs-12">
								<!-- Title Starts -->
								<h2 class="title-head">Our <span>Plans</span></h2>
								<!-- Title Ends -->
								<hr>
								<!-- Breadcrumb Starts -->
								<ul class="breadcrumb">
									<li><a href="/index.php" style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>"> home</a></li>
									<li>plans</li>
								</ul>
								<!-- Breadcrumb Ends -->
							</div>
						</div>
						<!-- Section Title Ends -->
					</div>
				</div>
			</div>
		</section>
		<!-- Banner Area Ends -->
        <!-- Pricing Starts -->
        <section class="pricing">
            <div class="container">
                <!-- Section Content Starts -->
				<h3 class="text-center">Our <span style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">Plans</span></h3>
				<p class="text-center">Invest using cryptocurrency</p>
                <div class="row pricing-tables-content pricing-page">
                    <div class="pricing-container">
                        <!-- Pricing Tables Starts -->
                        <ul class="pricing-list bounce-invert">
                            <li class="col-xs-6 col-sm-6 col-md-3 col-lg-6">
                                <ul class="pricing-wrapper">
                                    <!-- Buy Pricing Table #1 Starts -->
                                    <li data-type="buy" class="is-visible">
                                        <header class="pricing-header">
                                            <h2>Starter plan 1<span style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">For </span></h2>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">Minimum Deposit</h4>
                                                <span class="currency"><i class="fa fa-dollar"></i></span>
                                                <span class="value">50</span>
                                            </div>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">Maximum Deposit</h4>
                                                <span class="currency"><i class="fa fa-dollar"></i></span>
                                                <span class="value">4999</span>
                                            </div>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">3% After 24 hours</h4>
                                            </div>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">10% Referral commission</h4>
                                            </div>
                                        </header>
                                        <footer class="pricing-footer">
                                            <a href="./login.php" class="btn btn-primary" style="<?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder;?>;">ORDER NOW</a>
                                        </footer>
                                    </li>
                                </ul>
                            </li>
                            <li class="col-xs-6 col-sm-6 col-md-3 col-lg-6">
                                <ul class="pricing-wrapper">
                                    <!-- Buy Pricing Table #2 Starts -->
                                    <li data-type="buy" class="is-visible">
                                        <header class="pricing-header">
                                            <h2>Pro plan 2<span style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">For </span></h2>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">Minimum Deposit</h4>
                                                <span class="currency"><i class="fa fa-dollar"></i></span>
                                                <span class="value">5000</span>
                                            </div>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">Maximum Deposit</h4>
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">Unlimited</h4>
                                            </div>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">7% After 36 hours</h4>
                                            </div>
                                            <div class="price">
                                                <h4 style="color: #fff; font-size: 16px; text-transform: uppercase;">10% Referral commission</h4>
                                            </div>
                                        </header>
                                        <footer class="pricing-footer">
                                            <a href="./login.php" class="btn btn-primary" style="<?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder;?>;">ORDER NOW</a>
                                        </footer>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
        <!-- Call To Action Section Starts -->
        <section class="call-action-all">
			<div class="call-action-all-overlay">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<!-- Call To Action Text Starts -->
							<div class="action-text">
								<h2>Get Started Today With Bitcoin</h2>
								<p class="lead">Open account for free and start earning with cryptocurrency!</p>
							</div>
							<!-- Call To Action Text Ends -->
							<!-- Call To Action Button Starts -->
							<p class="action-btn"><a class="btn btn-primary" href="./register.php" style="<?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder;?>">Register Now</a></p>
							<!-- Call To Action Button Ends -->
						</div>
					</div>
				</div>
			</div>
        </section>
        <!-- Call To Action Section Ends -->
        <!-- Footer Starts -->
        <?php include_once('./includesPages/pageFooter.php'); ?>
        <?php
            include_once ('./includesPages/footer.php');
        ?>
    </div>
    <!-- Wrapper Ends -->
</body>


</html>