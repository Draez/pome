<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package pome
 */

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

      </div><!-- .container -->
    </section>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();
