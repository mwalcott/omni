<footer class="content-info">
<!--
  <div class="container">
    <?php dynamic_sidebar('sidebar-footer'); ?>
  </div>
-->
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-5 push-sm-7 contact">
				<?php the_field('address', 'option'); ?> - 
				<a href="tel:<?php the_field('phone_number', 'option'); ?>"><?php the_field('phone_number', 'option'); ?></a>
			</div>
			<div class="col-sm-2 social">
				<?php
				
					if( have_rows('social_accounts', 'option') ):
						echo '<ul>';
						while ( have_rows('social_accounts', 'option') ) : the_row(); ?>
							<li>
								<a href="<?php the_sub_field('account_url'); ?>" class="" rel="nofollow" target="_blank">
									<i class="fa fa-<?php the_sub_field('account_provider'); ?>" aria-hidden="true"></i>
								</a>
							</li>
						<?php endwhile;
						echo '</ul>';
					else :
					
					endif;
				
				?>				
			</div>
			<div class="col-sm-5 pull-sm-7 copyright">
				<?php echo date('Y'); ?> &copy; Omni Sprinkler Service and Landscaping – All Rights Reserved
			</div>
		</div>
	</div>
</footer>
