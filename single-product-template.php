<?php
/**
Template name: Single Product -pohja

 */
get_header();

?>

<div id="content" class="content-area">
    <main role="main" id="main" class="site-main">

        <section id="product-info">
            <div class="container">

                <div class="upper">
                    <div class="current-product">
                        <div id="product-popup" class="white-popup mfp-hide">
                            <div class="container">

                                <button title="Close (Esc)" type="button" class="mfp-close">Sulje</button>

                                <form id="search-form-modal">
                                    <input type="text" placeholder="Kirjoita hakusana" name="keyword" id="keyword" onkeyup="fetch()"></input>
                                    <span id="clear"><?php include get_theme_file_path('/svg/close.svg'); ?></span>
                                </form>

                                <div id="datafetch">
                                    <div id="loaderDiv" style="display: none; padding: 160px;">
                                        <?php include get_theme_file_path('/svg/loader.svg'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="product-popup" class="white-popup mfp-hide">
                            <div class="container">

                                <button title="Close (Esc)" type="button" class="mfp-close">Sulje</button>

                                <form id="search-form-modal">
                                    <input type="text" placeholder="Kirjoita hakusana" name="keyword" id="keyword" onkeyup="fetch()"></input>
                                    <span id="clear"><?php include get_theme_file_path('/svg/close.svg'); ?></span>
                                </form>

                                <div id="datafetch">
                                    <div id="loaderDiv" style="display: none; padding: 160px;">
                                        <?php include get_theme_file_path('/svg/loader.svg'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a href="#product-popup" class="open-popup-link">
                            <div class="open-popup-link">Hae tuotteita</div>
                        </a>


                    </div>
                    <?php include('template-parts/request.php'); ?>

                </div>

                <div class="product_variation">

                    <?php echo do_shortcode('[wpb_childpages]'); ?>
                </div>


                <div class="row">

                    <?php
                    $images = get_field('tuotekuvat');

                    ?>
                    <div class="col-md-6">

                        <div class="slider">

                            <?php if (have_rows('tuotekuvat_ja_videot')) : ?>

                                <?php while (have_rows('tuotekuvat_ja_videot')) : the_row(); ?>

                                    <?php
                                    $choice = get_sub_field('valinta');
                                    $carousel_video = get_sub_field('video');
                                    $carousel_image = get_sub_field('kuva');
                                    ?>

                                    <?php if ($choice == 'Kuva') : ?>

                                        <div id="image-popups">
                                            <a href="<?php echo $carousel_image['url']; ?>" data-effect="mfp-zoom-in">
                                                <div class="item" style="background-image: url(<?php echo $carousel_image['url']; ?>); min-height: 450px;">

                                                </div>
                                            </a>
                                        </div>

                                    <?php else : ?>

                                        <?php
                                        function getVimeoThumb($id)
                                        {
                                            $vimeo = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
                                            echo $large = $vimeo[0]['thumbnail_large'];
                                        }


                                        ?>

                                        <a class="popup-vimeo" href="<?php echo $carousel_video; ?>">
                                            <?php
                                            $str = preg_replace('/\D/', '', $carousel_video);
                                            ?>
                                            <div class="item" style="background-image: url(<?php getVimeoThumb($str); ?>); min-height: 450px;">



                                            </div>
                                            <div class="play">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/play.png">
                                            </div>
                                        </a>


                                    <?php endif; ?>

                                <?php endwhile;
                        endif; ?>

                        </div>

                        <div class="product-description">
                            <h1><?php the_title(); ?></h1>
                            <?php while (have_posts()) {
                                the_post(); ?>
                                <?php the_content(); ?>
                            <?php } ?>
                        </div>


                    </div>
                    <div class="col-md-6">
                        <?php
                        $taulukko = get_field('taulukko');
                        if ($taulukko) {

                            echo '<table border="0">';

                            if ($taulukko['header']) {

                                echo '<thead>';

                                echo '<tr>';

                                foreach ($taulukko['header'] as $th) {

                                    echo '<th>';
                                    echo $th['c'];
                                    echo '</th>';
                                }

                                echo '</tr>';

                                echo '</thead>';
                            }

                            echo '<tbody>';

                            foreach ($taulukko['body'] as $tr) {

                                echo '<tr>';

                                foreach ($tr as $td) {

                                    echo '<td>';
                                    echo $td['c'];
                                    echo '</td>';
                                }

                                echo '</tr>';
                            }

                            echo '</tbody>';

                            echo '</table>';
                        } ?>
                        <?php include('template-parts/yksittaisen-tuotteen-tiedot.php'); ?>
                    </div>


                </div>


                <div class="other-products">
                    <?php if (have_posts()) while (have_posts())  the_post(); ?>
                    <h3><?php
                        foreach ((get_the_category()) as $category) {
                            echo $category->cat_name . ' ';
                        }
                        ?></h3>


                    <div class="col-md-12">
                        <div class="row">

                            <?php

                            $orig_post = $post;
                            global $post;

                            $tags = get_the_category();
                            $tag_ids = array();
                            foreach ($tags as $individual_tag)
                                $tag_ids[] = $individual_tag->term_id;
                            $args = array(
                                'post_type' => 'page',
                                'category__and' => $tag_ids,
                                'orderby'   => 'rand',
                                'post__not_in' => array($post->ID),
                                'posts_per_page' => 4
                            );


                            $my_query = new WP_Query($args);

                            if ($my_query->have_posts()) {
                                while ($my_query->have_posts()) {
                                    $my_query->the_post(); ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 bottom-margin">
                                        <div class="alakategoria-tuote"><a href="<?php echo esc_url(post_permalink()); ?>">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <div class="testi" style="background-image: url(<?php the_post_thumbnail_url(); ?>); min-height: 200px; background-size: cover;"></div>

                                                <?php else : ?>

                                                    <div class="testi" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/no-image.jpg'); min-height: 200px; background-size: cover; background-position: center;"></div>

                                                <?php endif; ?>


                                                <h3><?php the_title(); ?></h3>
                                                <span class="kategoria">
                                                    <?php $current_cat_id = the_category_ID(false);
                                                    echo  get_cat_name($current_cat_id);
                                                    ?>
                                                </span>
                                            </a></div>
                                    </div>
                                <?php }
                        }
                        $post = $orig_post;
                        wp_reset_query(); ?>


                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php include('template-parts/introduction.php'); ?>


    </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer(); ?>