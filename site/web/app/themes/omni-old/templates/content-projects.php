<article <?php post_class('col-sm-4'); ?>>
  <a href="<?php the_permalink(); ?>">
	  <?php the_post_thumbnail('project-archive', array('class' => 'img-fluid')); ?>
	  <h2><?php the_title(); ?></?php>
  </a>
</article>
