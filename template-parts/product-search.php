<?php
/**
 * Template part for searching products
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pome
 */

?>
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