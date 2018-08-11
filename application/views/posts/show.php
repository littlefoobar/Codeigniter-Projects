<h3><?php echo $post['title']; ?></h3>
	<div class="row">
		<?php  if($post['post_image'] !== "no_image.jpg"):?>
			<div class="col-md-3">
				<img class="post-thumb" 
				src="<?php echo site_url();?>assets/images/
				<?php echo $post['post_image'];?>"</img>	
			</div>
		<?php endif;?>
		<div class="col-md-9">
			  <small class="post-date">Posted On: <?php echo gmdate('F j, Y', strtotime($post['created_at'])); ?>&nbsp;&nbsp;&nbsp;
				| &nbsp;&nbsp; Posted By :<?php if(isset($username)) echo $username;?> &nbsp; &nbsp;| &nbsp; &nbsp;&nbsp; <a href="<?php echo site_url('/posts/'.$post['slug']);?>">
				  	<span class="glyphicon glyphicon-comment"></span>
				</a> &nbsp;&nbsp;<?php if(isset($comment_count))  echo $comment_count;?> &nbsp;Comment 
				</small> 
			<div class="post-body">
				<?php echo $post['body']; ?>	
			</div>
		</div>
	</div>
<hr/>
<?php if($this->session->userdata('user_id') == $post['user_id'] || $this->session->userdata('username') == 'admin'):?>
	<?php echo form_open('/posts/delete/'.$post['id']);?>
		<input type="submit" value="Delete" class="btn btn-danger pull-right">
	<?php echo form_close();?>
		<a href="edit/<?php echo $post['slug'];?>" class="btn btn-primary pull-left">Edit </a>
<?php endif; ?>
<br/><br/>
<h3>Comments</h3>
<?php if(isset($comments) && count($comments)>0): ?>
	<?php foreach($comments as $comment):?>
		<div class="well">
		<h5><strong><?php echo $comment['name'];?></strong> says:</h5>
		<h5><?php echo date("F j, Y : g:i a", strtotime($comment['created_at'])); ?></h5>
		<br/>
			<p><?php echo $comment['comment'];?></p>
		</div>
	<?php endforeach;?>
<?php else :?>
	<p>No comments to display!!</p>
<?php endif;?> 	

<hr>
<h3>Post A Comment</h3>
<?php echo form_open('comments/create/'.$post['id']);?> 
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
		<label>Comment</label>
		<textarea class="form-control" name="body" placeholder="Enter body text"><?php echo set_value('body'); ?></textarea>
		<?php echo form_error('body', '<div class="error">', '</div>'); ?>
	</div>
	<input type="hidden" name='slug' value="<?php echo $post['slug'];?>">
	<button class="btn btn-primary" type="submit">Sumbit</button>
<?php form_close();?> 





	

