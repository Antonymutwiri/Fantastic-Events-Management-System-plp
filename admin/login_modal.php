<div class="container-fluid">
	<div id="msg"></div>
	<form id="login-form">
		<div class="form-group">
			<label for="username" class="control-label text-success">Username</label>
			<input type="text" id="username" name="username" class="form-control" required>
		</div>
		<div class="form-group">
			<label for="password" class="control-label">Password</label>
			<input type="password" id="password" name="password" class="form-control" required>
		</div>
		<center><button class="btn-sm btn-block btn-wave col-md-4 btn-success">Login</button></center>
	</form>
</div>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
			$('#login-form button').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>
