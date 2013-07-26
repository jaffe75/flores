<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package flores
 */
?>

	</div><!-- #main -->
</div><!-- #wrapper -->
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<p>&copy; <?php echo the_time('Y'); ?> <?php bloginfo('name'); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>