<div class="treato">

<?php
	$title = apply_filters('widget_title', $instance['treato_title']);
	if ( $title ) echo $before_title . $title . $after_title;
?>

<?php
	if ( $treato_content == 'default' ):
		$concept = $treato_search;
	elseif ( $treato_content == 'title' ):
		$concept = the_title_attribute( array( 'echo' => '0' ) );
	else:
		$concept = ' ';
	endif;
?>
	<iframe src="http://treato.com/widgets/general/widget.html?concept=<?php echo $concept; ?>" scrolling="no" style="width:300px; height:350px;" class="treato_iframe"></iframe>

<?php
	if ( $treato_poweredby == true ) {
		echo '<br />';
		_e( 'Powered by <a href="http://treato.com/">Treato.com</a>', treato );
	}
?>

</div>
