<?php session_start();

if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
	$redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	header("Location: $redirect_url");
	exit();}
	$cookie_time = (3600 * 24 * 30); 
	include('inc/myconnect.php');
	include('inc/function.php');
	if( ($_COOKIE["cookie_name"])!=null  )
	{ 

		parse_str($_COOKIE['cookie_name']);
		echo $usr."</br>";
		echo $hash."</br>";
		$query = "SELECT * FROM users WHERE username ='{$usr}' AND hash ='{$_COOKIE['cookie_name']}' AND status=1 ";
		$result = mysqli_query($dbc, $query);  
		kt_query($result,$query);
		if(mysqli_num_rows($result)==1)
		{ 
			$_SESSION['username']=$usr;				 			 				
			header('Location: include.php');
		}

		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>TESLATEQ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Teslateq,teslateq,tesla,canhnguyen" />
	<link rel="icon" type="image/png" href="images/a.png" >

	<link rel="stylesheet" href="bootstrap/css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 

	<link rel="stylesheet" href="bootstrap/fonts/awesome/css/font-awesome.min.css">

	<style type="text/css" >
	.required
	{
		color: red;
		font-size: 15px;
		padding-top: 10px;
	}

	
</style>	
</head>
	<body>
		<?php
		if($_SERVER ['REQUEST_METHOD'] == 'POST')
		{
			$errors=array();  
        if (empty($_POST['user'])) 
        {
        	$errors[]='username';
        	$message= "<p class='required'> Bạn hãy nhập đầy đủ thông tin </p>";
        }
        else{
        	$user=$_POST['user']; 
        }
        if (empty($_POST['pass'])) 
        {
        	$errors[]='password'; 
        	$message= "<p class='required'> Bạn hãy nhập đầy đủ thông tin </p>";    
        }
        else{
        	$pass=$_POST['pass']; 
           

        }

        if(empty($errors))
        {	 

        	$query = "SELECT * FROM users WHERE username ='{$user}' AND password ='{$pass}' AND status=1 ";
        	$result = mysqli_query($dbc, $query);  
        	kt_query($result,$query);

        	if(mysqli_num_rows($result)==1)
				{ // if($ok1==1){ 
					list($id,$username,$password,$status)= mysqli_fetch_array($result,MYSQLI_NUM);
					$_COOKIE["member_user"]=$_SESSION['id']=$id;
					$_SESSION['username']=$user;				
					$config_username=$user;
					$config_password=$user.$id;	
							
					if(isset($_POST['remember'])){
						$password_hash = md5($config_password); 
						
						setcookie ('cookie_name', 'usr='.$config_username.'&hash='.$password_hash.'s8', time() + $cookie_time);
						$query_in="UPDATE users SET hash='{$_COOKIE["cookie_name"]}' WHERE id=$id";
						$result_in=mysqli_query($dbc,$query_in);
						if(!$result_in)
						{
							die("Query {$query_in} \n <br> MYSQL Error:".mysqli_error($conn));
						}
					} 								
					header('Location: include.php');
				}

				else
				{	
					$message= "<p class='required'> Password hoặc Username không đúng </p>";
				}

			}

		}

		?>    
		<div class="w3-agile-banner" > 
			<!--</div>-->
			<div class="center-container">
				<!--header-->
				<div class="header-w3l" style="color:#F0893B;">
					<h1>TESLATEQ</h1>
					<!--<img src="images/logo-01-01.png" alt="">-->
				</div>
				<!--//header-->
				<!--main-->
				<div class="main-content-agile" >
					<div class="wthree-pro" style="background:#F0893B;"  >
						<h2 style="">Please Login</h2>
					</div>
					<div class="sub-main-w3">	
						<form action="#" method="post"  >

							<input placeholder="Username" name="user" type="text" >
					
							<input  placeholder="Password" name="pass" type="password" >
							
							<div class="rem-w3" >
								<span class="check-w3" style="margin-right:65px"><input name="remember" id="remember" type="checkbox" >Remember Me</span>
								<a  href="dangki.php">Sign up</a>


							</div>

								<input   type="submit" value="Enter">					

								<div style="text-align: center;">
									<?php
									if(isset($message))
										echo "$message";

									?></div>

								</form>
							</div>
						</div>

						<div class="footer"   >
							<p>&copy; 2018 Design by <a class="tesla" href="http://ad.teslateq.vn/" target="_blank">Teslateq Co., Ltd </a> <a class="for" href="forgot.php" >Forget Pass ?</a></p>
						</div>
						<!--//footer-->
						<div ></div>
					</div>
				</div>
			</body>
	</html>