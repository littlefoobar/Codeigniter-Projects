<h2><?php echo $title;?></h2>

<?php echo validation_errors();?>

<?php echo form_open('posts/update');?>
<input type="hidden" name="id" value="<?php echo $post['id'];?>">
	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" name="title" placeholder="Enter title" value="<?php echo $post['title'];?>">
		<?php echo form_error('title', '<div class="error">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea class="form-control" id="editor" name="body" placeholder="Enter body text">
			<?php echo $post['body'];?>
		</textarea>
		<?php echo form_error('body', '<div class="error">', '</div>'); ?>
	</div>
	<div class="form-group">
		<img  
		src="<?php echo site_url();?>assets/images/
		<?php echo $post['post_image'];?>"</img>	
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close();?>
<script>
	CKEDITOR.replace('body');
</script>