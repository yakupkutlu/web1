

<?php
include("app/connect.php");
include('./system.php');

$page = @$_GET["page"];
//error_reporting(0);

?>


<html lang="en">




<head>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "http://www.journaljaiwa.com/",
  "name": "journaljaiwa",
  "description": "JAIwA  is a journal platform for publishing scientific research articles."
}
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SHBBPLGEJW"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SHBBPLGEJW');
</script>
    <meta charset="utf-8">
	<?php
	$id = @$_GET["paperID"];
	if ($id  =="")  {
	$description=@get_icerik("aim_scope");
	$keywords=$description;
	$title = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM options "))->journalName;
	}else{
		$sorgu="SELECT * FROM submission_list WHERE id=".$id." AND `accept` = 1 ";
	 $title = mysqli_fetch_object(mysqli_query($baglanti,$sorgu))->title;
	 $description = mysqli_fetch_object(mysqli_query($baglanti,$sorgu))->abstract;
	 $keywords = mysqli_fetch_object(mysqli_query($baglanti,$sorgu))->keyword;
	}
		
   ?>
    <title><?php echo preg_replace('/<[^>]*>/', '', $title);
   ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="<?php echo preg_replace('/<[^>]*>/', '', $keywords);   ?>" name="keywords">
    <meta content="<?php echo preg_replace('/<[^>]*>/', '', $description);   ?>" name="description">
     
	 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
     <meta name="robots" content="nofollow">
	 <meta name="revisit" content="10 days">





<meta name="twitter:title" content="<?php echo preg_replace('/<[^>]*>/', '', $title);   ?>">
<meta name="twitter:description" content="<?php echo preg_replace('/<[^>]*>/', '', $keywords);   ?>">
<meta name="twitter:url" content="<?php echo  "https://".$journalDomain;   ?>">
<meta name="twitter:card" content="<?php echo preg_replace('/<[^>]*>/', '', $description);   ?>">


<meta property="og:title" content="<?php echo preg_replace('/<[^>]*>/', '', $title);   ?>">
<meta property="og:description" content="<?php echo preg_replace('/<[^>]*>/', '', $description);   ?>">
<meta property="og:image" content="<?php echo "https://".$journalDomain."/".$journallogo;   ?>">
<meta property="og:url" content="<?php echo "https://".$journalDomain;  ?>">



    <!-- Favicon -->
    <link href="favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet   -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
   
    <!-- Libraries Stylesheet-->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
 
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-blue2 navbar-light shadow sticky-top p-0">
            <a title="content " href="index.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
               <img style="mergin-left:30%; margin-top:80px" class="img-fluid" src="./_jaiwa_logo.png" alt=""> 
            </a>
			
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    
					  <div class="nav-item dropdown">
                        <a title="content " href="index.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About</a>
                        <div class="dropdown-menu rounded-0 m-0">
                             <a title="content " href="index.php" class="dropdown-item">About</a>
                            <a title="content " href="index.php?page=aim_scope" class="dropdown-item">Aim & Scope</a>
                            <a title="content " href="index.php?page=editorial_board" class="dropdown-item">Editorial Board</a>
							<a title="content " href="index.php?page=policy" class="dropdown-item">Publication Ethics</a>
							<a title="content " href="index.php?page=pppolicy" class="dropdown-item">Policies</a>
							<a title="content " href="index.php?page=copyright_and_licensing" class="dropdown-item">Copyright and Licensing</a>
							
							 
                        </div>
                    </div>
                    
					<!--		
                    <div class="nav-item dropdown">
                        <a title="content " href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">About</a>
                        <div class="dropdown-menu rounded-0 m-0">
                         
                            <a title="content " href="index.php?page=aim_scope" class="dropdown-item">Aim & Scope</a>
                            <a title="content " href="index.php?page=editorial_board" class="dropdown-item">Editorial Board</a>
							<a title="content " href="index.php?page=policy" class="dropdown-item">Publication Ethics</a>
							<a title="content " href="index.php?page=pppolicy" class="dropdown-item">Policies</a>
							 
                        </div>
                    </div>
                    	<div class="nav-item dropdown">
                        <a title="content " href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> Submission</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a title="content " href="index.php?page=guide_for_authors" class="dropdown-item">Guide for Authors </a>
                            <a title="content " href="index.php?page=login" class="dropdown-item">New Submission</a>
                            <a title="content " href="index.php?page=login" class="dropdown-item">Track  Submission</a>
                            
                        </div>
                    </div>
                    
                    
                    
                    -->
					 <div class="nav-item dropdown">
                        <a title="content " href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> Articles & Issues</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a title="content " href="index.php?page=content" class="dropdown-item">Current Issue</a>
                            <a title="content " href="index.php?page=earlyview" class="dropdown-item">Early View</a>
                            <a title="content " href="index.php?page=archive" class="dropdown-item">Archive</a>
                        </div>
                    </div>
				     <a title="content " href="index.php?page=guide_for_authors" class="nav-item nav-link">Guide for Authors </a>
                    <a title="content " href="index.php?page=index" class="nav-item nav-link">INDEX</a>
					 <a title="content " href="index.php?page=contact" class="nav-item nav-link">Contact</a>
                </div>
				 <a title="content " href="index.php?page=login" class="btn btn-secondary py-sm-3 px-sm-5 rounded-pill me-3 animated slideInRight">Login</a>
                  <a title="content " href="index.php?page=signup" class="btn btn-secondary py-sm-3 px-sm-5 rounded-pill me-3 animated slideInRight">Register</a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Carousel Start -->
	<?php if($page=="" || $page=="home" ){?>
        <div class="container-fluid p-0">
            <div class="owl-carousel header-carousel position-relative">
                <div class="owl-carousel-item position-relative">
                    <img  src="jaiwa_header.png" style ="width:100%" alt="">
					
					
               
                </div>
               
            </div>
        </div>
		
	<?php } ?>
        <!-- Carousel End -->







