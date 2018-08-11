<?php echo form_open('users/register');?>
<div class="row">
	<div class="col-md-4 col-md-offset-4">
		<h3 class="text-center"><?php echo $title; ?></h3>
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php echo set_value('name'); ?>">
			<?php echo form_error('name', '<div class="error">', '</div>'); ?>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="text" class="form-control" name="email" placeholder="Enter email" value="<?php echo set_value('email'); ?>">
			<?php echo form_error('email', '<div class="error">', '</div>'); ?>
		</div>
		<div class="form-group">
			<label>Username</label>
			<input type="text" class="form-control" name="username" placeholder="Enter username" value="<?php echo set_value('username');?>">
			<?php echo form_error('username', '<div class="error">', '</div>'); ?>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" name="password" placeholder="Enter password" value="<?php echo set_value('password');?>">
			<?php echo form_error('password', '<div class="error">', '</div>'); ?>
		</div>
		<div class="form-group">
			<label>Confirm Password</label>
			<input type="password" class="form-control" name="password-confirm" placeholder="Confirm  password" value="<?php echo set_value('password-confirm');?>">
			<?php echo form_error('password-confirm', '<div class="error">', '</div>'); ?>
		</div>
	    <button class="btn btn-primary btn-block" type="submit">Sign Up</button>
	</div>
</div>
<?php echo form_close();?>