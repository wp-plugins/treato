<div class="wrapper treato">

	<div class="option">
		<label for="treato_title">
			<?php _e( 'Title:', treato ); ?>
		</label>
		<input type="text" id="<?php echo $this->get_field_id('treato_title'); ?>" name="<?php echo $this->get_field_name('treato_title'); ?>" value="<?php echo $instance['treato_title']; ?>" class="treato_title">
	</div>

	<div class="option">
        <label for="treato_content">
			<?php _e( 'Content:', treato ); ?>
		</label>
		<br /><input type="radio" name="<?php echo $this->get_field_name('treato_content'); ?>" value="search"  <?php if ( $instance['treato_content'] == 'search'  ) echo 'checked="checked"'; ?> /><?php _e( 'Search box',   treato ); ?>
		<br /><input type="radio" name="<?php echo $this->get_field_name('treato_content'); ?>" value="title"   <?php if ( $instance['treato_content'] == 'title'   ) echo 'checked="checked"'; ?> /><?php _e( 'Post title',   treato ); ?>
		<br /><input type="radio" name="<?php echo $this->get_field_name('treato_content'); ?>" value="default" <?php if ( $instance['treato_content'] == 'default' ) echo 'checked="checked"'; ?> /><?php _e( 'Default search', treato ); ?>
		<input type="text" id="<?php echo $this->get_field_id('treato_search'); ?>" name="<?php echo $this->get_field_name('treato_search'); ?>" value="<?php echo $instance['treato_search']; ?>" class="treato_search">
	</div>

	<div class="option">
		<input type="checkbox" id="<?php echo $this->get_field_id('treato_poweredby'); ?>" name="<?php echo $this->get_field_name('treato_poweredby'); ?>" <?php if ( $instance['treato_poweredby'] ) echo 'checked="checked"'; ?>/>
        <label for="treato_poweredby">
			<?php _e( 'Powered by <a href="http://treato.com/">Treato.com</a>', treato ); ?>
		</label>
	</div>

</div><!-- /wrapper -->
