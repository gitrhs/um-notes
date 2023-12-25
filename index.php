<?php
include 'core/conf.php';
if (isLogin()){
    //there are 2 option
    //1. already registered
    if (!empty(userType())){
        header("location: dashboard");
    } else { //2. new user 
        header("location: userinformation");
    }
}  else if (verifyLoginCookie()){
    header("location: dashboard");
}
$folder = totalFolder();
$file = totalFile();
//this will the page where main page is...
/*

*/

?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
	<!-- Document Meta
    ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--IE Compatibility Meta-->
	<meta name="author" content="zytheme"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="UM notes - a place for student to share their notes">
	<meta property="og:image" content="//notes.ppiunimalaya.id/core/img/mobile.jpg" />
	<link rel="icon" type="image/x-icon" href="/core/img/favicon.ico">

	<!-- Fonts
    ============================================= -->
	<link href='http://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700ii%7CMerriweather:300,300i,400,400i,700,700i,900,900i' rel='stylesheet' type='text/css'>

	<!-- Stylesheets
    ============================================= -->
	<link href="assets/css/external.css" rel="stylesheet">
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">	
	<link href="assets/css/style.css?1" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	<!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
      <script src="assets/js/respond.min.js"></script>
    <![endif]-->

	<!-- Document Title
    ============================================= -->
	<title>UM Notes</title>
</head>

<body class="body-scroll" data-bs-theme="dark">
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="wrapper clearfix">
		
		<!-- Header
        ============================================= -->
		<header id="navbar-spy" class="header header-1 header-transparent header-bordered header-fixed">

			<nav id="primary-menu" class="navbar navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					
						<a class="logo" href="index.html">
						<img class="logo-dark" src="/core/img/logo-black.png" width="150" alt="appy Logo">
						<img class="logo-light" src="/core/img/logo.png" width="150" alt="appy Logo">
					</a>
					</div>
					<div class="collapse navbar-collapse pull-right" id="navbar-collapse-1">
						<ul class="nav navbar-nav nav-pos-right navbar-left nav-split">
							<li class="active"><a data-scroll="scrollTo" href="#slider">home</a>
							</li>
							<li><a href="privacyPolice">Privacy Police</a>
							</li>
							<li><a href="tos">ToS</a>
							</li>
							<li><a href="login">Login</a>
							</li>
						</ul>
					</div>
					<!--/.nav-collapse -->
				</div>
			</nav>

		</header>

		<!-- Slider #1
============================================= -->
		<section id="slider" class="section slider slider-2">
			<div class="slide--item" style="background-color: #181b21;">
				<div class="bg-ytvideo bg-overlay bg-overlay-dark">
				    <img src="core/gif/main.gif" style="object-fit: cover; width: 100%; height: 100%; -webkit-filter: blur(5px);
                    -moz-filter: blur(5px);
                    -o-filter: blur(5px);
                    -ms-filter: blur(5px);
                    filter: blur(5px);
                    background-color: #ccc;"></img>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="slide--logo mt-100 hidden-xs wow fadeInUp" data-wow-duration="1s">
								<img src="/core/img/logo.png" width="150" alt="logo hero">
							</div>
						</div>
					</div>
					<div class="row row-content">
						<div class="col-xs-12 col-sm-5 col-md-5 wow fadeInUp" data-wow-duration="1s">
							<div class="slide--holder">
								<img class="img-responsive" src="/core/img/umnotelogocircl.png" alt="screens">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-sm-offset-1 col-md-6 col-md-offset-1 pt-100 wow fadeInUp" data-wow-duration="1s">
							<div class="slide--headline"><b>“UM Notes”</b>, a place for UM students to share their notes and lecture slides.</div>
							<div class="slide--action">
								<a class="btn btn--primary btn--rounded" href="login">Login</a>
							</div>
						</div>
					</div>
					<!-- .row end -->
				</div>
				<!-- .container end -->
			</div>
			<!-- .slide-item end -->
		</section>
		<!-- #slider end -->
		<div class="clearfix bg-white"></div>
		<!-- Feature #2
