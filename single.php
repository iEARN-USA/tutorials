<?php get_header(); ?>

<div class="single">
	
	<div class="single--content" id="single--content">
				
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<h1><?php the_title(); ?></h1>
		
		<?php edit_post_link('Edit', '<p>', '</p>'); ?>
		
		<div id="ytplayer"></div>
			
		<?php $youtube = get_post_meta(get_the_ID(),'youtube', true); ?>
			
		<script> var youtube = {}; youtube.video = <?php if(!empty($youtube)) { echo '"'.$youtube.'"'; } else { echo 'null'; } ?>; </script>
		
		<?php the_content(); ?>
		
		<?php endwhile; endif; ?>

	</div>
	
	<div class="single--nav"><?php $tutorials_menu = new TutorialsMenu($segmentation); ?></div>
	
</div>

<?php get_footer(); ?>