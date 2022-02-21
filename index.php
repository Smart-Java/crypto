<!DOCTYPE html>
<html lang="en">
<?php
include_once ('./includesPages/header.php');
?>
<body>
    <script src="./pop_investor.js"></script>
    <!-- SVG Preloader Starts -->
    <?php
        include_once ('./includesPages/preloader.php');
    ?>    <!-- SVG Preloader Ends -->
    <?php
        include_once ('./includes/connection_includes.php');
        
    ?>
    <?php
        for ($i=0; $i <=2 ; $i++) { 
            if ($i == 0) {
                $data = "SELECT * FROM `investors` WHERE `status` = '1' AND `suspendAccount` = '0' AND `deleteAccount` = '0' ORDER BY `investors_id` DESC";
                $queryData = mysqli_query($connectionResult, $data);
                $refresh = mysqli_refresh($connectionResult, MYSQLI_REFRESH_GRANT);

                if ($queryData) {
                    while ($a = mysqli_fetch_assoc($queryData)) {
                        $userName = $a['fullname'];
                        ?>
                        <div class="row nav nav-bar" style="height: 40px; border-radius: 10px; position:fixed; bottom:0; width:80%; z-index:100; background-color: #ffa500;" id="popInvestorId">
                            <p style="color: #fff; margin-left: 10px; border-radius: 10px; width: 100%;" class="col-sm-12 col-md-7 col-lg-6" style="padding-left: 20px;">
                            <marquee behavior="" direction="">Investor <?php echo $userName;?> just login now</marquee>
                        </p>
                        </div>
                        <?php
                    }
                }
            }else if($i == 1){
                $money = "SELECT `amount`, `investor_referral_code` FROM `deposittransaction` WHERE `is_transaction_approved` = '1' ORDER BY `id` DESC";
                $queryMoney = mysqli_query($connectionResult, $money);
        
                if ($queryMoney) {
                    while ($b = mysqli_fetch_assoc($queryData)) {
                        $amount = $b['amount'];
                        $code = $b['investor_referral_code'];
        
                        $uniqueLink = "SELECT `fullname` FROM `investors` WHERE `investors_referral_link` = '$code'";
                        $queryUniqueLink = mysqli_query($connectionResult, $uniqueLink);
        
                        if ($queryUniqueLink) {
                            while ($c = mysqli_fetch_assoc($queryUniqueLink)) {
                                $name = $c['fullname'];
                                ?>
                                <div class="row nav nav-bar" style="height: 30px; border-radius: 10px; position:fixed; bottom:0; width:80%; z-index:100; background-color: #ffa500;" id="popInvestorId">
                                    <p style="color: black;" class="col-sm-12 col-md-7 col-lg-6"><?php echo $name;?> just invested <?php echo $amount;?></p>
                                    <!-- <p style="color: #000000; text-align: right;" class="col-sm-12 col-md-7 col-lg-6">&#10006</p> -->
                                </div>
                                <?php
                            }
                        }
                    }
                }
            }
        }
    ?>
    <?php
        include_once ('./includes/connection_includes.php');
        
    ?>
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
                        <a class="logo-mobile" href="#">
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
        <!-- Slider Starts -->
        <div id="main-slide" class="carousel slide carousel-fade" data-ride="carousel">
            <!-- Indicators Starts -->
            <ol class="carousel-indicators visible-lg visible-md">
                <li data-target="#main-slide" data-slide-to="0" class="active"></li>
                <li data-target="#main-slide" data-slide-to="1"></li>
                <li data-target="#main-slide" data-slide-to="2"></li>
            </ol>
            <!-- Indicators Ends -->
            <!-- Carousel Inner Starts -->
            <div class="carousel-inner">
                <!-- Carousel Item Starts -->
                <div class="item active bg-parallax item-1">
                    <div class="slider-content">
                        <div class="container">
                            <div class="slider-text text-center">
                                <h3 class="slide-title"><span>Secure</span> and <span>Easy Way</span><br/> To Bitcoin</h3>
                                <p>
                                    <a href="./about.php" class="slider btn btn-primary" style="<?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder?>">Learn more</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Item Ends -->
                <!-- Carousel Item Starts -->
                <div class="item bg-parallax item-2">
                    <div class="slider-content">
                        <div class="col-md-12">
                            <div class="container">
                                <div class="slider-text text-center">
                                    <h3 class="slide-title"><span>Bitcoin</span> Exchange <br/>You can <span>Trust</span> </h3>
                                    <p>
                                        <a href="./plans.php" class="slider btn btn-primary" style="<?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder?>">our plans</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Item Ends -->
            </div>
            <!-- Carousel Inner Ends -->
            <!-- Carousel Controlers Starts -->
            <a class="left carousel-control" href="#main-slide" data-slide="prev">
				<span><i class="fa fa-angle-left"></i></span>
			</a>
            <a class="right carousel-control" href="#main-slide" data-slide="next">
				<span><i class="fa fa-angle-right"></i></span>
			</a>
            <!-- Carousel Controlers Ends -->
        </div>
        <!-- Slider Ends -->
        <!-- Features Section Starts -->
        <section class="features">
            <div class="container">
                <div class="row features-row">
                    <!-- Feature Box Starts -->
                    <div class="feature-box col-md-4 col-sm-12">
                        <span class="feature-icon">
							<img id="download-bitcoin" src="images/icons/orange/download-bitcoin.png" alt="download bitcoin">
						</span>
                        <div class="feature-box-content">
                            <h3>Download Bitcoin Wallet</h3>
                            <p>Get it on PC or Mobile to create, send and receive bitcoins.</p>
                        </div>
                    </div>
                    <!-- Feature Box Ends -->
                    <!-- Feature Box Starts -->
                    <div class="feature-box two col-md-4 col-sm-12">
                        <span class="feature-icon">
							<img id="add-bitcoins" src="images/icons/orange/add-bitcoins.png" alt="add bitcoins">
						</span>
                        <div class="feature-box-content">
                            <h3>Add coins to your Wallet</h3>
                            <p>Add bitcoins you’ve created.</p>
                        </div>
                    </div>
                    <!-- Feature Box Ends -->
                    <!-- Feature Box Starts -->
                    <div class="feature-box three col-md-4 col-sm-12">
                        <span class="feature-icon">
							<img id="buy-sell-bitcoins" src="images/icons/orange/buy-sell-bitcoins.png" alt="buy and sell bitcoins">
						</span>
                        <div class="feature-box-content">
                            <h3>Invest with Wallet</h3>
                            <p>Enter receiver's address, specify the amount and send.</p>
                        </div>
                    </div>
                    <!-- Feature Box Ends -->
                </div>
            </div>
        </section>
        <!-- Features Section Ends -->
        
        <!-- About Section Starts -->
        <section class="about-us">
            <div class="container">
                <!-- Section Title Starts -->
                <div class="row text-center">
                    <h2 class="title-head">About <span style="<?php include_once('./includesPages/style.php'); echo $textOrange?>">Us</span></h2>
                    <div class="title-head-subtitle">
                        <p>a commercial website that lists wallets, exchanges and other investment related info</p>
                    </div>
                </div>
                <!-- Section Title Ends -->
                <!-- Section Content Starts -->
                <div class="row about-content">
                    <!-- Image Starts -->
                    <div class="col-sm-12 col-md-5 col-lg-6 text-center">
                        <img id="about-us" class="img-responsive img-about-us" src="images/team/member1.jpg" alt="about us" style="height: 400px; width: 70%; border-radius: 10px;">
                    </div>
                    <!-- Image Ends -->
                    <!-- Content Starts -->
                    <div class="col-sm-12 col-md-7 col-lg-6">
                        <h3 class="title-about">WE ARE Fortuneapex</h3>
                        <p>Founded in 2018, a place for everyone who wants to simply invest. Deposit funds using your wallets. Instant investment at fair price is guaranteed. Nothing extra. Join over 700,000 users from all over the world satisfied with our services.</p>
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#menu1">Our Mission</a></li>
                            <li><a data-toggle="tab" href="#menu2">Our advantages</a></li>
                            <li><a data-toggle="tab" href="#menu3">Our guarantees</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="menu1" class="tab-pane fade in active">
                                <p>Bitcoin is based on a protocol known as the blockchain, which allows to create, transfer and verify ultra-secure financial data without interference of third parties.</p>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <p>Our mission as an official partner of Bitcoin Foundation is to help you enter and better understand the world of #1 cryptocurrency and avoid any issues you may encounter.</p>
                            </div>
                            <div id="menu3" class="tab-pane fade">
                                <p>We are here because we are passionate about open, transparent markets and aim to be a major driving force in widespread adoption, we are the first and the best in cryptocurrency. </p>
                            </div>
                        </div>
                        <a class="btn btn-primary" href="about.php" style="<?php include_once('./includespages/style.php'); echo $btnOrangeTxtWhiteBorder;?>">Read More</a>
                    </div>
                    <!-- Content Ends -->
                </div>
                <!-- Section Content Ends -->
            </div>
        </section>
        <!-- About Section Ends -->
        <!-- Features and Video Section Starts -->
        <section class="image-block">
            <div class="container-fluid">
                <div class="row">
                    <!-- Features Starts -->
                    <div class="col-md-8 ts-padding img-block-left">
                        <div class="gap-20"></div>
                        <div class="row">
                            <!-- Feature Starts -->
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <div class="feature text-center">
                                    <span class="feature-icon">
										<img id="strong-security" src="images/icons/orange/strong-security.png" alt="strong security"/>
									</span>
                                    <h3 class="feature-title">Strong Security</h3>
                                    <p>Protection against DDoS attacks, <br>full data encryption</p>
                                </div>
                            </div>
                            <!-- Feature Ends -->
							<div class="gap-20-mobile"></div>
                            <!-- Feature Starts -->
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <div class="feature text-center">
                                    <span class="feature-icon">
										<img id="world-coverage" src="images/icons/orange/world-coverage.png" alt="world coverage"/>
									</span>
                                    <h3 class="feature-title">World Coverage</h3>
                                    <p>Providing services in 99% countries<br> around all the globe</p>
                                </div>
                            </div>
                            <!-- Feature Ends -->
                        </div>
                        <div class="gap-20"></div>
                        <div class="row">
                            <!-- Feature Starts -->
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <div class="feature text-center">
                                    <span class="feature-icon">
										<img id="payment-options" src="images/icons/orange/payment-options.png" alt="payment options"/>
									</span>
                                    <h3 class="feature-title">Payment Options</h3>
                                    <p>Popular methods: Cryptocurrency</p>
                                </div>
                            </div>
                            <!-- Feature Ends -->
							<div class="gap-20-mobile"></div>
                            <!-- Feature Starts -->
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <div class="feature text-center">
                                    <span class="feature-icon">
										<img id="mobile-app" src="images/icons/orange/mobile-app.png" alt="mobile app"/>
									</span>
                                    <h3 class="feature-title">Mobile App</h3>
                                    <p>Trading via our Mobile App, Available<br> in Play Store & App Store</p>
                                </div>
                            </div>
                            <!-- Feature Ends -->
                        </div>
                        <div class="gap-20"></div>
                        <div class="row">
                            <!-- Feature Starts -->
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <div class="feature text-center">
                                    <span class="feature-icon">
										<img id="cost-efficiency" src="images/icons/orange/cost-efficiency.png" alt="cost efficiency"/>
									</span>
                                    <h3 class="feature-title">Cost efficiency</h3>
                                    <p>Reasonable trading fees for takers<br> and all market makers</p>
                                </div>
                            </div>
                            <!-- Feature Ends -->
							<div class="gap-20-mobile"></div>
                            <!-- Feature Starts -->
                            <div class="col-sm-6 col-md-6 col-xs-12">
                                <div class="feature text-center">
                                    <span class="feature-icon">
										<img id="high-liquidity" src="images/icons/orange/high-liquidity.png" alt="high liquidity"/>
									</span>
                                    <h3 class="feature-title">High Liquidity</h3>
                                    <p>Fast access to high liquidity orderbook<br> for top currency pairs</p>
                                </div>
                            </div>
                            <!-- Feature Ends -->
                        </div>
                    </div>
                    <!-- Features Ends -->
                    <!-- Video Starts -->
                    <div class="col-md-4 ts-padding bg-image-1">
                        <div>
                            <!-- <div class="text-center">
                                <a class="" href="https://www.youtube.com/watch?v=0gv7OC9L2s8"></a>
                            </div> -->
                        </div>
                    </div>
                    <!-- Video Ends -->
                </div>
            </div>
        </section>
        <!-- Features and Video Section Ends -->
        <!-- Pricing Starts -->
        <section class="pricing">
            <div class="container">
                <!-- Section Title Starts -->
                <div class="row text-center">
                    <h2 class="title-head">affordable <span style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">plans</span></h2>
                    <div class="title-head-subtitle">
                        <p>Invest using cryptocurrency</p>
                    </div>
                </div>
                <!-- Section Title Ends -->
                <!-- Section Content Starts -->
                <div class="row pricing-tables-content">
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
            </div>
        </section>
        <!-- Pricing Ends -->
        <!-- Bitcoin Calculator Section Starts -->
        <section class="bitcoin-calculator-section">
            <div class="container">
                <div class="row">
                    <!-- Section Heading Starts -->
                    <div class="col-md-12">
                        <h2 class="title-head text-center"><span style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">Bitcoin</span> Calculator</h2>
                        <p class="message text-center">Find out the current Bitcoin value with our easy-to-use converter ... coming soon</p>
                    </div>
                    <!-- Section Heading Ends -->
                    <!-- Bitcoin Calculator Form Starts -->
                    <div class="col-md-12 text-center">
                        <form class="bitcoin-calculator" id="bitcoin-calculator">
                            <!-- Input #1 Starts -->
                            <input class="form-input" name="btc-calculator-value" value="1">
                            <!-- Input #1 Ends -->
                            <div class="form-info"><i class="fa fa-bitcoin"></i></div>
                            <div class="form-equal">=</div>
                            <!-- Input/Result Starts -->
                            <input class="form-input form-input-result" name="btc-calculator-result">
                            <!-- Input/Result Ends -->
                            <!-- Select Currency Starts -->
                            <div class="form-wrap">
                                <select id="currency-select" class="form-input select-currency select-primary" name="btc-calculator-currency" data-dropdown-class="select-primary-dropdown"></select>
                            </div>
                            <!-- Select Currency Ends -->
                        </form>
                        <p class="info"><i>* Data updated every 15 minutes</i></p>
                    </div>
                    <!-- Bitcoin Calculator Form Ends -->
                </div>
            </div>
        </section>
        <!-- Bitcoin Calculator Section Ends -->
        <!-- Team Section Starts -->
        <section class="team">
            <div class="container">
                <!-- Section Title Starts -->
                <div class="row text-center">
                    <h2 class="title-head">our <span style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">experts</span></h2>
                    <div class="title-head-subtitle">
                        <p> A talented team of Cryptocurrency experts based in London</p>
                    </div>
                </div>
                <!-- Section Title Ends -->
                <!-- Team Members Starts -->
                <div class="row team-content team-members">
                    <!-- Team Member Starts -->
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <img src="images/team/member1.jpg" class="img-responsive" alt="team member">
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <div class="team-member-caption social-icons">
                                <h4>Lina Marzouki</h4>
                                <p style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">Ceo Founder</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Member Details Ends -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                    <!-- Team Member Starts -->
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <img src="images/team/member2.jpg" class="img-responsive" alt="team member">
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <div class="team-member-caption social-icons">
                                <h4>Marco Verratti</h4>
                                <p style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">Director</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Member Details Ends -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                    <!-- Team Member Starts -->
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <!-- Team Member-->
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <img src="images/team/member3.jpg" class="img-responsive" alt="team member">
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <div class="team-member-caption social-icons">
                                <h4>Emilia Bella</h4>
                                <p style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">Bitcoin Consultant</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Member Details Ends -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                    <!-- Team Member Starts -->
                    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
                        <div class="team-member">
                            <!-- Team Member Picture Starts -->
                            <img src="images/team/member4.jpg" class="img-responsive" alt="team member">
                            <!-- Team Member Picture Ends -->
                            <!-- Team Member Details Starts -->
                            <div class="team-member-caption social-icons">
                                <h4>Antonio Conte</h4>
                                <p style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">Bitcoin Developer</p>
                                <ul class="list list-inline social">
                                    <li>
                                        <a href="#" class="fa fa-facebook"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-twitter"></a>
                                    </li>
                                    <li>
                                        <a href="#" class="fa fa-google-plus"></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- Team Member Details Ends -->
                        </div>
                    </div>
                    <!-- Team Member Ends -->
                </div>
                <!-- Team Members Ends -->
            </div>
        </section>
        <!-- Team Section Ends -->
        <!-- Quote and Chart Section Starts -->
        <section class="image-block2">
            <div class="container-fluid">
                <div class="row">
                    <!-- Quote Starts -->
                    <div class="col-md-4 img-block-quote bg-image-2">
                        <blockquote>
                            <p>Bitcoin is one of the most important inventions in all of human history. For the first time ever, anyone can send or receive any amount of money with anyone else, anywhere on the planet, conveniently and without restriction. It’s the dawn of a better, more free world.</p>
                            <footer><img src="images/team/member1.jpg" alt="ceo" /> <span>Marc Smith</span> - CEO</footer>
                        </blockquote>
                    </div>
                    <!-- Quote Ends -->
                    <!-- Chart Starts -->
                    <div class="col-md-8 bg-grey-chart">
                        <div class="chart-widget dark-chart chart-1">
                            <div>
                                <div class="btcwdgt-chart" data-bw-theme="dark" style="text-align: center; height: 500px; width: 100%; border-radius: 10px;">
                                    <img src="./images/backgrounds/coming-soon.jpg" alt="chart"style="height: 100%; border-radius: 10px;">
                                </div>
                            </div>
                        </div>
						<!-- <div class="chart-widget light-chart chart-2">
                            <div>
                                <div class="btcwdgt-chart" bw-theme="light"></div>
                            </div>
                        </div> -->
                    </div>
                    <!-- Chart Ends -->
                </div>
            </div>
        </section>
        <!-- Quote and Chart Section Ends -->
        
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
        <div id="google_translate_element">
            
        </div>
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