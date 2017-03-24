<header class="banner clearfix">
  <a class="brand" href="<?= esc_url(home_url('/')); ?>">
  	<img class="img-fluid" src="<?php the_field('logo', 'option'); ?>"/>
    <?php the_field('logo_heading', 'option'); ?>
    <span><?php the_field('logo_sub_heading', 'option'); ?></span>
  </a>
  <nav class="nav-primary float-right">
    <?php
    if (has_nav_menu('primary_navigation')) :
      wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
    endif;
    ?>
  </nav>
</header>
