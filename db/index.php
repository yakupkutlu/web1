<?php
include("app/connect.php");
include('system.php');

$page = @$_GET["page"];
//error_reporting(0);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76636950-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());

  gtag('config', 'UA-76636950-1');
</script>





<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>



<!-- Google reklam Manager   -------------------------------


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3687433991547872",
    enable_page_level_ads: true
  });
</script>

------------------------   Google reklam Manager -->

    <title>NESciences</title>
    <meta name="description" content="NESciences"/>
    <meta name="keywords" content="Journal of NESciences"/>
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico'/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/responsive.css"/>

    <link rel="stylesheet" type="text/css" href="css/custom.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PTGS93J');</script>
<!-- End Google Tag Manager -->
</head>


<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PTGS93J"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="header">
    <div id="banner" style="text-align: right">
        <a class="btn btn-round btn-success2" href="login.php">Login</a>
        <a class="btn btn-round btn-success2" href="login.php#signup">Register</a>
    </div><!--close banner-->
</div><!--close header-->

<div id="slideshow">
    <img src="images/iste.png" class="image_full"/>
    <img src="images/iste940.png" class="image_940"/>
    <img src="images/iste799.png" class="image_799"/>
    <img src="images/iste639.png" class="image_639"/>
    <img src="images/iste479.png" class="image_479"/>
    <img src="images/iste350.png" class="image_350"/>
</div><!--close slidesho-->

<div id="header">
    <div id="banner">
        <div id="welcome">
            <h1>
                <?php
                if ((!isset($page)) || ($page == "home")) echo 'About';
                if ($page == "aim_scope") echo 'Aim & Scope';
                if ($page == "editorial_board") echo 'Editorial Board';
                if ($page == "content") echo 'Current Issue';
                if ($page == "submission") echo 'Login';
                if ($page == "guide_for_authors") echo 'Guide for Authors';
                if ($page == "policy") echo 'Publication Ethics';   
                if ($page == "pppolicy") echo 'Peer Review Policy';
                if ($page == "archive") echo 'Archive';
                if ($page == "about") echo 'Index';                
                if ($page == "contact") echo 'Contact';
                if ($page == "earlyview") echo 'Early View';
                if ($page == "supplements") echo 'Supplements';
                if ($page == "announce") echo 'Announcements';
                ?>
            </h1>
        </div><!--close welcome-->
    </div><!--close banner-->
</div><!--close header-->


<div id="main">
    <div id="site_content">

        <?php include 'menu.php'; ?>

        <div class="content_container_midle">
            <?php
            if ((!isset($page)) || ($page == "home")) include("home.php");
            if ($page == "content") {
                $content = 1;
                include("content.php");
            }


            if ($page == "submission") {
            	
            //	include "login.php";

                ?>

                <center>
                    <form method="post" action="system.php?system=login">
                        <br>
                        <div>
                            <input type="text" placeholder="User Name" name="user" required=""/>
                        </div>
                        <div>
                            <input type="password" placeholder="Password" name="pass" required=""/>
                        </div>
                        <br>
                        <div>

                            <div class="formBody">
                                <input type="submit" value="Login" id="Send" onclick="send_form()"
                                       class="button_dynamic"/>
                            </div>


                            <a class="reset_pass" href="login.php#reset_pass">Lost your password?</a>
                        </div>

                        <hr>

                        <p class="change_link">
                            <a href="login.php#signup" style="font-size: 15px!important; font-weight: bold;">
                                <b>Create a New Account.</b> </a>
                        </p>

                </center>
                <?php


            }
            if ($page == "earlyview"){   $content = 1; include("content_earlyview.php"); }
            if ($page == "aim_scope") include("statik_icerik_goster.php");
            if ($page == "editorial_board") include("statik_icerik_goster.php");
            if ($page == "pppolicy") include("statik_icerik_goster.php");
            if ($page == "guide_for_authors") include("guide_for_authors.php");
            if ($page == "award") include("award.php");
            if ($page == "policy") include("policy.php");
            if ($page == "archive") {
                if ((isset($_GET["volume"]) and isset($_GET["no"]) and isset($_GET["year"])) || (isset($_GET["genel_aranan"]))) {
                    include('content.php');

                } else {
                    include 'archive.php';
                }
            }
            if ($page == "about") include("about.php");
            if ($page == "contact") include("contact.php");
            if ($page == "cited") include("cited.php");
            if ($page == "supplements")  {
                if ((isset($_GET["yturu"]) and isset($_GET["year"])) || (isset($_GET["genel_aranan"]))) {
                    include('contentsupplement.php');

                } else {
                    include("supplements.php"); 
                }
            }
            
            if ($page == "announce") include("announce.php");

            ?>

        </div>


    </div>


</div><!--close main-->
<?php include 'footer.php'; ?>


</body>
</html>