============================================= -->
		<section id="feature2" class="section feature feature-2 text-center bg-white">
			<div class="container">
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
						<div class="heading heading-1 mb-70 text--center wow fadeInUp" data-wow-duration="1s">
							<h2 class="heading--title">Platform</h2>
							<p class="heading--desc">Providing UM Students with tools to access course content, collaborate with peers, and prepare for lectures and exams.</p>
						</div>
					</div>
					<!-- .col-md-6 end -->
				</div>
				<!-- .row end -->
				<div class="row">
					<!-- Panel #1 -->
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="feature-panel wow fadeInUp" data-wow-duration="1s">
							<div class="feature--icon">
								<i class="fa-solid fa-eye"></i>
							</div>
							<div class="feature--content">
								<h3>View</h3>
								<p>Allow UM students to view the content of courses before making a decision to enroll through MAYA.</p>
							</div>
						</div>
						<!-- .feature-panel end -->
					</div>
					<!-- .col-md-4 end -->

					<!-- Panel #2 -->
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="feature-panel wow fadeInUp" data-wow-duration="1s">
							<div class="feature--icon">
								<i class="fa-solid fa-arrow-up-from-bracket"></i>
							</div>
							<div class="feature--content">
								<h3>Share</h3>
								<p>Student Collaboration and Note Sharing.</p>
							</div>
						</div>
						<!-- .feature-panel end -->
					</div>
					<!-- .col-md-4 end -->

					<!-- Panel #3 -->
					<div class="col-xs-12 col-sm-4 col-md-4">
						<div class="feature-panel wow fadeInUp" data-wow-duration="1s">
							<div class="feature--icon">
								<i class="fa-solid fa-book"></i>
							</div>
							<div class="feature--content">
								<h3>Prepare</h3>
								<p>Preparation for Lectures and Exams.</p>
							</div>
						</div>
						<!-- .feature-panel end -->
					</div>
					<!-- .col-md-4 end -->
				</div>
				<!-- .row end -->
			</div>
			<!-- .container end -->
		</section>
		<!-- #feature2 end -->
		<section class="pt-0 pb-0 bg-white">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<hr class="feature-divider">
					</div>
				</div><!-- .row end -->
			</div><!-- .container end -->
		</section>
		<!-- Feature #2
============================================= -->
		<section id="feature2" class="section feature feature-2 feature-left bg-white">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-5">
						<div class="heading heading-1 mb-60 wow fadeInUp" data-wow-duration="1s">
							<h2 class="heading--title pt-20">Content</h2>
							<p class="heading--desc pl-0">We collect the content from University of Malaya Contributors</p>
						</div>
						<div class="feature-panel mb-50 wow fadeInUp" data-wow-duration="1s">
							<div class="feature--icon">
								<i class="fa-solid fa-folder"></i>
							</div>
							<div class="feature--content">
								<h3><? echo $folder ?> Folders</h3>
								<p><? echo $folder ?> Folders have been created in UM Notes Platform</p>
							</div>
						</div>
						<!-- .feature-panel end -->
						<div class="feature-panel wow fadeInUp" data-wow-duration="1s">
							<div class="feature--icon">
								<i class="fa-solid fa-book"></i>
							</div>
							<div class="feature--content">
								<h3><? echo $file ?> Files</h3>
								<p><? echo $file ?> Files have been uploaded in UM Notes Platform</p>
							</div>
						</div>
						<!-- .feature-panel end -->
					</div><!-- .col-md-6 end -->
					<div class="col-xs-12 col-sm-12 col-md-7 wow fadeInUp">
						<img class="img-responsive center-block" src="core/img/macbook.png" alt="macbook"/>
					</div><!-- .col-md-6 end -->
				</div><!-- .row end -->
			</div>
			<!-- .container end -->
		</section>
		<!-- #feature2 end -->

		<!-- Banner 
============================================= -->
		<section id="banner" class="section banner pt-0 pb-0">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 pr-0 pl-0">
						<div class="col-img">
							<div class="bg-section">
								<img src="/core/img/pc.jpg" alt="Background"/>
							</div>
						</div>
					</div>
					<!-- .col-md-6 end-->
					<div class="col-xs-12 col-sm-12 col-md-6 col-content pl-100">
						<h3>About UM Notes</h3>
						<p style="font-size: 25px;  line-height: 1.6;">UM Notes, the best place to share your study related materials! 
