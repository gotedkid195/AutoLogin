<?php 
 session_start();
 if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {

	$redirect_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	header("Location: $redirect_url");

	exit();}
include('inc/myconnect.php');
include('inc/function.php');
if($_SERVER ['REQUEST_METHOD'] == 'POST')

		{
			$errors=array();  

			if(empty($_POST['user']))

			{

				$errors[]='username';
				$message= "<p class='required'> Bạn hãy nhập đầy đủ thông tin </p>";

			}

			else{

				$kt_user=str_replace(' ','',$_POST['user']); 

				$user=mysqli_real_escape_string($dbc,$kt_user); 

			}

			if (empty($_POST['pass']))

			{

				$errors[]='password'; 

				$message= "<p class='required'> Bạn hãy nhập đầy đủ thông tin </p>";    

			}

			else{

				$kt_pass=str_replace(' ','',$_POST['pass']); 

				$pass=mysqli_real_escape_string($dbc,$kt_pass);             

			}

			if(empty($errors))

			{	 

				$query = "SELECT * FROM users WHERE username ='{$user}' AND status=1 ";

				$result = mysqli_query($dbc, $query);  

				kt_query($result,$query);

				if(mysqli_num_rows($result)==1)

				{ 

					list($id,$username,$password,$status,$seri,$role,$admin)= mysqli_fetch_array($result,MYSQLI_NUM);
					if($pass==$password){
						$_SESSION['id']=$id;

						$_SESSION['username']=$user;

						$_SESSION['seri']=$seri;
						$_SESSION['ad']=$admin;				

					
						$tachcheckrole=explode(',',$role);

						$demthay=1;

						foreach ($tachcheckrole as $tachcheckrole_it) {

							if($demthay==2){

								$tachcheckrole2=explode('-',$tachcheckrole_it);}

								$demthay++;   

							}   

						if(isset($_POST['remember'])){
							$config_username=$user;
							$config_password=$id.'t'.$user;	
						$password_hash = md5($config_password); 
						
						setcookie('cookie_name', 'usr='.$config_username.'&hash='.$password_hash.'s8', time() + 2592000,'/'); //1 tháng

						$query_in="UPDATE users SET hash='{$_COOKIE["cookie_name"]}' WHERE id='{$id}'";

						$result_in=mysqli_query($dbc,$query_in);

						if(!$result_in)

						{

							die("Query {$result_in} \n <br> MYSQL Error:".mysqli_error($dbc));

						}

						//echo $_COOKIE['cookie_name']."</br>";

					} 
				
					if(!empty($tachcheckrole2[1]))			 				
						//echo $tachcheckrole2[1];
						header('Location:'.$tachcheckrole2[1]);
				}
			}
			$message= "<p class='required'> Tài khoản không đúng</p>";
		}
	}
 ?>
