<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
	$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach($system as $k => $v){
		$_SESSION['system'][$k] = $v;
	}
}
if(isset($_SESSION['login_id']))
	header("location:index.php?page=home");
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Event Management System</title>
 	

<?php include('./header.php'); ?>
</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		display: flex;
		align-items: center;
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);*/
		background:#28a745;
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	#login-right .card{
		margin: auto;
		z-index: 1
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    padding: .5em 0.8em;
    color: #000000b3;
  }
  #login-left .logo img {
    max-width: 90%;
    max-height: 80vh;
    object-fit: contain;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top py-2" style="box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger d-flex align-items-center" href="./../">
        <img src="assets/uploads/atechs-logo.jpeg" alt="AtechsSolutions" style="height: 40px; margin-right: 10px;">
        <span class="font-weight-bold text-success">Atechs Events Management System Solution</span>
      </a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto my-2 my-lg-0">
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./../index.php?page=home">Home</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./../index.php?page=venue">Venues</a></li>
          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="./../index.php?page=about">About</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main id="main" class=" bg-black">
  		<div id="login-left">
  			<div class="logo">
  				<img src="assets/uploads/admin-logo/itlogo1.png">
  			</div>
  		</div>

  		<div id="login-right">
  			<div class="w-100">
  				<h4 class="text-success text-center"><b><?php echo $_SESSION['system']['name'] ?></b></h4>
  				<br>

  			<div class="card col-md-8">
  				<div class="card-body">
  						
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label text-success">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
  						<center><button class="btn-sm btn-block btn-wave col-md-4 btn-success">Login</button></center>
  					</form>
  				</div>
  			</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>