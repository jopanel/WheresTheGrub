<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find who delivers food, where restaurants are, and your favorite grub.">
    <meta name="author" content="support@wheresthegrub.com">


    <link href="http://<?=$_SERVER['SERVER_NAME']?>/resources/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/jquery.mCustomScrollbar.css" type="text/css">
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/style.css" type="text/css">
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/user.style.css" type="text/css">
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/dropzone.css" type="text/css">
    <link rel="stylesheet" href="http://<?=$_SERVER['SERVER_NAME']?>/resources/css/jquery.ui.timepicker.css" type="text/css"> 


    <title>Wheres The Grub - Find Your Food Fast!</title>
    <meta name="robots" content="index, nofollow">
    <meta name="DC.Creator" content="Opanel, Joseph">
    <meta name="DC.Language" content="en">
    <meta name="DC.publisher" content="Opanel, Joseph">
    <meta name="DC.description" content="Lenapo Solutions provides professional web development, internet marketing, seo, and design in Los Angeles and Orange County.">
    <meta name="DC.subject" content="web development los angeles, web development orange county, internet marketing orange county, internet marketing los angeles, seo la, seo oc, best seo in la, lenapo solutions, lenapo">
    <meta name="DC.title" content="Wheres The Grub Food Finder Delivery Takeout Restaurant">
</head>

<body onunload="" class="map-fullscreen page-homepage navigation-off-canvas"  id="page-top">

<!-- Outer Wrapper-->
<div id="outer-wrapper">
    <!-- Inner Wrapper -->
    <div id="inner-wrapper">
        <!-- Navigation-->
        <div class="header">
            <div class="wrapper">
                <div class="brand">
                    <a href="http://<?=$_SERVER['SERVER_NAME']?>"><img src="http://<?=$_SERVER['SERVER_NAME']?>/resources/img/logo.png" alt="logo"></a>
                </div>
                <?php 
                if (isset($problem) && $problem == TRUE) {} else { ?>
                <nav class="navigation-items">
                    <div class="wrapper">
                        <ul class="main-navigation navigation-top-header"></ul>
                        <ul class="user-area">
                            <li><a href="/search">Find Food</a></li>
                            <li><a href="/business">Services</a></li>
                            <li><a href="/start/support">Support</a></li>
                            <?php if ($this->session->userdata("email")) { ?>
                            <li><a href="/user/feed"><strong>Coupons & Deals</strong></a></li>
                            <li><a href="/user/profile">Settings</a></li>
                           <?php } if ($this->session->userdata("vendorloggedin")) { ?>
                           <li><a href="/vendor"><strong>Welcome Back, <?=$this->session->userdata("fullname")?></strong></a></li>
                           <li><a href="/user/logout">Logout</a></li>
                           <?php } 

                           if (!$this->session->userdata("vendorloggedin") && !$this->session->userdata("email")) { ?>
                            <li><a href="/signin">Login</a></li>
                            <li><a href="/register"><strong>Register</strong></a></li>
                                <?php } ?>
                        </ul>
                        <div class="toggle-navigation">
                            <div class="icon">
                                <div class="line"></div>
                                <div class="line"></div>
                                <div class="line"></div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- end Navigation-->
        <!-- Page Canvas-->
        <div id="page-canvas" <?php if (isset($bgstyle)) { echo $bgstyle; } ?>>
            <!--Off Canvas Navigation-->
            <nav class="off-canvas-navigation">
                <header>Navigation</header>
                <div class="main-navigation navigation-off-canvas"></div>
                <ul class="user-area">
                            <li><a href="/search">Find Food</a></li>
                            <li><a href="/business">Services</a></li>
                            <li><a href="/start/support">Support</a></li>
                            <li><a href="/start/about">About Us</a></li> 
                            <?php if ($this->session->userdata("email")) { ?>
                            <li><a href="/user/feed">Coupons & Deals</a></li>
                            <li><a href="/user/following">Following</a></li>
                            <li><a href="/user/reviews">My Reviews</a></li>
                            <li><a href="/user/">My Profile</a></li>
                            <li><a href="/user/profile">Settings</a></li>
                            <li><a href="/user/logout">Logout</a></li>
                           <?php } 

                           if ($this->session->userdata("vendorloggedin")) { ?>
                           <li><a href="/vendor"><strong>Welcome Back, <?=$this->session->userdata("fullname")?></strong></a></li>
                           <li><a href="/user/logout">Logout</a></li>
                           <?php } 

                           if (!$this->session->userdata("vendorloggedin") && !$this->session->userdata("email")) { ?>
                            <li><a href="/signin">Login</a></li>
                            <li><a href="/register"><strong>Register</strong></a></li>
                                <?php } ?>
                        </ul>
            </nav>
                <?php } ?>
                
            <!--end Off Canvas Navigation-->

