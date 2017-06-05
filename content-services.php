<?php $current_page_id = $post->ID; ?>

<?php
  // loop through the sub-pages of current page
  $childpages = new WP_Query( array(
    'post_type'      => 'page',
    'post_parent'    => $current_page_id,
    'posts_per_page' => 100,
    'orderby'        => 'menu_order'
  ));
 ?>

<?php
  $testimonial_args = array(
    'post_type'     => 'testimonial',
    'post_status'   => 'publish',
    'post_per_page' => 15
    );
  $testimonial = new WP_Query($testimonial_args);
?>

<?php
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
?>

<?php if (!empty($image)) : ?>

  <section class="page-banner" style="background-image: url(<?php echo $image[0]; ?>);">

<?php else : ?>

  <section class="page-banner" style="background-color: #231f20;">

<?php endif; ?>

    <h1 class="page-banner__header service-banner__header">
      <img class="service__icon" src="<?php echo meta('_bru_services_icon'); ?>" alt="">
      <?php the_title(); ?>
    </h1>
  </section>


<div class="services__body" style="background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/assets/img/bg.svg);">

  <section class="service_text shrink">
    <p class="service_hdg"><span><?php the_title(); ?></span> <span class="service_sub"><?php echo meta('_bru_service_sub'); ?></span></p>
    <?php the_content(); ?>
  </section>


  <section class="services__container">

    <?php while ( $childpages->have_posts() ) : $childpages->the_post(); ?>

      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>

      <a href="<?php the_permalink(); ?>">
        <article class="service_box" style="background-image: url(<?php echo $image[0]; ?>);">
          <h2 class="title"><?php the_title(); ?></h2>
          <p class="sub"><?php echo get_post_meta( $post->ID, '_bru_service_sub', 'true'); ?></p>
          <span class="more">Learn More</span>

        </article><!-- service_box -->
      </a>

    <?php endwhile; wp_reset_query(); ?>
  </section><!-- services__container -->


  <section class="testimonial">
    <h4 class="testimonial_lead">what our</h4>
    <h2 class="testimonial_hdg">Patients are saying</h2>
    <div class="quote">
      <?php if ($testimonial->have_posts()) : ?>
        <?php while ($testimonial->have_posts()) : $testimonial->the_post() ?>
          <article>
            <?php the_content( ); ?>
          </article>
        <?php endwhile; wp_reset_query();?>
      <?php endif; ?>
    </div>
  </section><!-- testimonial -->
</div>
