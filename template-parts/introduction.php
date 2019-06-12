<?php
/**
 * Template part for introduction
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pome
 */
?>

<?php
$args = array('post_type' => 'esittely');

$the_query = new WP_Query($args);

?>

<section id="introduction">
    <div class="container">

        <div class="row">

            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                    <?php
                    $kuva = get_field('kuva');
                    $tekstit = get_field('tekstit');
                    ?>

                    <div class="col-md-6 bg" style="background-image: url('<?php echo $kuva['url']; ?>')">

                    </div>
                    <div class="col-md-6">
                        <?php echo $tekstit; ?>
                        <?php wp_nav_menu(array(
                            'theme_location'    => 'secondary',
                            'container'         => false,
                            'depth'             => 4,
                            'menu_class'        => 'menu-items',
                            'menu_id'           => 'main-menu',
                            'echo'              => true,
                            'fallback_cb'       => 'Air_Light_Navwalker::fallback',
                            'items_wrap'        => '<ul class="%2$s">%3$s</ul>',
                            'walker'            => new Air_Light_Navwalker(),
                        )); ?>
                    </div>

                <?php endwhile;
        endif; ?>

        </div>

    </div>
</section>