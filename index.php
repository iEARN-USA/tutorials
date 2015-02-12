<?php get_header(); ?>

<div class="intro">
	<h2>Welcome to iEARN tutorials,<br>teaching you how to learn with the world.</h2>
</div>

<div class="index">
	
	<div class="index--sidebar">
		
		<div class="index--sidebar--item index--sidebar--search">
			<h4>What do you need help with?</h4>
			<?php get_search_form(); ?> 
		</div>
		
		<div class="index--sidebar--item index--sidebar--new">
			<?php
			
			$args = array(
				'post_type' => 'tutorial',
				'tax_query' => array(
					array(
						'taxonomy' => 'spotlight',
						'field' => 'slug',
						'terms' => 'new'
					)
				)
			);
			
			$output = '';
			$query = new WP_Query($args);
								
			if ($query->have_posts()) {
				$output .= '<h4>Are you new to iEARN?</h4>';
				$output .= '<ul>';
				while ( $query->have_posts() ) {
					$query->the_post();
					$output .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$output .= '</ul>';
			}
			
			echo $output;
			
			?>
		</div>
		
		<div class="index--sidebar--item index--sidebar--popular">
			<?php
			
			$args = array(
				'post_type' => 'tutorial',
				'tax_query' => array(
					array(
						'taxonomy' => 'spotlight',
						'field' => 'slug',
						'terms' => 'popular'
					)
				)
			);
			
			$output = '';
			$query = new WP_Query($args);
								
			if ($query->have_posts()) {
				$output .= '<h4>Popular tutorials:</h4>';
				$output .= '<ul>';
				while ( $query->have_posts() ) {
					$query->the_post();
					$output .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$output .= '</ul>';
			}
			
			echo $output;
			
			?>
		</div>
		
		<div class="index--sidebar--item index--sidebar--resources">
			<h4>Resources</h4>
			<ul><?php
			 
			$args = array(
				'category'         => '24',
				'categorize'       => 0,
				'title_li'         => 0,
			);
			
			wp_list_bookmarks( $args );
			
			unset($args);
			
			?></ul>  
		</div>
		
	</div>
	
	<div class="index--main" id="index--main">
		
		<div class="index--main--video"><iframe src="http://player.vimeo.com/video/54670378?title=0&amp;byline=0&amp;portrait=0&amp;color=679ac9" width="717" height="403" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
		
		<div class="index--audience">
			<h3>Teachers</h3>
			<?php echo term_description(8, 'audience'); ?>
			<a class="btn" href="/audience/teachers">View Tutorials</a>
		</div>
		
		<div class="index--audience">
			<h3>Facilitators</h3>
			<?php echo term_description(9, 'audience'); ?>
			<a class="btn" href="/audience/facilitators">View Tutorials</a>
		</div>
		
		<div class="index--audience">
			<h3>Students</h3>
			<?php echo term_description(7, 'audience'); ?>
			<a class="btn" href="/audience/students">View Tutorials</a>
		</div>
		
	</div>
	
</div>



<?php get_footer(); ?>