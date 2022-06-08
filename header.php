<?php 
$uri = $_SERVER['REQUEST_URI'];

require (strpos($uri, 'news-and-events.php') ? 'functions.php' : 'config.php');
$page = "home";

$title = 'Indian Oil XTRAPOWER Fleet Card Program';
$description = 'IndianOil’s XTRAPOWER Smart Fleet Card Program is a complete Fleet Management Solution.';
$keywords = 'Fleet Card, Smart Fleet Card, Xtrapower';

if(strpos($uri, 'xtrapower-program-details.php') !== false){
    $page = 'xtrapower-program-details';
    $description = 'IndianOil’s XTRAPOWER Fleet Card is the ideal choice for managing your entire fleet easily';
} else if(strpos($uri, 'xtrapower-credit-partners.php') !== false) {
    $page = 'credit-partner';
    $title = 'Buy Fuel on Credit';
    $description = 'XTRAPOWER Fleet Card offers credit facility for purchase of Diesel';
    $keywords = 'Credit, Credit Facility, Fleet Card';
} else if(strpos($uri, 'xtrapower-awards.php') !== false) {
    $page = 'awards-recognition';
    $title = 'XTRAPOWER – Awards & Recognitions';
    $description = 'India’s most awarded Fleet Card Program';
} else if(strpos($uri, 'enroll-now.php') !== false) {
    $page = 'become-a-member';
    $title = 'Enroll now – Register Online';
    $description = 'Customers interested in becoming a member can apply online';
    $keywords = 'Fleet Card, Apply Online, Enroll now';
} else if(strpos($uri, 'xtrapower-downloads.php') !== false) {
    $page = 'downloads';
    $title = 'Download Useful Forms here';
    $description = 'Download useful forms related to XTRAPOWER Fleet Card';
    $keywords = 'Fleet Card, Application, Xtrapower';
} else if(strpos($uri, 'xtrapower-fleet-card-FAQs.php') !== false) {
    $page = 'faqs-help-center';
    $title = 'XTRAPOWER Fleet Card Queries';
    $description = 'XTRAPOWER Program – Fleet Card FAQs';
    $keywords = 'Fleet Card, Fleet Card FAQs, Xtrapower';
} else if(strpos($uri, 'network.php') !== false) {
    $page = 'network';
} else if(strpos($uri, 'telematics.php') !== false) {
    $page = 'telematics';
} else if(strpos($uri, 'industry.php') !== false) {
    $page = 'industry';
} else if(strpos($uri, 'easy-fuel.php') !== false) {
    $page = 'easy-fuel';
} else if(strpos($uri, 'easy-recharge.php') !== false) {
    $page = 'easy-recharge';
} else if(strpos($uri, 'insurance-benefits.php') !== false) {
    $page = 'insurance-benefits';
} else if(strpos($uri, 'disclaimer.php') !== false) {
    $page = 'disclaimer';
} else if(strpos($uri, 'privacy-policies.php') !== false) {
    $page = 'privacy-policies';
} else if(strpos($uri, 'terms-and-conditions.php') !== false) {
    $page = 'terms-and-conditions';
} else if(strpos($uri, 'news-and-events.php') !== false) {
    $page = 'news-and-events';
} else if(strpos($uri, 'see-a-demo.php') !== false) {
    $page = 'see-a-demo';
} else if(strpos($uri, 'b2b-integration.php') !== false) {
    $page = 'b2b-integration';
} else if(strpos($uri, 'help-center.php') !== false) {
    $page = 'help-center';
} else if(strpos($uri, 'faqlist.php') !== false) {
    $page = 'faqlist';
} else if(strpos($uri, 'support-article.php') !== false) {
    $page = 'support-article';
} 



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?=$description ?>">
    <meta name="keywords" content="<?=$keywords ?>">
    <meta name="author" content="IndianOil">
    <title><?=$title ?></title>

    <link rel="shortcut icon" href="<?=WEB_URL?>assets/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/bootstrap-4.5.0.min.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/fonts/LineIcons.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/owl.carousel.2.3.4.min.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/owl.theme.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/animate.css">
    <link rel="stylesheet" href="<?=WEB_URL?>assets/css/style1.css">
    <!--link rel="stylesheet" href="<?=WEB_URL?>assets/css/responsive.css"
    <?php if($page!='home'){ ?> <link rel="stylesheet" href="<?=WEB_URL?>assets/css/style.css"> <?php } ?>-->
</head>

<body>

    <header id="home" class="header">
        <div class="navbar-area">
            <div class="ioc-container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="<?=WEB_URL?>">
                                <img src="<?=WEB_URL?>assets/img/logo.png" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    <li class="nav-item<?=($page=='home') ? ' active' : ''?>">
                                        <a class="page-scroll" href="<?=WEB_URL?>#hero-area">Home</a>
                                    </li>
                                    <li class="nav-item<?=($page=='xtrapower-program-details') ? ' active' : ''?>">
                                        <a class="page-scroll" href="<?=WEB_URL?>#Program">Program</a>
                                    </li>
                                    <li class="nav-item<?=($page=='network') ? ' active' : ''?>">
                                        <a class="page-scroll" href="<?=WEB_URL?>#Network">Network</a>
                                    </li>
                                    <li class="nav-item<?=($page=='telematics') ? ' active' : ''?>">
                                        <a class="page-scroll" href="<?=WEB_URL?>#Telematics">Telematics</a>
                                    </li>
                                    <li class="nav-item<?=($page=='easy-fuel') ? ' active' : ''?>">
                                        <a class="page-scroll" href="<?=WEB_URL?>#Gifting">Gifting</a>
                                    </li>
                                    <li class="nav-item<?=($page=='easy-recharge' || $page=='insurance-benefits') ? ' active' : ''?>">
                                        <a class="page-scroll">More <i class="lni lni-chevron-down"></i></a>
                                        <ul class="sub-menu">
                                            <li><a href="<?=WEB_URL?>industry.php">Industry Solution</a></li>
                                            <li><a href="<?=WEB_URL?>search-outlet.php">Search Outlet</a></li>
                                            <li><a href="<?=WEB_URL?>help-center.php">Help Center</a></li>
                                            <li><a href="<?=WEB_URL?>#contact">Contact Us</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="menu-cta page-scroll" href="<?=WEB_LOGIN_URL?>">Login</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
    