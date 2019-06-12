<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pome
 */

?>

<?php
$args = array('post_type' => 'footer');

$the_query = new WP_Query($args);

?>

</div><!-- #content -->

<footer role="contentinfo" id="colophon" class="site-footer">

	<div class="container bottom-border">
		<div class="row">
			<?php if ($the_query->have_posts()) : ?>
				<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

					<?php if (have_rows('yhteystiedot')) : ?>

						<?php while (have_rows('yhteystiedot')) : the_row(); ?>

							<?php
							$henkilon_tiedot = get_sub_field('henkilotiedot');
							?>
							<div class="col-lg-3 col-md-6 col-sm-6 border">
								<?php echo $henkilon_tiedot; ?>
							</div>

						<?php endwhile;
				endif; ?>
				<?php endwhile;
		endif; ?>

		</div>
	</div>

	<div class="footer-logo">
		<img src="<?php echo get_template_directory_uri(); ?>/images/pomelogo@2x.png">
	</div>


</footer><!-- #colophon -->

</div><!-- #page -->


<?php wp_footer(); ?>

</body>

</html>