﻿<?php
	$pageName = "Register";
	include("admin/include/dbConnection.php");
	if(isset($_POST["register"]))
	{
		$fileName1 = $_FILES["profile"]["name"];
		if(!empty($fileName1))
		{
			$fileTmpLoc1 = $_FILES["profile"]["tmp_name"];
			$fileType1 = $_FILES["profile"]["type"];
			$fileSize1 = $_FILES["profile"]["size"];
			$fileErrorMsg1 = $_FILES["profile"]["error"];
			$kaboom1 = explode(".", $fileName1);
			$fileExt1 = end($kaboom1);
			$fileName1 = "PHOTO-SHARE-PHOTOGRAPHER-PROFILE-" . time() . "." . $fileExt1;
			move_uploaded_file($fileTmpLoc1, "images/photographer/$fileName1");
		}
		if(!is_numeric(trim($_POST["mobileNumber"])))
		{
			$error = "Mobile No. Must Be Numeric Only.";
		}
		else if(strlen(trim($_POST["mobileNumber"])) != 10)
		{
			$error = "Mobile No. Must Be 10 Digits Only.";
		}
		else if(trim($_POST["password"]) != trim($_POST["confirmPassword"]))
		{
			$error = "Password Does Not Match.";
		}
		if(!isset($error)){
		if(mysqli_query($connection, "INSERT INTO `photographer`(`firstName`, `lastName`, `mobileNumber`, `password`, `email`, `profile`, `about`, `status`) VALUES('" . ucwords(strtolower(trim($connection,$_POST["firstName"]))) . "', '" . ucwords(strtolower(trim($connection,$_POST["lastName"]))) . "', '" . trim($connection,$_POST["mobileNumber"]) . "', '" . trim($connection,$_POST["password"]) . "', '" . trim($connection,$_POST["email"]) . "', '$fileName1', '" . trim($_POST["about"]) . "', 'OFF')"))
		{
			header("Location:login.php?success=Your Registration Successfully. Please Login To Continue.");
		}
		}
	}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

	<meta charset="utf-8">
	<title>PhotoShare | <?php echo $pageName; ?></title>
	<meta name="description" content="PhotoShare | <?php echo $pageName; ?>" />
	<meta name="keywords" content="PhotoShare | <?php echo $pageName; ?>" />
	<meta name="author" content="PhotoShare | <?php echo $pageName; ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="css/base.css"/>
	<link rel="stylesheet" href="css/skeleton.css"/>
	<link rel="stylesheet" href="css/layout.css"/>
	<link rel="stylesheet" href="css/font-awesome.css" />
	<link rel="stylesheet" href="css/ionicons.min.css"/>
	<link rel="stylesheet" href="css/retina.css"/>

	<link rel="shortcut icon" href="admin/img/favicon.ico">
	
	<script type="text/javascript" src="js/modernizr.custom.js"></script> 
	<?php
	if(isset($_SESSION["photographerId"]))
	{
	?>
	<style type="text/css">
		.chat_box{
			position:fixed;
			right:20px;
			bottom:0px;
			width:250px;
			z-index:9999;
		}
		.chat_body{
			background:white;
			height:400px;
			padding:5px 0px;
		}

		.chat_head,.msg_head{
			background:#f39c12;
			color:white;
			padding:15px;
			font-weight:bold;
			cursor:pointer;
			border-radius:5px 5px 0px 0px;
		}

		.msg_box{
			position:fixed;
			bottom:-5px;
			width:250px;
			background:white;
			border-radius:5px 5px 0px 0px;
			z-index:9999;
		}

		.msg_head{
			background:#3498db;
		}

		.msg_body{
			background:white;
			height:200px;
			font-size:12px;
			padding:15px;
			overflow:auto;
			overflow-x: hidden;
		}
		.msg_input{
			width:100%;
			border: 1px solid white;
			border-top:1px solid #DDDDDD;
			-webkit-box-sizing: border-box; /* Safari/Chrome, other WebKit */
			-moz-box-sizing: border-box;    /* Firefox, other Gecko */
			box-sizing: border-box;  
		}

		.close{
			float:right;
			cursor:pointer;
		}
		.minimize{
			float:right;
			cursor:pointer;
			padding-right:5px;
			
		}

		.useronline{
			position:relative;
			padding:10px 30px;
		}
		.useronline:hover{
			background:#f8f8f8;
			cursor:pointer;

		}
		.useronline:before{
			content:'';
			position:absolute;
			background:#2ecc71;
			height:10px;
			width:10px;
			left:10px;
			top:15px;
			border-radius:6px;
		}
		
		.useroffline{
			position:relative;
			padding:10px 30px;
		}
		.useroffline:hover{
			background:#f8f8f8;
			cursor:pointer;

		}
		.useroffline:before{
			content:'';
			position:absolute;
			background:#f34e4e;
			height:10px;
			width:10px;
			left:10px;
			top:15px;
			border-radius:6px;
		}

		.msg_a{
			position:relative;
			background:#FDE4CE;
			padding:10px;
			min-height:10px;
			margin-bottom:5px;
			margin-right:10px;
			border-radius:5px;
		}
		.msg_a:before{
			content:"";
			position:absolute;
			width:0px;
			height:0px;
			border: 10px solid;
			border-color: transparent #FDE4CE transparent transparent;
			left:-20px;
			top:7px;
		}


		.msg_b{
			background:#EEF2E7;
			padding:10px;
			min-height:15px;
			margin-bottom:5px;
			position:relative;
			margin-left:10px;
			border-radius:5px;
			word-wrap: break-word;
		}
		.msg_b:after{
			content:"";
			position:absolute;
			width:0px;
			height:0px;
			border: 10px solid;
			border-color: transparent transparent transparent #EEF2E7;
			right:-20px;
			top:7px;
		}
	</style>
	<?php
	}
	/*
	`photographerId`, `firstName`, `lastName`, `mobileNumber`, `password`, `email`, `profile`, `about`, `status`, `login`, `loginTime`
	
	*/
	?>
	
