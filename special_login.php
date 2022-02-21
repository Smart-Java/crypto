<?php
include_once ('./class/login_admin_class.php');
include_once ('./includes/connection_includes.php');

$admin = '';
$code = '';
$information = '';

if (isset($_POST['name']) && isset($_POST['code'])) {
	$admin = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['name'])), FILTER_SANITIZE_STRING);
	$code = filter_var(trim(mysqli_real_escape_string($connectionResult, $_POST['code'])), FILTER_SANITIZE_STRING);

	$loginAdmin = new AdminLoginClass($admin, $code);
	$result = $loginAdmin -> loginAdmin($connectionResult);
	$information = 'Note: '.$result;
}
?>
<!DOCTYPE html>
<html lang="en">


<?php include_once('./includesPages/header.php');?>

<body class="auth-page">
    <!-- SVG Preloader Starts -->
    <?php include_once('./includesPages/preloader.php');?>
    <!-- SVG Preloader Ends -->
    <!-- Wrapper Starts -->
    <div class="wrapper">
        <div class="container-fluid user-auth">
			<div class="hidden-xs col-sm-4 col-md-4 col-lg-4">
				<!-- Logo Starts -->
				<a class="logo" href="#">
					<img id="logo-user" class="img-responsive" src="user/images/favicon.png" alt="logo">
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
									<footer><span>Rawia Chniti</span>, Russia</footer>
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
					<img id="logo" class="img-responsive mobile-logo" src="user/images/favicon.png" alt="logo">
				</a>
				<!-- Logo Ends -->
				<div class="form-container">
					<div>
						<!-- Section Title Starts -->
						<div class="row text-center">
							<h2 class="title-head hidden-xs">Admin <span>login</span></h2>
							 <p class="info-form">Make sure you sign in once and dont login again to avoid disabling the account<br><small style="font-size: 16px; font_weight: normal; color:#ffa500;"><?php echo $information;?></small></p>
						</div>
						<!-- Section Title Ends -->
						<!-- Form Starts -->
						<form method="post" action="<?php echo $scriptName;?>">
							<!-- Input Field Starts -->
							<div class="form-group">
								<input class="form-control" name="name" id="name" placeholder="ADMIN NAME" type="text" value="<?php echo $admin;?>" required>
							</div>
							<!-- Input Field Ends -->
							<!-- Input Field Starts -->
							<div class="form-group">
								<input class="form-control" name="code" id="code" placeholder="ADMIN PIN CODE" type="password" value="<?php echo $code;?>" required>
							</div>
							<!-- Input Field Ends -->
							<!-- Submit Form Button Starts -->
							<div class="form-group">
								<button class="btn btn-primary" type="submit" style="<?php include_once('./includesPages/style.php'); echo $btnWhiteTxtOrangeBorder;?>">login</button>
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