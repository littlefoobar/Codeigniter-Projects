<h2><?php echo $title;?></h2>

<?php echo form_open_multipart('posts/create');?>
	<div class="form-group">
		<label>Title</label>
		<input type="text" class="form-control" name="title" placeholder="Enter title"
		 value="<?php echo set_value('title'); ?>">
		<?php echo form_error('title', '<div class="error">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Body</label>
		<textarea  id="editor" class="form-control" name="body"><?php echo set_value("body"); ?></textarea>
		<?php echo form_error('body', '<div class="error">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Upload Image</label>
		<input type="file" name="userfile"/>
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
<?php echo form_close();?>


   <script>
			CKEDITOR.replace( 'body' );
   </script>
