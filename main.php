

        <!-- Search Start -->
        
        <!-- Search End -->


        <!-- Category Start -->
        <div class="container-xxl py-1  bg-white2">
            <div class="container">
		<br><br>
                 <h1 name="startcontent" class="text-center text-black  wow fadeInUp" data-wow-delay="0.1s"> <?php echo get_pageName($page); ?> </h1>
           <div class="row g-4">
				
			<div class="col">
			
			 <?php
            if ((!isset($page)) || ($page == "home")) { echo get_icerik($page); echo get_icerik("aim_scope");}
            if (($page == "content") || ($page == "earlyview")) {
                $content = 1;
                include("content.php");
            }

            if ($page == "login"){
            	
					include "login2.php";
			}
			if ($page == "signup"){
            	include("singup.php");
                // $link="https://".$journalDomain."/login.php#signup";
			    //Yonlendirme($link);
			}
			if ($page == "reset_pass"){
            	
				include("reset_pass.php");
				
                
                // $link="https://".$journalDomain."/login.php#reset_pass";
			    //Yonlendirme($link);
 
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
            if ($page == "earlyview1"){   $content = 1; echo get_icerik($page);// include("content_earlyview.php"); 
			}
            if ($page == "aim_scope")  echo get_icerik($page);// include("statik_icerik_goster.php");
            if ($page == "editorial_board")   include 'editor_list.php';
            if ($page == "pppolicy")  echo get_icerik($page);// include("statik_icerik_goster.php");
            if ($page == "guide_for_authors")  echo get_icerik($page);// include("guide_for_authors.php");
             if ($page == "copyright_and_licensing")  echo get_icerik($page);// include("guide_for_authors.php");
            
            if ($page == "award")  echo get_icerik($page);// include("award.php");
            if ($page == "policy")  echo get_icerik($page);// include("policy.php");
			if ($page == "index")   include 'indexed_list.php';// include("policy.php");
            if ($page == "archive") {
                if ((isset($_GET["volume"]) and isset($_GET["no"]) and isset($_GET["year"]))  ) {
                    include('content.php');

                } else {
                    include 'archive.php';
                }
            }
            if ($page == "about")  echo get_icerik($page);// include("statik_icerik_goster.php");
            if ($page == "contact")  echo get_icerik($page); //include("contact.php");
            if ($page == "cited") include("cited.php");
			if ($page == "detail") include("paper_detail.php");
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
				<?php
				if($page=="content"){
				//
				}
				?>
                   
                </div>
            </div>
        </div>
        <!-- Category End -->






 
