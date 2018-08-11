
<?php echo form_open('users/login');?>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h1 class="text-center"><?php echo $title; ?> </h1>
			<div class="form-group">
				<label>Username</label>
				<input type="text" class="form-control" name="username" placeholder="Enter username" value="<?php echo set_value('username'); ?>">
				<?php echo form_error('username', '<div class="error">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo set_value('password'); ?>">
				<?php echo form_error('password','<div class="error">', '</div>'); ?>
			</div>
			<button class="btn btn-primary btn-block" type="submit">Login</button>
		</div>
	</div>
<?php echo form_close();?>