<h2><?php echo $title;?></h2>
<?php if(count($posts) > 0): ?>
	<?php foreach($posts as $post): ?>
		<h3><?php echo $post['title']; ?></h3>
		<div class="row">
			<!-- <?php  //if($post['post_image'] !== "no_image.jpg"):?> -->
				<div class="col-md-3">
					<img class="post-thumb" 
					src="<?php echo site_url();?>assets/images/
					<?php echo $post['post_image'];?>"</img>	
			  	</div>
			<!-- <?php //endif;?>  -->
			<div class="col-md-9">
				<small class="post-date">Posted On: <?php echo gmdate('F j, Y', strtotime($post['created_at'])); ?>&nbsp;&nbsp;&nbsp;
				| &nbsp;&nbsp; Posted By :<?php if(isset($post['username'])) echo $post['username'];?> &nbsp; &nbsp;| &nbsp; &nbsp;&nbsp; <a href="<?php echo site_url('/posts/'.$post['slug']);?>">
				  	<span class="glyphicon glyphicon-comment"></span>
				</a> &nbsp;&nbsp;<?php if(isset($post['comment_count']))  echo $post['comment_count'];?> &nbsp;Comment 
				</small> 
				<br>
					<?php echo word_limiter($post['body'],70); ?>
					<br>
				<p><a class="btn btn-primary" href="<?php 
					echo site_url('/posts/'.$post['slug']);?>"> Read More </a>
		      	</p>
			</div>
		</div>
		<hr/>
	<?php endforeach;?>

	<div class="page-links"><?php echo $this->pagination->create_links();?></div>
<?php else: ?>
		<h4> No results found </h4>
<?php endif; 
