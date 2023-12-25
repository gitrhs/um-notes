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
	<link href="assets/images/favicon/favicon.png" rel="icon">

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
							<li><a href="index">home</a>
							</li>
							<li class="active"><a href="privacyPolice">Privacy Police</a>
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
			<div class="slide--item">
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
		<section id="feature2" class="section feature feature-2  bg-white">
			<div class="container">
				<div class="row clearfix">
					<div class="col-xs-12 col-sm-12 col-md-6 col-md-offset-3">
						<div class="heading heading-1 mb-70 wow fadeInUp" data-wow-duration="1s">
							<h1 class="heading--title" style="text-align: center;">Privacy Police</h1>
							<p class="heading--desc" style="text-align: center;">Last updated: 22 November 2023</p>
							<br><br>
							<p>
							    Welcome to UM Notes! This Privacy Policy describes how UM Notes ("we," "us," or "our") collects, uses, and shares your information when you access and use our website.
							
							    <h5><b>Information We Collect</b></h5>
							    <b>Account Information</b>
							    <p>To access UM Notes, users are required to log in using their university Siswamail accounts. We collect and store the following information:</p>
							    <ul>
                                  <li>Full name</li>
                                  <li>University email address (Siswamail)</li>
                                </ul> 
                                <b>User-Generated Content</b>
                                <p>UM Notes is a platform for students to share their notes. Any notes, comments, or other content you post on the platform may be collected and stored.</p>
                                <b>Automatically Collected Information</b>
                                <p>We may automatically collect certain information when you visit our website, including:</p>
                                <ul>
                                  <li>IP Address</li>
                                  <li>Date and time of access</li>
                                </ul> 
                                <h5><b>How We Use Your Information</b></h5>
                                <p>We use the collected information for the following purposes:</p>
                                <ul>
                                    <li>To provide and maintain UM Notes.</li>
                                    <li>To personalize your experience on the platform.</li>
                                    <li>To make sure that you are the active University of Malaya Students.</li>
                                    <li>To analyze usage patterns and improve our services.</li>
                                </ul>
                                <h5><b>Sharing Your Information</b></h5>
                                <p>We do not sell, trade, or otherwise transfer your personally identifiable information to third parties. Your information may be shared under the following circumstances:</p>
                                <ul>
                                    <li>With your consent.</li>
                                    <li>To comply with legal obligations.</li>
                                    <li>To protect our rights and the rights of others.</li>
                                </ul>
                                <h5><b>Security</b></h5>
                                <p>We take reasonable measures to protect the confidentiality and security of your information. However, no method of transmission over the internet or electronic storage is completely secure.</p>
                                <p>If you found any vuln or bug on the website, kindly contact us at [<a href="mailto:rafidaffa88@gmail.com">rafidaffa88@gmail.com</a>].</p>
                                <h5><b>Your Choices</b></h5>
                                <p>You can review, update, or delete your account information at any time by logging into your account. You can also contact us if you have any questions or concerns about your data.</p>
                                <h5><b>Changes to this Privacy Policy</b></h5>
                                <p>We may update this Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page.</p>
                                <h5><b>Contact Us</b></h5>
                                <p>If you have any questions or concerns about this Privacy Policy, please contact us at [<a href="mailto:rafidaffa88@gmail.com">rafidaffa88@gmail.com</a>].</p>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		

		

		<!-- Footer Scripts
============================================= -->
		<script src="assets/js/jquery-2.2.4.min.js"></script>
		<script src="assets/js/plugins.js"></script>
		<script src="assets/js/functions.js"></script>
</body>
</html>