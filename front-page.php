<?php
/**
  * Template Name: Front Page
  */
?>

<?php get_header( 'front' );
      $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
      if(!$url){
        $url = get_site_url() . "/wp-content/themes/isc-uw-child/assets/images/service-team.jpg";
      }
      $mobileimage = get_post_meta($post->ID, "mobileimage");
      $hasmobileimage = '';
      if( !empty($mobileimage) && $mobileimage[0] !== "") {
        $mobileimage = $mobileimage[0];
        $hasmobileimage = 'hero-mobile-image';
      }
      $banner = get_post_meta($post->ID, "banner");
      $buttontext = get_post_meta($post->ID, "buttontext");
      $buttonlink = get_post_meta($post->ID, "buttonlink");   ?>


<div class="uw-body" style="padding:0;">

    <div class="uw-content" role='main'>

      <?php uw_site_title(); ?>
      <?php get_template_part( 'menu', 'mobile' ); ?>

      <div class="isc-homepage-hero" style="background-color: #0f0403; background-image: url(<?php echo $url ?>);">
          <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="sr-only">Main Content</h2>
                    <?php $custom = get_post_meta(450); ?>
                    <div class="isc-homepage-title"> <?php echo $custom["isc-hero-title"][0]?> </div>
                    <span class="udub-slant"><span></span></span>
                    <div style="margin-bottom:2em;"> <?php echo $custom["isc-hero-description"][0]; ?></div>
                    <p><a class="uw-btn" href="<?php echo $custom["isc-hero-link-url"][0]; ?>"><?php echo $custom["isc-hero-link-text"][0];?></a></p>
                </div>
                <div class="col-md-4 col-md-offset-2">
                    <div class="isc-homepage-shortcuts">
                        <h2>Shortcuts</h2>
                        <ul>
                            <?php get_quicklinks(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div id='main_content' class="container uw-body-copy isc-homepage-body" tabindex="-1" style="margin-top: -100px;">

          <div class="row">

              <div class="col-md-8 isc-homepage-featured">

                  <h2>Featured articles</h2>

                  <div class="row">
                       <?php
                       // Featured Pages
                       // Query finds the published pages marked featured page and lists their
                       // title and description on a card
                       $args = array(
                         'post_type'	=> 'page',
                         'post_status' => 'publish',
                         'meta_key'		=> 'isc-featured',
                         'meta_value'	=> 'YES'
                      );

                      $featured = get_pages( $args );

                      if (!$featured) {
                        echo "<div class='col-md-6'>No featured pages found!</div>";
                      } else {
                        foreach ($featured as $featured_page) { ?>
                          <div class="col-md-6">
                            <div class="isc-homepage-card">


                                <div style="margin:-40px; height:160px; overflow:hidden; margin-bottom:30px;">
                                      <?php
                                      $custom = get_post_custom($featured_page->ID);
                                      if (array_key_exists("featured-image", $custom)) {
                                          $image = $custom["featured-image"][0];
                                      } else {
                                        // default featured image?
                                        $image = 'john_Vidale-1022-X3.jpg';
                                      }
                                      ?>
                                     <img alt="" class="" src="<?php echo get_site_url() . '/wp-content/themes/isc-uw-child/assets/images/' . $image ?>">

                                 </div>

                              <h3>
                                <a href="<?php echo get_permalink($featured_page->ID); ?>">
                                <?php echo get_the_title($featured_page->ID); ?></a>
                              </h3>
                              <?php
                                $description = $custom["isc-featured-description"][0];
                                if (array_key_exists("cta", $custom)) {
                                    $description_text = $custom["cta"][0];
                                } else {
                                    $description_text = "Learn More";
                                }
                              ?>
                              <p><?php echo $description; ?></p>
                              <p><a class="uw-btn btn-sm" href="<?php echo get_permalink($featured_page->ID); ?>"><?php echo $description_text; ?></a></p>

                            </div>
                        </div>
                          <?php
                        }
                      }
                      ?>

                  </div>

              </div>
              <div class="col-md-4 isc-homepage-news">
                  <h2>News</h2>

                  <!-- loop news posts here
                        Gets numberposts of the posts that have been
                        published, and have their location set to homepage
                  -->

                  <div class="isc-homepage-news-content">
                      <?php

                       $args = array(
                              'numberposts' => '5',
                              'post_status' => 'publish',
                              'tax_query' => array(
                                array(
                                  'taxonomy' => 'location',
                                  'field'    => 'slug',
                                  'terms'    => 'homepage',
                                ),
                              ),);
                       $news_posts = new WP_Query($args);

                       if($news_posts->have_posts()) :
                          while($news_posts->have_posts()) :
                             $news_posts->the_post();
                             ?>

                             <h3>
                               <a href="<?php echo get_post_permalink($recent['ID']); ?>">
                               <?php echo the_title(); ?></a>
                             </h3>
                             <p>
                             <?php echo get_the_date() ?>
                             <p><?php echo
                             the_excerpt() ?></p>
                           </p>

                    <?php
                          endwhile;
                      else:
                        echo "No news posts found.";
                      endif;
                    ?>
                      <p><a class="uw-btn btn-sm" href="#">See all news</a></p>
                  </div>

                  <!-- end loop -->

              </div>
          </div>
      </div>

    </div>

  </div>

<?php get_footer(); ?>
