<html>
	<head>
		<title>Welcome to myRecipe</title>
		<link href="<?php echo base_url();?>favicon.ico" rel="icon" type="image/x-icon" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
	    <script src="https://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">myRecipe</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_url();?>posts">Blog</a></li>
					<!--<li><a href="<?php echo base_url();?>">Home</a></li>
					<li><a href="<?php echo base_url();?>about">About</a></li> -->
					<li>
						<div class="search-box">
							<?php echo form_open('posts/search');?>
							<input type="text" name="searchtext"/> 
					    	<button type="submit" class="btn btn-primary">
					      		<span class="glyphicon glyphicon-search"></span>
					      	</button>
					      	<?php echo form_close();?>
					    </div>  
					</li>
				</ul>
            
				<ul class="nav navbar-nav navbar-right">
					<?php if($this->session->userdata('logged_in')):?>
					    <li>
							<div class="navbar-header">
								<a class="navbar-brand" href="#">Hi <?php echo  $this->session->userdata('username');?></a>
							</div>
						</li>
						<li><a href="<?php echo base_url();?>posts/create">Create Post</a></li>
					<?php endif;?>
					<?php if(!$this->session->userdata('logged_in')):?>
						<li><a href="<?php echo base_url();?>users/login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						<li><a href="<?php echo base_url();?>users/register"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
					<?php endif;?>
					<?php if($this->session->userdata('logged_in')):?>
					    <li><a href="<?php echo base_url();?>users/logout"><span class="glyphicon glyphicon-user"></span>Log out</a></li>
					<?php endif;?>	
				</ul>
				
			</div>
		</nav>
		<div class="container">
			<?php if($this->session->flashdata('user_registered')):?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_registered').'</p>'; ?>
			<?php endif; ?>
			<?php if($this->session->flashdata('post_created')):?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_created').'</p>'; ?>
			<?php endif; ?>
			<?php if($this->session->flashdata('post_updated')):?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_updated').'</p>'; ?>
			<?php endif; ?>
			<?php if($this->session->flashdata('post_deleted')):?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>'; ?>
			<?php endif; ?>
			<?php if($this->session->flashdata('login_failed')):?>
				<?php echo '<p class="alert alert-danger">'.$this->session->flashdata('login_failed').'</p>'; ?>
			<?php endif; ?>
			<?php if($this->session->flashdata('login_success')):?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('login_success').'</p>'; ?>
			<?php endif; ?>
			<?php if($this->session->flashdata('user_logout')):?>
				<?php echo '<p class="alert alert-success">'.$this->session->flashdata('user_logout').'</p>'; ?>
			<?php endif; ?>
			


			
		