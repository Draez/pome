<?php
/**
 * Template part for request Form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pome
 */

?>
<div id="requiry" class="white-popup mfp-hide">
    <div class="container">

        <div id="product-form">

            <div class="upper">
                <h3>Jätä tarjouspyyntö</h3>

                <a href="#mfp-close" class="mfp-close">Sulje</a>
            </div>

            <p>Haluan tarjouspyynnön tuotteesta <b><?php the_title(); ?></b></p>

            <?php echo do_shortcode('[contact-form-7 id="92" title="Tarjouspyyntö"]'); ?>

        </div>

    </div>
</div>

<a href="#requiry" class="product-link">
    <div class="product-link" id="tarjouspyynto">Jätä tarjouspyyntö</div>
</a>