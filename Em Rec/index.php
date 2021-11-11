<?php 
    ob_start();
    include("./inc/db_connect.php");

    session_start();
    if (isset($_SESSION['username'])){

        $username = $_SESSION['username'];

    }
    else {
        
        $username = '';
    }

    if($username){
        header("location: dashboard");
    }


    if(isset($_GET['error'])){
        $error_login = "failed_login";
    }


    if(isset($_POST['submit'])){

        $realusername = mysqli_real_escape_string($db_connect, $_POST['username']);
        $password = mysqli_real_escape_string($db_connect, $_POST['password']);
        
        $check_details = mysqli_query($db_connect, "SELECT username FROM users WHERE username = '$realusername' ");
        $check_details_row = mysqli_num_rows($check_details);

        if($check_details_row == 1){

            while($row = mysqli_fetch_array($check_details)){
                $usernamenew = $row['username'];
            }

            $loginpassword = md5(md5($password).md5($usernamenew));

            $sql = mysqli_query($db_connect, "SELECT user_id FROM users WHERE username = '$usernamenew' AND password = '$loginpassword' LIMIT 1 ");
            $sqlcount = mysqli_num_rows($sql);
            ob_end_clean();
            if ($sqlcount == 1){
                echo json_encode(array("response"=>"Success"));
                $_SESSION["username"] = $realusername;
                exit();

            } else {
                echo json_encode(array("response"=>"password"));
                exit();
            }
        } else {
            echo json_encode(array("response"=>"username"));
            exit();
        }
    

    }


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title> Employee Record</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link href="css/font-awesome.min.css" type="text/css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui.min.js"></script>





  
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/components.css">
    <link rel="stylesheet" href="../css/icons.css">
    <link rel="stylesheet" href="../css/responsee.css">
    <link rel="stylesheet" href="../owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="../owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="../css/lightcase.css">
    <!-- CUSTOM STYLE -->      
    <link rel="stylesheet" href="../css/template-style.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,400,600,900&subset=latin-ext" rel="stylesheet"> 
    <script type="../text/javascript" src="../js/jquery-1.8.3.min.js"></script>
    <script type="../text/javascript" src="../js/jquery-ui.min.js"></script>  
    </head>
 <body id="loginPage">

 <!-- HEADER -->
 <header role="banner" class="position-absolute margin-top-30 margin-m-top-0 margin-s-top-0">    
        <!-- Top Navigation -->
        <nav class="background-transparent background-transparent-hightlight full-width sticky">
          <div class="s-12 l-2">
            <a href="../index.php" class="logo">
              <!-- Logo version before sticky nav -->
              <img class="logo-before" src="../img/logo-dark.png" alt="">
              <!-- Logo version after sticky nav -->
              <img class="logo-after" src="../img/logo-dark.png" alt="">
            </a>
          </div>
          <div class="s-12 l-10">
            <div class="top-nav right">
              
              <ul class="right chevron">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../annecy.php">Annecy</a></li>
                <li><a href="../lille.php">Lille</a></li>
                <li><a href="../dax.php">Dax</a></li>
                <li><a href="">Gest A</a></li>
                <li><a href="../Em Rec/index.php">Emp Rec</a></li>
                <li><a href="../about-us.php">About Us</a></li>             
                <li><a href="../contact.php">Contact</a></li>
              </ul>
            </div>
          </div>  
        </nav>
      </header>

 	<div class="login_wrapper clearfix">
 		<div class="logo_login">
             <h1> EMPLOYEE RECORD SYSTEM </h2>
 		</div>
        <?php
            if(isset($_GET['error'])){
                if($error_login == "failed_login"){?>

                    <div class="LogResponse2">Please Sign in first</div>

                <?php }
                }
            ?>
        <div class="LogResponse"></div>
 		<div class="login_wrapper_inner">
 			<form id="loginForm" class="clearfix" method="post" action="">
	 			<div class="input-box">
	 				<input type="text" class="inputField username" name="username" placeholder="username">
	 				<div class="error usernameerror"></div>
	 			</div>
	 			<div class="input-box">
	 				<input  type="password" class="inputField password" name="password" placeholder="password">
	 				<div class="error passworderror"></div>
	 			</div>

	 			<div class="input-box">
	 				<button  type="submit" class="submitField sign_in"><span class="sign-icon"><i class="fa fa-lock"></i></span> Sign in</button>
	 			</div>
	 		</form>
 		</div>
 	</div>
 <div class="body_overlay"></div>
 
  <script type="text/javascript" src="./js/global.js"></script>

  


   
      <!-- FOOTER -->
      <footer>
        <!-- Contact Us -->
        <div class="background-dark padding text-center footer-social">
          <a class="margin-right-10" target="_blank" href="https://www.facebook.com"><i class="icon-facebook_circle text-size-30"></i> <span class="text-strong text-white hide-s hide-m">FACEBOOK</span></a>
          <a class="margin-right-10" target="_blank" href="https://www.twitter.com"><i class="icon-twitter_circle text-size-30"></i> <span class="text-strong text-white hide-s hide-m">TWITTER</span></a>
          <a class="margin-right-10" target="_blank" href="https://www.instagram.com"><i class="icon-instagram_circle text-size-30"></i> <span class="text-strong text-white hide-s hide-m">INSTAGRAM</span></a>
          <a target="_blank" href="https://www.linkedin.com"><i class="icon-linked_in_circle text-size-30"></i> <span class="text-strong text-white hide-s hide-m">LINKEDIN</span></a>                                                                         
        </div>

        <!-- Main Footer -->
        <section class="section-small-padding text-center background-dark full-width">
          <div class="line">
            <div class="margin">
              <!-- Collumn 1 -->              
              <div class="s-12 m-12 l-4 margin-m-bottom-30">
                <h3 class="text-size-16">Company Address</h3>
                <p class="text-size-14">
                   10 rue nollet<br>
                   Paris - France<br> 
                   Europe
                </p>               
              </div>
              <!-- Collumn 2 -->
              <div class="s-12 m-12 l-4 margin-m-bottom-30">
                <h3 class="text-size-16">E-mail</h3>
                <p class="text-size-14">
                   contact@sampledomain.com<br>
                   office@sampledomain.com
                </p>              
              </div>
              <!-- Collumn 3 -->
              <div class="s-12 m-12 l-4 ">
                <h3 class="text-size-16">Phone Numbers</h3>
                <p class="text-size-14">
                   0800 4521 800 50<br>
                   0450 5896 625 16<br>
                   0798 6546 465 15
                </p>             
              </div>
            </div>
          </div>  
        </section>
        <hr class="break margin-top-bottom-0" style="border-color: rgba(0, 0, 0, 0.80);">
        
        <!-- Bottom Footer -->
        <section class="padding background-dark full-width">
          <div class="text-center">
            <p class="text-size-12">Copyright 2021</p>
            <p class="text-size-12"></p>
          </div>
        </section>
      </footer>
    </div>
    <script type="text/javascript" src="js/responsee.js"></script>
    <script type="text/javascript" src="js/jquery.events.touch.js"></script>
    <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
    <script type="text/javascript" src="js/template-scripts.js"></script> 
 </body>
 </html>