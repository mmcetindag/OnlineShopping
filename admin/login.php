<?php
	require_once("inc/init.php");
	is_login(@$_SESSION['admin_id'], "index.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin login</title>
	<link rel="stylesheet" type="text/css" href="./../css/bootstrap.min.css">
	<style type="text/css">body{background:#eee!important}.wrapper{margin-top:80px;margin-bottom:80px}.form-signin{max-width:380px;padding:15px 35px 45px;margin:0 auto;background-color:#fff;border:1px solid rgba(0,0,0,.1)}.form-signin .checkbox,.form-signin .form-signin-heading{margin-bottom:30px}.form-signin .checkbox{font-weight:400}.form-signin .form-control{position:relative;font-size:16px;height:auto;padding:10px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}.form-signin .form-control:focus{z-index:2}.form-signin input[type=text]{margin-bottom:-1px;border-bottom-left-radius:0;border-bottom-right-radius:0}.form-signin input[type=password]{margin-bottom:20px;border-top-left-radius:0;border-top-right-radius:0}</style>
</head>
<body>
   <div class="wrapper">
    <form class="form-signin" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">       
      <h2 class="form-signin-heading">Admin login</h2>
      <?php
      	if (isset($_POST['username'])) {
      		$username = escape($_POST['username']);
      		$password = escape($_POST['password']);
      		$md5password = md5($password);
      		$fetch = $db->Fetch("*","admin","username='$username' AND password='$md5password'");
      		if ($fetch) {
      			$_SESSION['admin_id'] = $fetch['id'];
            $_SESSION['admin_username'] = $fetch['username'];
      			redirect("index.php");
      		}else{
      			echo "<div class='alert alert-danger' role='alert'>Invalid username or password</div>";
      		}
      	}
      ?>
      <input type="text" class="form-control" name="username" placeholder="Username" autofocus="" required=""/>
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>    
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
    </form>
  </div>
</body>
</html>