<?php
/**
 * The current version of the theme.
 *
 * @package pome
 */

define('AIR_LIGHT_VERSION', '4.6.3');

/**
 * Requires.
 */
require get_theme_file_path('/inc/functions.php');
require get_theme_file_path('/inc/menus.php');
require get_theme_file_path('/inc/nav-walker.php');

/**
 * Enable theme support for essential features.
 */
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
// add_theme_support( 'woocommerce' );

/**
 * Load textdomain.
 */
load_theme_textdomain('pome', get_template_directory() . '/languages');

/**
 * Define content width in articles
 */
if (!isset($content_width)) {
  $content_width = 800;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _air_light_widgets_init()
{
  register_sidebar(array(
    'name'          => esc_html__('Sidebar', 'pome'),
    'id'            => 'sidebar-1',
    'description'   => esc_html__('Add widgets here.', 'pome'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', '_air_light_widgets_init');

/**
 * Move jQuery to footer
 */
function air_light_move_jquery_into_footer($wp_scripts)
{
  if (!is_admin()) {
    $wp_scripts->add_data('jquery',         'group', 1);
    $wp_scripts->add_data('jquery-core',    'group', 1);
    $wp_scripts->add_data('jquery-migrate', 'group', 1);
  }
}
add_action('wp_default_scripts', 'air_light_move_jquery_into_footer');

/**
 * Enqueue scripts and styles.
 */
function air_light_scripts()
{
  $air_light_template = 'global.min';

  // Styles.
  wp_enqueue_style('styles', get_theme_file_uri("css/{$air_light_template}.css"), array(), filemtime(get_theme_file_path("css/{$air_light_template}.css")));

  // Scripts.
  wp_enqueue_script('jquery-core');
  wp_register_script('FroogaLoop', 'https://f.vimeocdn.com/js/froogaloop2.min.js', null, null, true);
  wp_enqueue_script('FroogaLoop');
  wp_enqueue_script('scripts', get_theme_file_uri('js/all.js'), array(), filemtime(get_theme_file_path('js/all.js')), true);

  // Required comment-reply script
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }

  wp_localize_script('scripts', 'air_light_screenReaderText', array(
    'expand'      => esc_html__('Open child menu', 'pome'),
    'collapse'    => esc_html__('Close child menu', 'pome'),
  ));
}
add_action('wp_enqueue_scripts', 'air_light_scripts');


// AJAX kutsu
add_action('wp_footer', 'ajax_fetch');
function ajax_fetch()
{ ?>

  <script type="text/javascript">
    function fetch() {
      jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: {
          action: 'data_fetch',
          keyword: jQuery('#keyword').val()
        },
        beforeSend: function() {
          if (jQuery('#keyword').val().length > 2) {
            jQuery("#loaderDiv").show();
          }
        },
        success: function(data) {
          if (jQuery('#keyword').val().length > 2) {
            jQuery('#datafetch').html(data);
          } else {
            jQuery('#datafetch').html('');
          }
        },
        complete: function() {
          jQuery("#loaderDiv").hide();
        }
      });
    }
  </script>
<?php
}

// Rekisteröidään Ajax kutsu
add_action('wp_ajax_data_fetch', 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'data_fetch');


// Haetaan dataa
function data_fetch()
{
  if (esc_attr($_POST['keyword']) == null) {
    die();
  }

  ?>
  <div class="modal-search">
    <div class="wrapper">
      <?php

      $the_query = new WP_Query(array('posts_per_page' => -1, 's' => esc_attr($_POST['keyword']), 'post_type' => 'page', 'compare' => 'LIKE'));
      if ($the_query->have_posts()) :

        while ($the_query->have_posts()) : $the_query->the_post();
          if (has_category()) : ?>

            <?php if (has_post_thumbnail()) : ?>
              <div class="alakategoria-tuote"><a href="<?php echo esc_url(post_permalink()); ?>">
                  <div class="testi" style="background-image: url(<?php the_post_thumbnail_url(); ?>); min-height: 200px; background-size: cover;"></div>
                  <h3><?php the_title(); ?></h3>
                  <span class="kategoria"><?php $current_cat_id = the_category_ID(false);
                                          echo get_cat_name($current_cat_id);
                                          ?></span>
                </a></div>

            <?php else : ?>
              <div class="alakategoria-tuote"><a href="<?php echo esc_url(post_permalink()); ?>">
                  <div class="testi" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/no-image.jpg'); min-height: 200px; background-size: cover; background-position: center;"></div>
                  <h3><?php the_title(); ?></h3>
                  <span class="kategoria"><?php $current_cat_id = the_category_ID(false);
                                          echo get_cat_name($current_cat_id);
                                          ?></span>
                </a></div>
            <?php endif; ?>
          <?php endif;
      endwhile;
      wp_reset_postdata();

    endif;
    wp_reset_query();
    ?> </div>
  </div> <?php
          die();
        }

        function add_categories_to_pages()
        {
          register_taxonomy_for_object_type('category', 'page');
        }
        add_action('init', 'add_categories_to_pages');


        function wpb_list_child_pages()
        {

          global $post;

          if (is_page() && $post->post_parent) {

            $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->post_parent . '&echo=0' . '&exclude=' . $post->ID);
            $parent = wp_list_pages('child_of = 91&title_li=&include=' . $post->post_parent . '&echo=0');
          } else {
            $childpages = wp_list_pages('sort_column=menu_order&title_li=&child_of=' . $post->ID . '&echo=0');
          }
          if ($childpages || $parent) {

            $string = '<ul class="variation-pages">' . $parent . $childpages . '</ul>';
          }

          return $string;
        }

        add_shortcode('wpb_childpages', 'wpb_list_child_pages');
