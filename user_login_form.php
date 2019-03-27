<form action="user_login_act.php?&act=1" method="post">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h4><i class="glyphicon glyphicon-lock"></i> Login User</h4>
			<small>Silahkan Login disini.</small>
		</div>
			<div class="panel-body">
				<div class="form-group">
					<label>Username</label>
					<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						<input type="text" name="username" class="form-control" placeholder="Username" maxlength="32">
					</div>				
				</div>

				<div class="form-group">
					<label>Password</label>
					<div class="input-group">
					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input type="password" name="password" placeholder="Password" class="form-control" maxlength="32">
					</div>				
				</div>
			</div>

		<div class="panel-footer">
				<button type="submit" class="btn btn-primary btn-block"> Login <i class="glyphicon glyphicon-log-in"></i></button>
		</div>
	</div>
</form>