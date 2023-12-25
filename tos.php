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
							<li><a href="privacyPolice">Privacy Police</a>
							</li>
							<li class="active"><a href="#">ToS</a>
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
							<h1 class="heading--title" style="text-align: center;">UM Notes Terms of Service</h1>
							<p class="heading--desc" style="text-align: center;">Last updated: 22 November 2023</p>
							<br><br>
							<p>
							    Welcome to UM Notes! By accessing or using our website, you agree to comply with and be bound by the following Terms of Service. Please read these terms carefully before using UM Notes.
							    <h5><b>Acceptance of Terms</b></h5>
							    <p>By accessing or using UM Notes, you agree to be bound by these Terms of Service. If you do not agree to these terms, please do not use our website.</p>
                                <h5><b>User Eligibility</b></h5>
                                <p>You must be a student of University Malaya and possess a valid Siswamail account to use UM Notes. By using our website, you represent and warrant that you meet these eligibility requirements.</p>
                                <h5><b>User Accounts</b></h5>
                                <p>To access certain features of UM Notes, you may be required to use your Siswamail Account. You are responsible for maintaining the confidentiality of your account information and agree to accept responsibility for all activities that occur under your account.</p>
                                <h5><b>User Conduct</b></h5>
                                <p>By using UM Notes, you agree not to:</p>
                                <ul>
                                    <li>Violate any applicable laws or regulations.</li>
                                    <li>Infringe upon the rights of others.</li>
                                    <li>Post or share content that is offensive, inappropriate, or violates our community guidelines.</li>
                                </ul>
                                <h5><b>Intellectual Property</b></h5>
                                <p>UM Notes and its original content, features, and functionality are owned by UM Notes and are protected by international copyright, trademark, patent, trade secret, and other intellectual property or proprietary rights laws.</p>
                                <h5><b>Termination</b></h5>
                                <p>We reserve the right to terminate or suspend your account and access to UM Notes at our sole discretion, without prior notice, for any reason, including without limitation, a breach of these Terms.</p>
                                <h5><b>Limitation of Liability</b></h5>
                                <p>UM Notes is provided "as is" without any warranties, expressed or implied. We shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues.</p>
                                <h5><b>Governing Law</b></h5>
                                <p>These Terms of Service are governed by and construed in accordance with the laws of Copyright Act 1987 (Act 332), without regard to its conflict of law principles.</p>
                                <h5><b>Changes to ToS</b></h5>
                                <p>We may update these Terms of Service from time to time. We will notify you of any changes by posting the new Terms of Service on this page.</p>
                                <h5><b>Contact Us</b></h5>
                                <p>If you have any questions or concerns about these Terms of Service, please contact us at [<a href="mailto:rafidaffa88@gmail.com">rafidaffa88@gmail.com</a>].</p>
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