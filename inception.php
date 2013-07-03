<?php 

/*
Plugin Name: Inception Button
Plugin URI: lukereid.me
Description: Click it and find out.
Version: 1.0
Author: Luke Reid
Author URI: lukereid.me
License: GPLv2 or later
*/

class inception{
	function inception(){
		$inception = array(
			'classname'   => 'inception_class',
			'description' => 'Inception'
		);

		$this->WP_Widget('inception', 'Inception', $inception);
	}

	function widget($args, $instance){
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;
		echo $before_title . $title . $after_title;
		?>
			<button class="button inception">Inception</button>
		<?php

		echo $after_widget;

	}

}

add_action( 'admin_menu', 'inception_menu' );

function inception_menu(){
	add_options_page('Inception Options', 'Inception', 'manage_options', 'my-unique-indetifier', 'inception_options');
}

function inception_options(){
	if (!current_user_can('manage_options')){
		wp_die ( __('Surprise Motherfucker, No options for you.'));
	}?>
	<div class="wrap">
		<?php screen_icon();?>
		<h2> Inception Plugin </h2> 
		<p> Enter class/id that you want Inception to be applied to below. </p>
			<form action="options.php" method="post">
				<?php settings_fields('inception_options');?>
				<?php do_settings_sections('inception'); ?>
				<input name="Submit" type="submit" class="button-primary" value="Save Changes"/>
			</form>
	</div> <?php
}

add_action('admin_init', 'inception_admin_init');
function inception_admin_init(){
	register_setting('inception_options', 'inception_options', '');
	add_settings_section('inception_main', 'Inception Settings', 'inception_section_text', 'inception');
	add_settings_field('inception_text_string', 'Enter Class/ID:', 'inception_setting_input', 'inception', 'inception_main');
}

function inception_section_text(){
	echo '<p>Enter your settings here.</p>';
}

function inception_setting_input(){
	$option      = get_option('inception_options');
	$text_string = $option['text_string'];
	echo "<input id='text_string' name='inception_options[text_string]' type='text' value='$text_string'>";
}

function inception_head(){
	if (!is_admin()){
		echo '<script>';
		echo 'var plugin_url = "'.plugins_url().'/inception/";';
		echo '</script>';
		wp_enqueue_script( 'inception', $src = plugins_url().'/inception/script.js', $deps = 'jquery', $in_footer = false );
	}
}
add_action('wp_head', 'inception_head');


function inception_footer(){
	$option      = get_option('inception_options');
	wp_localize_script( 'inception', 'inception_options', $option['text_string'] );
}
add_action('wp_footer', 'inception_footer');

?>
