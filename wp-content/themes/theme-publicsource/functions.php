<?php

define( 'INN_MEMBER', true );

/**
 * Include theme files
 *
 * Based off of how Largo loads files: https://github.com/INN/Largo/blob/master/functions.php#L358
 *
 * 1. hook function Largo() on after_setup_theme
 * 2. function Largo() runs Largo::get_instance()
 * 3. Largo::get_instance() runs Largo::require_files()
 *
 * This function is intended to be easily copied between child themes, and for that reason is not prefixed with this child theme's normal prefix.
 *
 * @link https://github.com/INN/Largo/blob/master/functions.php#L145
 */
function largo_child_require_files() {
	require_once( get_stylesheet_directory() . '/homepages/layouts/publicsource.php' );
}
add_action( 'after_setup_theme', 'largo_child_require_files' );

/**
 * Include compiled style.css
 */
function publicsource_stylesheet() {
	wp_dequeue_style( 'largo-child-styles' );
	$suffix = (LARGO_DEBUG)? '' : '.min';
	$style_css = '/css/style' . $suffix . '.css';
	wp_enqueue_style(
		'publicsource',
		get_stylesheet_directory_uri() . $style_css,
		array(),
		filemtime( get_stylesheet_directory() . $style_css )
	);
}
add_action( 'wp_enqueue_scripts', 'publicsource_stylesheet', 20 );

/**
 * Include TypeKit fonts
 */
function publicsource_typekit() { ?>
	<script src="https://use.typekit.net/eve5vcp.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
<?php }
add_action( 'wp_head', 'publicsource_typekit' );


/**
 * Interstitial widget areas in story rivers
 */
function publicsource_register_sidebars() {

	$sidebars = array();
	
	$sidebars[] = array(
		'name' => __( 'Story River Interstitial 1', 'publicsource' ),
		'id' => 'story-river-interstitial-1',
		'description' => __( 'First interstitial widget area that appears on category/archive pages in the main river of stories after the 3rd story.', 'publicsource' ),
		'before_widget' => '<aside id="%1$s" class="%2$s clearfix">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widgettitle">',
		'after_title' 	=> '</h3>',
	);
	
	$sidebars[] = array(
		'name' => __( 'Story River Interstitial 2', 'publicsource' ),
		'id' => 'story-river-interstitial-2',
		'description' => __( 'Second interstitial widget area that appears on category/archive pages in the main river of stories after the 7th story.', 'publicsource' ),
		'before_widget' => '<aside id="%1$s" class="%2$s clearfix">',
		'after_widget' 	=> '</aside>',
		'before_title' 	=> '<h3 class="widgettitle">',
		'after_title' 	=> '</h3>',
	);

	foreach ( $sidebars as $sidebar ) {
		register_sidebar( $sidebar );
	}
}
add_action( 'widgets_init', 'publicsource_register_sidebars', 11); 

// hook on largo_loop_after_post_x action after posts 3 and 7
function publicsource_interstitial( $counter, $context ) {
	if ( $counter === 3 ) {
		echo '<div id="story-river-interstitial-1" class="interstitial">';
		dynamic_sidebar( 'story-river-interstitial-1' );
		echo '</div>';
	}
	if ( $counter === 7 ) {
		echo '<div id="story-river-interstitial-2" class="interstitial">';
		dynamic_sidebar( 'story-river-interstitial-2' );
		echo '</div>';
	}
}
add_action( 'largo_loop_after_post_x', 'publicsource_interstitial', 10, 2 );


/**
 * Add some more background color options for the widgets
 *
 * This function replaces largo's largo_widget_custom_fields_form
 *
 * @see https://secure.helpscout.net/conversation/454033198/1400?folderId=1219602
 * @uses add_action() 'in_widget_form'
 * @since Largo 0.5.5.4
 */
function publicsource_widget_custom_fields_form( $widget, $args, $instance ) {
	$desktop = ! empty( $instance['hidden_desktop'] ) ? 'checked="checked"' : '';
	$tablet = ! empty( $instance['hidden_tablet'] ) ? 'checked="checked"' : '';
	$phone = ! empty( $instance['hidden_phone'] ) ? 'checked="checked"' : '';
?>
	<label for="<?php echo $widget->get_field_id( 'widget_class' ); ?>"><?php _e('Widget Background', 'largo'); ?></label>
	<select id="<?php echo $widget->get_field_id('widget_class'); ?>" name="<?php echo $widget->get_field_name('widget_class'); ?>" class="widefat" style="width:90%;">
		<option <?php selected( $instance['widget_class'], 'default'); ?> value="default"><?php _e('Default', 'largo'); ?></option>
		<option <?php selected( $instance['widget_class'], 'rev'); ?> value="rev"><?php _e('Reverse', 'largo'); ?></option>
		<option <?php selected( $instance['widget_class'], 'no-bg'); ?> value="no-bg"><?php _e('No Background', 'largo'); ?></option>
		<option <?php selected( $instance['widget_class'], 'salmon'); ?> value="salmon"><?php _e('Salmon', 'largo'); ?></option>
		<option <?php selected( $instance['widget_class'], 'ps-blue'); ?> value="ps-blue"><?php _e('Public Source Blue', 'largo'); ?></option>
	</select>

	<p style="margin:15px 0 10px 5px">
	<input class="checkbox" type="checkbox" <?php echo $desktop; ?> id="<?php echo $widget->get_field_id('hidden_desktop'); ?>" name="<?php echo $widget->get_field_name('hidden_desktop'); ?>" /> <label for="<?php echo $widget->get_field_id('hidden_desktop'); ?>"><?php _e('Hidden on Desktops?', 'largo'); ?></label>
	<br />
	<input class="checkbox" type="checkbox" <?php echo $tablet; ?> id="<?php echo $widget->get_field_id('hidden_tablet'); ?>" name="<?php echo $widget->get_field_name('hidden_tablet'); ?>" /> <label for="<?php echo $widget->get_field_id('hidden_tablet'); ?>"><?php _e('Hidden on Tablets?', 'largo'); ?></label>
	<br />
	<input class="checkbox" type="checkbox" <?php echo $phone; ?> id="<?php echo $widget->get_field_id('hidden_phone'); ?>" name="<?php echo $widget->get_field_name('hidden_phone'); ?>" /> <label for="<?php echo $widget->get_field_id('hidden_phone'); ?>"><?php _e('Hidden on Phones?', 'largo'); ?></label>
	</p>

	<p>
		<label for="<?php echo $widget->get_field_id('title_link'); ?>"><?php _e('Widget Title Link <small class="description">(Example: http://google.com)</small>', 'largo'); ?></label>
		<input type="text" name="<?php echo $widget->get_field_name('title_link'); ?>" id="<?php echo $widget->get_field_id('title_link'); ?>"" class="widefat" value="<?php echo esc_attr( $instance['title_link'] ); ?>"" />
	</p>
<?php
}
add_action( 'wp_loaded', function() {
	remove_action( 'in_widget_form', 'largo_widget_custom_fields_form', 1 );
	add_action( 'in_widget_form', 'publicsource_widget_custom_fields_form', 1, 3 );
});
