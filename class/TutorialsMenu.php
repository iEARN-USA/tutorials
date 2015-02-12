<?php

class TutorialsMenu {
	
	protected $sections = array();
	protected $segmentation;
	
	public function __construct($seg) {
		
		$this->segmentation = $seg;
		
		$this->query_sections();
		
		$this->write_menu();
						
	}
	
	protected function query_sections() {
	
		$args = array(
			'type' => 'tutorial',
			'orderby' => 'slug',
			'taxonomy' => 'section'
		);
	
		$this->sections = get_categories($args);
	
	}
	
	protected function write_menu() {
		
		$output = '';
				
		foreach($this->sections as $section) {
			
			// gets this section's posts
			
			$args = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'section',
						'terms' => $section->term_id
					)
				)
			);
			
			// not the most scalable
			// when USA, show all but Intl only; when Intl, show all but USA
			
			switch($this->segmentation->actual['locale']) {
				
				case 'usa':
				
				$args['tax_query'][] = array(
					'taxonomy' => 'locale',
					'field' => 'slug',
					'terms' => 'intl-only',
					'operator' => 'NOT IN'
				);
				
				break;
				
				default:
												
				$args['tax_query'][] = array(
					'taxonomy' => 'locale',
					'field' => 'slug',
					'terms' => 'usa',
					'operator' => 'NOT IN'
				);
				
			}
			
			// the way this block is written, 
			// a tutorial must have an audience set for it to display when an audience is set globally
			
			if(! empty($this->segmentation->actual['audience'])) {
				$args['tax_query'][] = array(
					'taxonomy' => 'audience',
					'field' => 'slug',
					'terms' => $this->segmentation->actual['audience']
				);
			}
		
			$query = new WP_Query($args);
			
			// write the list
								
			if ($query->have_posts()) {
				$output .= '<div class="tutorials_menu">';
				$output .= '<h3>'.$section->name.'</h3>';
				$output .= '<ul>';
				while ( $query->have_posts() ) {
					$query->the_post();
					$output .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
				}
				$output .= '</ul>';
				$output .= '</div>';
			}
		
			wp_reset_postdata();
		
		}
		
		echo $output;
		
	}
	
}

?>