<?php $page_id = get_query_var('page_id'); ?>
<?php if (has_post_thumbnail( $page_id ) ): ?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $page_id ), 'full' ); ?>
<?php endif; ?>

<?php
$args = array(
  'type'                     => 'post',
  'child_of'                 => 0,
  'parent'                   => '',
  'orderby'                  => 'term_id',
  'order'                    => 'ASC',
  'hide_empty'               => 0,
  'hierarchical'             => 1,
  'exclude'                  => '1',
  'include'                  => '',
  'number'                   => '',
  'taxonomy'                 => 'category',
  'pad_counts'               => false
);

$categories = get_categories( $args );
$current_category = get_category(get_query_var('cat' ))->slug;

?>


<section class="page-banner" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/river.jpg)">
  <h1 class="page-banner__header">news</h1>
  <h5 class="page-banner__text">Get the latest news from Port KC, including committee news, riverfront updates, and other Kansas City Downtown Riverfront happenings.</h5>
  <div class="secondary_menu">
    <ul class="news-nav" data-current="<?php echo $current_category; ?>">
      <li class="news-nav__item" data-slug="all">
        <a href="<?php echo home_url('/news' ); ?>">All</a>
      </li><!-- menu_item -->

      <?php foreach ($categories as $category) : ?>

        <?php if ($category->slug == $current_category): ?>

          <li class="news-nav__item active" data-slug="<?php echo $category->slug; ?>">
            <a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
          </li><!-- menu_item -->

        <?php else : ?>

        <li class="news-nav__item" data-slug="<?php echo $category->slug; ?>">
          <a href="<?php echo get_category_link( $category->term_id ); ?>"><?php echo $category->name; ?></a>
        </li><!-- menu_item -->

        <?php endif; ?>

      <?php endforeach; ?>
    </ul><!-- news-nav -->
  </div><!-- secondary_menu -->
</section><!-- page-banner -->

<section class="articles">
  <h2 class="articles__header">The Latest News from Port KC</h2>

  <?php if (!have_posts()) : ?>
    <div class="alert alert-warning">
      <?php _e('Sorry, no results were found.', 'roots'); ?>
    </div>
    <?php get_search_form(); ?>
  <?php endif; ?>
<?php global $row_id, $article_id; ?>
<?php $row_id = 1;
  $article_id = 1;
?>

  <?php while (have_posts()) : the_post(); ?>

    <?php if ($article_id == 1 ) : ?>
      <div class="article-row<?php echo $row_id ?>">
        <?php get_template_part('templates/contents/content'); ?>
        <?php $article_id++; // increment the counter for each post ?>

    <?php elseif ($article_id == 2 ) : ?>
      <div class="column-left column">
        <?php get_template_part('templates/contents/content'); ?>
        <?php $article_id++; // increment the counter for each post ?>

    <?php elseif ($article_id == 3 ) : ?>
      <?php get_template_part('templates/contents/content'); ?>
      <?php $article_id++; // increment the counter for each post ?>
      </div><!-- column-left -->

    <?php elseif ($article_id == 4 ) : ?>
      <div class="column-right column">
        <?php get_template_part('templates/contents/content'); ?>
        <?php $article_id++; // increment the counter for each post ?>

    <?php elseif ($article_id == 5 ) : ?>
      <?php get_template_part('templates/contents/content'); ?>
      <?php $article_id++; // increment the counter for each post ?>
      </div><!-- column-right -->
      </div><!-- article-row -->


      <?php if ($article_id > 5) : ?>
        <?php $article_id = 1; ?>

        <?php if ($row_id == 3) : ?>
          <?php $row_id = 1; ?>
        <?php else : ?>
          <?php $row_id++; ?>
        <?php endif; ?>
      <?php endif; ?>

    <?php endif; ?>
  <?php endwhile; ?>

  <?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="post-nav">
      <ul class="pager">
        <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
        <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
      </ul>
    </nav>
  <?php endif; ?>


</section><!-- articles -->
