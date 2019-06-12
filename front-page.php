<?php
/**
 * The template for displaying front page
 *
 * Contains the closing of the #content div and all content after.
 * Initial styles for front page template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package pome
 */

get_header();
?>

<div id="content" class="content-area">
  <main role="main" id="main" class="site-main">

    <section id="products">
      <div class="container">

        <?php include('template-parts/product-search.php'); ?>

        <div class="wrapper">

          <?php if (have_rows('alatuotteet')) : ?>

            <?php while (have_rows('alatuotteet')) : the_row();
              $paakategoria = get_sub_field('paakategoria');
              $paakategoria_kuva = get_sub_field('paakategorian_kuva'); ?>

              <div class="paakategoria">
                <div class="close"><?php include get_theme_file_path('/svg/close.svg'); ?></div>
                <?php if ($paakategoria_kuva) : ?>
                  <div class="bg-kuva" style="background-image: url('<?php echo $paakategoria_kuva['url']; ?>');"></div>
                  <h3><?php echo $paakategoria; ?></h3>

                <?php else : ?>
                  <h3 style="margin: 40px 10px;"><?php echo $paakategoria; ?></h3>
                <?php endif; ?>
              </div>

              <style>
                .paakategoria:hover .bg-kuva {
                  filter: invert(34%) sepia(89%) saturate(6189%) hue-rotate(336deg) brightness(100%) contrast(103%);
                  -webkit-filter: invert(34%) sepia(89%) saturate(6189%) hue-rotate(336deg) brightness(100%) contrast(103%);
                  -moz-filter: invert(34%) sepia(89%) saturate(6189%) hue-rotate(336deg) brightness(100%) contrast(103%);
                  -o-filter:
                }
              </style>


              <?php if (have_rows('alakategoria')) : ?>
                <?php while (have_rows('alakategoria')) : the_row();

                  $nimi = get_sub_field('nimi');
                  $linkki = get_sub_field('linkki');
                  $kuva = get_sub_field('kuva');
                  $kategoria = get_sub_field('kategoria');
                  ?>


                  <div class="alakategoria-tuote">
                    <a href="<?php echo $linkki; ?>">
                      <img src="<?php echo $kuva['url']; ?>" alt="<?php echo $kuva['alt']; ?>">
                      <h3><?php echo $nimi; ?></h3>

                      <?php if ($kategoria) {
                        $kategoria = get_category($kategoria); ?>
                        <span class="kategoria"><?php echo $kategoria->name; ?></span>
                      <?php } ?>
                    </a>
                  </div>

                <?php endwhile; ?>

              <?php endif; ?>

            <?php endwhile; ?>

          <?php endif; ?>

        </div>

      </div>
    </section>

    <?php include('template-parts/introduction.php'); ?>


  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
