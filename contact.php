<?php
include_once ('./includes/connection_includes.php');

$firstName = '';
$lastName = '';
$email = '';
$subject = '';
$message = '';
$information = '';

if (isset($_POST['sendMessageId'])) {
    echo "
        <script>
            alert('Error');  
        </script>
    ";
}

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['text']) && isset($_POST['message'])) {
    $firstName = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['firstname'])), FILTER_SANITIZE_STRING);
    $lastName = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['lastname'])), FILTER_SANITIZE_EMAIL);;
    $email = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['email'])), FILTER_SANITIZE_STRING);
    $subject = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['text'])), FILTER_SANITIZE_STRING);
    $message = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['message'])), FILTER_SANITIZE_STRING);

    if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $from = 'info@fortuneapex.com';
            $header = 'MIME-Version: 1.0' ."\r\n";
            $header .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

            $header.= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n".
            'X-Mailer: PHP/ '. phpversion();

            $message = '<html><body>';
            $message .= '<h1>I\'m '.$firstName.', '.$lastName.'!</h1>';
            $message .= '<p>'.$message.'</p>';
            $message .= '</body></html>';

            $subjectMessage = $subject;
            $msg = wordwrap($message);
            $sendMessage = mail($email, $subjectMessage, $msg, $header);
            
            if ($sendMessage == true) {
                echo '
                    <script>
                        alert(\'Successful message sent. \nPlease '.$firstName.', '.$lastName.' we will respond you in few hours from now.\');
                    </script>
                ';
                $firstName = '';
                $lastName = '';
                $email = '';
                $subject = '';
                $message = '';
            }
        } else{
            echo 'Wrong';
            $information = 'Email is wrong, please.';
        }
    } else{
        $information = 'You can\'t send an anonymous empty message here';
    }
} else{
    $information = 'You can\'t send an anonymous empty message here';
}
?>

<!DOCTYPE html>
<html lang="en">


<?php
include_once ('./includesPages/header.php');
?>

<body>
    <!-- SVG Preloader Starts -->
    <?php
        include_once ('./includesPages/preloader.php');
    ?>
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
								<h2 class="title-head">Get in <span>touch</span></h2>
								<!-- Title Ends -->
								<hr>
								<!-- Breadcrumb Starts -->
								<ul class="breadcrumb">
									<li><a href="./index.php" style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>"> home</a></li>
									<li>contact</li>
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
        <!-- Contact Section Starts -->
        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-8 contact-form">
						<h3 class="col-xs-12">feel free to drop us a message</h3>
                        <p class="col-xs-12">Need to speak to us? Do you have any queries or suggestions? Please contact us about all enquiries including membership and volunteer work using the form below.</p>
                        <p class="col-xs-12" style="margin-top: 0px; <?php include_once('./includesPages/style.php'); echo $textOrange;?>"><?php $information?></p>
                        <!-- Contact Form Starts -->
                        <form class="form-contact" method="post" action="contact.php">
                            <!-- Input Field Starts -->
                            <div class="form-group col-md-6">
                                <input class="form-control" name="firstname" id="firstname" placeholder="FIRST NAME" type="text" required>
                            </div>
                            <!-- Input Field Ends -->
                            <!-- Input Field Starts -->
                            <div class="form-group col-md-6">
                                <input class="form-control" name="lastname" id="lastname" placeholder="LAST NAME" type="text" required>
                            </div>
                            <!-- Input Field Ends -->
                            <!-- Input Field Starts -->
                            <div class="form-group col-md-6">
                                <input class="form-control" name="email" id="email" placeholder="EMAIL" type="email" required>
                            </div>
                            <!-- Input Field Ends -->
                            <!-- Input Field Starts -->
                            <div class="form-group col-md-6">
                                <input class="form-control" name="text" id="subject" placeholder="SUBJECT" type="text" required>
                            </div>
                            <!-- Input Field Ends -->
                            <!-- Input Field Starts -->
                            <div class="form-group col-xs-12">
                                <textarea class="form-control" id="message" name="message" placeholder="MESSAGE" required></textarea>
                            </div>
                            <!-- Input Field Ends -->
                            <!-- Submit Form Button Starts -->
                            <div class="form-group col-xs-12 col-sm-4">
                                <button class="btn btn-primary btn-contact" type="submit" name="sendMessageId" style="<?php include_once('./includesPages/style.php'); echo $btnOrangeTxtWhiteBorder;?>">send message </button>                           
                            </div>
                            <!-- Submit Form Button Ends -->
                        </form>
						<!-- Contact Form Ends -->
                    </div>
					<!-- Contact Widget Starts -->
                    <div class="col-xs-12 col-md-4">
                        <div class="widget">
                            <div class="contact-page-info">
								<!-- Contact Info Box Starts -->
                                <div class="contact-info-box">
                                    <i class="fa fa-home big-icon"></i>
                                    <div class="contact-info-box-content">
                                        <h4>Address</h4>
                                        <p>Van Wyck Expy, New York City</p>
                                    </div>
                                </div>
								<!-- Contact Info Box Ends -->
								<!-- Contact Info Box Starts -->
                                <div class="contact-info-box">
                                    <i class="fa fa-envelope big-icon"></i>
                                    <div class="contact-info-box-content">
                                        <h4>Email Addresses</h4>

                                        <p>info@fortuneapex.com</p>
                                    </div>
                                </div>
								<!-- Contact Info Box Ends -->
								<!-- Social Media Icons Starts -->
                                <div class="contact-info-box">
                                    <i class="fa fa-share-alt big-icon"></i>
                                    <div class="contact-info-box-content">
                                        <h4>Social Profiles</h4>
                                        <div class="social-contact">
                                            <ul>
                                                <li class="facebook"><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                                <li class="twitter"><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                                <li class="google-plus"><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
								<!-- Social Media Icons Starts -->
                            </div>
                        </div>
                    </div>
					<!-- Contact Widget Ends -->
                </div>
            </div>
        </section>
        <!-- Contact Section Ends -->
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
    <!-- Wrapper Ends -->
</body>

</html>