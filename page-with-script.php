<?php
/**
 * Template Name: Page With Script
 * 
 * This is simply a copy of the default page template, but with an added section for injecting scripts.
 * This template was created as it was getting difficult to manage JavasScript within WP's native editor (TinyMCE).
 * This template will inject the script that resides in the custom 'page-script' field of that page from WP.
 * @package isc-uw-child
 * @author Prasad Thakur <prasadt@uw.edu>
 */

get_header();
	  $url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
	  $sidebar = get_post_meta( $post->ID, 'sidebar' );   ?>

<div role="main">
	<script type="text/javascript">
		<?php 
			$script_array_delimited_by_commas = get_post_custom_values('page-script');
			foreach ($script_array_delimited_by_commas as $script_part) {
				echo $script_part;
			}
		?>
	</script>

	<?php uw_site_title(); ?>
	<?php get_template_part( 'menu', 'mobile' ); ?>

	<div class="container uw-body">

		<div class="row">
			<div class="col-md-12">

				<?php get_template_part( 'breadcrumbs' ); ?>
			</div>
		</div>

		<div class="row">

			<div class="uw-content col-md-9">

				<div id='main_content' class="uw-body-copy" tabindex="-1">

					<?php log_to_console( 'page.php' ) ?>

					<?php isc_title(); ?>

					<?php 

					the_modified_date('l, F j, Y', '<div class="isc-updated-date">Last updated ', '</div>');

					?>

					<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						the_content();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							  comments_template();
						}

					endwhile;
					?>

				</div>

			</div>

		</div>

	</div>

</div>

<?php get_footer(); ?>
