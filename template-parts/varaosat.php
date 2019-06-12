<?php
/**
 * Template name: Varaosat
 */
?>

<?php
get_header();

get_template_part('template-parts/hero', get_post_type()); ?>

<div id="content" class="content-area">
    <main role="main" id="main" class="site-main">
        <section id="other-pages">
            <div class="container">
                <?php while (have_posts()) {
                    the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1>', '</h1>'); ?>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->

                    <?php } ?>
                </article><!-- #post-## -->

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 left">
                            <p><?php the_field('kysymyksia_varaosista'); ?></p>
                        </div>
                        <div class="col-md-6 left">
                            <?php echo do_shortcode('[contact-form-7 id="87" title="Varaosat -tiedustelu"]'); ?>
                        </div>
                    </div>
                </div>

            </div><!-- .container -->
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
