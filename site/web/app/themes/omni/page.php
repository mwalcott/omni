<?php while (have_posts()) : the_post(); ?>
  <?php 
		if( is_front_page() ) {
			
		} else {
			get_template_part('templates/page', 'header'); 	
		}
	?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
