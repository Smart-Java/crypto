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
        <!-- Banner Area Starts -->
        <section class="banner-area">
			<div class="banner-overlay">
				<div class="banner-text text-center">
					<div class="container">
						<!-- Section Title Starts -->
						<div class="row text-center">
							<div class="col-xs-12">
								<!-- Title Starts -->
								<h2 class="title-head">Account <span>Area</span></h2>
								<!-- Title Ends -->
								<hr>
								<!-- Breadcrumb Starts -->
								<ul class="breadcrumb">
									<li><a href="./index.php" style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>"> home</a></li>
									<li>Profile</li>
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
        <!-- account details -->
        <section class="faq" style="margin-top: 0%;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4" style="width: 300px; height: 1000px;">
                        <ul style="background-color: #ffa500; text-decoration: none; list-style-type: none;">
                            <li><a href="" style="text-decoration: none; color: #ffffff;">Profile</a></li>
                            <li><a href="" style="text-decoration: none; color: #ffffff;">Make Deposit</a></li>
                            <li><a href="" style="text-decoration: none; color: #ffffff;">Withdraw Deposit</a></li>
                            <li><a href="" style="text-decoration: none; color: #ffffff;">Account History</a></li>
                            <li><a href="" style="text-decoration: none; color: #ffffff;">Account Settings</a></li>
                            <li><a href="" style="text-decoration: none; color: #ffffff;">Logout</a></li>
                        </ul>
                    </div>
                    <div class="col-md-8">
                        <div class="" style="text-align: left; display: inline;">
                            <ul style="display: inline; list-style-type: none;">
                                <li style="border-radius: 50%;">
                                    <img src="" alt="">
                                </li>
                            </ul>
                            <ul style="display: inline;">
                                <li style="display: inline;">Username</li>
                                <li style="display: inline;">Registration Date</li>
                                <li style="display: inline;">Last Access</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section FAQ Starts -->
        <section class="faq">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <!-- Panel Group Starts -->
                        <div class="panel-group" id="accordion">
                            <!-- Panel Starts -->
                            <div class="panel panel-default">
                                <!-- Panel Heading Starts -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
								what is bitcoin ?</a>
                                    </h4>
                                </div>
                                <!-- Panel Heading Ends -->
                                <!-- Panel Content Starts -->
                                <div id="collapse1" class="panel-collapse collapse in">
                                    <div class="panel-body">Bitcoin is a form of digital currency which is based on an open source code that was created and is held electronically. Bitcoin is a decentralized form of currency, meaning that it does not belong to any form of government and is not controlled by anyone.</div>
                                </div>
                                <!-- Panel Content Starts -->
                            </div>
                            <!-- Panel Ends -->
                            <!-- Panel Starts -->
                            <div class="panel panel-default">
                                <!-- Panel Heading Starts -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
								Who Developed Bitcoin?</a>
                                    </h4>
                                </div>
                                <!-- Panel Heading Ends -->
                                <!-- Panel Content Starts -->
                                <div id="collapse2" class="panel-collapse collapse">
                                    <div class="panel-body">The original Bitcoin code was designed by Satoshi Nakamoto under MIT open source credentials. In 2008 Nakamoto outlined the idea behind Bitcoin in his White Paper, which scientifically described how the cryptocurrency would function. Bitcoin is the first successful digital currency designed with trust in cryptography over central authorities. Satoshi left the Bitcoin code in the hands of developers and the community in 2010. Thus far hundreds of developers have added to the core code throughout the years.</div>
                                </div>
                                <!-- Panel Content Starts -->
                            </div>
                            <!-- Panel Ends -->
							<!-- Panel Starts -->
                            <div class="panel panel-default">
                                <!-- Panel Heading Starts -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
								What is Bitcoin Mining?</a>
                                    </h4>
                                </div>
                                <!-- Panel Heading Ends -->
                                <!-- Panel Content Starts -->
                                <div id="collapse3" class="panel-collapse collapse">
                                    <div class="panel-body">Bitcoin mining is analogous to the mining of gold, but its digital form. The process involves specialized computers solving algorithmic equations or hash functions. These problems help miners to confirm blocks of transactions held within the network. Bitcoin mining provides a reward for miners by paying out in Bitcoin in turn the miners confirm transactions on the blockchain. Miners introduce new Bitcoin into the network and also secure the system with transaction confirmation. They are also rewarded network fees for when they harvest new coin and a time when the last bitcoin is found mining will continue.</div>
                                </div>
                                <!-- Panel Content Starts -->
                            </div>
                            <!-- Panel Ends -->
							<!-- Panel Starts -->
                            <div class="panel panel-default">
                                <!-- Panel Heading Starts -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
								Is Bitcoin Used For Illegal Activities?</a>
                                    </h4>
                                </div>
                                <!-- Panel Heading Ends -->
                                <!-- Panel Content Starts -->
                                <div id="collapse4" class="panel-collapse collapse">
                                    <div class="panel-body">This is a yet another controversial topic. Because of the freedom and the degree of anonymity that the use of Bitcoin offers, many users who were seeking to purchase or solicit illegal goods or services initially turned to the use of Bitcoin as a method of payment.</div>
                                </div>
                                <!-- Panel Content Starts -->
                            </div>
                            <!-- Panel Ends -->
							<!-- Panel Starts -->
                            <div class="panel panel-default">
                                <!-- Panel Heading Starts -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
								Can Bitcoin Be Regulated In Any Way?</a>
                                    </h4>
                                </div>
                                <!-- Panel Heading Ends -->
                                <!-- Panel Content Starts -->
                                <div id="collapse5" class="panel-collapse collapse">
                                    <div class="panel-body">Again, when a user decides to use a specific type of software for their Bitcoin wallet, they are deciding what direction the Bitcoin network is heading towards. In other words, you need the cooperation of nearly every single user in order to modify any aspect of the Bitcoin protocol.</div>
                                </div>
                                <!-- Panel Content Starts -->
                            </div>
                            <!-- Panel Ends -->
							<!-- Panel Starts -->
                            <div class="panel panel-default">
                                <!-- Panel Heading Starts -->
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
								Is Bitcoin anonymous?</a>
                                    </h4>
                                </div>
                                <!-- Panel Heading Ends -->
                                <!-- Panel Content Starts -->
                                <div id="collapse6" class="panel-collapse collapse">
                                    <div class="panel-body">Participants in Bitcoin transactions are identified by public addresses – those are the long strings of around 30 characters you see in a person’s Bitcoin address, usually starting with the numerals ‘1’ or ‘3’. For every transaction, the sending and receiving addresses are publicly-viewable.</div>
                                </div>
                                <!-- Panel Content Starts -->
                            </div>
                            <!-- Panel Ends -->
                        </div>
                        <!-- Panel Group Ends -->
                    </div>
                </div>
            </div>
        </section>
        <!-- Section FAQ Ends -->
        <!-- Call To Action Section Starts -->
        <section class="call-action-all">
			<div class="call-action-all-overlay">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<!-- Call To Action Text Starts -->
							<div class="action-text">
								<h2>Get Started Today With Bitcoin</h2>
								<p class="lead">Open account for free and start trading Bitcoins!</p>
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
    <!-- Wrapper Ends -->
</body>


</html>