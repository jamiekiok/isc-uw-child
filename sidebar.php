<?php if ( uw_has_sidebar() ) :  ?>

  <div class="col-md-4 uw-sidebar">
    <?php uw_sidebar_menu(); ?>
    <?php dynamic_sidebar( UW_Sidebar::ID ); ?>
	<?php if (is_page('Diversity Resources'))
	//	echo 'hi';
	?>
  </div>

<?php endif; ?>
