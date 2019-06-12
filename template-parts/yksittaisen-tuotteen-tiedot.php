<?php
/**
 * Template name: Varaosat
 */
?>

<?php if (get_field('myynti') != '' && get_field('myynti_yhteys1') != '' && get_field('myynti_yhteys2') != '' && get_field('varaosat') != '') { ?>

    <div class="product-sales">

        <h3><?php the_field('myynti'); ?></h3>

        <div class="row">
            <div class="col-md-6">
                <?php the_field('myynti_yhteys1'); ?>
            </div>
            <div class="col-md-6">
                <?php the_field('myynti_yhteys2'); ?>
            </div>

        </div>

        <?php the_field('varaosat'); ?>
        <?php echo do_shortcode('[contact-form-7 id="87" title="Varaosat -tiedustelu"]'); ?>

        <?php the_field('vidi'); ?>

    </div>


<?php } else { ?>

    <?php
    $args = array('post_type' => 'yksittainen_tuote');

    $the_query = new WP_Query($args);

    ?>
    <?php if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

            <div class="product-sales">

                <h3><?php the_field('myynti'); ?></h3>

                <div class="row">
                    <div class="col-md-6">
                        <?php the_field('myynti_yhteys_1'); ?>
                    </div>
                    <div class="col-md-6">
                        <?php the_field('myynti_yhteys_2'); ?>
                    </div>

                </div>

                <?php the_field('varaosat'); ?>
                <?php echo do_shortcode('[contact-form-7 id="87" title="Varaosat -tiedustelu"]'); ?>

            </div>

        <?php endwhile;
endif; ?>

<?php } ?>