<?php
/**
 * Template Name: Home
 * @package flores
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<?php $tilemenu = new WP_Query(array(
				'post_type' => 'tile-links',
				'posts_per_page' => 3
			)); ?>
			<?php while($tilemenu->have_posts()) : $tilemenu->the_post() ?>
			<div class="single-tile-wrapper">
				<div class="single-tile-title">
					<h2><?php the_title(); ?></h2>
				</div>
				<div class="image">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="button-wrapper">
					<button class="tile-button">
						<a href="https://<?php the_field('link'); ?>"><?php the_field('link_name'); ?></a>
					</button>
				</div>
				<div class="social-media">
					<?php if(get_field('social-media')): ?>
							<?php while(has_sub_field('social-media')): ?>
 							<a href="http://<?php the_sub_field('url'); ?>" target="_blank"><img src="<?php the_sub_field('image');?>" /></a>
 						<?php endwhile; ?>
					<?php endif; ?>
				</div><!-- social media -->
			</div>
			<?php endwhile; ?>


		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>