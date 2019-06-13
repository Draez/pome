<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package pome
 */

get_header();


// Block settings
if (is_front_page()) :
	$block_class = ' block-front';
else :
	$block_class = ' block-' . get_post_type();
endif;

// Featured image
if (has_post_thumbnail()) :
	$featured_image = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
else :
	$featured_image = get_theme_file_uri('images/palvelut.jpg');
endif;
?>

<div class="block<?php echo $block_class; ?>" style="background-image: url('<?php echo esc_url($featured_image); ?>');">
	<div class="shade"></div>

	<div class="hero-content">
		<div class="container">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
	</div>

</div>


<section class="service-content">
	<div class="container">


		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e('Tätä sivua ei ole olemassa.', 'air-light'); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">Palaa etusivulle</a>
		</div><!-- .page-content -->


	</div><!-- .container -->
</section><!-- .error-404 -->

<?php
get_footer();
