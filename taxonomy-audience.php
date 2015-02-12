<?php

// update URL if posting a new audience

if(! isset($_POST['ns-audience'])) {
	$segmentation->reset_segment(get_queried_object()->slug, 'audience');
}

get_header();

?>

<div class="tax_audience">
	
	<div class="tax_audience--main">
		
		<?php $audience_title = single_term_title('', false); ?>
		<h1><?php echo $audience_title; ?></h1>
		<div class="tax_audience--main--desc"><?php echo term_description(); ?></div>
		
	</div>
	
	<div class="tax_audience--sidebar">
		
		<?php get_search_form(); ?> 
		
	</div>
	
</div>

<div class="tax_audience">
	
	<div class="tax_audience--main">
		
		<div class="tax_audience--main--nav">
		
			<?php $tutorials_menu = new TutorialsMenu($segmentation); ?>
		
		</div>
	
	</div>
	
	<div class="tax_audience--sidebar tax_audience--sidebar-gray">
		<?php
				
		$args = array(
			'post_type' => 'tutorial',
			'posts_per_page' => 3,
			'tax_query' => array(
				array(
					'taxonomy' => 'audience',
					'terms' => get_queried_object()->term_id
				),
				array(
					'taxonomy' => 'spotlight',
					'field' => 'slug',
					'terms' => '1st'
				)
			)
		);
		
		$output = '';
		$query = new WP_Query($args);
							
		if ($query->have_posts()) {
			$output .= '<h4>First 3 Tutorials for '.$audience_title.'</h4>';
			$output .= '<ul id="tax_audience--sidebar--videos" class="tax_audience--sidebar--videos">';
			while ( $query->have_posts() ) {
				$query->the_post();
				$output .= '<li data-youtube="'.get_post_meta(get_the_id(), 'youtube', true).'"><a href="'.get_the_permalink().'">' . get_the_title() . '</a></li>';
			}
			$output .= '</ul>';
		}
		
		echo $output;
		
		unset($output);
		
		?>
	</div>

</div>

<?php get_footer(); ?>