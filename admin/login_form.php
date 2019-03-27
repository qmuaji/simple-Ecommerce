<form action="login_act.php?&act=1" method="post">
<br><br>
<div class="col-md-4 col-md-offset-4">
	<div class="panel panel-info">
		<div class="panel-heading">
			<i class="glyphicon glyphicon-lock"></i> Silahkan Login terlebih dahulu.				
		</div>
		<div class="panel-body">
			<div class="form-group">
				<label>Username</label>
				<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					<input type="text" name="username" class="form-control" placeholder="Username" autofocus maxlength="20">
				</div>				
			</div>

			<div class="form-group">
				<label>Password</label>
				<div class="input-group">
				<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					<input type="password" name="password" placeholder="Password" class="form-control" maxlength="20">
				</div>				
			</div>
		</div>
		<div class="panel-footer">
			<button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-share-alt"></i> Login</button>
			<a href="../" class="btn btn-default btn-block">Back to Web</a>
		</div>
	</div>
	<hr>
</div> 

</form>