Our mission is to empower every UM students to excel at their 
studies by providing the best tools to study more efficiently.<br>
Learn anywhere, any time, in any device.</p>
					</div>
				</div>
				<!-- .row end -->
			</div>
			<!-- .container end -->
		</section>
		<!-- #banner2 end -->

		<!-- reviews
        ============================================= -->
		<section id="reviews" class="section reviews bg-white">
			<div class="container">
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
						<div class="heading heading-1 mb-80 text--center wow fadeInUp" data-wow-duration="1s">
							<h2 class="heading--title">Features</h2>
						</div>
					</div>
					<!-- .col-md-6 end -->
				</div>
				<!-- .row end -->

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="carousel " data-slide="2" data-slide-res="1" data-autoplay="true" data-nav="false" data-dots="false" data-space="30" data-loop="true" data-speed="800">
							<!--  featuress #1  -->
							<div class="testimonial-panel wow fadeInUp" data-wow-duration="1s">
								<div class="testimonial-body">
									<div class="testimonial--body">
										<p>Users can enhance the sharing and accessibility of knowledge by sharing their notes to UM Notes</p>
									</div>
									<div class="testimonial--meta">
										<div class="testimonial--author">
											<span style="font-size: 50px;"><i class="fa-solid fa-arrow-up-from-bracket"></i></span>
											<h4>Share</h4>
										</div>
									</div>
								</div>
							</div>

							<div class="testimonial-panel wow fadeInUp" data-wow-duration="1s">
								<div class="testimonial-body">
									<div class="testimonial--body">
										<p>Users can see other user's notes 
creating diverse perspectives among the user community</p>
									</div>
									<div class="testimonial--meta">
										<div class="testimonial--author">
											<span style="font-size: 50px;"><i class="fa-solid fa-eye"></i></span>
											<h4>View</h4>
										</div>
									</div>
								</div>
							</div>
							
							<div class="testimonial-panel wow fadeInUp" data-wow-duration="1s">
								<div class="testimonial-body">
									<div class="testimonial--body">
										<p>User that share their notes will recieve a point that can be redeemed to rewards.</p>
									</div>
									<div class="testimonial--meta">
										<div class="testimonial--author">
											<span style="font-size: 50px;"><i class="fa-solid fa-coins"></i></span>
											<h4>Rewards</h4>
										</div>
									</div>
								</div>
							</div>
							 
							<div class="testimonial-panel wow fadeInUp" data-wow-duration="1s">
								<div class="testimonial-body">
									<div class="testimonial--body">
										<p>Once you login to the site, you will always logged in for 30 days (unless logout).</p>
									</div>
									<div class="testimonial--meta">
										<div class="testimonial--author">
											<span style="font-size: 50px;"><i class="fa-solid fa-right-to-bracket"></i></span>
											<h4>Always Login</h4>
										</div>
									</div>
								</div>
							</div>
							
							<div class="testimonial-panel wow fadeInUp" data-wow-duration="1s">
								<div class="testimonial-body">
									<div class="testimonial--body">
										<p>User and Developer can use API that provided to do some function.</p>
									</div>
									<div class="testimonial--meta">
										<div class="testimonial--author">
											<span style="font-size: 50px;">{   }</span>
											<h4>API</h4>
										</div>
									</div>
								</div>
							</div>
							
							<div class="testimonial-panel wow fadeInUp" data-wow-duration="1s">
								<div class="testimonial-body">
									<div class="testimonial--body">
										<p>Using search bar can helps you to find the file easily</p>
									</div>
									<div class="testimonial--meta">
										<div class="testimonial--author">
											<span style="font-size: 50px;"><i class="fa-solid fa-magnifying-glass"></i></span>
											<h4>Search Bar</h4>
										</div>
									</div>
								</div>
							</div>
							
							<div class="testimonial-panel wow fadeInUp" data-wow-duration="1s">
								<div class="testimonial-body">
									<div class="testimonial--body">
										<p>You can simply click "Report" button if there is something wrong with the file.</p>
									</div>
									<div class="testimonial--meta">
										<div class="testimonial--author">
											<span style="font-size: 50px;"><i class="fa-solid fa-flag"></i></span>
											<h4>Report</h4>
										</div>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<!-- .container End -->
		</section>
		<!-- #reviews End-->

		<!-- Pricing Table #1
