<div class="container-fluid">
	<form action="" id="manage-signup">
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<input type="text" class="form-control" name="name"  required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<input type="email" class="form-control" name="email"  required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<input type="text" class="form-control" name="contact"  required>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<textarea cols="30" rows = "2" required="" name="address" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" class="form-control" name="password"  required>
		</div>
	</form>
</div>
<script>
	$('#manage-signup').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=signup',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Registration Successful. You can now login.",'success')
						end_load()
						setTimeout(function(){
							location.reload()
						},1500)

				}else if(resp==2){
					alert_toast("Email already exists.",'danger')
					end_load()
				}
			}
		})
	})
</script>
