<?php
$i = 0; 
$active = '';
$args = array(
	'post_type' => 'services',
	'posts_per_page' => 3,
	'meta_query' => array(
		array(
			'key' => 'featured',
			'compare' => '==',
			'value' => '1'
		)
	)

);

// the query
$the_query = new \WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>

	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); $i++; ?>
		<div class="col-sm-4" style="background-image: url(<?php the_post_thumbnail_url( 'full' ); ?>);">
			<h3><?php the_title(); ?></h3>
			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="btn btn-secondary">Learn More</a>
		</div>
	<?php endwhile; ?>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>