<?php
	if(isset($_POST) & !empty($_POST)){
	$fname = mysqli_real_escape_string($connection,$_POST['firstName']);
	$lname = mysqli_real_escape_string($connection,$_POST['lastName']);
	$email = mysqli_real_escape_string($connection,$_POST['email']);
	$mobile = mysqli_real_escape_string($connection,$_POST['mobileNumber']);
	$password = mysqli_real_escape_string($connection,$_POST['password']);
	$profile = mysqli_real_escape_string($connection,$_POST['profile']);
	//$gender = $_POST['gender'];
	//$age = $_POST['age'];

	$CreateSql = "INSERT INTO `photographer` (firstName, lastName, email, mobileNumber, password, profile) VALUES ('$firstName', '$lastName', '$email', '$mobileNumber', '$password', '$profile')";
	$res = mysqli_query($connection, $CreateSql) or die(mysqli_error($connection));
	if($res){
		$smsg = "Successfully inserted data, Insert New data.";
	}else{
		$fmsg = "Data not inserted, please try again later.";
	}
}
?>	
</head>
<body class="royal_preloader">	
	
	<div id="royal_preloader"></div>
	<?php
	if(isset($_SESSION["photographerId"]))
	{
	?>
	<div class="chat_box">
		<div class="chat_head"> Chat Box</div>
		<div class="chat_body">
		<?php
		$chatResult = mysqli_query($connection, "SELECT * FROM `photographer` WHERE `status` = 'ON' AND `photographerId` != '" . $_SESSION["photographerId"] . "' ORDER BY `loginTime` DESC");
		while($chatRow = mysqli_fetch_array($chatResult))
		{
		?>
			<div chat-from="<?php echo $_SESSION["photographerId"]; ?>" chat-to="<?php echo $chatRow["photographerId"]; ?>" class="<?php echo $chatRow["login"] == "YES" ? "useronline" : "useroffline"; ?>"> <?php echo $chatRow["firstName"] . " " . $chatRow["lastName"]; ?> </div>
		<?php
		}
		?>
		</div>
	</div>
	<span id="spanUserChat">
	</span>
	<input type="hidden" id="totalMessage" value="<?php echo mysqli_num_rows(mysqli_query($connection, "SELECT `chatId` FROM `chat` WHERE `photographerIdTo` = '" . $_SESSION["photographerId"] . "'")); ?>" />
	<?php
	}
	?>
		<nav id="menu-wrap" class="menu-back cbp-af-header">
			<div class="menu">
				<a href="index.php" ><div class="logo"></div></a>
				<ul>
					<li>
						<a class="shadow-hover <?php echo $pageName == "Home" ? "curent-shadow" : ""; ?>" href="index.php">Home</a>
					</li>
					<li>
						<a class="shadow-hover <?php echo $pageName == "Photos" ? "curent-shadow" : ""; ?>" href="#" >Photos</a>
						<ul>
						<?php
						$resultMenu = mysqli_query($connection, "SELECT `photographerId`, `firstName`, `lastName` FROM `photographer` WHERE `status` = 'ON' ORDER BY `firstName`, `lastName`");
						while($rowMenu = mysqli_fetch_array($resultMenu))
						{
						?>
							<li><a class="<?php echo isset($_GET["pgid"]) ? ($_GET["pgid"] == $rowMenu["photographerId"] ? "curent-multi-page" : "") : ""; ?>" href="photos.php?pgid=<?php echo $rowMenu["photographerId"]; ?>"><?php echo $rowMenu["firstName"] . " " . $rowMenu["lastName"]; ?></a></li>
						<?php
						}
						?>
						</ul>
					</li>
					<?php
					if(isset($_SESSION["photographerId"]))
					{
						$rowCurrent = mysqli_fetch_array(mysqli_query($connection, "SELECT `firstName`, `lastName` FROM `photographer` WHERE `photographerId` = '" . $_SESSION["photographerId"] . "'"));
					?>
					<li>
						<a style="color: #f39c12; text-shadow: 0px 0px 1px #FFF;" class="shadow-hover <?php echo $pageName == "My Photo's" ? "curent-shadow" : ""; ?>" href="myphotos.php"><?php
						echo $rowCurrent["firstName"] . " " . $rowCurrent["lastName"] . " (My Photo's)";
						?></a>
					</li>
					<li>
						<a style="color: #f39c12; text-shadow: 0px 0px 1px #FFF;" class="shadow-hover" href="logout.php">Logout</a>
					</li>
					<?php
					}
					else
					{
					?>
					<li>
						<a class="shadow-hover <?php echo $pageName == "Login" ? "curent-shadow" : ""; ?>" href="login.php">Login</a>
					</li>
					<li>
						<a class="shadow-hover <?php echo $pageName == "Register" ? "curent-shadow" : ""; ?>" href="register.php">Register</a>
					</li>
					<?php
					}
					?>
					<li>
						<a class="shadow-hover <?php echo $pageName == "Search" ? "curent-shadow" : ""; ?>" href="search.php">Search</a>
					</li>
				</ul>
			</div>
		</nav>

	<div class="section-block big-height">
		<div class="parallax" style="background-image: url('images/parallax-3.jpg')"></div>
		<div class="color-over-hero"></div>
		
		<div class="home-text-freelance z-bigger">
			<div class="container fade-elements">
				<div class="twelve columns">
					<h2><span><?php echo $pageName; ?></span></h2>
				</div>
			</div>
		</div>
						
		<div class="home-link fade-elements">
			<div class="container">
				<div class="twelve columns">
					<a href="#top-scroll" data-gal="m_PageScroll2id" data-ps2id-offset="78"><div class="link-down center tipped" data-title="scroll down"  data-tipper-options='{"direction":"top","follow":"true","margin":25}'></div></a>
				</div>
			</div>						
		</div>
			
	</div>
		
	<div class="section-block padding-top-small padding-bottom">
		<div class="container">
		<?php 
		echo isset($error) ? "<div style=\"color:red;padding:50px\">" . $error . "</div>" : ""; 
		?>
			<form name="ajax-form" id="ajax-form" method="post" enctype="multipart/form-data">
			<div class="six columns">
				<div class="one-fourth columns">
					<input name="firstName" id="firstName" type="text" placeholder="Your First Name *" value="<?php
					echo isset($_POST["firstName"]) ? $_POST["firstName"] : "";
					?>" required />
				</div>
				<div class="one-fourth columns">
					<input name="lastName" id="lastName" type="text" placeholder="Your Last Name *" value="<?php
					echo isset($_POST["lastName"]) ? $_POST["lastName"] : "";
					?>" required />
				</div>
				<div class="clear"></div>
				<div class="six columns remove-top">
					<input name="mobileNumber" id="mobileNumber" type="text" placeholder="Your Mobile No. *" value="<?php
					echo isset($_POST["mobileNumber"]) ? $_POST["mobileNumber"] : "";
					?>" required />
				</div>
				<div class="clear"></div>
				<div class="six columns remove-top">
					<input name="email" id="email" type="email" placeholder="Your E-Mail ID *" value="<?php
					echo isset($_POST["email"]) ? $_POST["email"] : "";
					?>" required />
				</div>
				<div class="clear"></div>
				<div class="six columns remove-top">
					<input name="password" id="password" type="password" placeholder="Enter Your Password *" value="<?php
					echo isset($_POST["password"]) ? $_POST["password"] : "";
					?>" required />
				</div>
				<div class="clear"></div>
				<div class="six columns remove-top">
					<input name="confirmPassword" id="confirmPassword" type="password" placeholder="Re-enter Your Password *" value="<?php
					echo isset($_POST["confirmPassword"]) ? $_POST["confirmPassword"] : "";
					?>" required />
				</div>
				<div class="clear"></div>
				<div class="six columns remove-top">
					<textarea name="about" id="about" placeholder="Enter About Your Self *" required><?php
					echo isset($_POST["about"]) ? $_POST["about"] : "";
					?></textarea>
				</div>
				<div class="clear"></div>
				<div class="six columns remove-top">
					<div id="button-con"><button name="register" class="send_message button-effect button--moema button--text-thick button--text-upper button--size-s" id="register" data-lang="en">Register</button></div>
				</div>
			</div>
			<div class="six columns">
				<label for="profile"><img id="profileImage" src="images/3dlens.jpg" width="100%" style="cursor:pointer" /></label>
				<input id="profile" name="profile" type="file" style="visibility:hidden;display:none;" onchange="readURL(this)" value="<?php
					echo isset($_POST["profile"]) ? $_POST["profile"] : "";
					?>" required />
			</div>
			</form>
		</div>
	</div>
	
	<div class="section-block padding-top-bottom background-color-blue">
		<div class="container footer">
			<div class="one-fifth column" data-scroll-reveal="enter bottom move 60px over 0.9s after 0.1s">
				<p>Photo Share</p>
				<p>-----------</p>
			</div>
			<div class="one-fifth column" data-scroll-reveal="enter bottom move 60px over 0.9s after 0.1s">
				<p>Address</p>
				<p>Country</p>
			</div>
			<div class="one-fifth column mail-phone" data-scroll-reveal="enter bottom move 60px over 0.9s after 0.1s">
				<a href="tel:1234567890"><p class="chaffle" data-lang="en">1234567890</p></a>
				<a href="mailto:email@domain.com"><p class="chaffle" data-lang="en">email@domain.com</p></a>
			</div>
			<div class="two-fifths column" data-scroll-reveal="enter bottom move 60px over 0.9s after 0.1s">
				<div class="social-footer">
					<ul class="list-social-footer">
						<li class="icon-footer tipped" data-title="Twitter"  data-tipper-options='{"direction":"top","follow":"true","margin":25}'>
							<a href="#"><span class="fa-twitter"></span></a>
						</li>
						<li class="icon-footer tipped" data-title="Github"  data-tipper-options='{"direction":"top","follow":"true","margin":25}'>
							<a href="#"><span class="fa-github"></span></a>
						</li>
						<li class="icon-footer tipped" data-title="Pinterest"  data-tipper-options='{"direction":"top","follow":"true","margin":25}'>
							<a href="#"><span class="fa-pinterest"></span></a>
						</li>
						<li class="icon-footer tipped" data-title="Facebook"  data-tipper-options='{"direction":"top","follow":"true","margin":25}'>
							<a href="#"><span class="fa-facebook"></span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>	
	</div>
	
	<script type="text/javascript">
	
		function readURL(input)
		{
			if(input.files && input.files[0])
			{
				var reader = new FileReader();
				reader.onload = function (e)
				{
					document.getElementById("profileImage").src = e.target.result;
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
	
	</script>
	<script type="text/javascript" src="js/jquery-2.1.1.js"></script>	
	<script type="text/javascript" src="js/royal_preloader.min.js"></script>
	<script type="text/javascript" src="js/retina.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.js"></script>	
	<script type="text/javascript" src="js/header-anime.js"></script>
	<script type="text/javascript" src="js/tipper.js"></script>
	<script type="text/javascript" src="js/scrolltoid.js"></script> 
	<script type="text/javascript" src="js/scrollReveal.js"></script>
	<script type="text/javascript" src="js/jquery.chaffle.min.js"></script>
	<script type="text/javascript" src="js/imagesloaded.pkgd.min.js"></script>
	<script type="text/javascript" src="js/parallax.js"></script>
	<script type="text/javascript" src="js/masonry.js"></script> 
	<script type="text/javascript" src="js/isotope.js"></script>

	<script type="text/javascript" src="js/custom-home-3.js"></script> 
	<?php
	if(isset($_SESSION["photographerId"]))
	{
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$(document).on("click", ".chat_head", function(){
				$('.chat_body').slideToggle('slow');
			});
			$(document).on("click", ".msg_head", function(){
				$('.msg_wrap').slideToggle('slow');
			});
			$(document).on("click", ".close", function(){
				$('.msg_box').hide();
			});
			$(document).on("click", ".useronline,.useroffline", function(){
				loadChat($(this).attr("chat-from"),$(this).attr("chat-to"));
			});
			$(document).on("keypress", "textarea", function(e){
				if (e.keyCode == 13) {
					e.preventDefault();
					var msg = $(this).val();
					$(this).val("");
					if(msg != "")
					{
						$.ajax({
							url: "ajax/saveuserchat.php",
							type: "get",
							data:{
								"photographerIdFrom":<?php echo $_SESSION["photographerId"]; ?>,
								"photographerIdTo":$("#chat-with").val(),
								"message":msg
							},
							success: function (data){
								loadChat(<?php echo $_SESSION["photographerId"]; ?>,$("#chat-with").val());
								$('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
							}
						});
					}
				}
			});
			
		});
		function loadChat(from,to)
		{
			$.ajax({
				url: "ajax/selectuserchat.php",
				type: "get",
				data:{
					"photographerIdFrom":from,
					"photographerIdTo":to
				},
				success: function (data){
					$("#spanUserChat").html(data);
					$('.msg_wrap').show();
					$('.msg_box').show();
				}
			});
		}
		function checkNewMessage()
		{
			$.ajax({
					url: "ajax/checkmessage.php",
					type: "get",
					data:{
						"photographerIdTo":<?php echo $_SESSION["photographerId"]; ?>
					},
					success: function (data){
						var jsonData = JSON.parse(data);
						if(jsonData[0] != $("#totalMessage").val())
						{
							$("#totalMessage").val(jsonData[0]);
							loadChat(<?php echo $_SESSION["photographerId"]; ?>,jsonData[1]);
						}
					}
				});
		}
		setInterval("checkNewMessage()",1000);
	</script>
	<?php
	}
	?>
</body>
</html>