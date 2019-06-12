<?php
/**
 * Template name: Ota yhteyttä
 */
?>

<?php
get_header(); ?>

<div id="content" class="content-area">
    <main role="main" id="main" class="site-main">

        <section id="contact">
            <div class="container">
                <header class="entry-header">
                    <?php the_title('<h1>', '</h1>'); ?>
                </header><!-- .entry-header -->

                <div class="col-md-12">
                    <div class="row">


                        <div class="col-md-6">

                            <p>Verkkolaskutusosoitteet tähän</p>

                            <div class="wrapper">

                                <?php if (have_rows('ihmiset')) : ?>

                                    <?php while (have_rows('ihmiset')) : the_row(); ?>

                                        <?php $people_picture = get_sub_field('kuva');
                                        $people_info = get_sub_field('tiedot'); ?>
                                        <div>
                                            <img src="<?php echo $people_picture['url'] ?>">
                                            <?php echo $people_info; ?>
                                        </div>

                                    <?php endwhile;
                            endif; ?>
                            </div>
                        </div>

                        <div class="col-md-6 form-contact">
                            <p>Ota yhteyttä meihin ja kerro minkälaisista tuotteista olet
                                kiinnostunut. Olemme sinuun yhteydessä.</p>
                            <?php echo do_shortcode('[contact-form-7 id="118" title="Ota yhteyttä"]'); ?>
                        </div>
                    </div>
                </div>
            </div><!-- .container -->
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
