<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Omni NameSpace
 */
namespace Omni;

/**
 * Custom image sizes
 */
add_image_size( 'project-archive', 1000, 750, true );

/**
 * Global options pages
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

/**
 * Hero
 */
function hero() { ?>
	<div id="hero" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<?php
				$i = 0; 
				$active = '';
				$args = array(
					'post_type' => 'projects',
					'posts_per_page' => 6,
					'meta_query' => array(
						array(
							'key' => 'featured',
							'compare' => '==',
							'value' => '1'
						)
					)
				
				);
				
				// the query
				$the_query = new \WP_Query( $args ); 
			?>
		
			<?php if ( $the_query->have_posts() ) : ?>
			
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); $i++; ?>
					<?php 
						if($i == 1) { 
							$active = 'active'; 
						} else {
							$active = '';
						}  
					?>
					<div class="carousel-item <?php echo $active; ?>" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
						<div class="carousel-caption d-none d-md-block">
							<h2><?php the_title(); ?></h2>
							<a href="<?php the_permalink(); ?>" class="btn btn-primary">View Project</a>
						</div>
					</div>
				<?php endwhile; ?>
			
				<?php wp_reset_postdata(); ?>
			
			<?php endif; ?>
		</div>
	</div>
<?php }
add_action('hero_hook', __NAMESPACE__ . '\\hero');

/**
 * Content Builder ACF
 */
function content_acf() { 

	// check if the flexible content field has rows of data
	if( have_rows('sections') ):
		$i = 0;
		// loop through the rows of data
		while ( have_rows('sections') ) : the_row(); $i++;
		
			$firstRow = '';
			if($i == 1) {
				$firstRow .= '<div class="row heading">';
				$firstRow .= '<div class="col-sm-10 offset-sm-1"><h1>' .get_sub_field('heading') . '</h1></div>';
				$firstRow .= '</div>';
			} else {
				$firstRow .= '<div class="row">';
				$firstRow .= '<h2>' .get_sub_field('heading') . '</h2>';
				$firstRow .= '</div>';
			}
		
			if( get_row_layout() == 'content_block' ) { ?>
				<?php echo $firstRow; ?>
				<div class="row content-block">
					<?php get_template_part('templates/acf/content-block'); ?>
				</div>
			<?php }

			if( get_row_layout() == 'service_block' ) { ?>
				<div class="row service-block">
					<?php get_template_part('templates/acf/service-block'); ?>
				</div>
			<?php }

			if( get_row_layout() == 'testimonial_carousel' ) { ?>
				<div class="row testimonial-carousel">
					<?php get_template_part('templates/acf/testimonial-carousel'); ?>
				</div>
			<? }
									
		endwhile;
	
	else :
	
		// no layouts found
	
endif;

}
add_action('content_builder', __NAMESPACE__ . '\\content_acf');

?>