============================================= -->
		<section id="pricing" class="section pricing pricing-1 bg-gray">
			<div class="container">
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
						<div class="heading heading-1 mb-80 text--center wow fadeInUp" data-wow-duration="1s">
							<h2 class="heading--title">Beneficial</h2>
							<p class="heading--desc">we shows only the best websites, portfolios ans landing pages built completely with passion, simplicity & creativity !</p>
						</div>
					</div>
					<!-- .col-md-6 end -->
				</div>
				<!-- .row end -->
				<div class="row">

					<!-- Pricing Packge #2
			============================================= -->
					<div class=" col-xs-12 col-sm-6 col-md-6 price-table wow fadeInUp" data-wow-duration="1s">
						<div class="pricing-panel">
							<!--  Pricing heading  -->
							<div class="pricing--heading text--center">
								<h4><i class="fa-solid fa-user"></i></h4>
								<div class="pricing--heading">
									<h4 style="color: black;">User
									</h4>
									<div class="pricing--desc">
										Normal User
									</div>
								</div>
							</div>
							<!--  Pricing body  -->
							<div class="pricing--body">
								<ul class="pricing--list list-unstyled">
									<li>Upload File</li>
									<li>Access File</li>
								</ul>
							</div>
							<!--  Pricing Body  -->
						</div>
					</div>
					<!-- .pricing-table End -->

					<!-- Pricing Packge #3
			============================================= -->
					<div class=" col-xs-12 col-sm-6 col-md-6 price-table wow fadeInUp" data-wow-duration="1s">
						<div class="pricing-panel">
							<!--  Pricing heading  -->
							<div class="pricing--heading text--center">
								<h4><i class="fa-solid fa-handshake-angle"></i></h4>
								<div class="pricing--heading">
									<h4 style="color: black;">Contributor
									</h4>
									<div class="pricing--desc">
										Verified User
									</div>
								</div>
							</div>
							<!--  Pricing body  -->
							<div class="pricing--body">
								<ul class="pricing--list list-unstyled">
									<li>Upload File</li>
									<li>Access File</li>
									<li>Automatic Approve</li>
									<li>Edit/delete file</li>
									<li>Rewards</li>
								</ul>
							</div>
							<!--  Pricing Body  -->
						</div>
					</div>
					<!-- .pricing-table End -->
				</div>
				<!-- .row end -->
			</div>
			<!-- .container end -->
		</section>
		<!-- #pricing1 end -->
		<!-- CTA #1
============================================= -->
		<section id="cta" class="section cta text-center pb-0 bg-dark">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3 mb-100 wow fadeInUp" data-wow-duration="1s">
						<h3>UM Notes</h3>
						<p>a place for UM students to share their notes and lecture slides.</p>
						<a class="btn btn--primary btn--rounded" href="login">Login</a>
					</div>
					<!-- .col-md-12 end -->
				</div>
				<!-- .row end -->
			</div>
			<!-- .container end -->
		</section>
		<!-- #cta1 end -->

		<!-- Footer #5
============================================= -->
		<footer id="footer" class="footer footer-5">
			<!-- Copyrights
	============================================= -->
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 text--center">
						<div class="footer--copyright">
							<span>&copy; 2023, Created With <i class="fa fa-heart"></i> by</span> <a href="https://mbed.cc">Rafi Daffa</a>
						</div>
					</div>

				</div>
			</div>
			<!-- .container end -->
		</footer>
		</div>
		<!-- #wrapper end -->

		<!-- Footer Scripts
============================================= -->
		<script src="assets/js/jquery-2.2.4.min.js"></script>
		<script src="assets/js/plugins.js"></script>
		<script src="assets/js/functions.js"></script>
</body>
</html>