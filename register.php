<?php
include_once ('./class/register_investor.php');
include_once ('./includes/connection_includes.php');

$email = '';
$password = '';
$confirmPassword = '';
$fullname = '';
$username = '';
$information = '';

if(isset($_GET['investor']) && !empty($_GET['investor'])){
	$getInvestorCode = filter_var(trim(mysqli_real_escape_string($connectionResult, $_GET['investor'])), FILTER_SANITIZE_STRING);
	$path = '?investor='.$getInvestorCode;
} else{
	$path = '';
}

if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['confirmPassword']) && isset($_POST['username'])) {
	$email = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['email'])), FILTER_SANITIZE_EMAIL);
	$password = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['password'])), FILTER_SANITIZE_STRING);
	$confirmPassword = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['confirmPassword'])), FILTER_SANITIZE_STRING);
	$fullname = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['name'])), FILTER_SANITIZE_STRING);
	$username = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['username'])), FILTER_SANITIZE_STRING);
	
	$registerInvestor = new InvestorRegistrationClass($email, $password, $confirmPassword, $fullname, $username);
	$information = 'Note: '.$registerInvestor -> uploadNewInvestor($connectionResult);
}
?>
<!DOCTYPE html>
<html lang="en">


<?php include_once('./includesPages/header.php')?>

<body class="auth-page" style="height: 100%;">
    <!-- SVG Preloader Starts -->
    <?php include_once('./includesPages/preloader.php')?>
    <!-- SVG Preloader Ends -->
	
    <!-- Wrapper Starts -->
    <div class="wrapper">
        <div class="container-fluid user-auth">
			<div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
				<!-- Logo Starts -->
				<a class="logo" href="./index.php">
					<img id="logo-user" class="img-responsive" src="images/backgrounds/favicon.png" alt="logo">
				</a>
				<!-- Logo Ends -->
				<!-- Slider Starts -->
				<div id="carousel-testimonials" class="carousel slide carousel-fade" data-ride="carousel">
					<!-- Indicators Starts -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-testimonials" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-testimonials" data-slide-to="1"></li>
						<li data-target="#carousel-testimonials" data-slide-to="2"></li>
					</ol>
					<!-- Indicators Ends -->
					<!-- Carousel Inner Starts -->
					<div class="carousel-inner">
						<!-- Carousel Item Starts -->
						<div class="item active item-1">
							<div>
								<blockquote>
									<p>This is a realistic program for anyone looking for site to invest. Paid to me regularly, keep up good work!</p>
									<footer><span>Lucy Smith</span>, England</footer>
								</blockquote>
							</div>
						</div>
						<!-- Carousel Item Ends -->
						<!-- Carousel Item Starts -->
						<div class="item item-2">
							<div>
								<blockquote>
									<p>Bitcoin doubled in 7 days. You should not expect anything more. Excellent customer service!</p>
									<footer><span>Slim Hamdi</span>, Tunisia</footer>
								</blockquote>
							</div>
						</div>
						<!-- Carousel Item Ends -->
						<!-- Carousel Item Starts -->
						<div class="item item-3">
							<div>
								<blockquote>
									<p>My family and me want to thank you for helping us find a great opportunity to make money online. Very happy with how things are going!</p>
									<footer><span>Dalel Boubaker</span>, Russia</footer>
								</blockquote>
							</div>
						</div>
						<!-- Carousel Item Ends -->
					</div>
					<!-- Carousel Inner Ends -->
				</div>
				<!-- Slider Ends -->
			</div>
			<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
				<!-- Logo Starts -->
				<a class="visible-xs" href="./index.php">
				<img id="logo-mobile" class="img-responsive" src="images/backgrounds/favicon.png" alt="log">
				</a>
				<!-- Logo Ends -->
				<div class="form-container" style="height: 100%;">
					<div>
						<!-- Section Title Starts -->
						<div class="row text-center">
							<h2 class="title-head hidden-xs">get <span>started</span></h2>
							 <p class="info-form">Open account for free and start trading Bitcoins now!<br><small style="font-size: 16px; font_weight: normal; color:#ffa500;"><?php echo $information;?></small></p>
						</div>
						<div id="google_translate_element" style="text-align: center;">
                
                		</div>
						<!-- Section Title Ends -->
						<!-- Form Starts -->
						<form method="post" action="register.php<?php echo $path;?>">
							<!-- Input Field Starts -->
							<div class="form-group">
								<input class="form-control" name="name" id="name" placeholder="NAME" type="text" value="<?php echo $fullname;?>" required>
							</div>
							<!-- Input Field Ends -->
							<!-- Input Field Starts -->
							<div class="form-group">
								<input class="form-control" name="username" id="username" placeholder="Username" type="text" value="<?php echo $username;?>" required>
							</div>
							<!-- Input Field Ends -->
							<!-- Input Field Starts -->
							<div class="form-group">
								<input class="form-control" name="email" id="email" placeholder="EMAIL" type="email" value="<?php echo $email;?>" required>
							</div>
							<!-- Input Field Ends -->
							<!-- Input Field Starts -->
							<div class="form-group">
								<input class="form-control" name="password" id="password" placeholder="PASSWORD" type="password" value="<?php echo $password;?>" >
							</div>
							<!-- Input Field Ends -->
							<!-- Input Field Starts -->
							<div class="form-group">
								<input class="form-control" name="confirmPassword" id="confirmPassword" placeholder="CONFRIM PASSWORD" type="password" value="<?php echo $confirmPassword;?>" required>
							</div>
							<!-- Input Field Ends -->
							<!-- Submit Form Button Starts -->
							<div class="form-group">
								<button class="btn btn-primary" type="submit" style="<?php include_once('./includesPages/style.php'); echo $btnWhiteTxtOrangeBorder;?>">create account</button>
								<p class="text-center">already have an account ? <a href="./login.php" style="<?php include_once('./includesPages/style.php'); echo $textOrange;?>">Login</a>
							</div>
							<!-- Submit Form Button Ends -->
						</form>
						<!-- Form Ends -->
					</div>
				</div>
				<?php include_once('./includesPages/login_footer.php');?>

    </div>
    <!-- Wrapper Ends -->
</body>


</html>